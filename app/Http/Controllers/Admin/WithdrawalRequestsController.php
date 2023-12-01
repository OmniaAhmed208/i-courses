<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\WithdrawRequest;
use App\Notifications\WithdrawRequestApproved;
use App\Notifications\WithdrawRequestRejected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawalRequestsController extends Controller
{
    public function index(Request $request)
    {
        $requests = WithdrawRequest::with('instructor')->when($request->status, function ($q) use ($request) {
            $q->where('status', $request->status);
        })->latest()->paginate(50);

        return view('admin.withdrawal_requests.index', compact('requests'));
    }

    public function approve(WithdrawRequest $withdrawRequest)
    {
        $instructor = $withdrawRequest->instructor;
        $new_balance = (int)$instructor->frozen_balance - (int)$withdrawRequest->amount;
        DB::transaction(function () use ($new_balance, $withdrawRequest) {
            $withdrawRequest->instructor->update([
                'frozen_balance' => $new_balance
            ]);
            $withdrawRequest->approve();
            Transaction::create([
                'user_id' => $withdrawRequest->instructor->id,
                'type' => Transaction::WITHDRAWAL,
                'amount' => $withdrawRequest->amount,
                'description' => "Withdraw" . $withdrawRequest->amount . "via" . $withdrawRequest->withdraw_method
            ]);
        });
        //send notification
        $instructor->notify(new WithdrawRequestApproved());
        session()->flash('success', __('site.withdraw_approved'));

        return redirect()->back();
    }

    public function reject(WithdrawRequest $withdrawRequest)
    {
        $instructor = $withdrawRequest->instructor;
        $new_available_balance = (int)$instructor->available_balance + (int)$withdrawRequest->amount;
        $new_frozen_balance = (int)$instructor->frozen_balance - (int)$withdrawRequest->amount;;
        DB::transaction(function () use ($new_available_balance, $new_frozen_balance, $withdrawRequest) {
            $withdrawRequest->instructor->update([
                'available_balance' => $new_available_balance,
                'frozen_balance' => $new_frozen_balance
            ]);
            $withdrawRequest->reject();
        });
        //send notification
        $instructor->notify(new WithdrawRequestRejected());
        session()->flash('success', __('site.withdraw_rejected'));
        return redirect()->back();
    }
}
