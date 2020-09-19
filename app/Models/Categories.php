<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoryweb;

class Categories extends Model
{
    protected $table = 'categories';
    
    protected $fillable = [ 'name','slug','parent_id','image', 'meta_title', 'meta_description', 'meta_keyword', 'status', 'teamplate', 'type', 'level'];

    public function get_child_cate()
    {
        return $this->where('parent_id', $this->id)->get();
    }
}
