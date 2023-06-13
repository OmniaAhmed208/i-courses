<?php

namespace App\Http\Resources;

use App\Models\StudentView;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseLessonsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        if (auth('api')->user()) {
            $views = StudentView::where('lesson_id', $this->id)->where('student_id', auth('api')->user()->id)->first();
            return [
                'id' => (int)$this->id,
                'name' => $this->name,
                'time' => Carbon::createFromTimestamp($this->time)->setTimezone('UTC')->format("H:i:s"),
                'is_free' => (boolean)$this->is_free,
                'type' => $this->type,
                'link' => $this->type == 'internal_link' ? asset($this->link) : $this->link,
                'created_at' => $this->created_at->format('d/m/Y'),
                'number_of_available_views' => !is_null($this->number_of_views) ? $this->number_of_views : 0,
                'student_views_count' => $views ? $views->number_of_views : 0
            ];
        }
        return [
            'id' => (int)$this->id,
            'name' => $this->name,
            'time' => Carbon::createFromTimestamp($this->time)->setTimezone('UTC')->format("H:i:s"),
            'is_free' => (boolean)$this->is_free,
            'type' => $this->type,
            'link' => $this->type == 'internal_link' ? asset($this->link) : $this->link,
            'created_at' => $this->created_at->format('d/m/Y'),
        ];
    }
}
