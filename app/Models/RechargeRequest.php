<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RechargeRequest extends Model
{

    const STATUS_REJECTED = 'rejected';
    const STATUS_PENDING = 'pending';
    const STATUS_DONE = 'done';

    protected $guarded = ['id'];

    protected $fillable = [
        'user_id',
        'receipt_image',
        'amount',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function done()
    {
        $this->status = RechargeRequest::STATUS_DONE;
        $this->save();
    }

    public function reject()
    {
        $this->status = RechargeRequest::STATUS_REJECTED;
        $this->save();
    }
}
