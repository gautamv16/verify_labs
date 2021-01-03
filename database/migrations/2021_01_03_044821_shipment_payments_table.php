<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShipmentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('shipment_id')->nullable();
            $table->string('record_id')->nullable();
            $table->string('card_number')->nullable();
            $table->string('expire_month')->nullable();
            $table->string('expire_year')->nullable();
            $table->string('type')->nullable();
            $table->string('cvv_number')->nullable();
            $table->string('fees')->nullable();
            $table->bigInteger('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_payments');
    }
}
