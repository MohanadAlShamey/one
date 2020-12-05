<?php
/**
 * Created by PhpStorm.
 * User: mohannad
 * Date: 09/22/2020
 * Time: 10:56 م
 */

namespace App\Helpers;


use App\Joker;
use App\Lesson;
use App\LessonUser;
use App\Log;
use App\Section;
use App\User;
use App\UserVideo;
use App\Video;
use App\Watch;
use Carbon\Carbon;
use function GuzzleHttp\Psr7\str;

class Helpers
{

    /* public static function is_active_lesson($current_lesson)
     {
         if ($current_lesson->order == 1 && $current_lesson->section->order == 1) {
             return true;
         }
         $start = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime(auth()->user()->created_at)));
         $jockers=Joker::where([
             'user_id'=>auth()->id(),
                 'status'=>'unactive'
             ])->count();
         $days =auth()->user()->reg_at+$jockers;

         $is_active = false;
         $increment = 0;
         $sat=0;
         foreach (Section::orderBy('order')->get() as $section) {

             ############
             foreach (Lesson::where('section_id', $section->id)->orderBy('order')->get() as $new_lesson) {
                // echo "Dayes ".(int) $days." -";

                 $curent_date = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($start . "+$increment days")));
                 //echo "T " . date('D', strtotime($curent_date));
                 if (date('D', strtotime($curent_date)) == 'Sat' ) {
                     //  echo date('D', strtotime($curent_date));
                     $days++;
                     $sat++;
                     //  dump('Plus'.$sat);
                     //dump(date('D', strtotime($curent_date)));
                 }elseif(date('D', strtotime($curent_date)) == 'Sun'){
                     $days++;
                 }
                 if ($current_lesson->id == $new_lesson->id) {
                     $endd = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($start . "+$days days")));

                     $end=Carbon::createFromFormat('Y-m-d h:i',date('Y-m-d h:i',strtotime(date('Y-m-d',strtotime(($endd))).' 05:00')));
                   if(date('D',strtotime($end))=='Sat'||date('D',strtotime($end))=='Sat'){
                       $days++;
                       continue;
                   }
                     $now = Carbon::now();
                     if ($now->greaterThan($end) || $now->equalTo($end)) {
                         return true;
                     }
                     break;
                 }
                 $days += $new_lesson->after;
                 $increment++;
             }
             ###################
             if ($is_active) {
                 break;
             }

         }
         return $is_active;
     }*/

