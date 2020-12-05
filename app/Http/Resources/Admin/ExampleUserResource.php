<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ExampleUserResource extends JsonResource
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
            'example'=> new ExampleResource($this->example),
            'user'=>new UserResourc($this->user),
            'rate'=>$this->rate,
            'body'=>$this->body
        ];
    }
}
