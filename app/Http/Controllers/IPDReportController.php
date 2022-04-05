<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;

class IPDReportController extends Controller
{
    public function index(){
        $reports = Customer::whereDate('created_at', Carbon::today())->whereNotNull('ipd_id')->orderBy("id","desc")->get();
        return view("ipd_report.index",compact('reports'));
    }

    public function viewipd(Request $request)
    {
        $ipdreportspurchase = Customer::where(["ipd_id"=>$request->ipd_id,"sale_type"=>"purchase"])->orderBy("id","desc")->get();
        $ipdreportsreturn = Customer::where(["ipd_id"=>$request->ipd_id,"sale_type"=>"return"])->orderBy("id","desc")->get();
        return view("ipd_report.viewipdreport",compact('ipdreportspurchase','ipdreportsreturn'));
    }
}
