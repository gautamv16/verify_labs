<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Labs extends Model
{
    protected $table = 'labs';
    public $timestamps = false;
    protected $fillable = [ 'name','address', 'email','contact_name','city','country','primary_contact','secondary_contact','lab_id','status'];
}
