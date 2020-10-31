<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'name', 'email', 'description', 'rate', 'product_id', 'user_id'
    ];

    public static function avg_rate($id)
    {
    	return Rating::where('product_id', $id)->avg('rate');
    }
}
