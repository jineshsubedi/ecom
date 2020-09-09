<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id', 'total_cost', 'phone', 'address', 'payment_mode', 'status'
    ];
}
