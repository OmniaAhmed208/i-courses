<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentView extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['student_id', 'lesson_id', 'number_of_views'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}
