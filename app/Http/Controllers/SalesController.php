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
use Session;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "sales";
        $orderitems = OrderItem::where('order_id',Session::get('id'))->get();

        return view('sale',compact('title','orderitems'));
    }

    public function autocomplete(Request $request)
    {
        return Product::select('medicine_name')
        ->where('medicine_name', 'like', "%{$request->term}%")
        ->pluck('medicine_name');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'medicinename' => 'required',
            'quantity' => 'required',
        ],[
            'medicinename.required' => ' The medicine name field is required.',
            'quantity.required' => ' The quantity field is required.',
        ]);
        $alldata = Product::where(["medicine_name"=>$request->medicinename])->first();
        $category = Category::where(["id"=>$alldata->category_id])->first();
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
        $orderitem->medicine_name = $request->medicinename;
        $orderitem->price = $alldata->price;
        $orderitem->quantity = $request->quantity;
        $orderitem->total_amount = $alldata->price * $request->quantity;
        $orderitem->expire_date = $alldata->expire_date;
        $orderitem->batch_no = $alldata->batch;
        $orderitem->save();


        $notification = array(
            'message'=>"Product has been added",
            'alert-type'=>'success',
        );

        return back()->with($notification);
    }

    public function checkout()
    {
        $order_id = Session::get('id');
        return view('checkout',compact('order_id'));
    }

    public function checkoutadd(Request $request)
    {
        // dd($request->all());
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
        // return back();
        return view('purchaserecipt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'product'=>'required',
            'quantity'=>'required|integer'
        ]);
        $sold_product = Product::find($request->product);

        /**update quantity of
            sold item from
         purchases
        **/
        $purchased_item = Purchase::find($sold_product->purchase->id);
        $new_quantity = ($purchased_item->quantity) - ($request->quantity);
        if ($new_quantity > 0){

            $purchased_item->update([
                'quantity'=>$new_quantity,
            ]);

            /**
             * calcualting item's total price
            **/
            $total_price = ($request->quantity) * ($sold_product->price);
            Sales::create([
                'product_id'=>$request->product,
                'quantity'=>$request->quantity,
                'total_price'=>$total_price,
            ]);

            $notification = array(
                'message'=>"Product has been sold",
                'alert-type'=>'success',
            );
        }

        elseif($new_quantity <=3 && $new_quantity !=0){
            // send notification
            $product = Purchase::where('quantity', '<=', 3)->first();
            event(new PurchaseOutStock($product));
            // end of notification
            $notification = array(
                'message'=>"Product is running out of stock!!!",
                'alert-type'=>'danger'
            );

        }
        else{
            $notification = array(
                'message'=>"Please check purchase product quantity",
                'alert-type'=>'info',
            );
            return back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $sale = Sales::find($request->id);
        $sale->delete();
        $notification = array(
            'message'=>"Sales has been deleted",
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }
}
