<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [ 'mavd','tongtien','id_member','ngay_giaodich','mentor','code','id_status'];
}