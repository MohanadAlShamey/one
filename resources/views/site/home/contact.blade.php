
@extends('site.home.layout_site')
@php
    $storage="/storage/";
@endphp
@section('content')
    @php
        if(\Illuminate\Support\Str::length($page->group5->bg)<=8){
    $bg1="background-color:".$page->group5->bg;
    }elseif(\Illuminate\Support\Str::contains($page->group5->bg,'images/upload')){
    $bg1='background-image:url("'.asset($storage.$page->group5->bg).'");';
    $bg1.=$page->group5->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group5->size;
    }else{
    $bg1=$page->group5->bg;
    }
    @endphp
    <section id="contact" class="getintouch pt-1 pb-1" style="{{html_entity_decode($bg1)}}">
        <div class="container modern-form">
            <div class="text-center">
                <h4 style="color: {{$page->group5->color}};font-size: 45px;">إتصل بنا</h4>
            </div>
            <hr class="modern-form__hr">
            <div class="modern-form__form-container">
                <form method="post" action="{{route('home_page.contact.store',$page)}}">
                    @csrf
                    <div class="form-row">
                        <div class="col col-contact">
                            <div class="form-group modern-form__form-group--padding-r">
                                <input  class="form-control input input-tr" type="text" name="name" placeholder="الاسم">
                                <div class="line-box">
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-contact">
                            <div class="form-group modern-form__form-group--padding-l">
                                <input class="form-control input input-tr" type="text" name="email" placeholder="البريد الإلكتروني">
                                <div class="line-box">
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group modern-form__form-group--padding-t">
                                <textarea class="form-control input modern-form__form-control--textarea" name="msg" placeholder="الرسالة"></textarea>
                                <div class="line-box">
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col text-center">
                            <button class="btn btn-primary submit-now" type="submit">إرسال</button></div>
                    </div>
                </form>
            </div>
        </div>
    </section><!-- End: Modern Contact Form -->
    <!-- Start: Footer Basic -->

@stop
