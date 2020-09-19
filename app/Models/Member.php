<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    protected $table = 'member';

    protected $fillable = ['full_name', 'user_name', 'password', 'email', 'phone','mentor','avartar','address','bank_account','bank_address','bank_name','so_cmnd','cmnd1','cmnd2','active','code','link_aff'];
}
