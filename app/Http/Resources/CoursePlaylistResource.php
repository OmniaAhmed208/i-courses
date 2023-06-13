<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursePlaylistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (int)$this->id,
            'name' => $this->name,
            'children' => count($this->children) > 0 ? CoursePlaylistResource::collection($this->children) : null,
            'lessons' => count($this->children) == 0 ? CourseLessonsResource::collection($this->lessons) : null
        ];
    }
}
