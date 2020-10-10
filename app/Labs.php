<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Labs extends Model
{
    protected $table = 'labs';
    public $timestamps = false;
    protected $fillable = [ 'name','lab_id','status'];
}
