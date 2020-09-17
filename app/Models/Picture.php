<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = 'library_image';
    
    protected $fillable = [ 'name','name_en', 'image', 'status'];
}
