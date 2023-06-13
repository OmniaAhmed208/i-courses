<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RechargeRequest;
use App\Models\Transaction;
use App\Notifications\RechargeRequestApproved;
use Illuminate\Support\Facades\DB;

class RechargeRequestsController extends Controller
{
    public function index()
    {
        $requests = RechargeRequest::with('user')->latest()->paginate(25);

        return view('admin.recharge_requests.index', compact('requests'));
    }


    public function approve(RechargeRequest $request)
    {
        $user = $request->user;
        DB::transaction(function () use ($user, $request) {
            Transaction::create([
                'user_id' => $user->id,
                'type' => Transaction::DEPOSITION,
                'amount' => $request->amount,
                'description' => 'Recharge Balance Manually'
            ]);
            $user->update([
                'available_balance' => $user->available_balance + $request->amount
            ]);
            $request->done();
        });
        //send notification here
        $user->notify(new RechargeRequestApproved());

        session()->flash('success', __('site.balance_added'));
        return redirect()->route('admin.recharge_requests.index');

    }
}
