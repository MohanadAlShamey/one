<?php

namespace App\Http\Controllers\Admin;

use App\Attach;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AttachResource;
use App\Lesson;
use Illuminate\Http\Request;


class AttachController extends Controller
{
    public function getFile(Attach $attach){
      $file=  \request()->getRelativeUriForPath(asset('storage/'.$attach->url));
      $ar=explode('.',$file);
      $ex=$ar[count($ar)-1];
        return response()->download(storage_path($attach->url),$attach->name.'.'.$ex);

    }

    public function update(Request $request,Attach $attach){
        $attach->name=$request->name;
        $attach->save();
        return AttachResource::collection($attach->lesson->attaches);
    }

    public function delete(Attach $attach){
        if(is_file(storage_path($attach->url))){
            unlink(storage_path($attach->url));
        }
        $lesson=$attach->lesson;
        $attach->delete();
        return AttachResource::collection($lesson->attaches);

    }

    public function store(Request $request,Lesson $lesson){

        if($request->hasFile('url')){
          //  return $request->all();
            $ex = $request->file('url')->getClientOriginalExtension();
            $name = uniqid() . '.' . $ex;
            $path = 'app/public/files/' . $name;
            $request->file("url")->storeAs('public/files/', $name);
            $lesson->attaches()->create([
                'url'=>$path,
                'name'=>$request->name
            ]);
        }
        return AttachResource::collection($lesson->attaches);
    }
}
