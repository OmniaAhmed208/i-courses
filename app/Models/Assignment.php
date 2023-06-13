<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    const STEP_ONE = 'first_step';
    const STEP_TWO = 'second_step';
    const STEP_THREE = 'third_step';

    protected $guarded = ['id'];
    protected $fillable = ['course_id', 'step', 'name', 'start_time', 'end_time', 'total_mark', 'student_group_id'];

    public function getStartTimeAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getEndTimeAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function sections()
    {
        return $this->hasMany(AssignmentSection::class, 'assignment_id');
    }

    public function questions()
    {
        return $this->hasManyThrough(AssignmentQuestion::class, AssignmentSection::class, 'assignment_id', 'assignment_section_id');
    }

    public function attempts()
    {
        return $this->hasMany(AssignmentAttempt::class, 'assignment_id');
    }

    public function getTotalMarkWithoutEssay()
    {
        $total = 0;
        foreach ($this->sections as $section) {
            foreach ($section->questions as $question) {
                if ($question->type != 'essay') {
                    $total += (int)$question->mark;
                }
            }
        }
        return $total;
    }
}
