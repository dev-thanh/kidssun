<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $table = 'order_detail';

    protected $fillable = [
    	'order_id','mavd','product_id','qty','price','price_total'
	];

	public function Products()
    {
        return $this->belongsTo('App\Models\Products', 'product_id', 'id')->withTrashed();
    }
}
