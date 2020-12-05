<?php

namespace App\Http\Controllers\Student;

use App\Example;
use App\Helpers\Helper2;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Joker;
use App\Lesson;
use App\LessonUser;
use App\Section;
use App\SessionResive;
use App\Watch;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function indext($id = null)
    {

        $month = date('Y-M', time());
        $jokers = Joker::where(['status' => 'active', 'user_id' => auth()->id()])->where(function ($query) use ($month) {
            $query->where('month', $month);
            $query->orWhere('type', 'sale');
        })->get();

        if (!is_null($id)) {
            $lesson = Lesson::find($id);
            $start = \Carbon\Carbon::createFromFormat('Y-m-d h:i', date('Y-m-d', strtotime(auth()->user()->created_at)) . ' 05:00');
            $now = \Carbon\Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d', time()) . ' 23:59');
            $reg_days = $now->diff($start);
            $reg_at = auth()->user()->reg_at;
            $jockes = \App\Joker::where([
                'user_id' => auth()->id(),
                'status' => 'unactive'
            ])->count();
            $num_sat_sun = \App\Helpers\Helpers::get_num_sat_sun($start, $now);
            $num_day = \App\Helpers\Helpers::num_days_to_lesson($lesson);
            $isw = LessonUser::where([
                'lesson_id' => $lesson->id,
                'user_id' => auth()->id()
            ])->first();

            if ($num_day > ($reg_days->days - $num_sat_sun - $jockes - $reg_at) && is_null($isw)) {
                return redirect()->route('student.home');
            }

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
            $last_show = Watch::where([
                'user_id' => auth()->id(),
            ])->latest()->first();

            Helpers::last_open_lesson();
            $lesson = Helpers::is_reg_lesson();
            $next_lesson = Helpers::get_next_lesson($lesson);
            $sum_day = Helpers::sum_days($lesson);
            $sum_day_next = Helpers::sum_days($next_lesson);


            return view('student.home', compact('lesson', 'sum_day', 'sum_day_next', 'next_lesson'));
        }


        return view('student.lessons.index', compact('lesson', 'jokers'));
    }


    public function index($id = null)
    {
        Helper2::AddJoker();
        foreach (Section::orderBy('order')->get() as $section){
            foreach(Lesson::where('section_id',$section->id)->orderBy('order')->get() as $les){
                Helper2::is_date_active_of_lesson($les);
            }
        }

        if ($id != null) {
            $lesson = Lesson::find($id);
            if (!$lesson) {
                return redirect(404);
            }
            $l=LessonUser::where([
                'user_id'=>auth()->id(),
                'lesson_id'=>$lesson->id,
            ])->first();
            if(!Helper2::is_date_active_of_lesson($lesson) && !$l){
                return redirect(404);
            }
            $is_watch = Watch::where([
                'user_id' => auth()->id(),
                'lesson_id' => $lesson->id
            ])->first();
            if (!$is_watch) {
                Watch::create([
                    'user_id' => auth()->id(),
                    'lesson_id' => $lesson->id,
                    'section_id' => $lesson->section->id,
                    'show_in' => date('Y-m-d', time())
                ]);
            }

            return view('student.lessons.index', compact('lesson'));
        }
        $lesson = LessonUser::where(['user_id' => auth()->id()])->latest('show_in')->orderByDesc('id')->first()->lesson ?? null;
        if (!$lesson) {
            $lesson = Section::orderBy('order')->first()->lessons()->orderBy('order')->first();
        }
        $lessonsIds=[];
        foreach(Lesson::orderBy('section_id')->orderBy('order')->get() as $ls){
            $is= LessonUser::where([
                'user_id' => auth()->id(),
                'lesson_id' => $ls->id,
            ])->first();
            if(!is_null($is)){
                $lessonsIds[]=$ls->id;
            }
        }
        if(count($lessonsIds)>3){
            $ids= array_splice($lessonsIds,count($lessonsIds)-3,count($lessonsIds)-1);

        }else{
            $ids=$lessonsIds;
        }
        $examples=Example::whereIn('lesson_id',$ids)->get();


        return view('student.home', compact('lesson','examples'));
    }

    public function test()
    {
        return view('student.test');
    }

    public function resive_session(Request $request)
    {
        $type=$request->type=='pending'?'ok':$request->type;
        $last_sesstion=SessionResive::where('type','ok')->where('created_at','>',now()->subDay())->latest()->first();
        if($last_sesstion){
            $date=Carbon::parse($last_sesstion->resive_time)->addMinutes(20);
        }else{

            $date=Carbon::parse(Carbon::now('+3')->next('Saturday'));
            $date->addHours(14);
        }

        SessionResive::create([
            'user_id' => auth()->id(),
            'type' =>$type,
            'resive_time'=>$date,
        ]);

    }
}
