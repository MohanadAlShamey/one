<!doctype html>
<html lang="ar" dir="rtl">
@php
    $asset='storage/';
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/site.css?'.date('l jS \of F Y h:i:s A'))}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    <link rel="icon" href="{{asset($asset.$page->logo)}}" type="image/gif" sizes="16x16">
    <title>{{$page->name}}</title>

    <style>
        .card-count {
            background: #3fc3ee;
            padding: 3px;
            border-radius: 5px;
            display: inline-block;
            margin: 4px;
        }

        .row.justify-content-center.p-3 {
            background-position: center !important;
            /* background-image:url("http://one2one.test/storage/app/public/images/upload/5fc8df5f9c47b.jpeg");
             background-size:cover;*/
        }
    </style>
</head>
<body>
<!-- Just an image -->

<section class="app" id="app">
    <nav class="navbar navbar-light fixed-top " style="background-color: rgba(0,0,0,.4)">
        <a class="navbar-brand" href="#">
            <img src="{{asset($asset.$page->logo)}}" width="30" height="30" alt="" loading="lazy">
        </a>
    </nav>

    @if($page->group1->active)
        @php

       if(\Illuminate\Support\Str::length($page->group1->bg)<9){
       $bg1="background:".$page->group1->bg;
       }elseif(\Illuminate\Support\Str::contains($page->group1->bg,'images/upload')){
       $bg1='background-image:url("'.asset($asset.$page->group1->bg).'");';
       $bg1.=$page->group1->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group1->size;
       }else{
       $bg1=$page->group1->bg;
       }

        @endphp

        <div class="container pt-5" style="{{html_entity_decode($bg1)}}">

            <div class="row justify-content-center pt-2">
                <div class="col-12">
                    <h4 class="d-flex flex-column text-center">
                        <strong class="" style="color:{{$page->group1->color??'#000'}}">{{$page->group1->title}}</strong>
                        <strong class="" style="color:{{$page->group1->color??'#000'}}">
                            <small>{{$page->group1->sub_title}}</small>
                        </strong>
                    </h4>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="img-thumbnail p-2 border-0 bg-dark my-2">
                        @if(\Illuminate\Support\Str::contains($page->group1->video,'images')&&\Illuminate\Support\Str::contains($page->group1->video,'upload'))
                            <img src="{{asset($asset.$page->group1->video)}}" class="img-fluid" alt="">
                        @else
                            <div class="embed-responsive embed-responsive-16by9">
                                {!! $page->group1->video !!}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-12 text-center my-3">
                    <div class="d-flex flex-column text-center justify-content-center">
                        <span class=" text-center h6 mb-2" style="color:{{$page->group1->color??'#000'}}">{{$page->group1->cta}}</span>
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-sm-12 mt-2">
                                <button type="button" data-toggle="modal" data-target="#exampleModal" class=" btn btn-sm btn-cta w-100 m-auto"><strong
                                            class="text-white text-center">{{$page->group1->btn}}</strong></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--End Group 1 --}}
    @endif
    @if($page->group2->active)
        @php
            if(\Illuminate\Support\Str::length($page->group2->bg)<=8){
         $bg1="background-color:".$page->group2->bg;
         }elseif(\Illuminate\Support\Str::contains($page->group2->bg,'images/upload')){
         $bg1='background-image:url("'.asset($asset.$page->group2->bg).'");';
         $bg1.=$page->group2->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group2->size;
         }else{
         $bg1=$page->group2->bg;
         }
        @endphp
        <div class="container py-2 mt-0" style="{{html_entity_decode($bg1)}}">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h4 class="text-center my-2"><strong class=""  style="color:{{$page->group2->color??'#000'}}">
                            {{$page->group2->title}}
                        </strong></h4>
                </div>

            </div>
            <div class="row ">
                <div class="col-sm-12 col-md-6  text-center">
                    <div class="d-flex flex-column my-5 justify-content-center">
                        <countdown :time="{{20*50*$count}}">
                            <template slot-scope="props">

                                <div class="d-flex flex-row justify-content-center">
                                    <div class="mx-3">
                                        <span  class=" h3">@{{ props.days }}</span>
                                        <hr>
                                        <span  style="color:{{$page->group2->color ??'#000'}}" class="h3">يوم</span>
                                    </div>

                                    <div class="mx-3">
                                        <span class=" h3">@{{ props.hours }}</span>
                                        <hr>
                                        <span  style="color:{{$page->group2->color??'#000'}}" class=" h3">ساعة</span>
                                    </div>


                                    <div class="mx-3">
                                        <span class=" h3">@{{ props.minutes }}</span>
                                        <hr>
                                        <span  style="color:{{$page->group2->color??'#000'}}" class=" h3">دقيقة</span>
                                    </div>

                                    <div class="mx-3">
                                        <span class=" h3">@{{ props.seconds }}</span>
                                        <hr>
                                        <span  style="color:{{$page->group2->color??'#000'}}" class=" h3">ثانية</span>
                                    </div>
                                </div>

                            </template>
                        </countdown>
                    </div>
                    <div class="my-2 p-2 d-none d-md-block text-center">
                        <span  style="color:{{$page->group2->color??'#000'}}" class="text-bold h5 text-center"><strong>{{$page->group2->qnt}}</strong></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="text-center">
                        <img src="{{asset($asset.$page->group2->img)}}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 d-none d-block d-md-none">
                    <div class="my-1 p-1 text-center">
                        <span  style="color:{{$page->group2->color??'#000'}}" class="text-bold h5 text-center"><strong>{{$page->group2->qnt}}</strong></span>
                    </div>
                </div>
            </div>
        </div>
        {{--End Group 2 --}}
    @endif
    @if($page->group3->active)
        {{--End Group 1 --}}
        @php
            if(\Illuminate\Support\Str::length($page->group3->bg)<=8){
       $bg1="background-color:".$page->group3->bg;
       }elseif(\Illuminate\Support\Str::contains($page->group3->bg,'images/upload')){
       $bg1='background-image:url("'.asset($asset.$page->group3->bg).'");';
       $bg1.=$page->group3->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group3->size;
       }else{
       $bg1=$page->group3->bg;
       }
        @endphp
        <div class="container py-2 mt-0" style="{{html_entity_decode($bg1)}}">
            <div class="row justify-content-center">
                <div class="col-md-6 col-sm-12 text-right py-3">
                    @foreach($page->group3->problems as $problem)
                        <div class="d-flex flex-row justify-content-start my-3"  style="color:{{$page->group3->color??'#000'}}">
                            <i class="far fa-window-close  fa-2x"  style="color:{{$page->group3->color??'#000'}}"></i>
                            <span class="mx-2 lead">{{$problem}}</span>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="text-center">
                        <img src="{{asset($asset.$page->group3->img)}}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="img-thumbnail p-3 border-0 radius shadow-box d-flex flex-column justify-content-center"
                     style="background-color: transparent">
                    <div class="bg-black radius" style="background-color: #000">
                        <p class="text-center p-2  h5 "  style="color:{{$page->group3->color??'#000'}}">{{$page->group3->story}}</p>
                    </div>
                </div>
            </div>


        </div>
    @endif
    @if($page->group4->active)

        @php
            if(\Illuminate\Support\Str::length($page->group4->bg)<=8){
    $bg1="background-color:".$page->group4->bg;
    }elseif(\Illuminate\Support\Str::contains($page->group4->bg,'images/upload')){
    $bg1='background-image:url("'.asset($asset.$page->group4->bg).'");';
    $bg1.=$page->group4->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group4->size;
    }else{
    $bg1=$page->group4->bg;
    }
        @endphp
        <div class="container py-2 mt-0" style="{{html_entity_decode($bg1)}}">
            <div class="row justify-content-center">
                <div class="col-md-6 col-sm-12 text-right py-3">
                    @foreach($page->group4->solutions as $problem)
                        <div class="d-flex flex-row justify-content-start my-3"  style="color:{{$page->group4->color??'#000'}}">
                        <span class="d-flex flex-column justify-content-center"> <i
                                    class="fa fa-check  fa-2x"  style="color:{{$page->group4->color??'#000'}}"></i></span>
                            <p class="mx-2 text-justify h5">{{$problem}}</p>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="text-center">
                        <img src="{{asset($asset.$page->group4->img)}}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center my-2">
                <div class="col-md-12">
                    <div class="d-flex flex-column text-center justify-content-center">
                        <span class="h5 border-dashed p-3 my-2"  style="color:{{$page->group4->color??'#000'}}"><strong>{{$page->group4->cta}}</strong></span>
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-sm-12 my-2">
                                <button type="button" data-toggle="modal" data-target="#exampleModal" class=" btn btn-sm btn-cta w-100 m-auto"><strong
                                            class="text-white">{{$page->group4->btn}}</strong></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($page->group5->active)
        @php
            if(\Illuminate\Support\Str::length($page->group5->bg)<=8){
 $bg1="background-color:".$page->group5->bg;
 }elseif(\Illuminate\Support\Str::contains($page->group5->bg,'images/upload')){
 $bg1='background-image:url("'.asset($asset.$page->group5->bg).'");';
 $bg1.=$page->group5->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group5->size;
 }else{
 $bg1=$page->group5->bg;
 }
        @endphp
        <div class="container py-2 mt-0" style="{{html_entity_decode($bg1)}}">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center py-3">
                    <h3 class=" text-center"  style="color:{{$page->group5->color??'#000'}}">{{$page->group5->price}}</h3>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-sm-12 text-right py-3">
                    @foreach($page->group5->benefists as $problem)
                        <div class="d-flex flex-row justify-content-start my-3 "  style="color:{{$page->group5->color??'#000'}}">
                        <span class="d-flex flex-column justify-content-center"> <i
                                    class="fa fa-star  fa-2x"  style="color:{{$page->group5->color??'#000'}}"></i></span>
                            <span  style="color:{{$page->group5->color??'#000'}}" class="mx-1 lead  border-dashed h5">{{$problem}}</span>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="text-center">
                        <img src="{{asset($asset.$page->group5->img)}}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($page->group6->active)
        @php
            if(\Illuminate\Support\Str::length($page->group6->bg)<=8){
$bg1="background-color:".$page->group6->bg;
}elseif(\Illuminate\Support\Str::contains($page->group6->bg,'images/upload')){
$bg1='background-image:url("'.asset($asset.$page->group6->bg).'");';
$bg1.=$page->group6->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group6->size;
}else{
$bg1=$page->group6->bg;
}
        @endphp
        <div class="container py-2 mt-0" style="{{html_entity_decode($bg1)}}">
            <div class="row justify-content-center">
                <div class="col-md-6 col-sm-12 text-right py-3">
                    @foreach($page->group6->dangers as $problem)
                        <div class="d-flex flex-row justify-content-start my-3"  style="color:{{$page->group6->color??'#000'}}">
                        <span class="d-flex flex-column justify-content-center"> <i
                                    class="fa fa-check  fa-2x" ></i></span>
                            <span  style="color:{{$page->group6->color??'#000'}}" class="mx-1 lead   border-dashed h5">{{$problem}}</span>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="text-center">
                        <img src="{{asset($asset.$page->group6->img)}}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-12"  style="color:{{$page->group6->color??'#000'}}">
                <p class="border-dashed py-3 px-2 text-warning border-warning text-center lead"
                   style="background-color: #000;">{{$page->group6->footer}}</p>
            </div>
        </div>
    @endif
    @if($page->group7->active)
        @php
            if(\Illuminate\Support\Str::length($page->group7->bg)<=8){
$bg1="background-color:".$page->group7->bg;
}elseif(\Illuminate\Support\Str::contains($page->group7->bg,'images/upload')){
$bg1='background-image:url("'.asset($asset.$page->group7->bg).'");';
$bg1.=$page->group7->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group7->size;
}else{
$bg1=$page->group7->bg;
}
        @endphp
        <div class="container py-2 mt-0" style="{{html_entity_decode($bg1)}}">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h3 class="text-center text-bold my-2"  style="color:{{$page->group7->color??'#000'}}">{{$page->group7->title}}</h3>

                </div>
                <div class="col-md-12">
                    <p class="border-dashed py-3 px-2 my-3 text-center lead"  style="color:{{$page->group7->color??'#000'}}">{{$page->group7->price}}</p>
                </div>
            </div>
        </div>
    @endif
    @if($page->group8->active)
        @php
            if(\Illuminate\Support\Str::length($page->group8->bg)<=8){
$bg1="background-color:".$page->group8->bg;
}elseif(\Illuminate\Support\Str::contains($page->group8->bg,'images/upload')){
$bg1='background-image:url("'.asset($asset.$page->group8->bg).'");';
$bg1.=$page->group8->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group8->size;
}else{
$bg1=$page->group8->bg;
}
        @endphp

        <div class="container py-2 mt-0 " style="{{html_entity_decode($bg1)}}">

            <div class="row justify-content-center">
                <div class="col-md-12 text-center"  style="color:{{$page->group8->color??'#000'}}">
                    <h4 class="border-dashed text-center "
                        style="border-radius: 0px !important;">{{$page->group8->title}}</h4>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6 col-sm-12 text-right py-3">
                    @foreach($page->group8->benefists as $problem)
                        <div class="d-flex flex-row justify-content-start my-3"  style="color:{{$page->group8->color??'#000'}}">
                        <span class="d-flex flex-column justify-content-center"> <i
                                    class="fa fa-check  fa-2x"  ></i></span>
                            <span  style="color:{{$page->group8->color??'#000'}}" class="mx-1 lead   border-dashed">{{$problem}}</span>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="text-center">
                        <img src="{{asset($asset.$page->group8->img)}}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-12"  style="color:{{$page->group8->color??'#000'}}">
                    <p class=" py-3 px-2  text-center lead"
                       style="background-color: #000;">{{$page->group8->footer}}</p>
                </div>

            </div>
            <div class="row justify-content-center my-2">
                <div class="col-md-12">
                    <div class="d-flex flex-column text-center justify-content-center">
                        <span class="h4  p-3 my-2"  style="color:{{$page->group8->color??'#000'}}">{{$page->group8->cta}}</span>
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-sm-12 my-2">
                                <button type="button" data-toggle="modal" data-target="#exampleModal" class=" btn btn-sm btn-cta w-100 m-auto"><strong
                                            class="text-white">{{$page->group8->btn}}</strong></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif
    @if($page->group9->active)
        @php
            if(\Illuminate\Support\Str::length($page->group9->bg)<=8){
$bg1="background-color:".$page->group9->bg;
}elseif(\Illuminate\Support\Str::contains($page->group9->bg,'images/upload')){
$bg1='background-image:url("'.asset($asset.$page->group8->bg).'");';
$bg1.=$page->group9->size=='repeat'?'background-repeat:repeat':'background-size:'.$page->group9->size;
}else{
$bg1=$page->group9->bg;
}
        @endphp
        <div class="container py-2 mt-0" style="{{html_entity_decode($bg1)}}">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    @foreach($page->group9->benefists as $benefist)
                        <div class="my-2">
                            <span><i class="fa fa-chevron-down fa-2x"></i></span>
                            <p class="border-dashed text-center text-bold h5"  style="color:{{$page->group9->color??'#000'}}">
                                {{$benefist}}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row justify-content-center my-2">
                <div class="col-md-12">
                    <div class="d-flex flex-column text-center justify-content-center">
                        <span class="h5  p-3 my-2" style="color:#f00"><strong  style="color:{{$page->group9->color??'#000'}}">{{$page->group9->cta}}</strong></span>
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-sm-12 my-2">
                                <button type="button" data-toggle="modal" data-target="#exampleModal" class=" btn btn-sm btn-cta w-100 m-auto"><strong
                                            class="text-white">{{$page->group9->btn}}</strong></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>


