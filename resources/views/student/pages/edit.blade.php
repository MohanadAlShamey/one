@extends('admin.layouts.master')

@section('content')
<dash-edit-page-component :users="{{$users}}" :page="{{$page}}"></dash-edit-page-component>

    @stop