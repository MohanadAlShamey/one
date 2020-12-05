@extends('admin.layouts.master')

@section('ol')
    <li class="breadcrumb-item"><a href="{{route('dahsboard.home')}}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="" >التدريبات</a></li>

@stop

@section('content')
<all-example-component></all-example-component>
@stop