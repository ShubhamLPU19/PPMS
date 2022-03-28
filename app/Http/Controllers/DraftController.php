<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Session;

class DraftController extends Controller
{
    public function index()
    {
        $draftorders = Order::where(['status'=>"draft"])->get();
        return view('draft.index',compact('draftorders'));
    }

    public function movetocart(Request $request)
    {
        Session::put('id', $request->id);
        return redirect()->to('sales');
    }
}
