@extends('admin.layouts.master')

@section('ol')
    <li class="breadcrumb-item"><a href="{{route('dahsboard.home')}}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="{{route('dahsboard.users')}}">المستخدمين</a></li>
    <li class="breadcrumb-item"><a>تعديل | {{$user->username}}</a></li>
@stop

@section('content')
<edit-user-component :user_id="{{$user->id}}" user_name="{{$user->username}}" :options="{{$options}}"></edit-user-component>
@stop