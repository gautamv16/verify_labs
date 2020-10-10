<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentTest extends Model
{
    protected $table = 'shipment_test';
     public $timestamps = false;
     protected $fillable = [
        'user_id','record_id','supervision_location_id','lab_id','supervision_date','uploaded_files'
    ];

     public function supervisionLocation(){
     	return $this->hasOne('\App\SupervisionLocations','id','supervision_location_id');
     }

     public function labs(){
     	return $this->hasOne('\App\Labs','id','lab_id');
     }
}
