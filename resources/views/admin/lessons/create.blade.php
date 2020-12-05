@extends('admin.layouts.master')

@section('ol')
    <li class="breadcrumb-item"><a href="{{route('dahsboard.home')}}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="{{route('dahsboard.sections')}}">الفصول</a></li>
    <li class="breadcrumb-item"><a href="{{route('dahsboard.sections.show',$section->id)}}">{{$section->name}}</a></li>
    <li class="breadcrumb-item"><a>إضافة درس</a></li>
@stop

@section('content')
<add-lesson-component section_id="{{$section->id}}"></add-lesson-component>
@stop