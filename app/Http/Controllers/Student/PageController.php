<?php

namespace App\Http\Controllers\Student;

use App\Helpers\OperatorArray;
use App\Http\Controllers\Controller;
use App\Page;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PageController extends Controller
{
    use OperatorArray;

    public function index()
    {
        if (!auth()->user()->hasOption('landingpage')) {
            abort(403, 'not allow to access');
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
        if (!auth()->user()->hasOption('landingpage')) {
            abort(403, 'not allow to access');
        }
        $users = User::all();
        return view('student.pages.create', compact('users'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasOption('landingpage')) {
            abort(403, 'not allow to access');
        }
        // {title: "", video: "", img: "", sub_title: "", cta: "", btn: "", bg: "", size: "cover"},
        $group1 = $request->group1;
        $group1['video'] = $this->ImageUpload($group1['video']);
        $group1['bg'] = $this->ImageUpload($group1['bg']);
        // {title: "", body: "", qnt: "", date: "", img: "", cta: "", btn: "", bg: "", size: "cover"}
        $group2 = $request->group2;
        $group2['img'] = $this->ImageUpload($group2['img']);
        $group2['bg'] = $this->ImageUpload($group2['bg']);
        //{problems:[],img:"",story:"",img_story:"",bg_story:"",btn:"",bg:"",size:"cover"},
        $group3 = $request->group3;
        $group3['img'] = $this->ImageUpload($group3['img']);
        $group3['img_story'] = $this->ImageUpload($group3['img_story']);
        $group3['bg_story'] = $this->ImageUpload($group3['bg_story']);
        $group3['bg'] = $this->ImageUpload($group3['bg']);
        $group3['problems'] = $this->removeEmptyInArray($group3['problems']);
        //{solutions:[],img:"",title:"",body:"",cta:"",btn:"",bg:"",size:"cover"},
        $group4 = $request->group4;
        $group4['img'] = $this->ImageUpload($group4['img']);
        $group4['bg'] = $this->ImageUpload($group4['bg']);
        $group4['solutions'] = $this->removeEmptyInArray($group4['solutions']);
        //{title:"",price:"",benefists:[],bg:"",size:"cover"},
        $group5 = $request->group5;
        //$group2['img'] = $this->ImageUpload($group2['img']);
        $group5['bg'] = $this->ImageUpload($group5['bg']);
        $group5['benefists'] = $this->removeEmptyInArray($group5['benefists']);
        //{title:"",price:"",dangers:[],img:"",footer:"",bg:"",size:""},
        $group6 = $request->group6;
        $group6['bg'] = $this->ImageUpload($group6['bg']);
        $group6['dangers'] = $this->removeEmptyInArray($group6['dangers']);
        //{title:"",sub_title:"",price:"",bg:"",size:""},
        $group7 = $request->group7;
        $group7['bg'] = $this->ImageUpload($group7['bg']);
        //{title:"",benefists:[],img:"",bg:"",size:""},
        $group8 = $request->group8;
        $group8['img'] = $this->ImageUpload($group8['img']);
        $group8['bg'] = $this->ImageUpload($group8['bg']);
        $group8['benefists'] = $this->removeEmptyInArray($group8['benefists']);
        //{title:"",sub_title:"",cta:"",btn:"",bg:"",size:""},
        $group9 = $request->group9;
        $group9['bg'] = $this->ImageUpload($group9['bg']);
        $group9['benefists'] = $this->removeEmptyInArray($group9['benefists']);
        //:{questions:[{ask:"",answer:""}],cta:"",btn:"",bg:"",size:""},
        $group10 = $request->group10;
        //$group2['img'] = $this->ImageUpload($group2['img']);
        $group10['bg'] = $this->ImageUpload($group10['bg']);
        $group10['questions'] = $this->removeEmptyInArray($group10['questions']);
        //:{bg:"",size:""},
        $group11 = $request->group11;
        $page = Page::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'logo' => $this->ImageUpload($request->logo, 65),
            'group1' => $group1,
            'group2' => $group2,
            'group3' => $group3,
            'group4' => $group4,
            'group5' => $group5,
            'group6' => $group6,
            'group7' => $group7,
            'group8' => $group8,
            'group9' => $group9,
            'group10' => $group10,
            'group11' => $group11,
        ]);

    }

    private function ImageUpload($string, $width = null)
    {
        if ($string != null && Str::contains($string, 'base64')) {
            if ($width == null) {
                $width = Image::make($string)->getWidth();
            }
            $ex = explode('/', explode(';', $string)[0])[1];
            // dd($ex);
            $name = 'images/upload/' . uniqid() . '.' . $ex;
            Image::make($string)->resize($width, null, function ($r) {
                $r->aspectRatio();
            })/*->encode('webp', 100)*/
            ->save(storage_path('app/public/' . $name));
            return $name;
        }
        return $string;
    }

    public function edit(Page $page)
    {
        if (!auth()->user()->hasOption('landingpage')) {
            abort(403, 'not allow to access');
        }
        $users = User::all();
        return view('student.pages.edit', compact('page', 'users'));
    }

    public function update(Request $request, Page $page)
    {
        if (!auth()->user()->hasOption('landingpage')) {
            abort(403, 'not allow to access');
        }
        // {title: "", video: "", img: "", sub_title: "", cta: "", btn: "", bg: "", size: "cover"},
        $group1 = $request->group1;
        $group1['video'] = $this->ImageUpload($group1['video']);
        $group1['bg'] = $this->ImageUpload($group1['bg']);
        // {title: "", body: "", qnt: "", date: "", img: "", cta: "", btn: "", bg: "", size: "cover"}
        $group2 = $request->group2;
        $group2['img'] = $this->ImageUpload($group2['img']);
        $group2['bg'] = $this->ImageUpload($group2['bg']);
        //{problems:[],img:"",story:"",img_story:"",bg_story:"",btn:"",bg:"",size:"cover"},
        $group3 = $request->group3;
        $group3['img'] = $this->ImageUpload($group3['img']);
        $group3['img_story'] = $this->ImageUpload($group3['img_story']);
        $group3['bg_story'] = $this->ImageUpload($group3['bg_story']);
        $group3['bg'] = $this->ImageUpload($group3['bg']);
        $group3['problems'] = $this->removeEmptyInArray($group3['problems']);
        //{solutions:[],img:"",title:"",body:"",cta:"",btn:"",bg:"",size:"cover"},
        $group4 = $request->group4;
        $group4['img'] = $this->ImageUpload($group4['img']);
        $group4['bg'] = $this->ImageUpload($group4['bg']);
        $group4['solutions'] = $this->removeEmptyInArray($group4['solutions']);
        //{title:"",price:"",benefists:[],bg:"",size:"cover"},
        $group5 = $request->group5;
        //$group2['img'] = $this->ImageUpload($group2['img']);
        $group5['bg'] = $this->ImageUpload($group5['bg']);
        $group5['benefists'] = $this->removeEmptyInArray($group5['benefists']);
        //{title:"",price:"",dangers:[],img:"",footer:"",bg:"",size:""},
        $group6 = $request->group6;
        $group6['bg'] = $this->ImageUpload($group6['bg']);
        $group6['dangers'] = $this->removeEmptyInArray($group6['dangers']);
        //{title:"",sub_title:"",price:"",bg:"",size:""},
        $group7 = $request->group7;
        $group7['bg'] = $this->ImageUpload($group7['bg']);
        //{title:"",benefists:[],img:"",bg:"",size:""},
        $group8 = $request->group8;
        $group8['img'] = $this->ImageUpload($group8['img']);
        $group8['bg'] = $this->ImageUpload($group8['bg']);
        $group8['benefists'] = $this->removeEmptyInArray($group8['benefists']);
        //{title:"",sub_title:"",cta:"",btn:"",bg:"",size:""},
        $group9 = $request->group9;
        $group9['bg'] = $this->ImageUpload($group9['bg']);
        $group9['benefists'] = $this->removeEmptyInArray($group9['benefists']);
        //:{questions:[{ask:"",answer:""}],cta:"",btn:"",bg:"",size:""},
        $group10 = $request->group10;
        //$group2['img'] = $this->ImageUpload($group2['img']);
        $group10['bg'] = $this->ImageUpload($group10['bg']);
        $group10['questions'] = $this->removeEmptyInArray($group10['questions']);
        //:{bg:"",size:""},
        $group11 = $request->group11;

        $page->update([

            'name' => $request->name,
            'logo' => $this->ImageUpload($request->logo, 65),
            'group1' => $group1,
            'group2' => $group2,
            'group3' => $group3,
            'group4' => $group4,
            'group5' => $group5,
            'group6' => $group6,
            'group7' => $group7,
            'group8' => $group8,
            'group9' => $group9,
            'group10' => $group10,
            'group11' => $group11,
        ]);

    }

    public function delete(Page $page)
    {
        if (!auth()->user()->hasOption('landingpage') && $page->user_id == auth()->id()) {
            abort(403, 'not allow to access');
        }
        $page->delete();
    }


}
