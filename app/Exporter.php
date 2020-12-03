<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exporter extends Model
{
    protected $table = 'exporters';
     public $timestamps = false;
    protected $fillable = [
        'name','address','approved_farm','user_id',
        'email','contact_name','city','country','primary_contact','secondary_contact','status'
    ];

    public function countryName(){
    	return $this->hasOne('\App\Country','id','country');
    }
}
