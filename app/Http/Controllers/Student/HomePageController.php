<?php

namespace App\Http\Controllers\Student;

use App\Helpers\OperatorArray;
use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    use OperatorArray;

    public function index()
    {

        $page=Page::where('user_id',auth()->id())->where('type','homepage')->first();
        if(!is_null($page)){

            return view('student.pages.home.edit',compact('page'));
        }
        return view('student.pages.home.create');

    }

    public function getAllPage(Request $request)
    {
        $q = $request->q;
        return auth()->user()->pages()->where('type','homepage')->where(function ($query) use ($q) {

            $query->where('name', 'like', "%$q%");
            $query->orWhereHas('user', function ($query) use ($q) {
                $query->where('name', 'like', "%$q%");
            });
        })->latest()->get();
    }

    public function create()
    {

    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',

        ], [
            'name.required' => 'اسم الموقع مطلوب'
        ]);
        $group1 = $request->group1;
        $group1['bg'] = $this->ImageUpload($group1['bg']);

        $group2 = $request->group2;
        $group2['bg'] = $this->ImageUpload($group2['bg']);
        $group3 = $request->group3;
        //return $request->group3['services'];
        $group3['bg'] = $this->ImageUpload($group3['bg']);
        foreach ($request->group3['services'] as $key => $service) {
            //return $service['img'];
            $group3['services'][$key] = [
                'name' => $request->group3['services'][$key]['name'],
                'description' => $request->group3['services'][$key]['description'],
                'img' => $this->ImageUpload($request->group3['services'][$key]['img'],65,65),
            ];
        }
        $group4 = $request->group4;
        $group4['bg'] = $this->ImageUpload($group4['bg']);
        foreach ($request->group4['gallery'] as $key => $service) {
            $group4['gallery'][$key] = [
                'name' => $request->group4['gallery'][$key]['name'],
                'description' => $request->group4['gallery'][$key]['description'],
                'img' => $this->ImageUpload($request->group4['gallery'][$key]['img'],500,250),
            ];
        }
        $group5 = $request->group5;
        $group5['bg'] = $this->ImageUpload($group5['bg']);
        $group6 = $request->group6;
        $group6['bg'] = $this->ImageUpload($group6['bg']);
        $group7 = $request->group7;
        //return $group3;
        Page::create([
            'user_id'=>auth()->id(),
            'name' => $request->name,
            'logo' => $this->ImageUpload($request->logo, 48,48),
            'group1' => $group1,
            'group2' => $group2,
            'group3' => $group3,
            'group4' => $group4,
            'group5' => $group5,
            'group6' => $group6,
            'group7' => $group7,
            'type' => 'homepage'
        ]);
    }




    public function update(Request $request,Page $page)
    {
        $this->validate($request, [
            'name' => 'required',

        ], [
            'name.required' => 'اسم الموقع مطلوب'
        ]);
        $group1 = $request->group1;
        $group1['bg'] = $this->ImageUpload($group1['bg']);

        $group2 = $request->group2;
        $group2['bg'] = $this->ImageUpload($group2['bg']);
        $group3 = $request->group3;
        //return $request->group3['services'];
        $group3['bg'] = $this->ImageUpload($group3['bg']);
        foreach ($request->group3['services'] as $key => $service) {
            //return $service['img'];
            $group3['services'][$key] = [
                'name' => $request->group3['services'][$key]['name'],
                'description' => $request->group3['services'][$key]['description'],
                'img' => $this->ImageUpload($request->group3['services'][$key]['img'],65,65),
            ];
        }
        $group4 = $request->group4;
        $group4['bg'] = $this->ImageUpload($group4['bg']);
        foreach ($request->group4['gallery'] as $key => $service) {
            $group4['gallery'][$key] = [
                'name' => $request->group4['gallery'][$key]['name'],
                'description' => $request->group4['gallery'][$key]['description'],
                'img' => $this->ImageUpload($request->group4['gallery'][$key]['img'],500,250),
            ];
        }
        $group5 = $request->group5;
        $group5['bg'] = $this->ImageUpload($group5['bg']);
        $group6 = $request->group6;
        $group6['bg'] = $this->ImageUpload($group6['bg']);
        $group7 = $request->group7;
        //return $group3;
       $page->update([

            'name' => $request->name,
            'logo' => $this->ImageUpload($request->logo, 48,48),
            'group1' => $group1,
            'group2' => $group2,
            'group3' => $group3,
            'group4' => $group4,
            'group5' => $group5,
            'group6' => $group6,
            'group7' => $group7,
        ]);
    }


}
