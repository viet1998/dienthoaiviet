<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill_detail extends Model
{
    protected $table ="bill_detail";

    public function product_variant(){
    	return $this->belongsTo(Product_variant::class,'id_product_variant','id');
    }
    public function bill(){
    	return $this->belongsTo('App\Bill','id_bill','id');
    }
}
