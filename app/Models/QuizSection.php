<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizSection extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['quiz_id', 'title'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_section_id');
    }
}
