@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Wallet')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">
                                <i class="la la-wallet"></i>
                                @lang('site.wallet')
                            </h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="section-tab section-tab-2">
                                <ul class="nav nav-tabs" role="tablist" id="review">
                                    <li role="presentation">
                                        <a href="#withdraw" role="tab" data-toggle="tab" class="active"
                                           aria-selected="true">
                                            @lang('site.withdraw')
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#withdraw_history" role="tab" data-toggle="tab"
                                           aria-selected="true">
                                            @lang('site.withdraw_history')
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#statement" role="tab" data-toggle="tab"
                                           aria-selected="true">
                                            @lang('site.statement')
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dashboard-tab-content mt-5">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active show" id="withdraw">
                                        <div class="balance-info">
                                            <ul class="list-items pb-5">
                                                <li>
                                                    <h3 class="widget-title font-size-18">@lang('site.current_balance')</h3>
                                                </li>
                                                <li>@lang('site.available_balance_is') <span
                                                        class="primary-color font-weight-semi-bold">{{ $available_balance }} @lang('site.le')</span>
                                                    @lang('site.ready_to_withdraw')
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="user-profile-action-wrap">
                                            <h3 class="widget-title font-size-18 padding-bottom-40px">
                                                @lang('site.select_withdraw_method')
                                            </h3>
                                        </div><!-- end user-profile-action-wrap -->
                                        <div class="withdraw-method-wrap">
                                            <div class="row">
                                                <div class="col-lg-6 column-td-half">
                                                    <div class="payment-option">
                                                        <label for="bank-transfer" class="radio-trigger">
                                                            <input type="radio" id="bank-transfer"
                                                                   name="withdraw_method" value="bank" checked>
                                                            <span class="checkmark"></span>
                                                            <span class="widget-title font-size-18">
                                                                @lang('site.method_bank')
                                                                <span
                                                                    class="d-block primary-color-3 font-weight-medium font-size-13 line-height-18">@lang('site.min_withdraw') 1000 @lang('site.le')</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div><!-- end col-lg-2 -->
                                                <div class="col-lg-6 column-td-half">
                                                    <div class="payment-option">
                                                        <label for="vodafone-transfer" class="radio-trigger">
                                                            <input type="radio" id="vodafone-transfer"
                                                                   name="withdraw_method" value="vodafone">
                                                            <span class="checkmark"></span>
                                                            <span class="widget-title font-size-18">
                                                                @lang('site.method_vodafone')
                                                                <span
                                                                    class="d-block primary-color-3 font-weight-medium font-size-13 line-height-18">@lang('site.min_withdraw')  200 @lang('site.le')</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div><!-- end col-lg-2 -->
                                            </div><!-- end row -->
                                        </div>
                                        <div class="user-form padding-top-50px">
                                            <div class="user-profile-action-wrap">
                                                <h3 class="widget-title font-size-18 padding-bottom-40px">
                                                    @lang('site.account_info')
                                                </h3>
                                            </div><!-- end user-profile-action-wrap -->
                                            <div class="contact-form-action">
                                                <form method="post" action="{{ route('teacher.wallet.bankWithdraw') }}"
                                                      id="bank">
                                                    @csrf
                                                    <input type="hidden" name="instructor_id"
                                                           value="{{ auth()->user()->id }}">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="input-box">
                                                                <label class="label-text">@lang('site.amount')<span
                                                                        class="primary-color-2 ml-1">*</span>
                                                                </label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('amount') error @enderror"
                                                                        type="number"
                                                                        name="amount"
                                                                        value="{{ $available_balance }}"
                                                                        min="1000"
                                                                    >
                                                                    <span class="la la-user input-icon"></span>
                                                                    @error('amount')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-4">
                                                            <div class="input-box">
                                                                <label class="label-text">@lang('site.name')<span
                                                                        class="primary-color-2 ml-1">*</span>
                                                                </label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('name') error @enderror"
                                                                        type="text"
                                                                        name="name"
                                                                        value="{{ auth()->user()->name }}">
                                                                    <span class="la la-user input-icon"></span>
                                                                    @error('name')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-4 -->
                                                        <div class="col-lg-4 col-sm-4">
                                                            <div class="input-box">
                                                                <label class="label-text">@lang('site.account_number')
                                                                    <span
                                                                        class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('account_number') error @enderror"
                                                                        type="text"
                                                                        name="account_number"
                                                                        placeholder="ex: 123456789123">
                                                                    <span class="la la-pencil input-icon"></span>
                                                                    @error('account_number')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-4 -->
                                                        <div class="col-lg-4 col-sm-4">
                                                            <div class="input-box">
                                                                <label class="label-text">@lang('site.bank_name')<span
                                                                        class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('bank_name') error @enderror"
                                                                        type="text"
                                                                        name="bank_name" placeholder="ex: CIB">
                                                                    <span class="la la-bank input-icon"></span>
                                                                    @error('bank_name')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-4 -->
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text">@lang('site.swift_iban')
                                                                    <span class="primary-color-2 ml-1">*</span>
                                                                </label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('swift_iban') error @enderror"
                                                                        type="text"
                                                                        name="swift_iban">
                                                                    <span class="la la-pencil input-icon"></span>
                                                                    @error('swift_iban')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-12">
                                                            <div class="btn-box">
                                                                <button class="theme-btn" type="submit">
                                                                    @lang('site.request_withdraw')
                                                                </button>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                    </div><!-- end row -->
                                                </form>
                                                <form method="post"
                                                      action="{{ route('teacher.wallet.vodafoneWithdraw') }}"
                                                      id="vodafone" style="display: none;">
                                                    @csrf
                                                    <input type="hidden" name="instructor_id"
                                                           value="{{ auth()->user()->id }}">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-sm-4">
                                                            <div class="input-box">
                                                                <label class="label-text">Vodafone Mobile Number<span
                                                                        class="primary-color-2 ml-1">*</span>
                                                                </label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('mobile') error @enderror"
                                                                        type="text"
                                                                        name="mobile"
                                                                        placeholder="ex: 01094388918">
                                                                    <span class="la la-user input-icon"></span>
                                                                    @error('mobile')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-4 -->
                                                        <div class="col-lg-4 col-sm-4">
                                                            <div class="input-box">
                                                                <label class="label-text">@lang('site.amount')<span
                                                                        class="primary-color-2 ml-1">*</span>
                                                                </label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('vodafone_amount') error @enderror"
                                                                        type="number"
                                                                        name="vodafone_amount"
                                                                        value="{{ $available_balance }}"
                                                                        min="200"
                                                                    >
                                                                    <span class="la la-user input-icon"></span>
                                                                    @error('vodafone_amount')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="btn-box">
                                                                <button class="theme-btn" type="submit">
                                                                    @lang('site.request_withdraw')
                                                                </button>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div><!-- end tab-pane-->
                                    <div role="tabpanel" class="tab-pane fade" id="withdraw_history">
                                        <div class="card-box-shared-body">
                                            <div class="statement-table withdraw-table table-responsive mb-5">
                                                <div class="statement-header pb-4">
                                                    <h3 class="widget-title font-size-18">@lang('site.pending_withdrawals')</h3>
                                                </div>
                                                @if(count($pending_withdrawals) > 0)
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">@lang('site.amount')</th>
                                                            <th scope="col">@lang('site.withdraw_method')</th>
                                                            <th scope="col">Created at</th>
                                                            <th scope="col">@lang('site.approved_at')</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($pending_withdrawals as $withdraw)
                                                            <tr>
                                                                <th scope="row">
                                                                    <span>{{ $withdraw->amount }} @lang('site.le')</span>
                                                                </th>
                                                                <td>
                                                                <span>
                                                                    @if($withdraw->withdraw_method == 'vodafone')
                                                                        @lang('site.method_vodafone')
                                                                    @elseif($withdraw->withdraw_method == 'bank')
                                                                        @lang('site.method_bank')
                                                                    @endif
                                                                </span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $withdraw->created_at->format('d/m/Y h:i A') }}</span>
                                                                </td>
                                                                <td>
                                                                <span class="badge badge-warning">
                                                                    @lang('site.' . $withdraw->status)
                                                                </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <ul class="list-items pb-5">
                                                        <li>@lang('site.pending_withdrawals')</li>
                                                    </ul>
                                                @endif
                                            </div>
                                            <div class="statement-table withdraw-table table-responsive mb-5">
                                                <div class="statement-header pb-4">
                                                    <h3 class="widget-title font-size-18">@lang('site.completed_withdrawals')</h3>
                                                </div>
                                                @if(count($completed_withdrawals) > 0)
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">@lang('site.amount')</th>
                                                            <th scope="col">@lang('site.withdraw_method')</th>
                                                            <th scope="col">@lang('site.created_at')</th>
                                                            <th scope="col">@lang('site.approved_at')</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($completed_withdrawals as $withdraw)
                                                            <tr>
                                                                <th scope="row">
                                                                    <span>{{ $withdraw->amount }} @lang('site.le')</span>
                                                                </th>
                                                                <td>
                                                                <span>
                                                                    @if($withdraw->withdraw_method == 'vodafone')
                                                                        @lang('site.method_vodafone')
                                                                    @elseif($withdraw->withdraw_method == 'bank')
                                                                        @lang('site.method_bank')
                                                                    @endif
                                                                </span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $withdraw->created_at->format('d/m/Y h:i A') }}</span>
                                                                </td>
                                                                <td>
                                                                <span>
                                                                    {{ $withdraw->updated_at->format('d/m/Y h:i A') }}
                                                                </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <ul class="list-items pb-5">
                                                        <li>@lang('site.no_completed_withdrawals')</li>
                                                    </ul>
                                                @endif
                                            </div>
                                            <div class="statement-table withdraw-table table-responsive">
                                                <div class="statement-header pb-4">
                                                    <h3 class="widget-title font-size-18">@lang('site.rejected_withdrawals')</h3>
                                                </div>
                                                @if(count($rejected_withdrawals) > 0)
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">@lang('site.amount')</th>
                                                            <th scope="col">@lang('site.withdraw_method')</th>
                                                            <th scope="col">@lang('site.created_at')</th>
                                                            <th scope="col">@lang('site.rejected_at')</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($rejected_withdrawals as $withdraw)
                                                            @if($withdraw->status == \App\Models\WithdrawRequest::STATUS_REJECTED)
                                                                <tr>
                                                                    <th scope="row">
                                                                        <span>{{ $withdraw->amount }} @lang('site.le')</span>
                                                                    </th>
                                                                    <td>
                                                                <span>
                                                                    @if($withdraw->withdraw_method == 'vodafone')
                                                                        @lang('site.method_vodafone')
                                                                    @elseif($withdraw->withdraw_method == 'bank')
                                                                        @lang('site.method_bank')
                                                                    @endif
                                                                </span>
                                                                    </td>
                                                                    <td>
                                                                        <span>{{ $withdraw->created_at->format('d/m/Y h:i A') }}</span>
                                                                    </td>
                                                                    <td>
                                                                <span>
                                                                    {{ $withdraw->updated_at->format('d/m/Y h:i A') }}
                                                                </span>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <ul class="list-items pb-5">
                                                        <li>@lang('site.no_rejected_withdrawals')</li>
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>

                                    </div><!-- end tab-pane-->
                                    <div role="tabpanel" class="tab-pane fade" id="statement">
                                        <div class="row mt-5">
                                            <div class="col-lg-4 column-lmd-2-half column-md-2-full">
                                                <div
                                                    class="icon-box icon-box-layout-2 bg-color-1 d-flex align-items-center">
                                                    <div class="icon-element flex-shrink-0">
                                                        <i class="la la-dollar"></i>
                                                    </div><!-- end icon-element-->
                                                    <div class="info-content">
                                                        <h4 class="info__title mb-2">@lang('site.available_balance')</h4>
                                                        <span
                                                            class="info__count">{{ $available_balance }} @lang('site.le')</span>
                                                    </div><!-- end info-content -->
                                                </div>
                                            </div><!-- end col-lg-4 -->
                                            <div class="col-lg-4 column-lmd-2-half column-md-2-full">
                                                <div
                                                    class="icon-box icon-box-layout-2 bg-color-3 d-flex align-items-center">
                                                    <div class="icon-element flex-shrink-0">
                                                        <i class="la la-dollar"></i>
                                                    </div><!-- end icon-element-->
                                                    <div class="info-content">
                                                        <h4 class="info__title mb-2">@lang('site.frozen_balance')</h4>
                                                        <span
                                                            class="info__count">{{ $frozen_balance }} @lang('site.le')</span>
                                                    </div><!-- end info-content -->
                                                </div>
                                            </div><!-- end col-lg-4 -->
                                        </div><!-- end row -->
                                        <div class="statement-table table-responsive">
                                            <div class="statement-header pb-4">
                                                <h3 class="widget-title pb-2">@lang('site.statement')</h3>
                                            </div>
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">@lang('site.course_info')</th>
                                                    <th scope="col">@lang('site.earning')</th>
                                                    <th scope="col">@lang('site.commission')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($statments as $statment)
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="statement-info">
                                                                <ul class="list-items mb-3">
                                                                    <li>
                                                                        <span class="primary-color mr-1">@lang('site.date'):</span>
                                                                        {{ $statment->created_at->format('d/m/Y H:i A') }}
                                                                    </li>
                                                                    <li>
                                                                        <span class="primary-color mr-1">@lang('site.course'):</span>
                                                                        {{ $statment->course->title }}
                                                                    </li>
                                                                    <li>
                                                                        <span class="primary-color mr-1">@lang('site.price'):</span>
                                                                        {{ $statment->total_price }} @lang('site.le')
                                                                    </li>
                                                                </ul>
                                                                <ul class="list-items">
                                                                    <li><span
                                                                            class="primary-color font-weight-bold">@lang('site.purchaser')</span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="primary-color mr-1">@lang('site.name'):</span>
                                                                        {{ $statment->user->name }}
                                                                    </li>
                                                                    <li>
                                                                        <span class="primary-color mr-1">@lang('site.email'):</span>
                                                                        {{ $statment->user->email }}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </th>
                                                        <td>
                                                            <div class="statement-info">
                                                                <ul class="list-items">
                                                                    <li class="primary-color">{{ $statment->earning }}
                                                                        @lang('site.le')
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="statement-info">
                                                                <ul class="list-items">
                                                                    <li class="primary-color">{{ $statment->commission }}
                                                                        @lang('site.le')
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3"
                                                            class="text-center">@lang('site.no_statement')</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                            {{ $statments->links('vendor.pagination.default') }}
                                        </div>
                                    </div><!-- end tab-pane-->
                                </div><!-- end tab-content -->
                            </div><!-- end dashboard-tab-content -->
                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
            @include('layouts.teacher._dashboard_footer')

        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection
@push('scripts')
    <script>
        $('input[type=radio][name=withdraw_method]').change(function () {
            let vodafone_form = $("#vodafone"),
                bank_form = $("#bank");
            if (this.value === 'vodafone') {
                bank_form.hide();
                vodafone_form.show();
            } else if (this.value === 'bank') {
                vodafone_form.hide();
                bank_form.show();
            }
        });
    </script>
@endpush
