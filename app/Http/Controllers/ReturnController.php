<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Sales;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Events\PurchaseOutStock;
use App\Notifications\StockAlert;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
use App\Models\Customer;
use App\Models\ProductBatch;
use Session;

class ReturnController extends Controller
{
    public function index()
    {
        $title = "sales";
        $orderitems = OrderItem::where('order_id',Session::get('id'))->get();

        return view('return.index',compact('title','orderitems'));
    }

    public function autocomplete(Request $request)
    {
        $result = Product::select('product_masters.medicine_name','product_masters.id','product_batch.available_quantity','product_batch.expiry_date','product_batch.batch_name')
        ->leftjoin('product_batch','product_masters.id','=','product_batch.product_id')
        ->where('product_masters.medicine_name', 'like', "{$request->term}%")
        ->whereNotNull('product_batch.batch_name')
        ->where('product_batch.available_quantity','>',0)
        ->orderBy('product_batch.available_quantity','asc')
        ->orderBy('product_batch.expiry_date','asc')
        ->get();
        $response = array();
        foreach($result as $res){
            $response[] = array("name"=>$res->medicine_name,"qty"=>$res->available_quantity,"expiry"=>$res->expiry_date,"id"=>$res->id,"batch"=>$res->batch_name);
        }
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'medicinename' => 'required',
            'quantity' => 'required',
        ],[
            'medicinename.required' => ' The medicine name field is required.',
            'quantity.required' => ' The quantity field is required.',
        ]);
        $arrData = explode('_',$request->medicinename);
        $medicine_name = $arrData[0];
        $expiry = $arrData[1];
        $availQty = $arrData[2];
        $batch = $arrData[3];
        $product = Product::where(["medicine_name"=>$medicine_name])->first();
        $alldata = ProductBatch::where(["batch_name"=>$batch])->first();
        $category = Category::where(["id"=>$product->category_id])->first();
        if(empty(Session::get('id')))
        {
            $order = new Order();
            $order->status = "open";
            $order->save();
        }

        if(empty(Session::get('id'))){
            $id = $order->id;
            Session::put('id', $id);
        }

        $orderitem = new OrderItem();
        $orderitem->order_id = Session::get('id');
        $orderitem->medicine_category = $category->name;
        $orderitem->medicine_name = $medicine_name;
        $orderitem->price = $alldata->price;
        $orderitem->quantity = $request->quantity;
        $orderitem->total_amount = $alldata->price * $request->quantity;
        $orderitem->expire_date = $alldata->expiry_date;
        $orderitem->batch_no = $alldata->batch_name;
        $orderitem->gst_rate = $alldata->gst_percent;
        $orderitem->gst_amount = (($alldata->price * $request->quantity) *  $alldata->gst_percent)/100;
        $orderitem->save();

        ProductBatch::where(["batch_name"=>$batch])->increment("available_quantity", $request->quantity);
        $notification = array(
            'message'=>"Product has been added",
            'alert-type'=>'success',
        );

        return "Product Added to Cart.";
    }

    public function checkout(Request $request)
    {
        $order_id = Session::get('id');
        $total_amount = OrderItem::where(['order_id'=>$order_id])->sum('total_amount');
        return view('return.returncheckout',compact('order_id','total_amount'));
    }

    public function checkoutaddreturn(Request $request)
    {
        $customer = new Customer();
        $customer->order__id = $request->order_id;
        $customer->name = $request->name;
        $customer->doctor_name = $request->doctor_name;
        $customer->ipd_id = $request->ipd_no;
        $customer->sale_type = "return";
        $customer->payment_type = $request->payment_type;
        $customer->sub_total = $request->sub_total;
        $customer->amount = $request->amount;
        $customer->paid_amount = $request->paid_amount;
        $customer->left_amount = $request->amount > $request->paid_amount ? $request->amount - $request->paid_amount : 0;
        $customer->discount_percent = !empty($request->discount_percent) ? $request->discount_percent : 0;
        $customer->discount_amount = !empty($request->discount_percent) ? ($request->discount_percent/100)*$request->sub_total : 0;
        $customer->save();

        $order = Order::where(['id'=>$request->order_id])
            ->update([
                "name" => $request->name,
                "doctor_name" => $request->doctor_name,
                "ipd_no"=> $request->ipd_no,
                "total_amount" => $request->amount,
                "paid_amount" => $request->paid_amount,
                "status" => "Close",
            ]);
        if($order)
        {
            Session::forget('id');
        }
        $orderitems = OrderItem::where(['order_id'=>$request->order_id])->get();
        $customer = Customer::where(['order__id'=>$request->order_id])->first();
        return view('return.returnrecipt',compact('orderitems','customer'));
    }

    public function update(Request $request)
    {
        $orderItem = OrderItem::where(['id'=>$request->id])->first();
        $product = ProductBatch::where(['batch_name'=>$request->batch])->first();
        $countval = 0;
        if($orderItem->quantity > $request->qty)
        {
            $countval = $orderItem->quantity - $request->qty;
            OrderItem::where(['id'=>$request->id])->update(['quantity'=>$countval]);
            ProductBatch::where(["batch_name"=>$request->batch])->update(['available_quantity'=>$product->available_quantity + $countval]);
        }elseif($orderItem->quantity < $request->qty)
        {
            $countval = $request->qty - $orderItem->quantity;
            OrderItem::where(['id'=>$request->id])->update(['quantity'=>$request->qty ]);
            ProductBatch::where(["batch_name"=>$request->batch])->update(['available_quantity'=>$product->available_quantity - $countval]);
        }
        return "Product quantity updated.";
    }

    public function destroy(Request $request)
    {
        $orderitem = OrderItem::find($request->id);
        $orderitem->delete();

        ProductBatch::where(["batch_name"=>$request->batch])->increment('available_quantity',$request->qty);

        return "Product Removed From Cart.";
    }

    public function returnreport()
    {
        $returnreports = Customer::whereDate('created_at', Carbon::today())->where(["sale_type"=>"return"])->orderBy("id","desc")->get();
        return view("return.returnreport",compact('returnreports'));
    }

    public function returnrecipt(Request $request,$order_id)
    {
        $orderitems = OrderItem::where(['order_id'=>$order_id])->get();
        $customer = Customer::where(['order__id'=>$order_id])->first();
        return view('return.returnrecipt',compact('orderitems','customer'));
    }

}
