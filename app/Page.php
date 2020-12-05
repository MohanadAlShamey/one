<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];
    protected $with = ['user'];

protected $casts=[
    'group1'=>'object',
    'group2'=>'object',
    'group3'=>'object',
    'group4'=>'object',
    'group5'=>'object',
    'group6'=>'object',
    'group7'=>'object',
    'group8'=>'object',
    'group9'=>'object',
    'group10'=>'object',
    'group11'=>'object',
];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
















}
