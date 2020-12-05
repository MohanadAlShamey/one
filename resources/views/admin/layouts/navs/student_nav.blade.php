@php
$sec_id=$lesson->section->id;
$les_id=$lesson->id;
    $start=\Carbon\Carbon::createFromFormat('Y-m-d h:i',date('Y-m-d',strtotime(auth()->user()->created_at)).' 05:00');
             $now=\Carbon\Carbon::now();
             $reg_days=$now->diff($start);
             $reg_at=auth()->user()->reg_at;
             $jockes=\App\Joker::where([
            'user_id'=>auth()->id(),
            'status'=>'unactive'
            ])->count();
             $num_sat_sun=\App\Helpers\Helpers::get_num_sat_sun($start,\Carbon\Carbon::now()->startOfDay());
$last_lesson_reg=\App\LessonUser::orderBy('show_in','desc')->first();

@endphp
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @foreach ($sections_student as $section)
            @php
                //$open=\App\Helpers\Helpers::openSection($section,request()->route()->parameter('id'));
                $open=$sec_id==$section->id;
            $is_new_section=false;
            $is_active_date_section=\App\Helpers\Helpers::is_active_date_section($section);
            foreach ($section->lessons as $lesson){
            $is_new_section=\App\Helpers\Helpers::is_new_lesson($lesson,$start,$now);
            if($is_new_section){
            break;
            }
            }


            @endphp
            <li class="nav-item has-treeview {{$open?'menu-open':''}} ">
                <a href="#" class="nav-link  " style="color:#fff ;background-color: #ccc;">
                    <i class="fa fa-tachometer-alt text-dark d-inline"></i>
                    <p class="text-dark text-justify d-inline">
                        @if($is_active_date_section)
                            {{$section->name}}
                        @else
                            <span class="d-inline-block"> الفصل التالي</span>
                            <span class="d-inline-block small">يجب إنهاء الفصل السابق للدخول لدروس هذا الفصل</span>

                        @endif

                        @if($is_new_section && $is_active_date_section)
                            <span class="badge badge-danger">جديد</span>
                        @endif
                        <i class="right fa fa-angle-left text-dark"></i>
                    </p>

                </a>
                @if(!$is_active_date_section)
                    @break
                @endif
                <ul class="nav nav-treeview ">
                    @if($is_active_date_section)

                        @foreach(\App\Lesson::where('section_id',$section->id)->orderBy('order')->get() as $lesson)
                            @php
                                 $num_day=\App\Helpers\Helpers::num_days_to_lesson($lesson);
                                $isw=\App\LessonUser::where([
        'lesson_id'=>$lesson->id,
        'user_id'=>auth()->id()
    ])->first();
$new=\Carbon\Carbon::createFromFormat('Y-m-d h:i',date('Y-m-d',strtotime(auth()->user()->created_at)).' 05:00');
$new->addDays($num_day+$num_sat_sun+$jockes+$reg_at+1);

                                    $is_active_date=$num_day <=  ($reg_days->days-$num_sat_sun-$jockes-$reg_at) &&\Carbon\Carbon::now()->greaterThanOrEqualTo($new) || !is_null($isw);

                                    $active=$les_id==$lesson->id;
                                    $is_new_lesson=\App\Helpers\Helpers::is_new_lesson($lesson);

                            @endphp
                            <li class="nav-item my-1">
                                <a @if($is_active_date) href="{{route('student.home',$lesson->id)}}" @endif
                                class="nav-link {{$active?'active' :''}}" style="border:2px dashed #ccc;">
                                    <p class="text-dark text-justify" style="white-space: initial; ">

                                        {{$lesson->name}}



                                        @if($is_new_lesson && $is_active_date)
                                            <span class="badge badge-danger">جديد</span>
                                        @endif

                                        @if(!$is_active_date)
                                            <span class="badge badge-secondary">غير متاح</span>
                                        @endif
                                    </p>

                                </a>
                            </li>
                            @php
                                $start->addDays($lesson->after);

                            @endphp
                        @endforeach
                    @else
                        <span style="font-size:12px;" class="bg-gray-light d-inline-block text-small">يجب إنهاء الفصل السابق للدخول للفصل التالي</span>
                    @endif
                </ul>
            </li>

        @endforeach


        <li class="nav-item mb-5">
            <a href="{{route('logout')}}" class="nav-link mb-2">
                <i class="nav-icon fa fa-sign-out-alt text-dark"></i>
                <p class="text-dark">

                    تسجيل الخروج

                </p>
            </a>
        </li>
    </ul>
</nav>