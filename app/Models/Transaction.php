<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    const WITHDRAWAL = "withdrawal";
    const DEPOSITION = "deposition";

    protected $guarded = ['id'];

    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
