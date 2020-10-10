<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_test', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('record_id');
            $table->bigInteger('supervision_location_id');
            $table->string('lab_id');
            $table->string('uploaded_files');
            $table->date('supervision_date')->nullable();
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
        Schema::dropIfExists('shipment_test');
    }
}
