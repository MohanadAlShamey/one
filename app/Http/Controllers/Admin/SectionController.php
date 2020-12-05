<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\SectionResourc;
use App\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(){
        return view('admin.sections.index');
    }

    public function all(Request $request){
        $q=$request->q;
        $sections=Section::where(function($query)use($q){
            $query->where('name','like',"%$q%");
        })->order()->paginate();
        return SectionResourc::collection($sections);

    }

    public function getAll(){
        return ['sections'=> Section::order()->get(['id','name'])];
    }

    public function sort(Request $request){
        $order=1;
        foreach ($request->sections as $section){
            Section::find($section['id'])->update(['order'=>$order]);
            $order++;
        }
    }

    public function create(){
        return view('admin.sections.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            //'order'=>'integer|required',
        ],[
            'name.required'=>'اسم الفصل مطلوب',
            'order.required'=>'ترتيب الفصل مطلوب',
            'order.integer'=>'يجب ان تكون القيمة عدد صحيح ',
        ]);
        $last_section=Section::orderBy('order','desc')->first();
        $order=1;
        if(!is_null($last_section)){
            $order=$last_section->order+1;
        }
        Section::create([
            'user_id'=>auth()->id(),
            'course_id'=>1,
            'order'=>$order,
            'name'=>$request->name,
        ]);

    }

    public function show(Section $section){
        return view('admin.sections.show',compact('section'));
    }


    public function edit(Section $section){
        return view('admin.sections.edit',compact('section'));
    }

    public function getSection(Section $section){
        return $section;
    }

    public function getShowSection(Section $section){
        return new SectionResourc($section);
    }

    public function update(Request $request,Section $section){
        $this->validate($request,[
            'name'=>'required',
           // 'order'=>'integer|required',
        ],[
            'name.required'=>'اسم الفصل مطلوب',
            'order.required'=>'ترتيب الفصل مطلوب',
            'order.integer'=>'يجب ان تكون القيمة عدد صحيح ',
        ]);

        $section->update([
            'name'=>$request->name,
            //'order'=>$order,
        ]);

    }

    public function delete(Section $section){

        foreach ($section->lessons as $lesson){
            $lesson->videos()->delete();
            foreach($lesson->attaches as $attach){
                if(is_file(storage_path($attach->url))){
                    unlink(storage_path($attach->url));
                }
            }
            $lesson->attaches()->delete();
        }
        $section->lessons()->delete();
        $section->delete();

    }
}
