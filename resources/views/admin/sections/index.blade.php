@extends('admin.layouts.master')

@section('ol')
    <li class="breadcrumb-item"><a href="{{route('dahsboard.home')}}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a >الفصول</a></li>
@stop

@section('content')
<index-section-component></index-section-component>
@stop