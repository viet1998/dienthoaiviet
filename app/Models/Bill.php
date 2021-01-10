<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table ="bills";

    public function customer(){
    	return $this->belongsTo('App\Customer','id_customer','id');
    }
    public function bill_detail(){
    	return $this->hasMany('App\Bill_detail','id_bill','id');
    }
}
