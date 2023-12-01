<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsGroup extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['course_id', 'name'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function students()
    {
        return $this->hasMany(User::class, 'group_id');
    }
}
