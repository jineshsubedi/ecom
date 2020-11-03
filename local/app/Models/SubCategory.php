<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
        'title', 'category_id', 'slug'
    ];
    public function product()
    {
        return $this->hasMany('\App\Models\Product', 'sub_category_id')->orderBy('visits', 'desc')->take(12);
    }

    public static function getTitle($id)
    {
    	$data = SubCategory::find($id);
    	if($data)
    	{
    		return $data->title;
    	}
    	return '';
    }
    public static function countProductBySubCategory($id)
    {
        return \App\Models\Product::where('sub_category_id', $id)->count();
    }
}
