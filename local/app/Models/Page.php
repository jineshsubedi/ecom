<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'banner', 'status'
    ];

    public static function getFooterPages()
    {
    	$data = Page::where('status', 0)->limit('10')->get();
    	return $data;
    }
}
