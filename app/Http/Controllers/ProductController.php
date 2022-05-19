<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\ProductBatch;
use Illuminate\Http\Request;
use App\Notifications\StockAlert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "products";
        $products = DB::table('product_masters')
            ->select('product_masters.*','categories.name as cat_name','suppliers.name as sup_name')
            ->leftjoin('categories', 'product_masters.category_id', '=', 'categories.id')
            ->leftjoin('suppliers', 'product_masters.supplier_id', '=', 'suppliers.id')
            ->get();
        $batchId = DB::table('product_masters')->select('id')->groupBy('id')->get();
        return view('products',compact('title','products','batchId'));
    }

    public function create(){
        $title= "Add Product";
        $categories = Category::all();
        $suppliers = Supplier::all();
        // dd($suppliers);
        return view('add-product',compact(
            'title','categories','suppliers'
        ));
    }


    /**
     * Display a listing of expired resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function expired(){
        $title = "expired Products";
        $products = Purchase::whereDate('expiry_date', '=', Carbon::now())->get();

        return view('expired',compact(
            'title','products'
        ));
    }

    /**
     * Display a listing of out of stock resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function outstock(){
        $title = "outstocked Products";
        $products = Purchase::where('quantity', '<=', 0)->get();
        $product = Purchase::where('quantity', '<=', 0)->first();
        // auth()->user()->notify(new StockAlert($product));

        return view('outstock',compact(
            'title','products',
        ));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'medicine_name'=>'required|unique:product_masters',
            'category_id'=>'required|min:1',
            'supplier_id'=>'required',
        ]);
        $price = $request->price;
        if($request->discount >0){
           $price = $request->discount * $request->price;
        }
        Product::create([
            'supplier_id'=>$request->supplier_id,
            'category_id'=>$request->category_id,
            'medicine_name'=>$request->medicine_name,
            'brand_name' => $request->brand_name,
            'created_by'=> Auth::user()->id,
        ]);
        $notification=array(
            'message'=>"Product has been added",
            'alert-type'=>'success',
        );
        return redirect()->route('products')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    // Add Batch
    public function show(Request $request, $id)
    {
        $title = "Add Batch";
        $product = Product::find($id);
        $categories = DB::table('categories')->get();
        $suppliers = DB::table('suppliers')->get();
        return view('addbatch',compact(
            'title','product','categories','suppliers'
        ));
    }

    public function addBatch(Request $request)
    {
        $batch = new ProductBatch();
        $batch->batch_name = $request->batch_name;
        $batch->product_id = $request->product_id;
        $batch->price = $request->price;
        $batch->expiry_date = $request->expire_date;
        $batch->location = $request->location;
        $batch->available_quantity = $request->quantity;
        $batch->gst_percent = $request->gst_percent;
        $batch->gst = $request->gst_type;
        $batch->save();
        $notification=array(
            'message'=>"Batch has been added.",
            'alert-type'=>'success',
        );
        return redirect()->route('products')->with($notification);
    }

    public function batchEdit(Request $request, $id)
    {
        $product = ProductBatch::where(['product_id'=>$id])->first();
        $batchData = ProductBatch::where('product_id',$id)->get();
        return view('editbatch',compact('batchData','product'));
    }

    public function editProduct($id)
    {
        $product = Product::where(['id'=>$id])->first();
        $categories = Category::select('id','name')->get();
        $suppliers = Supplier::select('id','name')->get();
        return view('edit-product',compact('product','categories','suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        dd("test");
       $product->update([
            'supplier_id'=>$request->supplier_id,
            'category_id'=>$request->category_id,
            'medicine_name'=>$request->medicine_name,
            'brand_name'=>$request->batch,
        ]);
        $notification=array(
            'message'=>"Product has been updated",
            'alert-type'=>'success',
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::find($request->id);
        $product->delete();
        $batch = ProductBatch::where(["product_id"=>$request->id])->delete();
        $notification = array(
            'message'=>"Product has been deleted",
            'alert-type'=>'success',
        );
        return back()->with($notification);
    }

    public function batchupdate (Request $request)
    {
        $reqObj = $request->all();

        $obj = ProductBatch::find($reqObj['id'][0]);
        $date_count = $request->expire_date;
        for($i=0;$i<count($date_count);$i++){
            if(!empty($request->id[$i])){
                $query = DB::table('product_batch')
                ->where('id', $request->id[$i])
                ->update(array(
                    'batch_name' => $reqObj['batch_name'][$i],
                    'quantity' => $reqObj['quantity'][$i],
                    'expire_date' => $reqObj['expire_date'][$i],
                    'price' => $reqObj['batch_name'][$i],
                    'gst_percent' => $reqObj['gst_percent'][$i],
                    'location'  => $reqObj['location'][$i],
                ));
            }
            elseif (!empty($request->price[$i]) && !empty($request->price[$i]))
            {
                $obj = new ProductBatch();
                $obj->batch_name = $reqObj['batch_name'][$i];
                $obj->quantity = $reqObj['quantity'][$i];
                $obj->expire_date = $reqObj['expire_date'][$i];
                $obj->price = $reqObj['price'][$i];
                $obj->gst_percent = $reqObj['gst_percent'][$i];
                $obj->location = $reqObj['location'][$i];
                $obj->save();
            }
        }
        $notification=array(
            'message'=>"Product batch has been updated",
            'alert-type'=>'success',
        );
        return redirect()->route('products')->with($notification);
    }
}
