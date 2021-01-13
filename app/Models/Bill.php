<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table ="bills";

    public function customer(){
    	return $this->belongsTo('App\Models\Customer','id_customer','id');
    }
    public function bill_detail(){
    	return $this->hasMany('App\Models\Bill_detail','id_bill','id');
    }
}
