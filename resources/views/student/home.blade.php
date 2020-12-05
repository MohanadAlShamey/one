@extends('admin.layouts.master')
@section('css')
    <style>
        .line-hight {
            line-height: 1.5;
        }
    </style>
@stop
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            @if(auth()->user()->status==1)
            @php
                $now=\Carbon\Carbon::createFromFormat('Y-m-d',date('Y-m-d',time()));
                $now->startOfDay()->addHours(1);
                $last_session=\Carbon\Carbon::parse($now);
               // echo  $last_session;

  $session=\App\SessionResive::where(['user_id'=>auth()->id()])
  ->where('created_at','>',$last_session->startOfDay())
  ->latest()->first();
           // dump($session->created_at);


            @endphp
            @if(!$session)
                @if( $now->isFriday() && \Carbon\Carbon::now()>$now && \Carbon\Carbon::now()->lessThanOrEqualTo($now->addHours(20)))
                    <resive-session></resive-session>
                @endif
            @endif

            @php
            $current_time=\Carbon\Carbon::now();
            $last_ses=\App\SessionResive::where('user_id',auth()->id())->where('created_at','<=',$current_time)->latest()->first();
            $bool=false;
           // dd($last_ses);
            if(!is_null($last_ses)){
            $pre_day=\Carbon\Carbon::parse($last_ses->resive_time);
            }

            if($last_ses &&($current_time->isFriday() && $current_time->greaterThanOrEqualTo(\Carbon\Carbon::now()->endOfDay()->subHours(3)) ||($current_time->isSaturday()&& $current_time->lessThanOrEqualTo($pre_day))) ){
           $bool=true;
            }
             //echo $current_time;
            @endphp
@if($bool && ($last_ses->type=='pending'|| $last_ses->type=='ok'))
    <div class="col-md-8">
        <div class="card" style="border:1px solid red">
            <div class="card-body">
                @php
                $hour=\Carbon\Carbon::parse($last_ses->resive_time);
                @endphp
                <h4><span>تم تأكيد حجز موعد جلسة الزوم</span></h4>
            <p>تبدأ الجلسة  في الساعة {{date('H:i',strtotime($hour))}} وتنتهي في الساعة {{date('H:i',strtotime($hour->addMinutes(15)))}}</p>
                <p>سيتم إرسال رابط الجلسة على الواتس , أتمنى أن تكون مستعداً قبل 5 دقائق وتتأكد من إعدادات الصوت على برنامج زووم</p>
            </div>
        </div>
    </div>
    @endif
            @endif
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><span>الدرس الحالي :</span> <a
                                href="{{route('student.home',$lesson->id)}}">{{$lesson->name}}</a></div>
                    <div class="card-body">
                        <span class="d-inline-block">مدة التدريب :</span>
                        <span class="d-inline-block">{{$lesson->after}} يوم</span>
                        <br>
                        @php

                             $jokers=\App\Joker::where(['user_id'=>auth()->id(),'status'=>'unactive'])->count();
                                $day_for_lesson=\App\Helpers\Helper2::get_num_day_for_lesson($lesson);
                              $week_end_day=\App\Helpers\Helper2::WeekEndNum();
                              $current_lesson_day=\Carbon\Carbon::parse(auth()->user()->created_at)->startOfDay()->addDays($day_for_lesson)->addDays($week_end_day);
                              $sendDate=\Carbon\Carbon::parse($current_lesson_day)->addDays($lesson->after-1);
                             if($current_lesson_day->equalTo($sendDate)&&$sendDate->isSaturday() ){
                              $sendDate->subDay();
                              }elseif ($sendDate->isSaturday()){
                              $sendDate->addDays(2);
                              }
                              if($current_lesson_day->equalTo($sendDate)&&$sendDate->isSunday() ){
                              $sendDate->subDays(2);
                              }


                           $next_date=\Carbon\Carbon::parse($sendDate)->endOfDay()->addMinute();
                            if($next_date->isSaturday() ){
                              $next_date->addDay();
                              }
                              if($next_date->isSunday() ){
                              $next_date->addDay();
                              }


                          /*  $complet_lesson_date=\Carbon\Carbon::parse($next_date);*/
                            $days=[
                            'Monday'=>'الإثنين',
                            'Tuesday'=>'الثلاثاء',
                            'Wednesday'=>'الأربعاء',
                            'Thursday'=>'الخميس',
                            'Friday'=>'الجمعة',
                            'Sunday'=>'الأحد',
                            'Saturday'=>'السبت',
                            ];

                        @endphp
                        <span class="d-inline-block py-1">موعد تسليم التدريب :</span>

                        <span class="d-inline-block py-1 text-danger">{{$days[$sendDate->dayName]}}</span>
                        <span class="d-inline-block py-1">قبل الساعة 23:00 ليلا</span>
                        <br>

                        <span class="d-inline-block py-1">موعد الدرس القادم : </span>

                        <span class="d-inline-block py-1 text-danger">{{$days[$next_date->dayName]}}</span>
                        <span class="d-inline-block py-1">الساعة : 01:00 ليلا</span>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">التمارين غير المكتملة</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>اسم الدرس</th>
                                    <th>اسم التمرين</th>
                                </tr>
                                @foreach($examples as $example)
                                    @if(!\App\ExampleUser::where([
                                    'user_id'=>auth()->id(),
                                    'example_id'=>$example->id])->first())
                                        <tr>
                                            <td class="py-2"><a href="{{route('student.home',$example->lesson->id)}}">{{$example->lesson->name}}</a></td>
                                            <td class="py-2"><a href="{{route('student.example.complete',$example->id)}}">{{$example->name}}</a></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop