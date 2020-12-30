<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uae_firs_number')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('zad_number')->nullable();
            $table->bigInteger('importer_id')->nullable();
            $table->bigInteger('exporter_id')->nullable();
            $table->bigInteger('export_country')->nullable();
            $table->bigInteger('entry_port')->nullable();
            $table->bigInteger('discharge_port')->nullable();
            $table->date('arrival_date')->nullable();
            $table->string('shipment_method')->nullable();
            $table->string('shipment_method_type')->nullable();
            $table->string('products_type')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('fob_value')->nullable();
            $table->string('uploaded_invoices')->nullable();
            $table->string('uploaded_packaging_list')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revision');
    }
}
