<?php

namespace App\Http\Resources\Admin;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
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
            'user_name'=>$this->user->name,
            'type'=>$this->getType(),
            'time'=>$this->resive_time!=null?date('Y-m-d',strtotime($this->resive_time)):'',
            'carbon'=>$this->resive_time!=null?date('H:i',strtotime($this->resive_time)):'',
        ];
    }
    public function getType(){
        switch ($this->type){
            case 'pending':
                return "لم يتم تثبيت الحجز";
                break;
            case "ok":
                return "حجز مثبت";
                break;
        }
    }
}
