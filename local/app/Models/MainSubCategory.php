<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainSubCategory extends Model
{
    protected $fillable = [
        'title', 'category_id', 'slug', 'sub_category_id'
    ];

    public static function getTitle($id)
    {
    	$data = MainSubCategory::find($id);
    	if($data)
    	{
    		return $data->title;
    	}
    	return '';
    }
}
