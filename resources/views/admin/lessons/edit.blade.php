@extends('admin.layouts.master')

@section('ol')
    <li class="breadcrumb-item"><a href="{{route('dahsboard.home')}}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="{{route('dahsboard.sections')}}">الفصول</a></li>
    <li class="breadcrumb-item"><a href="{{route('dahsboard.sections.show',$lesson->section->id)}}">{{$lesson->section->name}}</a></li>
    <li class="breadcrumb-item"><a>تعديل | {{$lesson->name}}</a></li>
@stop

@section('content')
<edit-lesson-component lesson_id="{{$lesson->id}}" lesson_name="{{$lesson->name}}"></edit-lesson-component>
@stop