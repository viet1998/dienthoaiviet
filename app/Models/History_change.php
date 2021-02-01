<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History_change extends Model
{
    use HasFactory;
    protected $table ="history_changes";
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class,'id_user','id'); //id của type product
    }
}
