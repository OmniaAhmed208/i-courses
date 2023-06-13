<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'slug' => $this->slug,
            'title' => $this->title,
            'cover' => $this->image,
            'description' => $this->description,
            'requirements' => $this->requirements,
            'level' => $this->level,
            'price' => (int)$this->price,
            'total_duration' => Carbon::createFromTimestamp($this->total_duration)->setTimezone('UTC')->format("H:i:s"),
            'lectures_count' => (int)$this->lessons_count,
            'last_updated' => $this->updated_at->format('d/m/Y'),
            'students_enrolled' => (int)$this->students_count,
            'total_rate' => (double)$this->total_rate,
            'rates_count' => (int)$this->rates_count,
            'author_info' => [
                'name' => $this->instructor->name,
                'image' => $this->instructor->avatar
            ]
        ];
    }
}
