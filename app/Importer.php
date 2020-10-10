<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Importer extends Model
{
    protected $table = 'importers';
    public $timestamps = false;
    protected $fillable = [
        'name','address',
        'email','contact_name','city','country','primary_contact','secondary_contact','status'
    ];
}
