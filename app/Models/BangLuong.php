<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BangLuong extends Model
{
    protected $table = 'bang_luong';

    protected $fillable =[
    	'id_daily','luong_thang','money','bu_tru','noidung'
    ];
}
