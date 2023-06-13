<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['student_id', 'order_id', 'total_amount'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function courses()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
