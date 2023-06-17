<?php


namespace App\Repositories;


use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    private $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function checkout()
    {
        $total = $this->cartRepository->total();
        if (auth()->user()->available_balance >= $total) {
            $items = $this->cartRepository->all();

            DB::transaction(function () use ($items, $total) {
                $order = Order::create([
                    'student_id' => auth()->user()->id,
                    'order_id' => auth()->user()->id . time(),
                    'total_amount' => $total
                ]);
                foreach ($items as $item) {
                    if (!is_null($item->course->expire_after_days) && $item->course->expire_after_days > 0) {
                        if (!in_array(auth()->user()->courses->pluck('id')->toArray(), $item->course->id)) {
                            auth()->user()->courses()->attach($item->course->id, ['progress' => 0, 'expired' => false]);
                        } else {
                            auth()->user()->courses()->where('course_id', $item->course->id)->update([
                                'expired' => false
                            ]);
                        }
                    } else {
                        auth()->user()->courses()->attach($item->course->id, ['progress' => 0]);
                    }
                    auth()->user()->update([
                        'available_balance' => auth()->user()->available_balance - $item->price
                    ]);
                    Transaction::create([
                        'user_id' => auth()->user()->id,
                        'type' => Transaction::WITHDRAWAL,
                        'amount' => $item->price,
                        'description' => 'Buying ' . $item->course->title
                    ]);
                    $instructor = $item->course->instructor;
                    $instructor->update([
                        'available_balance' => $instructor->available_balance + $item->price
                    ]);
                    Transaction::create([
                        'user_id' => $instructor->id,
                        'type' => Transaction::DEPOSITION,
                        'amount' => $item->price,
                        'description' => 'Student Buy ' . $item->course->title
                    ]);
                    OrderItem::create([
                        'order_id' => $order->id,
                        'course_id' => $item->course->id,
                        'price' => $item->price
                    ]);
                    //send notification to teacher
                }
            });
            foreach ($items as $item) {
                $item->delete();
            }
            return true;
        } else {
            return false;
        }
    }

    public function checkout_api($item)
    {
        $total = $item->price;
        if (auth('api')->user()->available_balance >= $total) {
            DB::transaction(function () use ($item, $total) {
                $order = Order::create([
                    'student_id' => auth('api')->user()->id,
                    'order_id' => auth('api')->user()->id . time(),
                    'total_amount' => $total
                ]);
                if (!is_null($item->expire_after_days) && $item->expire_after_days > 0) {
                    if (!in_array(auth('api')->user()->courses->pluck('id')->toArray(), $item->course->id)) {
                        auth('api')->user()->courses()->attach($item->id, ['progress' => 0, 'expired' => false]);
                    } else {
                        auth('api')->user()->courses()->where('course_id', $item->id)->update([
                            'expired' => false
                        ]);
                    }
                } else {
                    auth('api')->user()->courses()->attach($item->id, ['progress' => 0]);
                }
                auth('api')->user()->update([
                    'available_balance' => auth('api')->user()->available_balance - $item->price
                ]);
                Transaction::create([
                    'user_id' => auth('api')->user()->id,
                    'type' => Transaction::WITHDRAWAL,
                    'amount' => $item->price,
                    'description' => 'Buying ' . $item->title
                ]);
                $instructor = $item->instructor;
                $instructor->update([
                    'available_balance' => $instructor->available_balance + $item->price
                ]);
                Transaction::create([
                    'user_id' => $instructor->id,
                    'type' => Transaction::DEPOSITION,
                    'amount' => $item->price,
                    'description' => 'Student Buy ' . $item->title
                ]);
                OrderItem::create([
                    'order_id' => $order->id,
                    'course_id' => $item->id,
                    'price' => $item->price
                ]);
                //send notification to teacher
            });
            return true;
        } else {
            return false;
        }
    }
}
