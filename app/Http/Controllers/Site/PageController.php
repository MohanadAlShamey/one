<?php

namespace App\Http\Controllers\Site;

use App\Contact;
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

    public function contact(Page $page){
        // return $page;
        if($page->type!='homepage'){
            return redirect(404);
        }

        return view('site.home.contact',compact('page'));
    }

    public function storeContact(Request $request,Page $page){
$this->validate($request,[
    'name'=>'required',
    'email'=>'required|email',
    'msg'=>'required'
],[
    'name.required'=>'حقل الاسم مطلوب',
    'email.required'=>'حقل البريد الإلكتروني مطلوب',
    'email.email'=>'البريد الإلكتروني غير صالح',
    'msg.required'=>'يجب كتابة الرسالة',
]);

Contact::create([
    'user_id'=>$page->user_id,
    'name'=>$request->name,
    'email'=>$request->email,
    'msg'=>$request->msg,
]);
return redirect()->route('home_page.show',$page)->with('success','تم إرسال الرسالة بنجاح سيتم الرد بأقرب وقت ممكن');
    }
}
