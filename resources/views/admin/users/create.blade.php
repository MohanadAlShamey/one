@extends('admin.layouts.master')

@section('ol')
    <li class="breadcrumb-item"><a href="{{route('dahsboard.home')}}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="{{route('dahsboard.users')}}">المستخدمين</a></li>
    <li class="breadcrumb-item"><a>إضافة مستخدم</a></li>
@stop

@section('content')
<add-user-component date_now="{{date('Y-m-d',time())}}" :options="{{$options}}"></add-user-component>
@stop