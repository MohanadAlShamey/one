<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Page $page){
        $end=Carbon::createFromFormat('Y-m-d',date('Y-m-d',strtotime($page->group2->date)))->endOfDay()->endOfHour()->endOfMinute()->endOfSecond();
        //dd($end);
        $count=Carbon::now()->diffInSeconds($end);
        //dd($count);

        return view('site.layouts.theme1.layouts',compact('page','count'));
    }
    public function home(Page $page){
        if($page->type!='homepage'){
            return redirect(404);
        }
        return view('site.home.page',compact('page'));
    }

    public function policy(Page $page){
        if($page->type!='homepage'){
            return redirect(404);
        }
        $type='policy';
        return view('site.home.privacy',compact('page','type'));
    }

    public function terams(Page $page){
       // return $page;
        if($page->type!='homepage'){
            return redirect(404);
        }
        $type='terams';
        return view('site.home.privacy',compact('page','type'));
    }
}
