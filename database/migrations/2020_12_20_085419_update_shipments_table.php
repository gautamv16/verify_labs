<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipments', function (Blueprint $table) {            
            $table->bigInteger('export_country')->nullable();
            $table->string('zad_number')->nullable();
            $table->bigInteger('discharge_port')->nullable();
            $table->date('arrival_date')->nullable();
            $table->string('shipment_method')->nullable();
            $table->string('shipment_method_type')->nullable();
            $table->string('products_type')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('amount')->nullable();
            $table->bigInteger('currency')->nullable();
            $table->string('fob_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
