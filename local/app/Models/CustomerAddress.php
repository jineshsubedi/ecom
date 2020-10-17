<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $fillable = [
        'customer_id', 'first_name', 'last_name', 'email', 'phone_number', 'street', 'country', 'state', 'zip', 'city'
    ];

    public static function getMyAddress()
    {
    	if(auth()->user()->role == 'customer'){
    		$data = CustomerAddress::where('customer_id', auth()->user()->id)->latest()->first();
    	}else{
    		$data = '';
    	}
    	return $data;
    }
}
