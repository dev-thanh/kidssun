<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quyenloi extends Model
{
    protected $table = 'quyenloi';

    protected $fillable = ['hhds_dlbl','hhm_dlbl','hhds_dlpp','hhtk_dlbl','hhtk_dlpp'];
}
