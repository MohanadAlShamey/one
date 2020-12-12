
@extends('site.home.layout_site')
@php
    $asset=asset('/home_page/assets/');
    $storage="/storage/";
@endphp
@section('content')

<section id="about">
    <div class="container mt-3">
        <div class="row">
            <div class="col offset-lg-8 mx-auto text-justify">
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