<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QasResource extends JsonResource
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
            'question' => $this->question,
            'answer' => $this->answer,
            'asked_by' => $this->student->name,
            'answered_by' => $this->answer ? $this->course->instructor->name : null,
            'created_at' => $this->created_at
        ];
    }
}
