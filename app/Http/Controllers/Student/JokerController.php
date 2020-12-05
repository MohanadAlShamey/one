<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Joker;
use App\Log;
use Illuminate\Http\Request;

class JokerController extends Controller
{
    public function pick(Joker $joker){
        if(auth()->id()==$joker->user_id && $joker->status=='active'){
            $joker->update([
                'status'=>'unactive',
                'used_at'=>date('Y-m-d')
            ]);
            Log::create([
                'user_id'=>auth()->id(),
                'task'=>'استخدام جوكر',
                'at_date'=>date('Y-m-d H:i',time())
            ]);
        }

        return redirect()->back();
    }

    public function getAll(){
        $month = date('Y-M', time());
        return Joker::where(['status' => 'active', 'user_id' => auth()->id()])->where(function ($query) use ($month) {
            $query->where('month', $month);
            $query->orWhere('type', 'sale');
        })->get();
    }
}
