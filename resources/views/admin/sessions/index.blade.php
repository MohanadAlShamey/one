@extends('admin.layouts.master')

@section('ol')
    <li class="breadcrumb-item"><a href="{{route('dahsboard.home')}}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a >حجوزات منصة زووم</a></li>
@stop

@section('content')
<resive-session-component></resive-session-component>
@stop