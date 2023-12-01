<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUsMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
    ];

    protected $guarded = ['id'];
}
