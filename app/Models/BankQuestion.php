<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankQuestion extends Model
{
    protected $guarded = ['id'];

    protected $fillable = ['group_id', 'course_id', 'title', 'type', 'mark', 'picture', 'choices'];

    public function getChoicesAttribute($value)
    {
        return json_decode($value);
    }

    public function group()
    {
        return $this->belongsTo(BankGroup::class, 'group_id');
    }

}
