<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'slug', 'category_id', 'sub_category_id', 'price', 'description', 'visits'
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

    public function product_attachment()
    {
        return $this->hasOne('\App\Models\ProductAttachment', 'product_id');
    }
    public function product_attachments()
    {
        return $this->hasMany('\App\Models\ProductAttachment', 'product_id');
    }
}
