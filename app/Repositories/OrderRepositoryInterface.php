<?php

namespace App\Repositories;

interface OrderRepositoryInterface
{
    public function checkout();

    public function checkout_api($item);
}
