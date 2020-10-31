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

    public function product()
    {
        return $this->hasMany('\App\Models\Product', 'category_id')->take(12);
    }

    public function sub_category()
    {
        return $this->hasMany('\App\Models\SubCategory', 'category_id');
    }
    public static function getFeaturedCats()
    {
        $data = Category::where('featured', 1)->where('image', '!=', NULL)->get();
        return $data;
    }
}
