<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="site_url" content="{{url('/')}}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>One2One</title>


    <!-- Font Awesome Icons -->
    {{-- <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
     <!-- Theme style -->
     <link rel="stylesheet" href="dist/css/adminlte.min.css">
     <!-- Google Font: Source Sans Pro -->
     <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

     <!-- bootstrap rtl -->
     <link rel="stylesheet" href="dist/css/bootstrap-rtl.min.css">
     <!-- template rtl version -->
     <link rel="stylesheet" href="dist/css/custom-style.css">--}}
    <link rel="stylesheet" href="{{asset('css/app.css?v=2')}}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap');
        .new-font{
            font-family: 'Dancing Script', cursive;
        }
    </style>
    <style>
        /* cairo-regular - latin */
        @font-face {
            font-family: 'cairo';
            font-style:all;
            font-weight: 600;
            src: url('{{asset('fonts/cairo/Cairo-Regular.ttf')}}') format('truetype'), /* IE9 Compat Modes */ /* src: local('Cairo Regular'), local('Cairo-Regular'),*/ url('{{asset('fonts/cairo/cairo-v8-latin-regular.eot?#iefix')}}') format('embedded-opentype'), /* IE6-IE8 */ url('{{asset('fonts/cairo/cairo-v8-latin-regular.woff2')}}') format('woff2'), /* Super Modern Browsers */ url('{{asset('fonts/cairo/cairo-v8-latin-regular.woff')}}') format('woff'), /* Modern Browsers */ url('{{asset('fontsfonts/cairo/cairo-v8-latin-regular.ttf')}}') format('truetype'), /* Safari, Android, iOS */ url('{{asset('fonts/cairo/cairo-v8-latin-regular.svg#Cairo')}}') format('svg'); /* Legacy iOS */
            url('{{asset('fonts/cairo/Cairo-Bold.ttf')}}') format('truetype'), /* IE9 Compat Modes */ /* src: local('Cairo Regular'), local('Cairo-Regular'),*/ url('{{asset('fonts/cairo/cairo-v8-latin-regular.eot?#iefix')}}') format('embedded-opentype'), /* IE6-IE8 */ url('{{asset('fonts/cairo/cairo-v8-latin-regular.woff2')}}') format('woff2'), /* Super Modern Browsers */ url('{{asset('fonts/cairo/cairo-v8-latin-regular.woff')}}') format('woff'), /* Modern Browsers */ url('{{asset('fontsfonts/cairo/cairo-v8-latin-regular.ttf')}}') format('truetype'), /* Safari, Android, iOS */ url('{{asset('fonts/cairo/cairo-v8-latin-regular.svg#Cairo')}}') format('svg'); /* Legacy iOS */
        }

        @font-face {
            font-family: 'cairo';
            font-style:all;
            font-weight: 900;
            src:url('{{asset('fonts/cairo/Cairo-Bold.ttf')}}') format('truetype'), /* IE9 Compat Modes */ /* src: local('Cairo Regular'), local('Cairo-Regular'),*/ url('{{asset('fonts/cairo/cairo-v8-latin-regular.eot?#iefix')}}') format('embedded-opentype'), /* IE6-IE8 */ url('{{asset('fonts/cairo/cairo-v8-latin-regular.woff2')}}') format('woff2'), /* Super Modern Browsers */ url('{{asset('fonts/cairo/cairo-v8-latin-regular.woff')}}') format('woff'), /* Modern Browsers */ url('{{asset('fontsfonts/cairo/cairo-v8-latin-regular.ttf')}}') format('truetype'), /* Safari, Android, iOS */ url('{{asset('fonts/cairo/cairo-v8-latin-regular.svg#Cairo')}}') format('svg'); /* Legacy iOS */
        }
        .sidebar-mini .nav-sidebar, .sidebar-mini .nav-sidebar .nav-link, .sidebar-mini .nav-sidebar > .nav-header{
            white-space: normal !important;
        }
        * {
            font-family: 'cairo', 'sans-serif';
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link:active, .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link:focus{
            background-color: rgba(161, 204, 167, 0.95) !important;
        }
        .sidebar-dark-primary .nav-treeview > .nav-item > .nav-link.active, .sidebar-dark-primary .nav-treeview > .nav-item > .nav-link.active:hover{
            background-color: #1fc8e3;
        }
        .sidebar-dark-primary .nav-sidebar > .nav-item.menu-open > .nav-link, .sidebar-dark-primary .nav-sidebar > .nav-item:hover > .nav-link{
            background-color: #ccc;
        }
        .sidebar-dark-primary .nav-sidebar > .nav-item.menu-open > .nav-link, .sidebar-dark-primary .nav-sidebar > .nav-item:hover > .nav-link:hover{
            background-color: #ccc;
        }
        .sidebar-dark-primary .nav-treeview > .nav-item > .nav-link:hover{
            background-color: #ccc;
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active{
            background-color: rgba(161, 204, 167, 0.95) !important;
        }
        .menu-open>a{
            background-color: #ccc !important;
        }
       
    </style>
    @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
            @if(auth()->user()->hasOption('landingpage'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('dashboard.pages')}}">
                      صفحات الهبوط
                    </a>

                </li>
            @endif
        {{-- @include('admin.layouts.ul')--}}
            {{--  <li class="nav-item d-none d-sm-inline-block">
                  <a href="index3.html" class="nav-link">خانه</a>
              </li>
              <li class="nav-item d-none d-sm-inline-block">
                  <a href="#" class="nav-link">تماس</a>
              </li>--}}
        </ul>

        <!-- SEARCH FORM -->
    {{--  <form class="form-inline ml-3">
          <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">
              <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                      <i class="fa fa-search"></i>
                  </button>
              </div>
          </div>
      </form>--}}

    <!-- Right navbar links -->
      {{--  <ul class="navbar-nav mr-auto">
            <!-- Messages Dropdown Menu -->
        --}}
        {{--  <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="fa fa-envelope"></i>
                  <span class="badge badge-danger navbar-badge">3</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                  <a href="#" class="dropdown-item">
                      <!-- Message Start -->
                      <div class="media">
                          <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 ml-3 img-circle">
                          <div class="media-body">
                              <h3 class="dropdown-item-title">
                                  {{auth()->user()->username}}
                                  <span class="float-left text-sm text-danger"><i class="fa fa-star"></i></span>
                              </h3>
                              <p class="text-sm">با من تماس بگیر لطفا...</p>
                              <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>
                          </div>
                      </div>
                      <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <!-- Message Start -->
                      <div class="media">
                          <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle ml-3">
                          <div class="media-body">
                              <h3 class="dropdown-item-title">
                                  پیمان احمدی
                                  <span class="float-left text-sm text-muted"><i class="fa fa-star"></i></span>
                              </h3>
                              <p class="text-sm">من پیامتو دریافت کردم</p>
                              <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>
                          </div>
                      </div>
                      <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <!-- Message Start -->
                      <div class="media">
                          <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle ml-3">
                          <div class="media-body">
                              <h3 class="dropdown-item-title">
                                  سارا وکیلی
                                  <span class="float-left text-sm text-warning"><i class="fa fa-star"></i></span>
                              </h3>
                              <p class="text-sm">پروژه اتون عالی بود مرسی واقعا</p>
                              <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i>4 ساعت قبل</p>
                          </div>
                      </div>
                      <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">مشاهده همه پیام‌ها</a>
              </div>
          </li>--}}{{--
        <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">10</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                    <span class="dropdown-item dropdown-header">15 نوتیفیکیشن</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-envelope ml-2"></i> 4 پیام جدید
                        <span class="float-left text-muted text-sm">3 دقیقه</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-users ml-2"></i> 8 درخواست دوستی
                        <span class="float-left text-muted text-sm">12 ساعت</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-file ml-2"></i> 3 گزارش جدید
                        <span class="float-left text-muted text-sm">2 روز</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">مشاهده همه نوتیفیکیشن</a>
                </div>
            </li>
            --}}{{-- <li class="nav-item">
                 <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                             class="fa fa-th-large"></i></a>
             </li>--}}{{--
        </ul>--}}
        <admin-notify-component></admin-notify-component>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('home')}}" class="brand-link">
            {{--<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">--}}
            <span class="brand-text font-weight-light new-font d-block text-center" >One to One</span>
            <span class="brand-text font-weight-light  d-block small text-center" >تعليمية - تدريبية - <span class="text-warning font-weight-bolder" style="font-weight: bolder">إستشارية</span></span>
        </a>
        <a href="" class="d-inline-block p-2 text-center text-white">
            {{auth()->user()->name}} / {{auth()->user()->company}}
        </a>

        <!-- Sidebar -->
        <div class="sidebar" style="background-color: #fff;">
            <div>
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel ">
                    <div class="info">
                        <a href="#" class="d-block text-dark">قائمة الدروس</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                @if (auth()->user()->hasRole('admin'))
                    @include('admin.layouts.navs.admin_nav')

                    @elseif(auth()->user()->hasRole('student'))
                    @include('admin.layouts.navs.student_nav1')
                @endif

            <!-- /.sidebar-menu -->
            </div>
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <ol class="breadcrumb ">

                            {{--<li class="breadcrumb-item active">صفحه سریع</li>--}}
                            @section('ol')
                                <li class="breadcrumb-item"><a href="{{url('/home')}}">الرئيسية</a></li>
                            @show
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
    @yield('content')
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
{{--<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>--}}
<!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>CopyLeft &copy; {{date('Y')}} <a href="#">أحمد نحاس</a>.</strong>
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<script src="{{asset('js/app.js?v=2')}}"></script>
@yield('js')
@if(session()->has('success'))
    <script>
        Toast.fire({
            icon:'success',
            title:'{{session('success')}}'
        })
    </script>
@endif
</body>
</html>
