<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log_profits extends Model
{
    protected $table = 'log_profits';

    protected $fillable = [
    	'id_donhang','id_capduoi','name_capduoi','id_nguoinhan','name_nguoinhan','money','id_status','name_status','ngay_nhan','active'
    ];

    public function doanh_Thu($id,$year,$month){
    	$start_format = $year.'-'.$month.'-01';
                   
        $end_format = $year.'-'.$month.'-31';

        $data = Log_profits::where([
        	'id_nguoinhan' => $id,
        	// 'active' => $id,
        ])->whereBetween('ngay_nhan', [$start_format, $end_format])->get()->sum('money');
        // $money=0;
        // foreach ($data as $value) {
        //     $money+=$value->money;
        // }
        return $data;
    }
}
