<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'customer_id', 'product_id', 'unit_cost', 'quantity', 'total_cost'
    ];

    public function product_attachment()
    {
    	return $this->hasOne('\App\Models\ProductAttachment', 'product_id');
    }
    public static function countMyCartItem()
    {
    	$count = Cart::where('customer_id', auth()->user()->id)->count();
    	if($count == 0){
    		return '';
    	}
    	return $count;
    }
}
