<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    const STEP_ONE = 'first_step';
    const STEP_TWO = 'second_step';
    const STEP_THREE = 'third_step';

    protected $guarded = ['id'];
    protected $fillable = ['course_id', 'step', 'name', 'start_time', 'end_time', 'duration_in_minutes', 'total_mark', 'passed', 'failed', 'student_group_id'];

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
        return $this->hasMany(QuizSection::class, 'quiz_id');
    }

    public function questions()
    {
        return $this->hasManyThrough(QuizQuestion::class, QuizSection::class, 'quiz_id', 'quiz_section_id');
    }

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class, 'quiz_id');
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
