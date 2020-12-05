<?php

namespace App\Http\Controllers\Admin;

use App\Example;
use App\ExampleUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ExampleResource;
use App\Http\Resources\Admin\ExampleUserResource;
use App\Lesson;
use App\User;
use Illuminate\Http\Request;

class ExampleController extends Controller
{

    public function index(){
        return view('admin.examples.all');
    }

    public function getAllData(){
        $examples=ExampleUser::latest('id')->paginate();
        return ExampleUserResource::collection($examples);
    }


    public function getUser(User $user){
        $examples=ExampleUser::where('user_id',$user->id)->latest()->paginate();
        return view('admin.examples.example_user',compact('examples','user'));
    }

    public function update(Request $request,Example $example){
        $example->name=$request->name;
        $example->body=$request->body;
        $example->save();
        return ExampleResource::collection($example->lesson->examples);
    }

    public function delete(Example $example){
        $lesson=$example->lesson;
        $example->delete();
        return ExampleResource::collection($lesson->examples);
    }

    public function store(Request $request ,Lesson $lesson){
        $lesson->examples()->create([
            'name'=>$request->name,
            'body'=>$request->body
        ]);
        return ExampleResource::collection($lesson->examples);
    }

    public function rateExample(Example $example,User $user,$notify=null){
        if($notify!=null){
           $not= auth()->user()->unReadNotifications()->where('id',$notify)->first();
          if($not){
              $not->markAsRead();
          }

        }
        return redirect()->route('dahsboard.logs.index',$user->id);
    }

    public function getData(Example $example , User $user){
        $ex=ExampleUser::where([
            'user_id'=>$user->id,
            'example_id'=>$example->id,
        ])->first();
        return new ExampleUserResource($ex);
    }

    public function getFile(ExampleUser $example){
        if(is_file(storage_path($example->files))){
            $expload=explode('.',storage_path($example->files));
            $ex=$expload[count($expload)-1];
            return response()->download(storage_path($example->files),$example->user->name.'-'.$example->example->lesson->name.$example->name.'.'.$ex);
        }
        return redirect(404);
    }

    public function rate(Request $request,ExampleUser $example){
//dd();
        $example->update([
            'rate'=>10
        ]);
        return redirect()->back();
    }
}
