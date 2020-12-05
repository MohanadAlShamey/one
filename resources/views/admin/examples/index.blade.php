@extends('admin.layouts.master')

@section('ol')
    <li class="breadcrumb-item"><a href="{{route('dahsboard.home')}}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="{{route('dahsboard.lessons.show',$example->lesson->id)}}" >{{$example->lesson->name}}</a></li>
    <li class="breadcrumb-item"><a>{{$example->name}}</a></li>
    <li class="breadcrumb-item"><a  >{{$user->name}}</a></li>
@stop

@section('content')
<rate-example-component user_id="{{$user->id}}" user_name="{{$user->name}}" example_id="{{$example->id}}" example_name="{{$example->name}}"></rate-example-component>
@stop