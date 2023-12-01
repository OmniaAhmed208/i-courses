<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionQuestionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (int)$this->id,
            'title' => $this->title,
            'type' => $this->type,
            'mark' => (int)$this->mark,
            'choices' => $this->choices,
            'picture' => $this->picture ? asset('storage/' . $this->picture) : null,
        ];
    }
}
