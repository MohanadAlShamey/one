@extends('admin.layouts.master')

@section('ol')
    <li class="breadcrumb-item"><a href="{{route('dahsboard.home')}}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a >الدروس</a></li>
@stop

@section('content')
<index-lesson-component></index-lesson-component>
@stop