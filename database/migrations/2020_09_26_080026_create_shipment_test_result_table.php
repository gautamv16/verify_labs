<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentTestResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_test_result', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('record_id');
            $table->smallInteger('result');
            $table->string('lab_id');
            $table->string('report_upload');
            $table->date('testing_date')->nullable();
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
        Schema::dropIfExists('shipment_test_result');
    }
}
