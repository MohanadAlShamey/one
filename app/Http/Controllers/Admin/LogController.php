<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Log;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(User $user){
        $start=Carbon::now()->subHours(48);

        $logs= Log::where('user_id',$user->id)->whereDate('at_date','>',$start)->orderBy('at_date','desc')->paginate();
       return view('admin.logs.index',compact('user','logs'));
    }

    public function update(Request $request){
        foreach($request->logs as $log){
            Log::findOrFail($log)->update([
                'status'=>'seen',
            ]);

        }
        return redirect()->back()->with('success','تم تعيين التسجيلات كمقروء');
    }

    public function asMark(User $user){
        foreach (Log::where('user_id',$user->id)->get() as $item) {
            $item->update(['status'=>'seen']);

        }
        return redirect()->back()->with('success','تم تعيين التسجيلات كمقروء');
    }
}
