<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $table = 'revisions';
    public $timestamps = false;
    protected $fillable = [
        'importer_id','exporter_id','user_id','entry_port','uae_firs_number','uploaded_packaging_list','uploaded_invoices','qr_code','status',
        'zad_number','currency','shipment_method','shipment_method_type','export_country','discharge_port','arrival_date','products_type','amount','invoice_number','fob_value'
    ];

    public function revision_user(){
        return $this->hasOne('\App\AdminUser','id','user_id');
    }
     public function importer(){
     	return $this->hasOne('\App\Importer','id','importer_id');
     }

     public function exporter(){
     	return $this->hasOne('\App\Exporter','id','exporter_id');
     }
     public function shipment(){
        return $this->hasOne('\App\Shipment','uae_firs_number','uae_firs_number');
    }

     
     
}
