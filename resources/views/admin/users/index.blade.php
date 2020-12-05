@extends('admin.layouts.master')

@section('ol')
    <li class="breadcrumb-item"><a href="{{route('dahsboard.home')}}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a >المستخدمين</a></li>
@stop

@section('content')
<index-user-component></index-user-component>
@stop