<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    protected $guarded=[];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function section(){
        return $this->belongsTo(Section::class);

    }

    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }
}
