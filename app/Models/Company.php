<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table ="companies";
    public function product(){
    	return $this->hasMany('App\Models\Product','id_company','id'); //id của type product
    }
}
