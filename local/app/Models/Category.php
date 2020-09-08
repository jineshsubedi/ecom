<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title', 'image', 'slug', 'featured'
    ];

    public static function getTitle($id)
    {
    	$data = Category::find($id);
    	if($data)
    	{
    		return $data->title;
    	}
    	return '';
    }
}
