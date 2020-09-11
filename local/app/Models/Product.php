<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'slug', 'category_id', 'sub_category_id', 'price', 'description', 'visits', 'featured'
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

    public function category()
    {
        return $this->belongsTo('\App\Models\Category');
    }
    public function sub_category()
    {
        return $this->belongsTo('\App\Models\SubCategory');
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
        return $data->product_attachment->file_name;
    }
}
