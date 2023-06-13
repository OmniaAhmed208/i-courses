<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseGuestLessonsResource extends JsonResource
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
            'time' => Carbon::createFromTimestamp($this->time)->setTimezone('UTC')->format("H:i:s"),
            'is_free' => (boolean)$this->is_free,
            'type' => $this->type,
            'link' => $this->is_free ? ($this->type == 'internal_link' ? asset($this->link) : $this->link) : null,
            'created_at' => $this->created_at->format('d/m/Y'),
        ];
    }
}
