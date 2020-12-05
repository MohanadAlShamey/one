<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExampleUser extends Model
{
    protected $guarded=[];
    protected $table='example_user';
public function example(){
    return $this->belongsTo(Example::class);
}

public function user(){
    return $this->belongsTo(User::class);
}
}
