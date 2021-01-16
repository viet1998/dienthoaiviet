<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table ="bills";

    public function customer(){
    	return $this->belongsTo('App\Models\Customer','id_customer','id');
    }

    public function user(){
    	return $this->belongsTo(User::class,'id_user','id');
    }

    public function user_modified(){
    	return $this->belongsTo(User::class,'last_modified_by_user','id');
    }

    public function bill_detail(){
    	return $this->hasMany('App\Models\Bill_detail','id_bill','id');
    }

}
