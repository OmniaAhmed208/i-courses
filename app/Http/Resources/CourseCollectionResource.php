<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseCollectionResource extends JsonResource
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
            'category_id' => (int)$this->category_id,
            'cover' => $this->image,
            'slug' => $this->slug,
            'title' => $this->title,
            'level' => $this->level,
            'price' => (int)$this->price,
            'author_name' => $this->instructor->name,
            'total_duration' => Carbon::createFromTimestamp($this->total_duration)->setTimezone('UTC')->format("H:i:s"),
            'lectures_count' => (int)$this->lessons_count,
            'total_rate' => (double)$this->total_rate,
            'rates_count' => (int)$this->rates_count,
            'language' => $this->language
        ];
    }
}
