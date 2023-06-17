<?php

namespace App\Http\Resources;

use App\Models\AssignmentAttempt;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssignmentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $attempt = AssignmentAttempt::where('student_id', auth('api')->user()->id)->where('assignment_id', $this->id)->first();
        return [
            'id' => (int)$this->id,
            'name' => $this->name,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'total_mark' => (int)$this->total_mark,
            'is_student_answers_all_questions' => $attempt && $attempt->student_answers_all_questions,
            'created_at' => $this->created_at->format('d/m/Y'),
        ];
    }
}
