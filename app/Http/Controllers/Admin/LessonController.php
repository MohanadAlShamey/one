<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\LessonResource;
use App\Lesson;
use App\LessonUser;
use App\Section;
use App\User;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        return view('admin.lessons.index');
    }

    public function all(Request $request)
    {
        $q = $request->q;
        $lessons = Lesson::order()->where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%");
        })->paginate();

        return LessonResource::collection($lessons);
    }

    public function getAll()
    {
        return ['lessons' => Lesson::order()->get(['id', 'name'])];
    }

    public function getLesson(Lesson $lesson)
    {
        return new LessonResource($lesson);
    }

    public function getFile(Lesson $lesson)
    {
        $file=  \request()->getRelativeUriForPath(asset('storage/'.$lesson->url));
        $ar=explode('.',$file);
        $ex=$ar[count($ar)-1];
        return response()->download(storage_path($lesson->url),$lesson->name.'.'.$ex);
    }

    public function create(Section $section)
    {
        return view('admin.lessons.create', compact('section'));
    }

    public function store(Request $request, Section $section)
    {
        //return date('Y-m-d',strtotime('01-01-2020 +1 days'));
        $this->validate($request, [
            'name' => 'required',
            // 'videos'=>'required|min:1',
            // 'after'=>'required',
        ], [
            'name.required' => 'اسم الدرس مطلوب',
            'videos.*' => 'فيديوهات الدرس مطلوبة',
            'after.require' => 'موعد الدرس مطلوب'
        ]);

        $last_order = $section->lessons()->orderBy('order', 'desc')->first();
        $order = 1;
        if (!is_null($last_order)) {
            $order = $last_order->order + 1;
        }
        $url = '';
        if ($request->hasFile('url')) {
            $ex = $request->file('url')->getClientOriginalExtension();
            $name = uniqid() . '.' . $ex;
            $path = 'app/public/files/' . $name;
            $request->file("url")->storeAs('public/files/', $name);
            $url = $path;
        }
        $lesson = $section->lessons()->create([
            'name' => $request->name,
            'body' => $request->body,
            'user_id' => auth()->id(),
            'order' => $order,
            'after' => $request->after ?? 1,
            'url' => $url,
        ]);
       /* $users = User::where(function ($query){
            $query->whereHas('roles',function ($query){
               $query->where('name','student');
            });
        })->get();*/
     /*   foreach ($users as $user) {
            $link_user=LessonUser::create([
                'user_id'=>$user->id,
                'lesson_id'=>$lesson->id,
                'show_in'=>date('Y-m-d')
            ]);
    $last_show=LessonUser::where([
        'user_id'=>$user->id,
    ])->max('show_in')??date('Y-m-d',time());

//dump('LastOrder',$last_order);
//dump('last_show',$last_show);
    if($last_show){
        $after=isset($last_order->after)?$last_order->after:1;
        $time=date('Y-m-d',strtotime($last_show.' +'.$after.' days'));
        dump('Time',$time);
        $link_user->update(['show_in'=>$time]);
    }
        }*/
        foreach ($request->videos as $video) {
            //   dd($video);
            if (!empty($video['name']) && !empty($video['url'])) {
                $lesson->videos()->create($video);
            }

        }

        foreach ($request->examples as $example) {
            //dd($example);
            if (!empty($example['name'])) {
                $lesson->examples()->create($example);
            }
        }

        // dd(count($request->attach));
        foreach ($request->attach as $key => $attach) {
            $f = $request->attach[$key]['url'];
            if (is_file($f)) {
                //return "ok";
                $ex = $request->file("attach")[$key]['url']->getClientOriginalExtension();
                $name = uniqid() . '.' . $ex;
                $path = 'app/public/files/' . $name;
                $request->file("attach")[$key]['url']->storeAs('public/files/', $name);
                $data['name'] = $request->attach[$key]['name'];
                $data['url'] = $path;
                $lesson->attaches()->create($data);

            }
        }
//return $lesson->id;
    }


    public function edit(Lesson $lesson)
    {
        return view('admin.lessons.edit', compact('lesson'));
    }

    public function show(Lesson $lesson)
    {
        return view('admin.lessons.show', compact('lesson'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $lesson->name = $request->name;
        $lesson->body = $request->body;
        $lesson->after = $request->after;
        if ($request->hasFile('url')) {
//return "ok";
            if (is_file(storage_path($lesson->url))) {
                unlink(storage_path($lesson->url));
            }
            $ex = $request->file('url')->getClientOriginalExtension();
            $name = uniqid() . '.' . $ex;
            $path = 'app/public/files/' . $name;
            $request->file("url")->storeAs('public/files/', $name);
            $lesson->url = $path;
        }
        $lesson->save();
        //return redirect()->route('dahsboard.home');
        // return new LessonResource($lesson);

    }


    public function delete(Lesson $lesson)
    {
        $lesson->videos()->delete();
        foreach ($lesson->attaches as $attach) {
            if (is_file(storage_path($attach->url))) {
                unlink(storage_path($attach->url));
            }
        }
        $section = $lesson->section;
        $lesson->attaches()->delete();
        $lesson->delete();
        return LessonResource::collection(Lesson::order()->where('section_id', $section->id)->get());

    }

    public function sort(Request $request)
    {
        //dd($request->all());
        $order = 1;
        foreach ($request->lessons as $lesson) {
            Lesson::find($lesson['id'])->update(['order' => $order]);
            $order++;
        }
    }
}
