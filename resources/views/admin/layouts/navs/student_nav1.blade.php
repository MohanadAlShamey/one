

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @foreach ($sections_student as $section)
@php
$open=\App\Helpers\Helper2::is_open_section($section)|| \App\Helpers\Helper2::is_register_lesson($section->lessons()->orderBy('order')->first())


@endphp

            <li class="nav-item has-treeview  ">
                <a href="#" class="nav-link  " style="color:#fff ;background-color: #ccc;">
                    <i class="fa fa-tachometer-alt text-dark d-inline"></i>
                    <p class="text-dark text-justify d-inline">
                        @if($open)
                            {{$section->name}}
                        @else
                            <span class="d-inline-block"> الفصل التالي</span>
                            {{--<span class="d-inline-block small">يجب إنهاء الفصل السابق للدخول لدروس هذا الفصل</span>--}}


                        @endif

                       @if(\App\Helpers\Helper2::is_new_section($section))
                            <span class="badge badge-danger">جديد</span>
                        @endif
                        <i class="right fa fa-angle-left text-dark"></i>
                    </p>

                </a>


                <ul class="nav nav-treeview ">
                    @if($open)

                        @foreach(\App\Lesson::where('section_id',$section->id)->orderBy('order')->get() as $lesson)
@php
$open_lesson=\App\Helpers\Helper2::is_date_active_of_lesson($lesson) || \App\Helpers\Helper2::is_register_lesson($lesson);
$numDayForLesson=\App\Helpers\Helper2::get_num_day_for_lesson($lesson);
$userActiveDay=\App\Helpers\Helper2::diff_date_start_to_now()-\App\Helpers\Helper2::WeekEndNum();
@endphp

                            <li class="nav-item my-1">
                                <a @if($open_lesson) href="{{route('student.home',$lesson->id)}}"@endif
                                class="nav-link " style="border:2px dashed #ccc;">
                                    <p class="text-dark text-justify" style="white-space: initial; ">

                                        {{$lesson->name}}
                                        <span class="text-danger">{{$numDayForLesson}}</span>
                                        <span class="text-success">{{$userActiveDay}}</span>



                                       @if(\App\Helpers\Helper2::is_new_lesson($lesson))
                                            <span class="badge badge-danger">جديد</span>
                                        @elseif(\App\Helpers\Helper2::isNotExampleCompleate($lesson)&& $open_lesson && $numDayForLesson>=$userActiveDay-3)
                                            <span class="badge badge-warning">يوجد تمارين غير مكتملة</span>
                                        @endif

                                        @if(!$open_lesson)
                                            <span class="badge badge-secondary">غير متاح</span>
                                        @endif
                                    </p>

                                </a>
                            </li>

                        @endforeach
                    @else
                        <span style="font-size:12px;" class="bg-gray-light d-inline-block text-small">يجب إنهاء الفصل السابق للدخول للفصل التالي</span>
                    @endif


                </ul>

            </li>
            @if(!$open)
                @break
            @endif
 {{--@php
              if($new || \App\Helpers\Helpers::ShowAllVideo($lesson)){
              echo "<p class='alert alert-danger small'>لن تستطيع الدخول للفصل التالي قبل إنهاء الفصل الحالي</p>";
              break;
              }
              @endphp--}}

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
