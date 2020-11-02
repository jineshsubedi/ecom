<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'title', 'start_date', 'end_date', 'status', 'product', 'image'
    ];
}
