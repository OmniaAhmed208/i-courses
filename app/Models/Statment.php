<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statment extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'student_id',
        'course_id',
        'total_price',
        'earning',
        'commission'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
