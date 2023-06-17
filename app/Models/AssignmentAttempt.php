<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentAttempt extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['student_id', 'assignment_id', 'answers', 'mark', 'is_final_mark', 'student_answers_all_questions'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    public function getAnswersAttribute($value)
    {
        return json_decode($value);
    }

    public function getAnswerById($id)
    {
        foreach ($this->answers as $answer) {
            if ($answer->id == $id) {
                return $answer;
            }
        }
        return false;
    }
}
