<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Image;

class Product_variant extends Model
{
    use HasFactory;
    protected $table ="product_variants";

    public function product(){
    	return $this->belongsTo('App\Models\Product','id_product','id'); //id của type product
    }
    public function user_modified(){
    	return $this->belongsTo(User::class,'last_modified_by_user','id'); //id của type product
    }
    
    public function image(){
    	return $this->hasOne(Image::class,'id','id_image');
    }

    public function bill_detail(){
    	return $this->hasMany('App\Models\Bill_detail','id_product_variant','id');
    }

}
