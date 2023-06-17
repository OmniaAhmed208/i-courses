<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['quiz_section_id', 'title', 'type', 'mark', 'choices', 'picture'];

    public function section()
    {
        return $this->belongsTo(QuizSection::class, 'quiz_section_id');
    }

    public function getChoicesAttribute($value)
    {
        return json_decode($value);
    }
}
