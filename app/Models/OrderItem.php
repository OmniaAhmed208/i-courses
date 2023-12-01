<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['order_id', 'course_id', 'price'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
