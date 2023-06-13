<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Course;
use App\Repositories\CartRepositoryInterface;

class CartController extends Controller
{
    private $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function index()
    {
        $items = $this->cartRepository->all();
        $total = $this->cartRepository->total();
        return view('website.cart.index', compact('items', 'total'));
    }

    public function add(Course $course)
    {
        if ($this->cartRepository->add_to_cart($course)) {
            session()->flash('success', 'Course Added to Cart Successffully');
            return redirect()->route('cart.index');
        } else {
            session()->flash('error', 'Something went wrong please try again!');
            return redirect()->back();
        }
    }

    public function destroy(CartItem $cartItem)
    {
        $this->cartRepository->destroy($cartItem);
        session()->flash('success', 'Course Delete Successffully from your cart');
        return redirect()->route('cart.index');
    }
}
