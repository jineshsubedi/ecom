<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
        'title', 'category_id', 'slug'
    ];

    public static function getTitle($id)
    {
    	$data = SubCategory::find($id);
    	if($data)
    	{
    		return $data->title;
    	}
    	return '';
    }
}
