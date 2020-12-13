<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InspectionChecklist extends Model
{
    protected $table = 'inspection_checklist';
    protected $fillable = [ 'id','name','status'];
}
