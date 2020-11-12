<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\SubjectResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dump($this->subjects);
        return array_merge(
            parent::toArray($request),
            // CourseResource::collection($this->courses)
            [
                'subjects' =>SubjectResource::collection($this->subjects)
            ]
        );
    }
}
