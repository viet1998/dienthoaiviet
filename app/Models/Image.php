<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table="images";

    public function product(){
        return $this->belongsTo(Product::class,'id_product','id'); //id của type product
    }
    
    public function product_variant(){
        return $this->hasOne(Product_variant::class,'id_image','id');
    }
}
