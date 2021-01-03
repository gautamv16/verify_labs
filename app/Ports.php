<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ports extends Model
{
    protected $table = 'ports';
    
    public $timestamps = false;
    protected $fillable = [ 'id','name','country_id','status'];
}
