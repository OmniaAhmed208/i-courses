<?php

namespace App\Repositories;

interface WalletRepositoryInterface
{
    public function create_request($data);

    public function frozen_balance();

    public function requests();

    public function transactions();

    public function available_balance();
}
