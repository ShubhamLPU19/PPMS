<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('doctor_name')->nullable();
            $table->bigInteger('ipd_no')->nullable();
            $table->float('total_amount',10,2)->nullable();
            $table->float('paid_amount',10,2)->nullable();
            $table->float('due_amount',10,2)->nullable();
            $table->enum('status', ['open', 'close'])->default('open');
            $table->enum('type', ['purchase','return'])->default('purchase');
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
        Schema::dropIfExists('orders');
    }
}
