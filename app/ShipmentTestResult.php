<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentTestResult extends Model
{
    protected $table = 'shipment_test_result';
     public $timestamps = false;
     protected $fillable = [
        'user_id','record_id','result','lab_id','testing_date','report_upload'
    ];

     public function labs(){
     	return $this->hasOne('\App\Labs','id','lab_id');
     }
}
