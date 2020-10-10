<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    protected $table = 'admin_users';
    protected $fillable = [
        'first_name','last_name',
        'email','password','office_location_id','role_id','primary_contact','secondary_contact','status'
    ];
}
