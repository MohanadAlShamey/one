<?php

namespace App\Http\Resources\Admin;

use App\Lesson;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResourc extends JsonResource
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
            'num_lesson'=>$this->lessons()->count(),
            'lessons'=>LessonResource::collection($this->getLessons()),
        ];
    }

    public function getLessons(){
        return Lesson::order()->where(['section_id'=>$this->id])->get();
}
}
