<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log_profits extends Model
{
    protected $table = 'log_profits';

    protected $fillable = [
    	'id_donhang','id_capduoi','name_capduoi','id_nguoinhan','name_nguoinhan','money','id_status','name_status','ngay_nhan'
    ];
}
