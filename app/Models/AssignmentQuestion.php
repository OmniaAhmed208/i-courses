<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentQuestion extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['assignment_section_id', 'title', 'type', 'mark', 'choices', 'picture'];

    public function section()
    {
        return $this->belongsTo(AssignmentSection::class, 'assignment_section_id');
    }

    public function getChoicesAttribute($value)
    {
        return json_decode($value);
    }

    public function is_answered()
    {
        $answer = AssignmentAttempt::where('student_id', auth()->user()->id)->where('assignment_id', $this->section->assignment_id)->first();
        return $answer && $answer->getAnswerById($this->id);
    }

}
