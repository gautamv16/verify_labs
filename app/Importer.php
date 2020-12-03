<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Importer extends Model
{
    protected $table = 'importers';
    public $timestamps = false;
    protected $fillable = [
        'name','address','user_id',
        'email','contact_name','city','country','primary_contact','secondary_contact','status'
    ];

    public function countryName(){
    	return $this->hasOne('\App\Country','id','country');
    }
}
