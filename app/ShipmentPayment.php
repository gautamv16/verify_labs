<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentPayment extends Model
{
    protected $table = 'shipment_payments';
    public $timestamps = false;
    protected $fillable = [ 'id','shipment_id','record_id','card_number','expire_month','expire_year','cvv_number','type','fees','status'];
}
