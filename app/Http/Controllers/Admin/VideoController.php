<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VideoResource;
use App\Lesson;
use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function update(Request $request,Video $video){
        $video->name=$request->name;
        $video->url=$request->url;
        $video->save();
        return VideoResource::collection($video->lesson->videos());
    }

    public function delete(Video $video){
        $lesson=$video->lesson;
        $video->delete();
        return VideoResource::collection($lesson->videos);
    }

    public function store(Request $request ,Lesson $lesson){
        $lesson->videos()->create([
            'name'=>$request->name,
            'url'=>$request->url
        ]);
        return VideoResource::collection($lesson->videos);
    }
}
