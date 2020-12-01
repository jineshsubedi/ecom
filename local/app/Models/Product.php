<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'slug', 'category_id', 'sub_category_id', 'main_category_id', 'price', 'description', 'brand', 'visits', 'featured', 'new', 'inventory'
    ];

    public static function getItemByProductId($id)
    {
    	$data = Product::find($id);
    	$item = \App\Models\Item::find($data->item_id);
    	return $item;
    }
    public static function getProductPrice($id)
    {
    	$data = Product::find($id);
    	if($data)
    	{
    		return $data->price;
    	}
    	else{
    		return 0.0;
    	}
    }
    public static function getProductInventory($id)
    {
        $data = Product::find($id);
        if($data)
        {
            return $data->inventory;
        }
        else{
            return 0;
        }
    }
    public static function getTitle($id)
    {
        $data = Product::find($id);
        if($data)
        {
            return $data->title;
        }
        else{
            return 0.0;
        }
    }
    public static function getSlug($id)
    {
        $data = Product::find($id);
        if($data)
        {
            return $data->slug;
        }
        else{
            return 0.0;
        }
    }
    public function category()
    {
        return $this->belongsTo('\App\Models\Category');
    }
    public function sub_category()
    {
        return $this->belongsTo('\App\Models\SubCategory');
    }
    public function main_category()
    {
        return $this->belongsTo('\App\Models\MainSubCategory');
    }
    public function product_attachment()
    {
        return $this->hasOne('\App\Models\ProductAttachment', 'product_id');
    }
    public function product_attachments()
    {
        return $this->hasMany('\App\Models\ProductAttachment', 'product_id');
    }

    public static function getMinimumPrice()
    {
        return Product::min('price');
    }
    public static function getMaximumPrice()
    {
        return Product::max('price');
    }
    public static function getAttachmentFromId($id)
    {
        $data = Product::find($id);
        if(isset($data->id)){
            return $data->product_attachment->file_name;
        }
        return '';
    }
    public static function getProductTopBrand()
    {
        $brands = Product::where('inventory','>',0)->where('brand', '!=', NULL)->orderBy('visits', 'desc')->orderBy('featured', 'desc')->groupBy('brand')->pluck('brand');
        return $brands;
    }
    public static function countProductByBrand($brand)
    {
        return Product::where('brand', $brand)->count();
    }
    public static function getInventory($id)
    {
        $data = Product::find($id);
        if($data)
        {
            return $data->inventory;
        }
        else{
            return 0.0;
        }
    }
}