<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Log;
use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function visit(Video $video){
        auth()->user()->videos()->syncWithoutDetaching($video);
        Log::create([
            'user_id'=>auth()->id(),
            'task'=>'مشاهدة فيديو '. $video->name.'  من درس '.$video->lesson->name,
            'at_date'=>date('Y-m-d H:i',time())
        ]);
        return redirect()->to($video->url);
    }
}
