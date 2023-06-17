<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentSection extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['assignment_id', 'title'];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    public function questions()
    {
        return $this->hasMany(AssignmentQuestion::class, 'assignment_section_id');
    }
}
