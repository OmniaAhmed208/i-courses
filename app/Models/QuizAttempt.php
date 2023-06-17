<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['student_id', 'quiz_id', 'answers', 'mark', 'is_final_mark'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
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
