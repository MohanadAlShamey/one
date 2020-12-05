<?php

namespace App\Http\Controllers\Student;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Joker;
use App\Lesson;
use App\LessonUser;
use App\Section;
use App\Watch;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index($id = null)
    {
        Helpers::AddJokerToStudent();
        $month=date('Y-M',time());
        $jokers = Joker::where(['status'=>'active','user_id'=>auth()->id()])->where(function($query)use($month){
            $query->where('month',$month);
            $query->orWhere('type','sale');
        })->get();

        if (!is_null($id)) {
            $lesson = Lesson::find($id);
            if (!Helpers::is_active_lesson($lesson)) {
                return redirect(404);
            }
        }
        if ($id != null) {
            $lesson = Lesson::find($id);
            if (!is_null($lesson)) {
                $watch = Watch::where([
                    'user_id' => auth()->id(),
                    'lesson_id' => $lesson->id
                ])->first();
                if (is_null($watch)) {
                    Watch::create([
                        'user_id' => auth()->id(),
                        'lesson_id' => $lesson->id,
                        'section_id' => $lesson->section->id,
                        'show_in' => date('Y-m-d', time())
                    ]);
                }
            }
        } else {
            $last = Watch::where(['user_id' => auth()->id()])->latest()->first();
            if (!is_null($last)) {
                return redirect()->route('student.home', $last->lesson->id);
            } else {
                $section = Section::orderBy('order', 'asc')->first();
                if (!is_null($section)) {
                    $lesson = Lesson::where('section_id', $section->id)->orderBy('order', 'asc')->first();
                    if (!is_null($lesson)) {
                        $watch = Watch::where([
                            'user_id' => auth()->id(),
                            'lesson_id' => $lesson->id
                        ])->first();
                        if (is_null($watch)) {
                            Watch::create([
                                'user_id' => auth()->id(),
                                'lesson_id' => $lesson->id,
                                'section_id' => $lesson->section->id,
                                'show_in' => date('Y-m-d', time())
                            ]);
                        }
                    }

                }
            }
        }


        return view('student.lessons.index', compact('lesson', 'jokers'));
    }
}
