<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','company','created_at','reg_at','status','site'
    ];
//public $timestamps=false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
protected $appends=['optionIds'];

    public function hasAnyRoles($roles){
        if(is_array($roles)){
            foreach ($roles as $role){
                if($this->hasRole($role)){
                    return true;
                }
            }
            return false;
        }else{
            return $this->hasRole($roles);
        }
    }


    public function hasRole($role){
        if($this->roles()->where('name',$role)->first()){
            return true;
        }
        return false;

    }







    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function sections(){
        return $this->hasMany(Section::class);
    }

    public function lessons(){
        return $this->belongsToMany(Lesson::class,'lesson_user');
    }

    public function examples(){
        return $this->belongsToMany(Example::class,'example_user');
    }

    public function example_user(){
        return $this->hasMany(ExampleUser::class,'user_id','id');
    }

    public function videos(){
        return $this->belongsToMany(Video::class,'user_video');
    }

    public function watches(){
        return $this->belongsToMany(Lesson::class,'watches');
    }

    public function jokers(){
        return $this->hasMany(Joker::class);
    }

    public function logs(){
        return $this->hasMany(Log::class);
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }

    public function pages(){
        return $this->hasMany(Page::class);
    }
    public function options(){
        return $this->belongsToMany(Option::class);
    }
public function hasOption($option){
        if($this->options()->where('name',$option)->first()){
            return true;
        }
        return false;
}
    public function getOptionIdsAttribute(){
        $data=[];
        foreach ($this->options as $option) {
           //return ($option);
            $data[]=$option->id;
        }
        return $data;
    }
}
