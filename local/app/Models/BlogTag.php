<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    protected $fillable = [
        'blog_id', 'title',
    ];

    public static function getTitle($id)
    {
    	$data = BlogTags::findOrFail($id);
    	if($data){
    		return $data->title;
    	}
    	return '';
    }
}
