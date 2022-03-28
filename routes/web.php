<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\IPDReportController;
use App\Http\Controllers\DraftController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware'=>['guest']],function (){
    Route::get('login',[LoginController::class,'index'])->name('login');
    Route::post('login',[LoginController::class,'login']);
    Route::get('register',[RegisterController::class,'index'])->name('register');
    Route::post('register',[RegisterController::class,'store']);



    Route::get('forgot-password',[ForgotPasswordController::class,'index'])->name('forgot-password');
    Route::post('forgot-password',[ForgotPasswordController::class,'reset']);
});

Route::group(['middleware'=>['auth']],function (){
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('logout',[LogoutController::class,'index'])->name('logout');

    Route::get('categories',[CategoryController::class,'index'])->name('categories');
    Route::post('categories',[CategoryController::class,'store']);
    Route::put('categories',[CategoryController::class,'update']);
    Route::delete('categories',[CategoryController::class,'destroy']);

    Route::get('products',[ProductController::class,'index'])->name('products');
    Route::get('products/create',[ProductController::class,'create'])->name('add-product');
    Route::get('expired-products',[ProductController::class,'expired'])->name('expired');
    Route::get('products/{product}',[ProductController::class,'show'])->name('add-batch');
    Route::get('outstock-products',[ProductController::class,'outstock'])->name('outstock');
    Route::post('products/create',[ProductController::class,'store']);
    Route::post('products/{product}',[ProductController::class,'update']);
    Route::delete('products',[ProductController::class,'destroy']);
    Route::post('addBatch/{product}',[ProductController::class,'addBatch'])->name('addBatch');
    Route::get('editbatch/{product}',[ProductController::class,'batchEdit'])->name('editBatch');
    Route::post('updatebatch/{product}',[ProductController::class,'batchupdate'])->name('batchupdate');

    Route::get('suppliers',[SupplierController::class,'index'])->name('suppliers');
    Route::get('add-supplier',[SupplierController::class,'create'])->name('add-supplier');
    Route::post('add-supplier',[SupplierController::class,'store']);
    Route::get('suppliers/{supplier}',[SupplierController::class,'show'])->name('edit-supplier');
    Route::delete('suppliers',[SupplierController::class,'destroy']);
    Route::put('suppliers/{supplier}}',[SupplierController::class,'update'])->name('edit-supplier');

    Route::get('purchases',[PurchaseController::class,'index'])->name('purchases');
    Route::get('add-purchase',[PurchaseController::class,'create'])->name('add-purchase');
    Route::post('add-purchase',[PurchaseController::class,'store']);
    Route::get('purchases/{purchase}',[PurchaseController::class,'show'])->name('edit-purchase');
    Route::put('purchases/{purchase}',[PurchaseController::class,'update']);
    Route::delete('purchases',[PurchaseController::class,'destroy']);

    /* Sales */

    Route::get('sales',[SalesController::class,'index'])->name('sales');
    Route::post('sales',[SalesController::class,'store'])->name('addorder');
    Route::get('checkout',[SalesController::class,'checkout'])->name('checkout');
    Route::post('checkoutadd',[SalesController::class,'checkoutadd'])->name('checkoutadd');
    Route::put('itemupdate/{id}',[SalesController::class,'update'])->name('updateqty');
    Route::delete('itemdelete/{id}',[SalesController::class,'destroy'])->name('deleteitem');
    Route::get('salesrecipt/{id}',[SalesController::class,'salesrecipt'])->name('salesrecipt');
    Route::post('draft',[SalesController::class,'draft'])->name('draft');

    /* End of sale */

    /* Return */

    Route::get('return',[ReturnController::class,'index'])->name('return');
    Route::post('return',[ReturnController::class,'store'])->name('addorderreturn');
    Route::get('returncheckout',[ReturnController::class,'checkout'])->name('returncheckout');
    Route::post('checkoutaddreturn',[ReturnController::class,'checkoutaddreturn'])->name('checkoutaddreturn');
    Route::put('itemupdate/{id}',[ReturnController::class,'update'])->name('updateqtyreturn');
    Route::delete('itemdelete/{id}',[ReturnController::class,'destroy'])->name('deleteitemreturn');
    Route::get('autocompletereturn', [ReturnController::class, 'autocomplete'])->name('autocompletereturn');
    Route::get('returnreport',[ReturnController::class,'returnreport'])->name('returnreport');
    Route::get('returnrecipt/{id}',[ReturnController::class,'returnrecipt'])->name('returnrecipt');

    Route::get('ipdreport',[IPDReportController::class,'index'])->name('ipdreport');
    Route::get('viewipd/{ipd_id}', [IPDReportController::class,'viewipd'])->name('viewipd');

    Route::get('drafts',[DraftController::class,'index'])->name('drafts');
    Route::post('movetocart',[DraftController::class,'movetocart'])->name('movetocart');

    /* End of return */
    Route::get('permissions',[PermissionController::class,'index'])->name('permissions');
    Route::post('permissions',[PermissionController::class,'store']);
    Route::put('permissions',[PermissionController::class,'update']);
    Route::delete('permissions',[PermissionController::class,'destroy']);

    Route::get('roles',[RoleController::class,'index'])->name('roles');
    Route::post('roles',[RoleController::class,'store']);
    Route::put('roles',[RoleController::class,'update']);
    Route::delete('roles',[RoleController::class,'destroy']);

    Route::get('users',[UserController::class,'index'])->name('users');
    Route::post('users',[UserController::class,'store']);
    Route::put('users',[UserController::class,'update']);
    Route::delete('users',[UserController::class,'destroy']);

    Route::get('profile',[UserController::class,'profile'])->name('profile');
    Route::post('profile',[UserController::class,'updateProfile']);
    Route::put('profile',[UserController::class,'updatePassword'])->name('update-password');

    Route::get('settings',[SettingController::class,'index'])->name('settings');

    Route::get('notification',[NotificationController::class,'markAsRead'])->name('mark-as-read');
    Route::get('notification-read',[NotificationController::class,'read'])->name('read');

    Route::get('reports',[ReportController::class,'index'])->name('reports');
    Route::post('reports',[ReportController::class,'getData']);

    Route::get('backup',[BackupController::class,'index'])->name('backup-app');
    Route::get('backup-app',[BackupController::class,'database'])->name('backup-db');

    Route::get('autocomplete', [SalesController::class, 'autocomplete'])->name('autocomplete');
    Route::get('fetchdropdown',[SalesController::class, 'fetchdropdown'])->name('fetchdropdown');

});

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('test',[SalesController::class,'test']);