    public static function is_active_lesson($current_lesson)
    {
        $start = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime(auth()->user()->created_at)));
        $jokers = Joker::where(['user_id' => auth()->id(), 'status' => 'unactive'])->count();

        $plus_days = intval(auth()->user()->reg_at + $jokers);
        $end = Carbon::createFromFormat('Y-m-d h:i', date('Y-m-d h:i', strtotime(auth()->user()->created_at . ' +' . $plus_days . ' days')));

        $stop = false;
        $increment = 0;
        foreach (Section::orderBy('order')->get() as $section) {
            foreach (Lesson::where('section_id', $section->id)->orderBy('order')->get() as $new_lesson) {
                $current_date = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($start . ' +' . $increment . ' days')));
                if (date('D', strtotime($end)) == 'Sat') {
                    $plus_days = $plus_days + 2;
                } elseif (date('D', strtotime($end)) == 'Sun') {
                    $plus_days = $plus_days + 1;
                }
                $end = Carbon::createFromFormat('Y-m-d h:i', date('Y-m-d h:i', strtotime($start . ' +' . $plus_days . ' days')));
                if (date('D', strtotime($end)) == 'Sat') {
                    $plus_days = $plus_days + 2;
                } elseif (date('D', strtotime($end)) == 'Sun') {
                    $plus_days = $plus_days + 1;
                }
                $end = Carbon::createFromFormat('Y-m-d h:i', date('Y-m-d h:i', strtotime($start . ' +' . $plus_days . ' days')));

                if ($current_lesson->id == $new_lesson->id) {

                    $stop = true;
                    break;
                }
                $plus_days = $plus_days + $new_lesson->after;

                $increment++;
            }
            if ($stop) {
                break;
            }
        }
        $now = Carbon::now();
        $end = Carbon::createFromFormat('Y-m-d h:i', date('Y-m-d h:i', strtotime(date('Y-m-d', strtotime($end)) . '05:00')));


        return $now->greaterThan($end) || $now->equalTo($end);
    }

    public static function num_days_to_lesson($current_lesson)
    {
        $sections = Section::orderBy('order', 'asc')->get();
        $days = 0;
        foreach ($sections as $section) {
            $lessons = Lesson::where([
                'section_id' => $section->id
            ])->orderBy('order', 'asc')->get();

            foreach ($lessons as $lesson) {
                if ($current_lesson->id == $lesson->id) {
                    return $days;

                }
                $days += $lesson->after;

            }

        }
        return $days;

    }

    public static function get_num_sat_sun(Carbon $start, Carbon $end)
    {
        $days = 0;
        if ($end->dayName == 'Saturday') {
            $end->addDay();
        }

        if ($end->dayName == 'Sunday') {
            $end->addDay();
        }

        for ($i = 0; ; $i++) {
            if ($start->dayName == 'Saturday') {
                $start->addDay();
                $days++;
            }
            if ($start->dayName == 'Sunday') {
                $start->addDay();
                $days++;
            }
            if ($start->startOfDay()->greaterThanOrEqualTo($end->endOfDay())) {
                break;
            }
            $start->addDay();
        }
        return $days;

    }

    public static function is_active_date_section($section)
    {
        $lesson = Lesson::where(['section_id' => $section->id])->orderBy('order')->first();
        $start = \Carbon\Carbon::createFromFormat('Y-m-d h:i', date('Y-m-d', strtotime(auth()->user()->created_at)) . ' 05:00');
        $now = \Carbon\Carbon::now();
        $reg_days = $now->diff($start);
        $reg_at = auth()->user()->reg_at;
        $jockes = \App\Joker::where([
            'user_id' => auth()->id(),
            'status' => 'unactive'
        ])->count();
        $num_sat_sun = \App\Helpers\Helpers::get_num_sat_sun($start, $now);
        $num_day = \App\Helpers\Helpers::num_days_to_lesson($lesson);

        if ($num_day <= ($reg_days->days - $num_sat_sun - $jockes - $reg_at)) {
            return true;
        }
        return false;
    }


    public static function is_new_lesson($lesson)
    {


        $start=\Carbon\Carbon::createFromFormat('Y-m-d h:i',date('Y-m-d',strtotime(auth()->user()->created_at)).' 05:00');
        $now=\Carbon\Carbon::now();
        $reg_days=$now->diff($start);
        $reg_at=auth()->user()->reg_at;
        $jockes=\App\Joker::where([
            'user_id'=>auth()->id(),
            'status'=>'unactive'
        ])->count();
        $num_sat_sun=\App\Helpers\Helpers::get_num_sat_sun($start,\Carbon\Carbon::now()->endOfDay());
        $num_day=self::num_days_to_lesson($lesson);
        $isw=\App\LessonUser::where([
            'lesson_id'=>$lesson->id,
            'user_id'=>auth()->id()
        ])->first();
        $is_active_date=$num_day <=  ($reg_days->days-$num_sat_sun-$jockes-$reg_at) || !is_null($isw);
        if(!$is_active_date){
            return false;
        }
        ##############

        $is_watch = Watch::where([
            'user_id' => auth()->id(),
            'lesson_id' => $lesson->id
        ])->first();
        $is_watch_videos = false;
        foreach ($lesson->videos as $video) {
            $is_show_video = UserVideo::where([
                'user_id' => auth()->id(),
                'video_id' => $video->id
            ])->first();
            if ($lesson->videos()->count() > 0 && is_null($is_show_video)) {
                $is_watch_videos = true;
                break;
            }
        }
        if (is_null($is_watch) || $is_watch_videos) {
            return true;
        }
        return false;
    }

    public static function openSection($section, $id = null)
    {
        $open = false;
        if ($section->order == 1 && empty($id)) {
            $open = true;
        } elseif (!is_null($id)) {
            $lesson_loop = \App\Lesson::find($id);

            if (!is_null($lesson_loop) && $lesson_loop->section->id == $section->id)
                $open = true;
        } else {
            $open = false;
        }
        return $open;
    }

    public static function activeLesson($lesson, $id = null)
    {
        $active = false;
        if (is_null($id) && $lesson->order == 1 && $lesson->section->order == 1) {
            $active = true;
        } elseif ($id != null && $lesson->id == $id) {
            $active = true;

        }
        return $active;
    }

    public static function AddJokerToStudent()
    {
        $users = User::where(function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'student');
            });
        })->get();
        $month = date('Y-M', time());
        $old_joker = Joker::where(function ($query) use ($month) {
            $query->where('user_id', auth()->id());
            $query->where('month', '!=', $month);
            $query->where('type', 'free');
            $query->where('status', 'active');
        })->get();

        foreach ($old_joker as $item) {
            $item->update([
                'status' => 'not_use',
                'used_at' => date('Y-m-d'),
            ]);
        }


        foreach ($users as $user) {
            $jokers_free = Joker::where([
                'user_id' => $user->id,
                'month' => $month,
                'type' => 'free',
            ])->first();
            if (is_null($jokers_free)) {
                for ($i = 0; $i < 5; $i++) {
                    Joker::create([
                        'user_id' => $user->id,
                        'month' => $month,
                    ]);
                    Log::create([
                        'user_id'=>auth()->id(),
                        'task'=>'إضافة جوكر جديد',
                        'at_date'=>date('Y-m-d H:i',time())
                    ]);
                }
            }
        }
    }

    public static function active_lesson_date($current_lesson)
    {

        $start = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime(auth()->user()->created_at)));
        $jokers = Joker::where(['user_id' => auth()->id(), 'status' => 'unactive'])->count();

        $plus_days = intval(auth()->user()->reg_at + $jokers);
        $end = Carbon::createFromFormat('Y-m-d h:i', date('Y-m-d h:i', strtotime($start . ' +' . $plus_days . ' days')));
        $stop = false;
        $increment = 0;
        foreach (Section::orderBy('order')->get() as $section) {
            foreach (Lesson::where('section_id', $section->id)->orderBy('order')->get() as $new_lesson) {
                $current_date = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($start . ' +' . $increment . ' days')));
                if (date('D', strtotime($end)) == 'Sat') {
                    $plus_days = $plus_days + 2;
                } elseif (date('D', strtotime($end)) == 'Sun') {
                    $plus_days = $plus_days + 1;
                }
                $end = Carbon::createFromFormat('Y-m-d h:i', date('Y-m-d h:i', strtotime($start . ' +' . $plus_days . ' days')));
                if (date('D', strtotime($end)) == 'Sat') {
                    $plus_days = $plus_days + 2;
                } elseif (date('D', strtotime($end)) == 'Sun') {
                    $plus_days = $plus_days + 1;
                }
                $end = Carbon::createFromFormat('Y-m-d h:i', date('Y-m-d h:i', strtotime($start . ' +' . $plus_days . ' days')));

                if ($current_lesson->id == $new_lesson->id) {

                    $stop = true;
                    break;
                }
                $plus_days = $plus_days + $new_lesson->after;

                $increment++;
            }
            if ($stop) {
                break;
            }
        }
        $now = Carbon::now();
        $end = Carbon::createFromFormat('Y-m-d h:i', date('Y-m-d h:i', strtotime(date('Y-m-d', strtotime($end)) . '05:00')));


        return $end;
    }

    public static function last_open_lesson()
    {
        $sections = Section::orderBy('order')->get();
        $loop = false;
        foreach ($sections as $section) {
            $lessons = Lesson::orderBy('order')->where('section_id', $section->id)->get();
            foreach ($lessons as $lesson) {
                $start = \Carbon\Carbon::createFromFormat('Y-m-d h:i', date('Y-m-d', strtotime(auth()->user()->created_at)) . ' 05:00');
                $now = \Carbon\Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d',time()).' 23:59');
                $reg_days = $now->diff($start);
                $reg_at = auth()->user()->reg_at;
                $jockes = \App\Joker::where([
                    'user_id' => auth()->id(),
                    'status' => 'unactive'
                ])->count();
                $num_sat_sun = self::get_num_sat_sun($start,  Carbon::now()->endOfDay());
                $num_day = self::num_days_to_lesson($lesson);

                if ($num_day > ($reg_days->days - $num_sat_sun - $jockes - $reg_at)) {
                    $loop = true;
                    break;
                }
                $l = $lesson;
            }
            if ($loop) {
                break;
            }
        }


        return $l;
    }

    public static function  sum_days($lesson){
        //$lesson=Lesson::find(65);
        $start = \Carbon\Carbon::createFromFormat('Y-m-d h:i', date('Y-m-d', strtotime(auth()->user()->created_at)) . ' 05:00');
        $now = \Carbon\Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d',time()).' 23:59');
        $reg_days = $now->diff($start);
        // dump($reg_days->days);
        $reg_at = auth()->user()->reg_at;
        // dump($reg_at);
        $jockes = \App\Joker::where([
            'user_id' => auth()->id(),
            'status' => 'unactive'
        ])->count();
        // dump($jockes);
        $num_sat_sun = \App\Helpers\Helpers::get_num_sat_sun($start,$now);
        //  dump($num_sat_sun);
        $num_day = \App\Helpers\Helpers::num_days_to_lesson($lesson);
        // dump($num_day);
        // dump($reg_days->days-$reg_at-$jockes-$num_sat_sun);
        $date=\Carbon\Carbon::createFromFormat('Y-m-d h:i', date('Y-m-d', strtotime(auth()->user()->created_at)) . ' 05:00');
        $date->addDays($reg_at+$jockes+$num_sat_sun+$num_day);
if(Carbon::now()->greaterThanOrEqualTo($date)){
    LessonUser::firstOrCreate([
        'user_id' => auth()->id(),
        'lesson_id' => $lesson->id,
        'show_in' => date('Y-m-d'),
    ]);
    Log::create([
        'user_id'=>auth()->id(),
        'task'=>'فتح الدرس '.$lesson->name,
        'at_date'=>date('Y-m-d H:i',time())
    ]);
}
        return    (object) ['sub'=> ($reg_days->days-$reg_at-$jockes - $num_sat_sun ),
            'total'=>$num_day,'date'=>$date] ;
    }

    public static function get_next_lesson($current_lesson){
        $loop=false;
        $big_loop=false;
        foreach (Section::orderBy('order')->get() as $section){
            $lessons=Lesson::where(['section_id'=>$section->id])->orderBy('order')->get();
            foreach ($lessons as $lesson) {
                if($loop){
                    $next_lesson=$lesson;
                    //dump($next_lesson->id);
                    $big_loop=true;
                    break;
                }
                //dd($current_lesson);
                if($lesson->id==$current_lesson->id){
                    // dump("ID".$current_lesson->id);
                    $loop=true;
                }
            }
            if($big_loop){
                break;
            }


        }
        return $next_lesson;
    }
    public static function is_reg_lesson(){
        $loop=false;
        $big_loop=false;
        foreach (Section::orderBy('order','desc')->get() as $section){
            $lessons=Lesson::where(['section_id'=>$section->id])->orderBy('order','desc')->get();
            foreach ($lessons as $lesson) {
                $is_reg=LessonUser::where([
                    'user_id'=>auth()->id(),
                    'lesson_id'=>$lesson->id
                ])->first();

                if(!is_null($is_reg)){
                    return $lesson;
                }
            }


        }
        return Lesson::where(function($query){
            $query->whereHas('section',function ($query){
                $query->where('order',1);
            });
            $query->where('order',1);
        })->first();
    }


}