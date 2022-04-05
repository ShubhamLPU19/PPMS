<?php

namespace App\Http\Controllers;
use App\Models\ProductBatch;

use Illuminate\Http\Request;

class ProductBatchController extends Controller
{
    public function index()
    {
        $title = "product Batch";
        $productbatch = \DB::table('product_masters')
            ->select('product_masters.medicine_name','product_batch.*')
            ->leftjoin('product_batch', 'product_masters.id', '=', 'product_batch.product_id')
            ->whereNotNull('product_batch.batch_name')
            ->orderBy('product_batch.batch_name','asc')
            ->get();
        return view('productbatch.index',compact('title','productbatch'));
    }

    public function batchEdit(Request $request, $id)
    {
        $productbatch = \DB::table('product_masters')
        ->select('product_masters.medicine_name','product_batch.*')
        ->leftjoin('product_batch', '.product_masters.id', '=', 'product_batch.product_id')
        ->whereNotNull('product_batch.batch_name')
        ->where(['product_batch.id'=>$id])
        ->first();
        // dd($productbatch);
        return view('productbatch.editbatch',compact('productbatch'));
    }

    public function batchupdate(Request $request)
    {
        ProductBatch::where(["id"=>$request->batchId])->update([
        "batch_name"=>$request->batch_name,
        "available_quantity" => $request->quantity,
        "expiry_date"=> $request->expire_date,
        "gst" => $request->gst_type,
        "price" => $request->price,
        "gst_percent" => $request->gst_percent,
        "location"  => $request->location
        ]);
        return redirect('/productbatch')->with("Product batch updated successfully");
    }

    public function statuschange(Request $request, $id)
    {
        ProductBatch::where(["id"=>$id])->update(["status"=>"inactive"]);
        return redirect()->back();
    }
}
