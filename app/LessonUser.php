<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonUser extends Model
{
    protected $guarded=[];
    protected $table='lesson_user';
    public $timestamps=false;

    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }
}
