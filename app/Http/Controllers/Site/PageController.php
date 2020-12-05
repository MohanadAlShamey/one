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
}
