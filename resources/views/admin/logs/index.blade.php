@extends('admin.layouts.master')

@section('ol')
    <li class="breadcrumb-item"><a href="{{route('dahsboard.home')}}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a>تسجيلات المتدرب {{$user->name}}</a></li>

@stop

@section('content')

    <div class="row justify-content-center">
        @php
            $lesson = \App\LessonUser::where(['user_id' =>$user->id])->orderByDesc('lesson_id')->first();
            //dd($user->id);
    if (!$lesson) {
        $lesson = \App\Section::orderBy('order')->first()->lessons()->orderBy('order')->first();
    }else{
    $lesson=$lesson->lesson;
    }

        @endphp
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><span>الدرس الحالي :</span> <a
                            href="{{route('student.home',$lesson->id)}}">{{$lesson->name}}</a></div>
                <div class="card-body">
                    <span class="d-inline-block">مدة التدريب :</span>
                    <span class="d-inline-block">{{$lesson->after}} يوم</span>
                    <br>
                    @php

                        $jokers=\App\Joker::where(['user_id'=>$user->id,'status'=>'unactive'])->count();
                        $day_for_lesson=\App\Helpers\Helper2::get_num_day_for_lesson($lesson,$user);
                         $week_end_day=\App\Helpers\Helper2::WeekEndNum($user);
                          $current_lesson_day=\Carbon\Carbon::parse($user->created_at)->startOfDay()->addDays($day_for_lesson)->addDays($week_end_day);
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
    @php
        $examples=\App\ExampleUser::where(['user_id'=>$user->id,'rate'=>'pending'])->latest('id')->limit(5)->get();

    @endphp
    @if($examples->count()>0)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">تمارين بحاجة للتقييم</div>
                        <div class="card-body">
                            @php
                                $examples=\App\ExampleUser::where(['user_id'=>$user->id,'rate'=>'pending'])->latest('id')->limit(5)->get();

                            @endphp
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <td>اسم التدريب</td>
                                        <td>اسم الدرس</td>
                                        <td>المرفق</td>
                                        <td>الحالة</td>
                                    </tr>
                                    @foreach( $examples as $example)

                                        <tr>
                                            <td>{{$example->example->name}}</td>
                                            <td>{{$example->example->lesson->name}}</td>
                                            <td>
                                                <a href="{{route('dahsboard.examples.completeExample.getFile',$example->id)}}">مشاهدة</a>
                                            </td>
                                            <td>
                                                @if($example->rate=='pending')
                                                    <a href="{{route('dahsboard.examples.rateExample.rate',$example->id)}}"><i
                                                                class="fa fa-check-circle"></i></a>
                                                @else
                                                    <span>تم تقييمه</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    @php
        $lessonsIds=[];
    foreach(\App\Lesson::orderBy('section_id')->orderBy('order')->get() as $ls){
    $is= \App\LessonUser::where([
    'user_id' => $user->id,
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
    $data=[];
      $examples=\App\Example::whereIn('lesson_id',$ids)->get();
     foreach($examples as $example){
     $user_example=\App\ExampleUser::where([
                                    'user_id'=>$user->id,
                                    'example_id'=>$example->id
                                    ])->first();
     if(!$user_example){
       $data[]=$example;                             }
     }
    if(count($data)>0){

    $examples= collect($data);
    }

    @endphp
    @if($examples->count()>0)
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
                                        <tr>
                                            <td class="py-2"><a
                                                        href="{{route('student.home',$example->lesson->id)}}">{{$example->lesson->name}}</a>
                                            </td>
                                            <td class="py-2"><a
                                                        href="{{route('student.example.complete',$example->id)}}">{{$example->name}}</a>
                                            </td>
                                        </tr>

                                    @endforeach
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif



    @if($logs->count()>0)
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span>آخر تسجيلات المتدرب</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {{--<a href="{{route('dahsboard.logs.asMark',$user)}}" class="btn btn-sm btn-primary my-2">تعيين الكل كمقروء</a>--}}
                            <form action="{{route('dahsboard.logs.update')}}" method="post">
                                @csrf
                                <table class="table table-bordered">
                                    <tr>
                                        <th>التسجيل</th>
                                        <th>التاريخ</th>
                                        {{-- <th>
                                             <button class="btn btn-sm btn-primary" type="submit">تعيين كمقروء</button>
                                         </th>--}}
                                    </tr>
                                    @foreach($logs as $log)
                                        <tr>
                                            <td>{{$log->task}}</td>
                                            <td>{{date('Y-m-d | H:i',strtotime($log->at_date))}}</td>
                                            {{--<td>
                                                @if($log->status==null)
                                                <input type="checkbox" class="form-check" name="logs[]" value="{{$log->id}}">
                                                    @else
                                                    مقروء
                                                    @endif
                                            </td>--}}
                                        </tr>
                                    @endforeach
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$logs->links()}}
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop