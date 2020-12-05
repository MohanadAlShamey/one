<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'body'=>$this->body,
            'after'=>$this->after,
            'url'=>'',
            'videos'=>VideoResource::collection($this->videos),
            'examples'=>ExampleResource::collection($this->examples),
            'attaches'=>AttachResource::collection($this->attaches),
        'num_example'=>$this->examples()->count(),
        'num_video'=>$this->videos()->count(),
        ];
    }
}
