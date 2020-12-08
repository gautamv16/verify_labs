<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupervisionLocations extends Model
{
   protected $table = 'supervision_locations';
   public $timestamps = false;
   protected $fillable = [ 'name','country_id','status'];
   public function country(){
      return $this->hasOne('\App\Country','id','country_id');
   }
}
