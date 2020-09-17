<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
   	protected $table = 'menu_items';
    public function get_child_cate()
    {
    	return $this->where('parent_id', $this->id)->orderBy('position')->get();
    }
}
