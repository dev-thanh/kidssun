<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    protected $table = 'recharge';

    protected $fillable = [
    	'sender','bankname','receiver','amount_money','image','trading_code','note','id_status','member_id'
	];
	
	public function member()
    {
    	return $this->belongsTo('App\Models\Member', 'member_id', 'id');
    }
}
