<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficeLocation extends Model
{
    protected $table = 'office_locations';
    public $timestamps = false;
    protected $fillable = [ 'name','status'];
}
