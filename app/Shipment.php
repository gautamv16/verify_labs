<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $table = 'shipments';
    public $timestamps = false;
    protected $fillable = [
        'importer_id','exporter_id','user_id','record_id','port_id','uae_firs_number','registration_location_id','uploaded_packaging_list','uploaded_invoices','qr_code','record_id','created_date',
        'zad_number','currency','shipment_method','shipment_method_type','export_country','discharge_port','arrival_date','products_type','amount','invoice_number','fob_value','status'
    ];

    public function shipment_user(){
        return $this->hasOne('\App\AdminUser','id','user_id');
    }
     public function importer(){
     	return $this->hasOne('\App\Importer','id','importer_id');
     }

     public function exporter(){
     	return $this->hasOne('\App\Exporter','id','exporter_id');
     }

     

     public function registrationLocation(){
     	return $this->hasOne('\App\Location','id','registration_location_id');
     }
     public function shipment_test(){
     	return $this->belongsTo('\App\ShipmentTest','record_id','record_id');
     }

     public function shipment_test_result(){
     	return $this->belongsTo('\App\ShipmentTestResult','record_id','record_id');
     }
}
