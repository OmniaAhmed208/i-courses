<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [
        'course_id',
        'user_id',
        'price',
        'after_sale_price',
        'qty',
        'coupon'
    ];

    public static function headerItems()
    {
        return CartItem::with('course')->where('user_id', auth()->user()->id)->get();
    }

    public static function headerTotal()
    {
        return CartItem::where('user_id', auth()->user()->id)->sum('price');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
