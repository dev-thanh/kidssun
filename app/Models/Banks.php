<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banks extends Model
{
    protected $table = 'banks';
    
    protected $fillable = ['name_bank','name_account','number','branch','status','image'];
}
