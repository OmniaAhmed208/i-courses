<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseRate extends Model
{
    protected $guarded = ['id'];

    protected $fillable = ['course_id', 'rate', 'comment', 'user_id'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
