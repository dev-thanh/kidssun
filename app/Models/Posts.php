<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';
    protected $fillable = [ 
        'name', 'name_en', 'slug' , 'desc' , 'desc_en' , 'content' , 'content_en' , 'image' , 'is_new',
        'type' , 'hot' , 'status' , 'meta_title' , 'meta_description' , 'meta_keyword', 'user_id'
	];

	public function Author()
    {
        return $this->hasOne('App\User', 'id', 'user_id'); 
    }
}
