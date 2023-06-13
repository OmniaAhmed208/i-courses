<?php

namespace App\Http\Controllers;

use App\Http\Requests\RechargeRequest;
use App\Models\User;
use App\Notifications\RechargeRequestCreated;
use App\Repositories\WalletRepositoryInterface;
use App\Services\ImageService;
use Illuminate\Support\Facades\Notification;

class WalletController extends Controller
{
    private $walletRepository;

    public function __construct(WalletRepositoryInterface $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    public function index()
    {
        $balance = $this->walletRepository->available_balance();
        $requests = $this->walletRepository->requests();
        return view('website.wallet.index', compact('balance', 'requests'));
    }

    public function create_request(RechargeRequest $request)
    {
        $data['amount'] = $request->amount;
        $data['user_id'] = auth()->user()->id;
        $data['receipt_image'] = ImageService::storeReceiptImage($request->image);
        $this->walletRepository->create_request($data);
        //notify admins
        $admins = User::whereRoleIs('admin')->orWhereRoleIs('moderator')->get();
        Notification::send($admins, new RechargeRequestCreated(auth()->user()));

        session()->flash('success', __('site.recharge_request_sent'));
        return redirect()->back();

    }
}
