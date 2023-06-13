<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['course_id', 'group_id', 'body'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function group()
    {
        return $this->belongsTo(StudentsGroup::class, 'group_id');
    }
}
