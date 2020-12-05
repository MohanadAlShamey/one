<?php
/**
 * Created by PhpStorm.
 * User: mohannad
 * Date: 15/10/2020
 * Time: 09:03 ص
 */

namespace App\Helpers;


use App\ExampleUser;
use App\Joker;
use App\Lesson;
use App\LessonUser;
use App\Section;
use App\User;
use App\UserVideo;
use Carbon\Carbon;

class Helper2
{


    public static function WeekEndNum(User $user = null)
    {
        $user = $user ?? auth()->user();
        //dd($user);
        $num =0;
        $start_date = Carbon::parse($user->created_at);

        $current_date = Carbon::parse($start_date)->startOfDay();
        $now = Carbon::now()->endOfDay();
       // dd($start_date->diffInDays($current_date));
        while (!$current_date->greaterThanOrEqualTo($now)) {
            if ($current_date->isSaturday()) {
                $num++;
                // dump('Sat',$num);
               // echo $current_date->dayName;
                $current_date->addDay();

                continue;
            }
            if ($current_date->isSunday()) {
                $num++;
                //  dump('sun',$num);
               // echo $current_date->dayName;
                $current_date->addDay();

                continue;
            }


            $current_date->addDay();
        }

        $jokers = Joker::where(['user_id' => $user->id, 'status' => 'unactive'])->count();
        //dd($num);
        return $num + $user->reg_at + $jokers;
    }

    public static function is_date_active_of_section($section)
    {
        $lesson = $section->lessons()->where(['order' => 1])->first();

    }


    public static function is_date_active_of_lesson(Lesson $current_lesson, User $user = null)
    {

        $user = $user ?? auth()->user();
        if($user->status==0){
            return false;
        }


        $num_day = self::get_num_day_for_lesson($current_lesson, $user);
        // dump('NumDay',$num_day);
        $weekEnd = self::WeekEndNum($user);
        // dump('End',$weekEnd);
        $active_day = self::diff_date_start_to_now($user);
        //  dump('Job',$active_day);
        if ($active_day >= $num_day + $weekEnd) {
           /* $is_log = LessonUser::where([
                'user_id' => $user->id,
                'lesson_id' => $current_lesson->id,
            ])->first();*/
            LessonUser::firstOrCreate([
                'user_id' => $user->id,
                'lesson_id' => $current_lesson->id,
                'show_in' => date('Y-m-d'),
            ]);
            return true;
        }
        return false;

    }

    public static function get_num_day_for_lesson($current_lesson, User $user = null)
    {
        $user = $user ?? auth()->user();
        $sections = Section::orderBy('order')->get();
        $num = 0;
        foreach ($sections as $section) {
            $lessons = Lesson::where('section_id', $section->id)->orderBy('order')->get();
            foreach ($lessons as $lesson) {
                // dd($current_lesson->id);
                if ($lesson->id == $current_lesson->id) {

                    return $num;
                }
                $num += $lesson->after;
            }

        }
    }

    public static function diff_date_start_to_now(User $user = null)
    {
        $user = $user ?? auth()->user();
        $start_date = Carbon::parse($user->created_at)->startOfDay();
        //dump($start_date);
        $end = Carbon::now()->endOfDay();
        //dd($end->diffInDays($start_date));
        return $end->diffInDays($start_date);
    }

    public static function is_open_section(Section $section, User $user = null)
    {
        $user = $user ?? auth()->user();
        $lesson = Lesson::where(['section_id' => $section->id, 'order' => 1])->first();
        if (!$lesson) {
            return false;
        }

        if (self::is_date_active_of_lesson($lesson, $user)) {
            return true;
        }
        return false;

    }

    public static function is_new_section($section, User $user = null)
    {
        $user = $user ?? auth()->user();
        $lessons = Lesson::where('section_id', $section->id)->orderBy('order')->get();
        foreach ($lessons as $lesson) {

            if (self::is_date_active_of_lesson($lesson, $user)) {
                foreach ($lesson->videos as $video) {
                    $is_show_video = UserVideo::where([
                        'user_id' => $user->id,
                        'video_id' => $video->id
                    ])->first();
                    if ($lesson->videos()->count() > 0 && is_null($is_show_video)) {
                        return true;
                    }

                }
            } else {
                return false;
            }
        }

        return false;
    }

    public static function is_new_lesson($lesson, User $user = null)
    {
        $user = $user ?? auth()->user();
        if (self::is_date_active_of_lesson($lesson, $user)) {
            foreach ($lesson->videos as $video) {
                $is_show_video = UserVideo::where([
                    'user_id' => $user->id,
                    'video_id' => $video->id
                ])->first();
                if ($lesson->videos()->count() > 0 && is_null($is_show_video)) {
                    return true;
                }

            }
        } else {
            return false;
        }
    }


    public static function AddJoker(User $user = null)
    {
        $user = $user ?? auth()->user();
        $month = date('Y-M', time());
        $jokers = Joker::where([
            'user_id' => $user->id,
            'type' => 'free',
            'month' => $month,
        ])->count();
        Joker::where('month', '!=', $month)->where([
            'user_id' => $user,
            'type' => 'free',
            'status' => 'active'
        ])->update(['status' => 'not_use']);
        if ($jokers == 0) {
            for ($i = 0; $i < 5; $i++) {
                Joker::create([
                    'user_id' => $user->id,
                    'month' => $month,
                    'type' => 'free',
                    'status' => 'active'
                ]);
            }
        }
    }


    public static function last_open_lesson(User $user = null)
    {
        $user = $user ?? auth()->user();
        $sections = Section::orderByDesc('order')->get();
        $next_lesson = $sections[0]->lessons()->orderBy('order')->first();
        foreach ($sections as $section) {
            $lessons = Lesson::where('section_id', $section->id)->orderByDesc('order')->get();
            foreach ($lessons as $lesson) {
                $is_reg = LessonUser::where([
                    'user_id' => $user->id,
                    'lesson_id' => $lesson->id,
                ])->first();
                if (!$is_reg) {
                    $next_lesson = $lesson;
                } else {
                   // dd($next_lesson);
                    return $next_lesson;
                }
            }
        }


        return $next_lesson;
    }

    public static function next_lesson_date($lesson, User $user = null)
    {
        $user = $user ?? auth()->user();
        $next = Carbon::parse($user->created_at)->startOfDay()->subMinute();
        $next->addDays(self::get_num_day_for_lesson($lesson, $user));
        $next->addDays(self::WeekEndNum($user));
        if($next->isSaturday()){
            $next->subDay();
        }
        if($next->isSunday()){
            $next->addDays(1);
        }
//dd($next);
        return $next;
    }

    public static function is_register_lesson($lesson, User $user = null)
    {
        $user = $user ?? auth()->user();
        $is = LessonUser::where([
            'user_id' => $user->id,
            'lesson_id' => $lesson->id
        ])->first();
        if ($is) {
            return true;
        }
        return false;
    }

    public static function isNotExampleCompleate(Lesson $lesson, User $user = null)
    {
        $user = $user ?? auth()->user();
        $examples = $lesson->examples;
        foreach ($examples as $example) {
            $ex = ExampleUser::where([
                'user_id' => $user->id,
                'example_id' => $example->id
            ])->first();
            if (is_null($ex)) {
                return true;
            }
        }
        return false;
    }
}