{{--<div class="container" id="app">
    <div class="row justify-content-center p-3"  style="@if($page->bg_1->img==null)background:{{$page->bg_1->color}}
    @else
            background:url('{{asset($asset.$page->bg_1->img)}}');
    @if($page->bg_1->repeat=='repeat')background-repeat: repeat
    @else background-size:{{$page->bg_1->repeat}};background-repeat: no-repeat @endif @endif">
        <div class="col-md-12 text-center">
            <h3>{{$page->head_line}}</h3>
            <h5>{{$page->sub_head_line}}</h5>
        </div>
        <div class="col-md-12 text-center">
            @if($page->img_video_type=='img')
                <img src="{{asset($asset.$page->img_video)}}" class="img-thumbnail img-fluid" alt="">
                @else
            {!! $page->img_video !!}
                @endif
        </div>
        <div class="col-md-12 text-center">
            <p class="lead">{{$page->cta1}}</p>
            <a href="" class="btn btn-sm btn-warning">{{$page->cta1_btn}}</a>
        </div>
    </div>
    <div class="row justify-content-center p-3"  style="@if($page->bg_2->img==null)background:{{$page->bg_2->color}}
    @else
            background:url('{{asset($asset.$page->bg_2->img)}}');
    @if($page->bg_2->repeat=='repeat')background-repeat: repeat
    @else background-size:{{$page->bg_2->repeat}};background-repeat: no-repeat @endif @endif">

    <div class="col-md-12 ">
          @foreach($page->whynows()->where('type','group1')->get() as $why)
           <p class="lead"><i class="fa fa-1x fa-question text-white bg-primary p-2"></i> {!!$why->body!!}</p>
              @endforeach
        </div>
        <div class="col-md-12 text-center">
            <p class="lead">{{$page->count}}</p>
            <countdown :time="{{20*50*$count}}">
                <template slot-scope="props">
                    <h5>الوقت المتبقي</h5>
                   <span class="card-count"> @{{ props.days }}<br> يوم</span>
                   <span class="card-count"> @{{ props.hours }}<br> ساعة</span>
                   <span class="card-count">  @{{ props.minutes }}<br> دقيقة</span>
                   <span class="card-count"> @{{ props.seconds }}<br> ثانية</span>
                    </template>
            </countdown>
        </div>
    </div>
    <div class="row justify-content-center p-3"
         style="@if($page->bg_3->img==null)background:{{$page->bg_3->color}}
         @else
                 background:url('{{asset($asset.$page->bg_3->img)}}');
         @if($page->bg_3->repeat=='repeat')background-repeat: repeat
         @else background-size:{{$page->bg_3->repeat}};background-repeat: no-repeat @endif @endif">
    <div class="col-md-12 ">
            @foreach( $page->problems as $problem)
            <p class="lead"><i class="fa fa-1x fa-close text-white bg-danger p-2"></i> {{$problem->body}}</p>
                @endforeach
        </div>

        <div class="col-md-12 text-center row justify-content-center">
           <div class="col-md-8 img-thumbnail">
               <img src="{{asset($asset.$page->img_story)}}" class="img-fluid" alt="">
               <p class="lead"> {!! $page->story !!}</p>
           </div>
        </div>


    ------------------------------
    <div class="col-md-12">
        @foreach($page->whynows()->where('type','group2')->get() as $why)
            <p class="lead"><i class="fa fa-1x fa-question text-white bg-primary p-2"></i> {!!$why->body!!}</p>
        @endforeach
    </div>

    <div class="col-md-12 text-center">
        <p class="lead">{{$page->cta2}}</p>
        <a href="" class="btn btn-sm btn-warning">{{$page->cta2_btn}}</a>
    </div>
</div>

    <div class="row justify-content-center p-3"
         style="@if($page->bg_4->img==null)background:{{$page->bg_4->color}}
         @else
                 background:url('{{asset($asset.$page->bg_4->img)}}');
         @if($page->bg_4->repeat=='repeat')background-repeat: repeat
         @else background-size:{{$page->bg_4->repeat}};background-repeat: no-repeat @endif @endif">


    <div class="col-md-12 text-center">
        <h4>السعر بدون القيمة المضافة</h4>
        <p class="lead">{{$page->real_price}}</p>

    </div>

    <div class="col-md-12">
        <h3>الفوائد</h3>
        @foreach($page->benefists as $benefist)
            <p class="lead"><i class="fa fa-1x fa-star text-danger bg-dark p-2"></i> {!!$benefist->body!!}</p>
        @endforeach
    </div>
    <div class="col-md-12 text-center">
        <h3 class="text-bold">السعر + القيمة المضافة</h3>
        <p class="lead">{{$page->total_price}}</p>

    </div>

    <div class="col-md-12">
        <h3>حذف المخاطر</h3>
        @foreach($page->dangers as $danger)
            <p class="lead"><i class="fa fa-1x fa-lock text-danger bg-dark p-2"></i> {!!$danger->body!!}</p>
        @endforeach
    </div>

    <div class="col-md-12 text-center">
        <h3 class="text-bold">مفترق الطرق</h3>
        <p class="lead">{{$page->fork_way}}</p>

    </div>
    </div>
    <div class="row justify-content-center p-3"
         style="@if($page->bg_5->img==null)background:{{$page->bg_5->color}}
         @else
                 background:url('{{asset($asset.$page->bg_5->img)}}');
         @if($page->bg_5->repeat=='repeat')background-repeat: repeat
         @else background-size:{{$page->bg_5->repeat}};background-repeat: no-repeat @endif @endif">


    <div class="col-md-12">
        <h3>العروض</h3>
        @foreach($page->offers as $offer)
            <p class="lead"><i class="fa fa-1x fa-gift text-danger bg-dark p-2"></i> {!!$offer->body!!}</p>
        @endforeach
    </div>

    <div class="col-md-12">
        @foreach($page->whynows()->where('type','group3')->get() as $why)
            <p class="lead"><i class="fa fa-1x fa-question text-white bg-primary p-2"></i> {!!$why->body!!}</p>
        @endforeach
    </div>
    <div class="col-md-12 text-center">
        <p class="lead">{{$page->cta3}}</p>
        <a href="" class="btn btn-sm btn-warning">{{$page->cta3_btn}}</a>
    </div>
    </div>
    <div class="row justify-content-center p-3"
         style="@if($page->bg_6->img==null)background:{{$page->bg_6->color}}
         @else
                 background:url('{{asset($asset.$page->bg_6->img)}}');
         @if($page->bg_6->repeat=='repeat')background-repeat: repeat
         @else background-size:{{$page->bg_6->repeat}};background-repeat: no-repeat @endif @endif">




    <div class="col-md-12">
        @foreach($page->quastions as $quastion)
            <p class="lead"><i class="fa fa-1x fa-question text-white bg-primary p-2"></i> {!!$quastion->ask!!}</p>
            <p class="lead"> {!!$quastion->answer!!}</p>
        @endforeach
    </div>

    <div class="col-md-12">
        @foreach($page->whynows()->where('type','group4')->get() as $why)
            <p class="lead"><i class="fa fa-1x fa-question text-white bg-primary p-2"></i> {!!$why->body!!}</p>
        @endforeach
    </div>

    <div class="col-md-12 text-center">
        <p class="lead">{{$page->cta4}}</p>
        <a href="" class="btn btn-sm btn-warning">{{$page->cta4_btn}}</a>
    </div>
</div>
</div>--}}
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" style="direction: rtl" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{route('orders.store',$page)}}" method="post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">طلب المنتج</h5>

            </div>
            <div class="modal-body" style="direction: rtl !important;">

                    @csrf
                    <div class="form-row">
                       <div class="col-md-6">
                           <label class="d-flex justify-content-start" >الاسم</label>
                           <input type="text" name="name" class="form-control">
                       </div>
                        <div class="col-md-6">
                            <label class="d-flex justify-content-start">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-6">
                            <label class="d-flex justify-content-start">العنوان</label>
                            <input type="text" name="address" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="d-flex justify-content-start">الهاتف</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                    </div>


                <div class="form-group">
                    <label class="d-flex justify-content-start">ملاحظات</label>
                    <textarea name="note" class="form-control"></textarea>
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-between" >
                <button type="submit" class="btn btn-primary">طلب</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء الأمر</button>

            </div>
        </div>
    </div>
    </form>
</div>

<script src="{{asset('js/site.js?'.date('l jS \of F Y h:i:s A'))}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
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