<?php

namespace App\Http\Resources\Admin;

use App\Example;
use App\ExampleUser;
use App\Log;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResourc extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'status'=>$this->status,
            'username'=>$this->username,
            'email'=>$this->email,
            'roles'=>$this->roles,
            'role_ids'=>$this->getRoles(),
            'company'=>$this->company,
            'created_at'=>date('Y-m-d',strtotime($this->created_at)),
            'password'=>'',
            'reg_at'=>$this->reg_at,
            'optionIds'=>$this->optionIds,
            'example'=>ExampleUser::where([
                'user_id'=>$this->id,
                'rate'=>'pending'
            ])->count(),
            'new_log'=>Log::where(['user_id'=>$this->id,'status'=>null])->count()>0?true:false,
        ];
    }

    public function getRoles(){
        $data=[];
        foreach ($this->roles as $role){
            $data[]=$role->id;
        }
        return $data;
    }
}
