<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded=[];

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function videos(){
        return $this->hasMany(Video::class);
    }

    public function attaches(){
        return $this->hasMany(Attach::class);
    }

    public function examples(){
        return $this->hasMany(Example::class);
    }

    public function students(){
        return $this->belongsToMany(User::class,'watches');
    }



    public function scopeOrder(){
        return $this->orderBy('order');
    }

  /*  public function scopeActive(){
        return $this->where('status',1);
    }*/
}
