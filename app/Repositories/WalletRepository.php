<?php


namespace App\Repositories;


use App\Models\RechargeRequest;
use App\Models\Transaction;

class WalletRepository implements WalletRepositoryInterface
{
    public function create_request($data)
    {
        return RechargeRequest::create($data);
    }

    public function frozen_balance()
    {
        return auth()->user()->frozen_balance;
    }

    public function requests()
    {
        return RechargeRequest::where('user_id', auth()->user()->id)->latest()->get();
    }

    public function transactions()
    {
        return Transaction::where('user_id', auth()->user()->id)->get();
    }

    public function available_balance()
    {
        return auth()->user()->available_balance;
    }
}
