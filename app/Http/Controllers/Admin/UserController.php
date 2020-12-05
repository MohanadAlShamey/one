<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\UserResourc;
use App\Joker;
use App\Lesson;
use App\LessonUser;
use App\Option;
use App\Role;
use App\Section;
use App\User;
use App\Watch;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        return view('admin.users.index');
    }

    public function all(Request $request)
    {
        $q = $request->q;
        $users = User::where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%");
            $query->orWhere('username', 'like', "%$q%");
            $query->orWhere('email', 'like', "%$q%");
            $query->orWhere('company', 'like', "%$q%");
        })->orderByDesc('status')->latest()->paginate();
        return UserResourc::collection($users);
    }

    public function create(){
        $options=Option::all();
        return view('admin.users.create',compact('options'));
    }

    public function store(Request $request){

      $this->validate($request,[
            'name'=>'required',
            'username'=>'required|unique:users,username',
            'email'=>'required|email|unique:users,email',
            'role_ids'=>'required|min:1',
            'password'=>'required|min:8',
          'created_at'=>'required'
        ],
            [
                'name.required'=>'الاسم مطلوب',
                'role_ids.*'=>'يجب تحديد صلاحيات المستخدم',
                'username.required'=>'اسم المستخدم مطلوب',
                'username.unique'=>'اسم المستخدم موجود بالفعل',
                'email.unique'=>'البريد الإلكتروني موجود بالفعل',
                'email.required'=>'البريد الإلكتروني مطلوب',
                'email.email'=>'تنسيق غير صالح',
                'password.*'=>'كلمة المرور قصيرة يجب أن تحوي 8 أحرف على الأقل',
                'created_at.required'=>'تاريخ التسجيل مطلوب'
            ]);
        $data=[
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'company'=>$request->company,
            'site'=>$request->site,
            'password'=>bcrypt($request->password),
            'created_at'=>date('Y-m-d',strtotime($request->created_at)),
            'reg_at'=>$request->reg_at,
        ];

       $user=User::create($data);
$user->options()->sync($request->optionIds);
        $user->roles()->sync($request->role_ids);
        if($user->hasRole('student')) {
            for($i=0;$i<5;$i++){
                Joker::create([
                    'status'=>'active',
                    'month'=>date('Y-M',time()),
                    'type'=>'free',
                    'user_id'=>$user->id
                ]);
            }
        }
       }



    public function edit(User $user){
        $options=Option::all();
        return view('admin.users.edit',compact('user','options'));
    }

    public function getUser(User $user){
        $us= new UserResourc($user);
        $roles=Role::all();
        return ['user'=>$us,'roles'=>$roles];
    }

    public function update(Request $request,User $user){
        //dd($request->all());
        $this->validate($request,[
            'name'=>'required',
            'username'=>'required|unique:users,username,'.$user->id,
            'email'=>'required|email|unique:users,email,'.$user->id,
            'role_ids'=>'required|min:1',
            'password'=>'nullable|min:8',
            'created_at'=>'required'
        ],
            [
                'name.required'=>'الاسم مطلوب',
                'role_ids.*'=>'يجب تحديد صلاحيات المستخدم',
                'username.required'=>'اسم المستخدم مطلوب',
                'username.unique'=>'اسم المستخدم موجود بالفعل',
                'email.unique'=>'البريد الإلكتروني موجود بالفعل',
                'email.required'=>'البريد الإلكتروني مطلوب',
                'email.email'=>'تنسيق غير صالح',
                'password.min'=>'كلمة المرور قصيرة يجب أن تحوي 8 أحرف على الأقل',
                'created_at.required'=>'تاريخ التسجيل مطلوب'
            ]);
        $data=[
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'company'=>$request->company,
            'site'=>$request->site,
            'created_at'=>date('Y-m-d',strtotime($request->created_at)),
            'reg_at'=>$request->reg_at,
        ];

        if(!empty($request->password)){
            $data['password']=bcrypt($request->password);
        }
        $user->update($data);
        //$user->roles()->detach();
        $user->options()->sync($request->optionIds);
        $user->roles()->sync($request->role_ids);

    }


    public function delete(User $user){
        $user->roles()->detach();
        $user->logs()->delete();
        $user->videos()->detach();
        $user->examples()->detach();
        $user->delete();
    }
    public function deactive(User $user){
        if($user->status==0){
            $user->update(['status'=>1]);
        }else{
            $user->update(['status'=>0]);
        }

        return "ok";
    }

    public function dateClear(User $user){
        LessonUser::where('user_id',$user->id)->delete();
        return redirect()->back()->with('success','تم حذف التواريخ بنجاح');
    }
}
