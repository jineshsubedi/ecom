<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'customer_id', 'product_id', 'unit_cost', 'quantity', 'total_cost'
    ];
}
