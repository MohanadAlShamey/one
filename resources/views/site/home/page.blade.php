<!DOCTYPE html>
<html>
@php
$asset=asset('/home_page/assets/');
$storage="/storage/";
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
    <link rel="stylesheet" href="{{$asset}}/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{$asset}}//css/styles.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap');
        *{
            font-family: 'Cairo', sans-serif !important;
        }
    </style>
</head>

<body id="page-top" class="rtl">
<nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
            <img src="{{asset($storage.$page->logo)}}" alt="">
        </a>
        <button data-toggle="collapse" data-target="#navbarResponsive"
                class="navbar-toggler navbar-toggler-right" type="button"
                aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <i class="fa fa-align-justify"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">من نحن</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services">خدماتنا</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio">المعرض</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">إتصل بنا</a></li>
            </ul>
        </div>
    </div>
</nav>
@php
    if(isset($page->group1->css)&&!is_null($page->group1->css)){
    $bg1=$page->group2->css;
    }elseif(\Illuminate\Support\Str::length($page->group1->bg)<=8){
    $bg1="background-color:".$page->group1->bg;
    }else{
    $bg1='background-image:url("'.asset($storage.$page->group1->bg).'");';
    $bg1.=$page->group1->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group1->size;
    }
@endphp
<header class="masthead text-center text-white d-flex" style="{{$bg1}}">
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <h1 class="text-uppercase"><strong>{{$page->group1->title}}</strong></h1>
                <hr>
            </div>
        </div>
        <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5"> {{$page->group1->body}}</p>

        </div>
    </div>
</header>

@php
    if(isset($page->group2->css)&&!is_null($page->group2->css)){
    $bg1=$page->group2->css;
    }elseif(\Illuminate\Support\Str::length($page->group2->bg)<=8){
    $bg1="background-color:".$page->group2->bg;
    }else{
    $bg1='background-image:url("'.asset($storage.$page->group2->bg).'");';
    $bg1.=$page->group2->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group2->size;
    }
@endphp
<section id="about" style="{{$bg1}}">
    <div class="container">
        <div class="row">
            <div class="col offset-lg-8 mx-auto text-center">
                <h2 class="text-white section-heading">من نحن</h2>
                <hr class="light my-4">
                <p class="text-faded mb-4"> {{$page->group2->body}}</p>
            </div>
        </div>
    </div>
</section>
@php
    if(isset($page->group3->css)&&!is_null($page->group3->css)){
    $bg1=$page->group3->css;
    }elseif(\Illuminate\Support\Str::length($page->group3->bg)<=8){
    $bg1="background-color:".$page->group3->bg;
    }else{
    $bg1='background-image:url("'.asset($storage.$page->group3->bg).'");';
    $bg1.=$page->group3->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group3->size;
    }
@endphp

<section id="services" style="{{$bg1}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">خدماتنا</h2>
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
                    <p class="text-muted mb-0">{{$service->description}}</p>
                </div>
            </div>
                @endforeach


        </div>
    </div>
</section>

@php
    if(isset($page->group4->css)&&!is_null($page->group4->css)){
    $bg1=$page->group4->css;
    }elseif(\Illuminate\Support\Str::length($page->group4->bg)<=8){
    $bg1="background-color:".$page->group4->bg;
    }else{
    $bg1='background-image:url("'.asset($storage.$page->group4->bg).'");';
    $bg1.=$page->group4->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group4->size;
    }
@endphp
<section id="portfolio" class="p-0" style="{{$bg1}}">
    <div class="container-fluid p-0">
        <div class="row no-gutters popup-gallery">
            @foreach($page->group4->gallery as $gallery)
            <div class="col-sm-6 col-lg-4">
                <a class="portfolio-box" href="#">
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
@php
    if(isset($page->group5->css)&&!is_null($page->group5->css)){
    $bg1=$page->group5->css;
    }elseif(\Illuminate\Support\Str::length($page->group5->bg)<=8){
    $bg1="background-color:".$page->group5->bg;
    }else{
    $bg1='background-image:url("'.asset($storage.$page->group5->bg).'");';
    $bg1.=$page->group5->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group5->size;
    }
@endphp
<section id="contact" class="getintouch" style="{{$bg1}}">
    <div class="container modern-form">
        <div class="text-center">
            <h4 style="color: #212529;font-size: 45px;">إتصل بنا</h4>
        </div>
        <hr class="modern-form__hr">
        <div class="modern-form__form-container">
            <form>
                <div class="form-row">
                    <div class="col col-contact">
                        <div class="form-group modern-form__form-group--padding-r">
                            <input class="form-control input input-tr" type="text" placeholder="الاسم">
                            <div class="line-box">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-contact">
                        <div class="form-group modern-form__form-group--padding-l">
                            <input class="form-control input input-tr" type="text" placeholder="البريد الإلكتروني">
                            <div class="line-box">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group modern-form__form-group--padding-t">
                            <textarea class="form-control input modern-form__form-control--textarea" placeholder="الرسالة"></textarea>
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

@php
    if(isset($page->group6->css)&&!is_null($page->group6->css)){
    $bg1=$page->group6->css;
    }elseif(\Illuminate\Support\Str::length($page->group6->bg)<=8){
    $bg1="background-color:".$page->group6->bg;
    }else{
    $bg1='background-image:url("'.asset($storage.$page->group6->bg).'");';
    $bg1.=$page->group6->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group6->size;
    }
@endphp
<div class="footer-basic" style="{{$bg1}}">
    <footer>
        <!-- Start: Social Icons -->
        <div class="social">
           @if($page->group6->inestagram!='')
                <a href="{{$page->group6->inestagram}}">
                    <i class="icon ion-social-instagram"></i>
                </a>
               @endif
               @if($page->group6->twitter!='')

            <a href="{{$page->group6->twitter}}">
                <i class="icon ion-social-twitter"></i>
            </a>
               @endif
               @if($page->group6->face!='')
            <a href="{{$page->group6->face}}">
                <i class="icon ion-social-facebook"></i>
            </a>
                   @endif
        </div><!-- End: Social Icons -->
        <!-- Start: Links -->
        <ul class="list-inline">



            <li class="list-inline-item"><a class="js-scroll-trigger" href="#page-top">الرئيسية</a></li>
            <li class="list-inline-item"><a class="js-scroll-trigger" href="#services">خدماتنا</a></li>
            <li class="list-inline-item"><a class="js-scroll-trigger" href="#about">من نحن</a></li>
            <li class="list-inline-item"><a class="js-scroll-trigger" href="#portfolio">المعرض</a></li>
            <li class="list-inline-item"><a class="js-scroll-trigger" href="{{route('home_page.terams',$page)}}">شروط الإستخدام</a></li>
            <li class="list-inline-item"><a class="js-scroll-trigger" href="{{route('home_page.policy',$page)}}">سياسة الخصوصية</a></li>
        </ul><!-- End: Links -->
        <!-- Start: Copyright -->
        <p class="copyright">{{$page->group7->company}} © {{date('Y')}}</p><!-- End: Copyright -->
    </footer>
</div><!-- End: Footer Basic -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="{{$asset}}//js/script.min.js?h=9844fe25e6b4ee529bf71977d852a46b"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-v4-rtl/4.5.2-1/js/bootstrap.min.js"></script>
</body>

</html>