
@extends('site.home.layout_site')
@php
    $storage="/storage/";
@endphp
@section('content')
@php
    if(\Illuminate\Support\Str::length($page->group1->bg)<=8){
    $bg1="background-color:".$page->group1->bg;
    }elseif(\Illuminate\Support\Str::contains($page->group1->bg,'images/upload')){
    $bg1='background-image:url("'.asset($storage.$page->group1->bg).'");';
    $bg1.=$page->group1->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group1->size;
    }else{
    $bg1=$page->group1->bg;
    }
@endphp
<header class="masthead text-center text-white d-flex" style="{{html_entity_decode($bg1)}}">
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <h1 class="text-uppercase" style="color:{{$page->group1->color}}"><strong>{{$page->group1->title}}</strong></h1>
                <hr>
            </div>
        </div>
        <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5" style="color:{{$page->group1->color}}"> {{$page->group1->body}}</p>

        </div>
    </div>
</header>

@php
    if(\Illuminate\Support\Str::length($page->group2->bg)<=8){
    $bg1="background-color:".$page->group2->bg;
    }elseif(\Illuminate\Support\Str::contains($page->group2->bg,'images/upload')){
    $bg1='background-image:url("'.asset($storage.$page->group2->bg).'");';
    $bg1.=$page->group2->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group2->size;
    }else{
    $bg1=$page->group2->bg;
    }
@endphp
<section id="about" style="{{html_entity_decode($bg1)}}">
    <div class="container">
        <div class="row">
            <div class="col offset-lg-8 mx-auto text-center">
                <h2 class=" section-heading" style="color:{{$page->group2->color}}">من نحن</h2>
                <hr class="light my-4">
                <p class="text-faded mb-4" style="color:{{$page->group2->color}}"> {{$page->group2->body}}</p>
            </div>
        </div>
    </div>
</section>
@php
    if(\Illuminate\Support\Str::length($page->group3->bg)<=8){
   $bg1="background-color:".$page->group3->bg;
   }elseif(\Illuminate\Support\Str::contains($page->group3->bg,'images/upload')){
   $bg1='background-image:url("'.asset($storage.$page->group3->bg).'");';
   $bg1.=$page->group3->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group3->size;
   }else{
   $bg1=$page->group3->bg;
   }
@endphp

<section id="services" style="{{html_entity_decode($bg1)}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" style="color:{{$page->group3->color}}">خدماتنا</h2>
                <hr class="my-4">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach($page->group3->services as $service)
            <div class="col-md-6 col-lg-3 text-center">
                <div class="mx-auto service-box mt-5">
                    <img src="{{asset($storage.$service->img)}}" data-aos="zoom-in" data-aos-duration="200" data-aos-once="true"></i>
                    <h3 class="mb-3">{{$service->name}}</h3>
                    <p class="text-muted mb-0" style="color:{{$page->group3->color}}">{{$service->description}}</p>
                </div>
            </div>
                @endforeach


        </div>
    </div>
</section>

@php


    if(\Illuminate\Support\Str::length($page->group4->bg)<=8){
    $bg1="background-color:".$page->group4->bg;
    }elseif(\Illuminate\Support\Str::contains($page->group4->bg,'images/upload')){
    $bg1='background-image:url("'.asset($storage.$page->group4->bg).'");';
    $bg1.=$page->group4->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group4->size;
    }else{
    $bg1=$page->group4->bg;
    }
@endphp
<section id="portfolio" class="p-0" style="{{html_entity_decode($bg1)}}">
    <div class="container-fluid p-0">
        <div class="row no-gutters popup-gallery">
            @foreach($page->group4->gallery as $gallery)
            <div class="col-sm-6 col-lg-4">
                <a class="portfolio-box" href="{{asset($storage.$gallery->img)}}">
                    <img class="img-fluid" src="{{asset($storage.$gallery->img)}}">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded"><span>{{$gallery->name}}</span></div>
                            <div class="project-name"><span>{{$gallery->description}}</span></div>
                        </div>
                    </div>
                </a>
            </div>


           @endforeach

            </div>
    </div>

</section>
<!-- Start: Modern Contact Form -->
@stop