<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'subject', 'message', 'status'
    ];

    public static function setMessageSeen($id)
    {
    	$data = Contact::find($id)->update(['status' => 1]);
    	return $id;
    }
}
