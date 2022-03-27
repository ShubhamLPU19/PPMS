<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory,Notifiable;

    protected $table = 'product_masters';
    protected $fillable = [
        'supplier_id','category_id',
        'medicine_name','brand_name','batch','quantity','expire_date','company_name','price','gst','location','status',
    ];



    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }
}
