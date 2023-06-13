<?php

namespace App\Http\Controllers;

use App\Repositories\OrderRepositoryInterface;

class OrdersController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function checkout()
    {
        if ($this->orderRepository->checkout()) {
            session()->flash('success', 'Your Order has been processed');
        } else {
            session()->flash('error', 'You don\'t have enough balance');
            return redirect()->route('wallet.index');
        }
        return redirect()->route('home');
    }
}
