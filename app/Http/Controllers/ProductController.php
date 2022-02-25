<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
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
        // $products = Product::all();
        $products = DB::table('product_masters')
            ->select('product_masters.*','categories.name as cat_name','suppliers.name as sup_name')
            ->leftjoin('categories', 'product_masters.category_id', '=', 'categories.id')
            ->leftjoin('suppliers', 'product_masters.supplier_id', '=', 'suppliers.id')
            ->get();
        // dd($products);
        return view('products',compact(
            'title','products',
        ));
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
            // 'product'=>'required|max:200',
            'price'=>'required|min:1',
            // 'discount'=>'nullable',
            // 'description'=>'nullable|max:200',
        ]);
        $price = $request->price;
        if($request->discount >0){
           $price = $request->discount * $request->price;
        }
        Product::create([
            'supplier_id'=>$request->supplier_id,
            'category_id'=>$request->category_id,
            'medicine_name'=>$request->medicine_name,
            'batch'=>$request->batch,
            'quantity'=>$request->quantity,
            'expire_date'=>$request->expire_date,
            'company_name'=>$request->company_name,
            'price'=>$request->price,
            'gst'=>$request->gst,
            'status'=> "Open",
            'location'=>$request->location,
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
    public function show(Request $request, $id)
    {
        $title = "Edit Product";
        $product = Product::find($id);
        $categories = DB::table('categories')->get();
        $suppliers = DB::table('suppliers')->get();
        return view('edit-product',compact(
            'title','product','categories','suppliers'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product)
    {
        $this->validate($request,[
            'price'=>'required',
        ]);

       $product->update([
            'supplier_id'=>$request->supplier_id,
            'category_id'=>$request->category_id,
            'medicine_name'=>$request->medicine_name,
            'batch'=>$request->batch,
            'quantity'=>$request->quantity,
            'expire_date'=>$request->expire_date,
            'company_name'=>$request->company_name,
            'price'=>$request->price,
            'gst'=>$request->gst,
            'status'=> "Open",
            'location'=>$request->location,
            'created_by'=> Auth::user()->id,
        ]);
        $notification=array(
            'message'=>"Product has been updated",
            'alert-type'=>'success',
        );
        return redirect()->route('products')->with($notification);
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
        $notification = array(
            'message'=>"Product has been deleted",
            'alert-type'=>'success',
        );
        return back()->with($notification);
    }
}
