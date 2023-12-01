<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankWithdrawRequest;
use App\Http\Requests\VodafoneWithdrawRequest;
use App\Models\Statment;
use App\Models\User;
use App\Models\WithdrawRequest;
use App\Notifications\TeacherWithdrawRequestNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class WalletController extends Controller
{
    public function index()
    {
        $course_ids = auth()->user()->instructor_courses->pluck('id')->toArray();
        $statments = Statment::with('course', 'student')->whereIn('course_id', $course_ids)->paginate(10);
        $available_balance = auth()->user()->available_balance;
        $frozen_balance = auth()->user()->frozen_balance;
        $pending_withdrawals = WithdrawRequest::where('instructor_id', auth()->user()->id)->where('status', WithdrawRequest::STATUS_PENDING)->get();
        $rejected_withdrawals = WithdrawRequest::where('instructor_id', auth()->user()->id)->where('status', WithdrawRequest::STATUS_REJECTED)->get();
        $completed_withdrawals = WithdrawRequest::where('instructor_id', auth()->user()->id)->where('status', WithdrawRequest::STATUS_COMPLETED)->get();


        return view('teacher.wallet.index', compact('statments', 'available_balance', 'frozen_balance', 'pending_withdrawals', 'rejected_withdrawals', 'completed_withdrawals'));
    }

    public function vodafoneWithdraw(VodafoneWithdrawRequest $request)
    {
        if (auth()->user()->available_balance >= $request->vodafone_amount) {
            $instructor = User::find($request->instructor_id);
            $data = $request->validated();
            $data['status'] = WithdrawRequest::STATUS_PENDING;
            $data['withdraw_method'] = WithdrawRequest::VODAFONE_METHOD;
            $data['amount'] = $request->vodafone_amount;
            DB::transaction(function () use ($data, $request) {
                WithdrawRequest::create($data);
                auth()->user()->update([
                    'available_balance' => (int)auth()->user()->available_balance - (int)$request->vodafone_amount,
                    'frozen_balance' => (int)auth()->user()->frozen_balance + (int)$request->vodafone_amount
                ]);
            });
            //notify admin
            $admins = User::whereRoleIs('admin')->orWhereRoleIs('moderator')->get();
            Notification::send($admins, new TeacherWithdrawRequestNotification($instructor->name, $data['amount']));
            session()->flash('success', __('site.withdraw_request_submited'));
        } else {
            session()->flash('error', __('site.not_enough_balance'));
        }
        return redirect()->route('teacher.wallet.index');
    }

    public function bankWithdraw(BankWithdrawRequest $request)
    {
        if (auth()->user()->available_balance >= $request->amount) {
            $instructor = User::find($request->instructor_id);
            $data = $request->validated();
            $data['status'] = WithdrawRequest::STATUS_PENDING;
            $data['withdraw_method'] = WithdrawRequest::BANK_METHOD;
            DB::transaction(function () use ($data, $request) {
                WithdrawRequest::create($data);
                auth()->user()->update([
                    'available_balance' => (int)auth()->user()->available_balance - (int)$request->amount,
                    'frozen_balance' => (int)auth()->user()->frozen_balance + (int)$request->amount
                ]);
            });
            //notify admin
            $admins = User::whereRoleIs('admin')->orWhereRoleIs('moderator')->get();
            Notification::send($admins, new TeacherWithdrawRequestNotification($instructor->name, $data['amount']));
            session()->flash('success', __('site.withdraw_request_submited'));
        } else {
            session()->flash('error', __('site.not_enough_balance'));
        }
        return redirect()->route('teacher.wallet.index');
    }
}
