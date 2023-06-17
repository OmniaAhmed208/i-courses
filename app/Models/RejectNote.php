<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RejectNote extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'rejected_by',
        'course_id',
        'note'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }
}
