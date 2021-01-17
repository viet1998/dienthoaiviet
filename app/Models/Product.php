<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table ="products";

    public function product_type(){
    	return $this->belongsTo('App\Models\Type_product','id_type','id'); //id của type product
    }

    public function company(){
    	return $this->belongsTo('App\Models\Company','id_company','id'); //id của type product
    }

    public function user_modified(){
        return $this->belongsTo(User::class,'last_modified_by_user','id'); //id của type product
    }
    
    public function product_variants(){
        return $this->hasMany(Product_variant::class,'id_product','id');
    }

    public function images(){
    	return $this->hasMany(Image::class,'id_product','id');
    }
}
