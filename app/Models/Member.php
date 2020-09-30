<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Log_profits;


class Member extends Authenticatable
{
    protected $table = 'member';

    protected $fillable = ['full_name', 'user_name', 'password', 'email', 'phone','mentor','avartar','address','bank_account','bank_address','bank_name','so_cmnd','cmnd1','cmnd2','active','code','link_aff','bank_account_name','tiennap','lock'];

    public function doanh_Thu($id){
        $data = Log_profits::where('id_nguoinhan',$id)->get()->sum('money');
        // $money=0;
        // foreach ($data as $value) {
        //     $money+=$value->money;
        // }
        return $data;
    }
}
