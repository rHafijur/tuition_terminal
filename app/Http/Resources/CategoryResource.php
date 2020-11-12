<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CourseResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dd(1);
        // dd();
        return array_merge(
            parent::toArray($request),
            // CourseResource::collection($this->courses)
            [
                'courses' =>CourseResource::collection($this->courses)
            ]
        );
    }
}
