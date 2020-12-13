<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($v){
        return  date('Y-m-d',strtotime($v));
    }
}
