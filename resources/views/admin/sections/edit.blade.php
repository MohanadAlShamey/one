@extends('admin.layouts.master')

@section('ol')
    <li class="breadcrumb-item"><a href="{{route('dahsboard.home')}}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="{{route('dahsboard.sections')}}">الفصول</a></li>
    <li class="breadcrumb-item"><a>تعديل | {{$section->name}}</a></li>
@stop

@section('content')
<edit-section-component section_id="{{$section->id}}" section_name="{{$section->name}}"></edit-section-component>
@stop