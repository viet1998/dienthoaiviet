<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table ="slide";

    public function user_modified(){
        return $this->belongsTo(User::class,'last_modified_by_user','id'); //id của type product
    }
}
