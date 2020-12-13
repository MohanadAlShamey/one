
@extends('site.home.layout_site')
@php

    $storage="/storage/";
@endphp
@section('content')

<section id="about">
    <div class="container mt-3">
        <div class="row">
            <div class="col offset-lg-8 mx-auto text-justify" style="color:{{$page->group7->color}}">
                @if($type=='policy')
                {!! $page->group7->policy !!}
                    @else
                    {!! $page->group7->terms !!}
                @endif
            </div>
        </div>
    </div>
</section>
@stop