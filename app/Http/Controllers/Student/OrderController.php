<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        return view('student.orders.index');
    }

    public function getAllOrder(){
        return Order::where('user_id',auth()->id())->latest()->paginate();
    }
}
