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
    

    public function bill_detail(){
    	return $this->hasMany('App\Models\Bill_detail','id_product','id');
    }
}
