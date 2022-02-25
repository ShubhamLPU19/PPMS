<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_masters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('supplier_id')->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->string('medicine_name')->nullable();
            $table->string('batch')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('used_quantity')->nullable();
            $table->date('expire_date')->nullable();
            $table->string('company_name')->nullable();
            $table->decimal('price',10,2)->unsigned();
            $table->string('status')->nullable();
            $table->string('gst')->nullable();
            $table->text('location')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_masters');
    }
}
