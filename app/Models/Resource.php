<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['course_id', 'path', 'name', 'extension', 'size'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
