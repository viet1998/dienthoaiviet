<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table ="news";

    public function user(){
    	return $this->belongsTo('App\Models\User','created_by_user','id'); //id của type product
    }

    public function user_modified(){
    	return $this->belongsTo('App\Models\User','last_modified_by_user','id'); //id của type product
    }
}
