<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
    protected $guarded = ['id'];

    protected $fillable = ['course_id', 'name', 'parent_id'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'section_id');
    }

    public function parent()
    {
        return $this->belongsTo(CourseSection::class, 'parent_id');
    }

    public function parents()
    {
        return $this->belongsTo(CourseSection::class, 'parent_id')->with('parent');
    }

    public function getFlatAncestorsAttribute()
    {
        return collect(flat_ancestors($this));
    }


    public function isLastLevelChild()
    {
        return $this->child()->count() == 0;
    }

    public function child()
    {
        return $this->hasMany(CourseSection::class, 'parent_id');
    }

    public function children()
    {
        return $this->child()->with('children');
    }

}
