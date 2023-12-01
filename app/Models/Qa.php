<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qa extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['course_id', 'student_id', 'question', 'answer'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
