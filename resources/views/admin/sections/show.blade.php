@extends('admin.layouts.master')

@section('ol')
    <li class="breadcrumb-item"><a href="{{route('dahsboard.home')}}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="{{route('dahsboard.sections')}}">الفصول</a></li>
    <li class="breadcrumb-item"><a>عرض | {{$section->name}}</a></li>
@stop

@section('content')
<show-section-component section_name="{{$section->name}}" section_id="{{$section->id}}"></show-section-component>
@stop