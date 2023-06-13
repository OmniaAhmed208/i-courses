<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankGroup extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['course_id', 'name'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function questions()
    {
        return $this->hasMany(BankQuestion::class, 'group_id');
    }
}
