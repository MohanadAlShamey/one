<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VideoResource;
use App\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function getVideos(Lesson $lesson){
        return VideoResource::collection($lesson->videos);
    }
}
