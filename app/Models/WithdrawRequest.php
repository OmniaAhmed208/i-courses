<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    const BANK_METHOD = 'bank';
    const VODAFONE_METHOD = 'vodafone';

    const STATUS_REJECTED = 'rejected';
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';

    protected $guarded = ['id'];
    protected $fillable = [
        'status',
        'instructor_id',
        'amount',
        'withdraw_method',
        'mobile',
        'name',
        'account_number',
        'bank_name',
        'swift_iban'
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function approve()
    {
        $this->status = WithdrawRequest::STATUS_COMPLETED;
        $this->save();
    }

    public function reject()
    {
        $this->status = WithdrawRequest::STATUS_REJECTED;
        $this->save();
    }
}
