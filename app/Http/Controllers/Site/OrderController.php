<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Order;
use App\Page;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request,Page $page){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'address'=>'required',

        ]);
        Order::create([
            'user_id'=>$page->user_id,
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'note'=>$request->note,
        ]);
        return redirect()->back()->with('success',' شكرا لتواصلكم سيتم الرد في أقرب وقت');
    }
}
