
<!DOCTYPE html>
<html>
@php
    $asset=asset('/home_page/assets/');
    $storage="/storage/";
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{$page->name}}</title>
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
        nav .nav-link.js-scroll-trigger {
            color:#000 !important;
        }
        p{
            line-height: 2 !important;

        }

    </style>
</head>

<body id="page-top" class="rtl">
<nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="{{route('home_page.show',$page)}}">
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
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{route('home_page.show',$page)}}">الرئيسية</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">من نحن</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services">خدماتنا</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio">المعرض</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{route('home_page.contact',$page)}}">إتصل بنا</a></li>
            </ul>
        </div>
    </div>
</nav>


@yield('content')

@php
    if(\Illuminate\Support\Str::length($page->group6->bg)<=8){
    $bg1="background-color:".$page->group6->bg;
    }elseif(\Illuminate\Support\Str::contains($page->group6->bg,'images/upload')){
    $bg1='background-image:url("'.asset($storage.$page->group6->bg).'");';
    $bg1.=$page->group6->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group6->size;
    }else{
    $bg1=$page->group6->bg;
    }
@endphp

<div class="footer-basic" style="{{html_entity_decode($bg1)}}">
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
            <li class="list-inline-item"><a class="js-scroll-trigger" href="{{route('home_page.terams',$page)}}">شروط الإستخدام</a></li>
            <li class="list-inline-item"><a class="js-scroll-trigger" href="{{route('home_page.policy',$page)}}">سياسة الخصوصية</a></li>
            <li class="list-inline-item"><a class="js-scroll-trigger" href="{{route('home_page.contact',$page)}}">إتصل بنا</a></li>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@if(session()->has('success'))
<script>
    Swal.fire({
        icon:'success',
        text:"{{session('success')}}"
    });
</script>
    @endif
</body>

</html>