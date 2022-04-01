<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sales;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Notifications\StockAlert;
use App\Events\ProductReachedLowStock;
use App\Models\ProductBatch;
use App\Models\Customer;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index(){
        $title = "dashboard";

        $total_purchases = Purchase::where('expiry_date','=',Carbon::now())->count();
        $total_categories = Category::count();
        $total_suppliers = Supplier::count();
        $total_sales = Sales::count();

        $pieChart = app()->chartjs
                ->name('pieChart')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['Total Purchases', 'Total Suppliers','Total Sales'])
                ->datasets([
                    [
                        'backgroundColor' => ['#FF6384', '#36A2EB','#7bb13c'],
                        'hoverBackgroundColor' => ['#FF6384', '#36A2EB','#7bb13c'],
                        'data' => [$total_purchases, $total_suppliers,$total_sales]
                    ]
                ])
                ->options([]);


        $expireTreshold = Carbon::now()->addDays(60);
        $total_expired_products = ProductBatch::where('expiry_date', '<=', $expireTreshold)->count();
        $outofStockSoon = ProductBatch::where('available_quantity','<=',10)->count();
        $outofStock = ProductBatch::where('available_quantity','<=',0)->count();
        $sales = Customer::where(['sale_type'=>'purchase'])->whereDate('created_at','=',Carbon::now())->sum('amount');
        $return = Customer::where(['sale_type'=>'return'])->whereDate('created_at','=',Carbon::now())->sum('amount');
        $latest_sales = Sales::whereDate('created_at','=',Carbon::now())->get();
        $today_sales = Sales::whereDate('created_at','=',Carbon::now())->sum('total_price');
        $draft = Order::where(['status'=>'draft'])->whereDate('updated_at','=',Carbon::now())->count();
        return view('dashboard',compact(
            'title','pieChart','total_expired_products',
            'latest_sales','today_sales','total_categories','outofStock','outofStockSoon','sales','return','draft'
        ));
    }
}
