<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order__id');
            $table->string('name');
            $table->string('doctor_name');
            $table->integer('ipd_id');
            $table->string('sale_type');
            $table->float('amount',10,2);
            $table->float('paid_amount',10,2);
            $table->float('left_amount',10,2)->nullable();
            $table->float('discount_percent')->nullable();
            $table->float('discount_amount')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
