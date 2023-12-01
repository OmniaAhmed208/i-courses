<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
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
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'duration_in_minutes' => $this->duration_in_minutes,
            'total_mark' => (int)$this->total_mark,
            'created_at' => $this->created_at->format('d/m/Y'),
            'sections' => QuizSectionsResource::collection($this->sections)
        ];
    }
}
