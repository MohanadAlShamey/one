<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
    public function getNotify(){
        $notify= auth()->user()->unreadNotifications()->latest()->limit(5)->get();
        $count=auth()->user()->unreadNotifications()->count();
        return [
            'notify'=>$notify,
            'count'=>$count
        ];
    }
}
