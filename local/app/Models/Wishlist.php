<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
        'customer_id', 'product_id'
    ];

    public static function checkIsWishlist($id)
    {
    	$data = Wishlist::where('product_id', $id)->where('customer_id', auth()->user()->id)->first();
    	if(isset($data->id))
    	{
    		return true;
    	}
    	return false;
    }

}
