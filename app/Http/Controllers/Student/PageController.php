<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Page;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PageController extends Controller
{
    public function index()
    {
        if(!auth()->user()->hasOption('landingpage')){
           abort(403,'not allow to access');
        }

        return view('student.pages.index');
    }

    public function getAllPage(Request $request)
    {
        $q = $request->q;
        return auth()->user()->pages()->where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%");
            $query->orWhereHas('user', function ($query) use ($q) {
                $query->where('name', 'like', "%$q%");
            });
        })->latest()->get();
    }

    public function create()
    {
        if(!auth()->user()->hasOption('landingpage')){
            abort(403,'not allow to access');
        }
        $users = User::all();
        return view('student.pages.create', compact('users'));
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasOption('landingpage')){
            abort(403,'not allow to access');
        }
        $group1 = $request->group1;// {title: "", video: "", img: "", sub_title: "", cta: "", btn: "", bg: "", size: "cover"},
        $group1['video'] = $this->ImageUpload($group1['video']);
        $group1 = $this->shiftEmpty($group1);

        $group1['bg'] = $this->ImageUpload($group1['bg']);
        $group2 = $request->group2;// {title: "", body: "", qnt: "", date: "", img: "", cta: "", btn: "", bg: "", size: "cover"}
        $group2['img'] = $this->ImageUpload($group2['img']);
        $group2['bg'] = $this->ImageUpload($group2['bg']);
        $group2 = $this->shiftEmpty($group2);
        $group3 = $request->group3;//{problems:[],img:"",story:"",img_story:"",bg_story:"",btn:"",bg:"",size:"cover"},
        $group3['img']=$this->ImageUpload($group3['img']);
        $group3['img_story']=$this->ImageUpload($group3['img_story']);
        $group3['bg_story']=$this->ImageUpload($group3['bg_story']);
        $group3['bg']=$this->ImageUpload($group3['bg']);
        $group3 = $this->shiftEmpty($group3);
        $group4 = $request->group4;//{solutions:[],img:"",title:"",body:"",cta:"",btn:"",bg:"",size:"cover"},
        $group4['img'] = $this->ImageUpload($group4['img']);
        $group4['bg'] = $this->ImageUpload($group4['bg']);
        $group4 = $this->shiftEmpty($group4);
        $group5 = $request->group5;//{title:"",price:"",benefists:[],bg:"",size:"cover"},
        //$group2['img'] = $this->ImageUpload($group2['img']);
        $group5['bg'] = $this->ImageUpload($group5['bg']);
        $group5 = $this->shiftEmpty($group5);
        $group6 = $request->group6;//{title:"",price:"",dangers:[],img:"",footer:"",bg:"",size:""},
        //$group2['img'] = $this->ImageUpload($group2['img']);
        $group6['bg'] = $this->ImageUpload($group6['bg']);
        $group6 = $this->shiftEmpty($group6);
        $group7 = $request->group7;//{title:"",sub_title:"",price:"",bg:"",size:""},
        // $group2['img'] = $this->ImageUpload($group2['img']);
        $group7['bg'] = $this->ImageUpload($group7['bg']);
        $group7 = $this->shiftEmpty($group7);
        $group8 = $request->group8;//{title:"",benefists:[],img:"",bg:"",size:""},
        $group8['img'] = $this->ImageUpload($group8['img']);
        $group8['bg'] = $this->ImageUpload($group8['bg']);
        $group8 = $this->shiftEmpty($group8);
        $group9 = $request->group9;//{title:"",sub_title:"",cta:"",btn:"",bg:"",size:""},
        //$group2['img'] = $this->ImageUpload($group2['img']);

        $group9['bg'] = $this->ImageUpload($group9['bg']);
        $group9 = $this->shiftEmpty($group9);
        $group10 = $request->group10;//:{questions:[{ask:"",answer:""}],cta:"",btn:"",bg:"",size:""},
        //$group2['img'] = $this->ImageUpload($group2['img']);
        $group10['bg'] = $this->ImageUpload($group10['bg']);
        $group10 = $this->shiftEmpty($group10);
        $group11 = $request->group11;//:{bg:"",size:""},
        $group11 = $this->shiftEmpty($group11);
        //return ['shift'=>,'ttt'=>$group3];

        $page=Page::create([
            'user_id'=>auth()->id(),
            'name'=>$request->name,
            'logo'=>$this->ImageUpload($request->logo,65),
            'group1'=>$group1,
            'group2'=>$group2,
            'group3'=>$group3,
            'group4'=>$group4,
            'group5'=>$group5,
            'group6'=>$group6,
            'group7'=>$group7,
            'group8'=>$group8,
            'group9'=>$group9,
            'group10'=>$group10,
            'group11'=>$group11,
        ]);

    }

    private function ImageUpload($string,$width=null)
    {
       // dd($string);

        if ($string != null && Str::contains($string, 'base64')) {
            if($width==null){
                $width= Image::make($string)->getWidth();
            }
            $ex = explode('/', explode(';', $string)[0])[1];
            // dd($ex);
            $name = 'images/upload/' . uniqid() . '.'.$ex;
            Image::make($string)->resize($width,null,function ($r){
                $r->aspectRatio();
            })/*->encode('webp', 100)*/->save(storage_path('app/public/' . $name));
            return $name;
        }
        return $string;
    }

    public function edit(Page $page)
    {
        if(!auth()->user()->hasOption('landingpage')){
            abort(403,'not allow to access');
        }
        $users = User::all();
        return view('student.pages.edit', compact('page', 'users'));
    }

    public function update(Request $request, Page $page)
    {
        if(!auth()->user()->hasOption('landingpage')){
            abort(403,'not allow to access');
        }
        //return $request->group5;
        $group1 = $request->group1;// {title: "", video: "", img: "", sub_title: "", cta: "", btn: "", bg: "", size: "cover"},
        $group1['video'] = $this->ImageUpload($group1['video']);
        $group1 = $this->shiftEmpty($group1);

        $group1['bg'] = $this->ImageUpload($group1['bg']);
        $group2 = $request->group2;// {title: "", body: "", qnt: "", date: "", img: "", cta: "", btn: "", bg: "", size: "cover"}
        $group2['img'] = $this->ImageUpload($group2['img']);
        $group2['bg'] = $this->ImageUpload($group2['bg']);
        $group2 = $this->shiftEmpty($group2);
        $group3 = $request->group3;//{problems:[],img:"",story:"",img_story:"",bg_story:"",btn:"",bg:"",size:"cover"},
        $group3['img']=$this->ImageUpload($group3['img']);
        $group3['img_story']=$this->ImageUpload($group3['img_story']);
        $group3['bg_story']=$this->ImageUpload($group3['bg_story']);
        $group3['bg']=$this->ImageUpload($group3['bg']);
        $group3 = $this->shiftEmpty($group3);
        $group4 = $request->group4;//{solutions:[],img:"",title:"",body:"",cta:"",btn:"",bg:"",size:"cover"},
        $group4['img'] = $this->ImageUpload($group4['img']);
        $group4['bg'] = $this->ImageUpload($group4['bg']);
        $group4 = $this->shiftEmpty($group4);
        $group5 = $request->group5;//{title:"",price:"",benefists:[],bg:"",size:"cover"},
        //$group2['img'] = $this->ImageUpload($group2['img']);
        $group5['bg'] = $this->ImageUpload($group5['bg']);
        $group5 = $this->shiftEmpty($group5);
        $group6 = $request->group6;//{title:"",price:"",dangers:[],img:"",footer:"",bg:"",size:""},
        //$group2['img'] = $this->ImageUpload($group2['img']);
        $group6['bg'] = $this->ImageUpload($group6['bg']);
        $group6 = $this->shiftEmpty($group6);
        $group7 = $request->group7;//{title:"",sub_title:"",price:"",bg:"",size:""},
        // $group2['img'] = $this->ImageUpload($group2['img']);
        $group7['bg'] = $this->ImageUpload($group7['bg']);
        $group7 = $this->shiftEmpty($group7);
        $group8 = $request->group8;//{title:"",benefists:[],img:"",bg:"",size:""},
        $group8['img'] = $this->ImageUpload($group8['img']);
        $group8['bg'] = $this->ImageUpload($group8['bg']);
        $group8 = $this->shiftEmpty($group8);
        $group9 = $request->group9;//{title:"",sub_title:"",cta:"",btn:"",bg:"",size:""},
        //$group2['img'] = $this->ImageUpload($group2['img']);

        $group9['bg'] = $this->ImageUpload($group9['bg']);
        $group9 = $this->shiftEmpty($group9);
        $group10 = $request->group10;//:{questions:[{ask:"",answer:""}],cta:"",btn:"",bg:"",size:""},
        //$group2['img'] = $this->ImageUpload($group2['img']);
        $group10['bg'] = $this->ImageUpload($group10['bg']);
        $group10 = $this->shiftEmpty($group10);
        $group11 = $request->group11;//:{bg:"",size:""},
        $group11 = $this->shiftEmpty($group11);
        //return ['shift'=>,'ttt'=>$group3];
        $page->update([

            'name'=>$request->name,
            'logo'=>$this->ImageUpload($request->logo,65),
            'group1'=>$group1,
            'group2'=>$group2,
            'group3'=>$group3,
            'group4'=>$group4,
            'group5'=>$group5,
            'group6'=>$group6,
            'group7'=>$group7,
            'group8'=>$group8,
            'group9'=>$group9,
            'group10'=>$group10,
            'group11'=>$group11,
        ]);

    }
    public function delete(Page $page){
        if(!auth()->user()->hasOption('landingpage') && $page->user_id==auth()->id()){
            abort(403,'not allow to access');
        }
        $page->delete();
    }

    public function shiftEmpty($array=[]){
        $data=[];
        foreach ($array as $key=>$a){

            if(is_array($a)){
                foreach ($a as $k=>$val){
                    if(!empty($val)){
                      $data[$key][$k]=$val;
                    }
                }
            }else{
                $data[$key]=$a;
            }
        }
        return $data;
    }
}
