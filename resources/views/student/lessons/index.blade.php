@extends('admin.layouts.master')

@section('css')
    <style>
        .custom-text {
            font-weight: bold;
            font-size: 0.9em;
            border: 1px solid #cfcfcf;
            padding-left: 10px;
            padding-right: 10px;
            border-radius: 5px;
            color: #999;
            background: #fff;
            letter-spacing: 2px;
        }

    </style>
@stop

@section('content')
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                @if($lesson!=null)
                <div class="card-header">
                    <span>{{$lesson->name}}</span> |
                    <span class="title pb-0 text-danger">مدة التدريب <span class="text-danger">{{$lesson->after}} يوم</span></span>
                </div>
                <div class="card-body">
                    <div class="img-thumbnail p-3">

                        @if(!empty($lesson->body)&& $lesson->body!='null')

                            {!! $lesson->body !!}
                            <hr>
                        @endif
                        @if(!empty($lesson->url))
                            <table class="table table-bordered">
                                <tr>
                                    <th>{{$lesson->name}}</th>
                                    <td><a target="_blank" href="{{route('dahsboard.lessons.getFile',$lesson->id)}}">تحميل</a></td>
                                </tr>
                            </table>


                        @endif
                        @if($lesson->videos()->count()>0)


                            <show-videos-component lesson_id="{{$lesson->id}}"></show-videos-component>
                        @endif

                            @if($lesson->attaches()->count()>0)
                                <h6 class="title mb-2">مرفقات الدرس</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>اسم المرفق</th>
                                            <th>تحميل</th>
                                        </tr>
                                        @foreach($lesson->attaches as $attach)
                                            <tr>
                                                <td>{{$attach->name}}</td>
                                                <td>
                                                    <a href="{{route('dahsboard.attaches.getFile',$attach->id)}}"
                                                       target="_blank">
                                                       تحميل
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endif


                            @if($lesson->examples()->count()>0)
                                <h6 class="title mb-2">تمارين الدرس</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>اسم التدريب</th>
                                            <th>وصف التدريب</th>
                                            <th>تنفيذ</th>
                                        </tr>
                                        @foreach($lesson->examples as $example)
                                            <tr>
                                                <td>{{$example->name}}</td>
                                                <td>{{$example->body}}</td>
                                                <td>
                                                    @php
                                                    $ex=auth()->user()->example_user()->where('example_id',$example->id)->first();
                                                    @endphp
                                                    @if($ex)
                                                    @if($ex->rate=='pending')

بإنتظار التقييم
                                                        @else

                                                   تم التقييم
                                                        @endif
                                                        @else
                                                        <a href="{{route('student.example.complete',$example->id)}}"
                                                           >
                                                            تنفيذ
                                                        </a>
                                                   @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endif
                    </div>
                </div>

                    @else

                    <div class="card-body">
                        <p>لم يتم إضافة أية دروس</p>
                    </div>
                    @endif

            </div>
        </div>

<joker-component img="{{asset('public/img/joker.png')}}" ></joker-component>

    </div>
@stop