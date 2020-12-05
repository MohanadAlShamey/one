<?php

namespace App\Http\Resources\Admin;

use App\UserVideo;
use App\Video;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
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
            'url'=>$this->url,
            'name'=>$this->name,
            'visit'=>$this->is_visit()
        ];
    }
    public function is_visit()
    {
       $v= UserVideo::where([
            'user_id'=>auth()->id(),
            'video_id'=>$this->id
        ])->first();
        if(!is_null($v)){
            return false;
        }
        return true;
    }
}
