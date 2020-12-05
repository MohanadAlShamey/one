@extends('admin.layouts.master')

@section('content')
<add-page-component :users="{{$users}}"></add-page-component>

    @stop