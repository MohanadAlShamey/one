@extends('admin.layouts.master')

@section('ol')
    <li class="breadcrumb-item"><a href="{{route('dahsboard.home')}}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="{{route('dahsboard.sections')}}">الفصول</a></li>
    <li class="breadcrumb-item"><a>إضافة فصل</a></li>
@stop

@section('content')
<add-section-component></add-section-component>
@stop