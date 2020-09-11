<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id', 'total_cost', 'phone', 'address', 'payment_mode', 'status', 'order_date', 'delivery_date'
    ];

    public static function getOrderPaymentMode($id)
    {
    	if($id == 1){
    		return 'Cash On Delivery';
    	}
    	return '';
    }
    public static function getOrderStatus($id)
    {
    	if($id == 'order_pending'){
    		return 'Order Pending';
    	}
    	if($id == 'order_place'){
    		return 'Order Placed';
    	}
    	if($id == 'order_cancel'){
    		return 'Order Canceled';
    	}
    	if($id == 'order_success'){
    		return 'Order Success';
    	}
    	if($id == 'order_complete'){
    		return 'Order Complete';
    	}
    	return '';
    }
}
