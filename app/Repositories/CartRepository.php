<?php


namespace App\Repositories;


use App\Models\CartItem;
use Illuminate\Support\Facades\Cache;

class CartRepository implements CartRepositoryInterface
{
    public function add_to_cart($course)
    {
        Cache::forget('cart_total_' . auth()->user()->id);
        Cache::forget('cart_items_' . auth()->user()->id);
        return CartItem::create([
            'course_id' => $course->id,
            'user_id' => auth()->user()->id,
            'price' => $course->price,
            'qty' => 1
        ]);
    }

    public function total()
    {
        return Cache::remember('cart_total_' . auth()->user()->id, 86400, function () {
            return CartItem::where('user_id', auth()->user()->id)->sum('price');
        });
    }

    public function all()
    {
        return Cache::remember('cart_items_' . auth()->user()->id, 86400, function () {
            return CartItem::with('course')->where('user_id', auth()->user()->id)->get();
        });
    }

    public function apply_coupon($cart)
    {

    }

    public function destroy($item)
    {
        Cache::forget('cart_total_' . auth()->user()->id);
        Cache::forget('cart_items_' . auth()->user()->id);
        $item->delete();
    }
}
