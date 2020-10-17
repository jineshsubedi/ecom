<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttachment extends Model
{
    protected $fillable = [
        'product_id', 'file_name'
    ];

    public static function getProductSingleImage($id)
    {
    	$data = ProductAttachment::where('product_id', $id)->first();
    	if(isset($data->id)){
    		$image = $data->file_name;
    	}else{
    		$image = 'theme/images/no-img.jpg';
    	}
    	return $image;
    }
}
