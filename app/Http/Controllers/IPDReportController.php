<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;

class IPDReportController extends Controller
{
    public function index(){
        $reports = Customer::whereNotNull('ipd_id')->where(["sale_type"=>"purchase"])->orderBy("ipd_id","desc")->groupBy('ipd_id')->get();
        // $reports = Customer::whereDate('created_at', Carbon::today())->whereNotNull('ipd_id')->orderBy("id","desc")->get();
        return view("ipd_report.index",compact('reports'));
    }

    public function viewipd(Request $request)
    {
        $ipdreportspurchase = Customer::where(["ipd_id"=>$request->ipd_id,"sale_type"=>"purchase"])->orderBy("id","desc")->get();
        $ipdreportsreturn = Customer::where(["ipd_id"=>$request->ipd_id,"sale_type"=>"return"])->orderBy("id","desc")->get();
        $totalPaid = Customer::where(["ipd_id"=>$request->ipd_id,"sale_type"=>"purchase"])->sum('paid_amount');
        $ipd_id = $request->ipd_id;
        return view("ipd_report.viewipdreport",compact('ipdreportspurchase','ipdreportsreturn','totalPaid','ipd_id'));
    }

    public function storeIpd(Request $request)
    {
        $customer = new Customer;
        $customer->amount = $request->amount;
        $customer->ipd_id = $request->ipd_id;
        $customer->sale_type = $request->sale_type;
        $customer->save();
        $purchase = Customer::where(["ipd_id"=>$request->ipd_id,"sale_type"=>"purchase"])->get();
        $return = Customer::where(["ipd_id"=>$request->ipd_id,"sale_type"=>"return"])->get();
        $customer = Customer::where(["ipd_id"=>$request->ipd_id])->orderBy("id","asc")->first();
        return view("ipd_report.ipdreport_print",compact('purchase','return','customer'));
    }
}
