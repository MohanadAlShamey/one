<?php

namespace App\Http\Controllers\Student;

use App\Example;
use App\ExampleUser;
use App\Http\Controllers\Controller;
use App\Log;
use App\Notifications\Admin\CompleteExampleNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ExampleController extends Controller
{
    public function index(Example $example){
if(auth()->user()->examples()->where('example_id',$example->id)->first()){
    return redirect()->route('student.home');
}

        return view('student.examples.index',compact('example'));
    }

    public function store(Request $request,Example $example){
        $this->validate($request,[
            'pdf'=>'required|max:30720'
        ],[
            'pdf.required'=>'ملف التدريب مطلوب',
            'pdf.max'=>'الملف كبير جدا الحد المسموح هو 30 ميغا بايت فقط'
        ]);
       $url='';
        if($request->hasFile('pdf')){
            $name=uniqid().'.'.$request->file('pdf')->getClientOriginalExtension();
            $path='app/public/files/';
            $request->file('pdf')->storeAs('public/files',$name);
            $url=$path.$name;
        }
        $id=auth()->user()->examples()->syncWithoutDetaching([$example->id=>[
            'body'=>$request->body,
            'files'=>$url,
        ]]);
        $admins=User::where(function($query){
            $query->whereHas('roles',function($query){
               $query->where('name','admin');
            });
        })->get();

        $data=[
            'user'=>auth()->user()->name,
            'user_id'=>auth()->id(),
            'example_name'=>$example->name,
            'example_id'=>$example->id,
            'url'=>url('/')
        ];
        Log::create([
            'user_id'=>auth()->id(),
            'task'=>'تنفيذ التدريب: '.$example->name.' من الدرس '. $example->lesson->name,
            'at_date'=>date('Y-m-d H:i',time())
        ]);
        Notification::send($admins,new CompleteExampleNotification($data));

return redirect()->route('student.home',$example->lesson->id)->with('success','تم تسليم التدريب');
    }
}
