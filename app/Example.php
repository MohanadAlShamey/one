<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    protected $guarded=[];
    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }

    public function students(){
        return $this->belongsToMany(User::class,'example_user');
    }
}
