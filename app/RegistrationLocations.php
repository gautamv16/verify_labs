<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationLocations extends Model
{
    protected $table = 'registration_locations';
    public $timestamps = false;
    protected $fillable = [ 'name','country_id','status'];
}
