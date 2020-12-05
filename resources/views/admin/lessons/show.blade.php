@extends('admin.layouts.master')

@section('ol')
    <li class="breadcrumb-item"><a href="{{route('dahsboard.home')}}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="{{route('dahsboard.sections.show',$lesson->section->id)}}">{{$lesson->section->name}}</a></li>

    <li class="breadcrumb-item"><a>عرض | {{$lesson->name}}</a></li>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>{{$lesson->name}}</span>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>اسم الدرس</th>
                            <td>{{$lesson->name}}</td>
                        </tr>
@if(!empty($lesson->url))
                        <tr>
                            <th>ملف الدرس</th>
                            <td><a target="_blank" href="{{route('dahsboard.lessons.getFile',$lesson->id)}}">مشاهدة</a> </td>
                        </tr>
@endif

                        @if(!empty($lesson->body))
                            <tr>
                                <th>وصف الدرس</th>
                                <td>{!! $lesson->body !!}</td>
                            </tr>
                        @endif

                            <tr>
                                <th>ترتيب الدرس</th>
                                <td>{{$lesson->order}}</td>
                            </tr>

                        <tr>
                            <th>مدة تنفيذ الدرس</th>
                            <td>{{$lesson->after}} يوم </td>
                        </tr>

                    </table>
@if($lesson->videos()->count()!=0)
                    <h4>الفيديوهات</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>اسم الفيديو</th>
                            <th>مشاهدة</th>
                        </tr>
                        @foreach($lesson->videos as $video)
                            <tr>
                                <td>{{$video->name}}</td>
                                <td><a target="_blank" href="{{$video->url}}">مشاهدة</a></td>
                            </tr>
                            @endforeach
                    </table>
    @endif

                    @if($lesson->examples()->count()!=0)
                        <h4>التدريبات</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>اسم المرفق</th>
                                <th>تحميل المرفق</th>
                            </tr>
                            @foreach($lesson->examples as $example)
                                <tr>
                                    <td>{{$example->name}}</td>
                                    <td>{{$example->body}}</td>
                                </tr>
                            @endforeach
                        </table>
                    @endif

                    @if($lesson->attaches()->count()!=0)
                        <h4>المرفقات</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>اسم التدريب</th>
                                <th>وصف التدريب</th>
                            </tr>
                            @foreach($lesson->attaches as $attach)
                                <tr>
                                    <td>{{$attach->name}}</td>
                                    <td><a target="_blank" href="{{route('dahsboard.attaches.getFile',$attach->id)}}">تحميل</a></td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop