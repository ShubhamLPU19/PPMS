<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_batch', function (Blueprint $table) {
            $table->id();
            $table->string('batch_name');
            $table->bigInteger('product_id');
            $table->float('price',10,2);
            $table->date('expiry_date');
            $table->string('location')->nullable();
            $table->float('available_quantity',10,2);
            $table->float('gst_percent',10,2);
            $table->float('gst',10,2);
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
        Schema::dropIfExists('product_batch');
    }
}
