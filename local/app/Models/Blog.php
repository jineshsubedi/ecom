<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'slug', 'image', 'tags'
    ];

    public function blog_tag()
    {
    	return $this->hasMany('\App\Models\BlogTag', 'blog_id');
    }
}
