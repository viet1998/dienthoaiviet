<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table ="customer";

    public function bill(){
    	return $this->hasMany(Bill::class,'id_customer','id');
    }

    public function user_modified(){
    	return $this->belongsTo(User::class,'last_modified_by_user','id');
    }
}
