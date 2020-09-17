<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
	   protected $table = 'library_video';
	   
	   protected $fillable = [ 
		   'name', 'name_en', 'slug', 'image', 'banner', 'content', 'content_en', 'iframe_video', 
	   		'status', 'meta_title', 'meta_description', 'meta_keyword'
		];
}
