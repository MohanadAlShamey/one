@extends('admin.layouts.master')

@section('content')
    <div class="container">
        @if($lesson)
            @php
           // dd($lesson);
                $days=[
                   'Saturday'=>'السبت',
                   'Sunday'=>'الاحد',
                   'Monday'=>'الإثنين',
                   'Tuesday'=>'الثلاثاء',
                   'Wednesday'=>'الاربعاء',
                   'Thursday'=>'الخميس',
                   'Friday'=>'الجمعة',
                   ];

           $last_lesson= \App\LessonUser::where([
            'user_id'=>auth()->id(),
            'lesson_id'=>$lesson->id,
            ])->first();
            $end_lesson=\Carbon\Carbon::createFromFormat('Y-m-d  H:i',$last_lesson->show_in.'23:00')->addDays($lesson->after-1);
            if($end_lesson->dayName=='Saturday'){
            $end_lesson->addDay();
            }
             if($end_lesson->dayName=='Sunday'){
            $end_lesson->addDay();
            }
            @endphp

<div class="row">
    <div class="col">
        <h4>الدرس الحالي</h4>
        <div class="card">
            <div class="card-body">
                <h4 class="title"><a href="{{route('student.home',$lesson->id)}}">{{$lesson->name}}</a></h4>
                <h6>مدة التدريب <span class="text-danger">{{$lesson->after}} يوم</span></h6>
                <h6>موعد تسليم التدريب <span class="text-danger"> يوم {{$days[$end_lesson->dayName]}} <span class="text-muted">{{date('Y-m-d',strtotime($end_lesson))}}</span> الساعة {{date('H:i',strtotime($end_lesson))}}</span></h6>
                @php
                    $end_lesson->addHours(6);
                  if($end_lesson->dayName=='Saturday'){
            $end_lesson->addDay();
            }
             if($end_lesson->dayName=='Sunday'){
            $end_lesson->addDay();
            }
                @endphp
                <h6>موعد الدرس القادم <span class="text-danger"> يوم {{$days[$end_lesson->dayName]}} <span class="text-muted">{{date('Y-m-d',strtotime($end_lesson))}}</span> الساعة {{date('H:i',strtotime($end_lesson))}}</span></h6>

            </div>
        </div>
    </div>
</div>
        @endif
    </div>


@stop