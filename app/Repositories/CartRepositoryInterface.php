<?php

namespace App\Repositories;

interface CartRepositoryInterface
{
    public function add_to_cart($course);

    public function all();

    public function total();

    public function apply_coupon($cart);

    public function destroy($item);
}
