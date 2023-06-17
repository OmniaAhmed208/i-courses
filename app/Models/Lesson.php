<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = ['id'];

    protected $fillable = ['name', 'link', 'time', 'description', 'section_id', 'is_free', 'type', 'number_of_views'];


    public function getLinkAttribute($value)
    {
        if ($this->type == 'internal_link') {
            return 'storage/' . $value;
        }
        return $value;

    }//end of image attribute

    public function section()
    {
        return $this->belongsTo(CourseSection::class, 'section_id');
    }

    public function attendance()
    {
        return $this->belongsToMany(User::class, 'student_views', 'lesson_id', 'student_id')
            ->withPivot('number_of_views')
            ->withTimestamps();
    }
}
