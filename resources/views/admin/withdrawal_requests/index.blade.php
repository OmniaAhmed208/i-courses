@extends('layouts.admin.app')
@section('title', setting('website_name') . ' Recharge Requests')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex align-items-center">
                            <h3 class="widget-title">@lang('site.withdrawal_requests')</h3>
                            <form action="{{ route('admin.withdrawal_requests.index') }}" method="get" class="ml-3">
                                <select name="status" id="status"
                                        class="form-control {{ app()->getLocale() == 'ar' ? 'pt-0 pb-0' : '' }}"
                                        onchange="this.form.submit()">
                                    <option value="">
                                        @lang('site.all')
                                    </option>
                                    <option
                                        value="{{ \App\Models\WithdrawRequest::STATUS_COMPLETED }}" {{ request()->status == \App\Models\WithdrawRequest::STATUS_COMPLETED ? 'selected' : '' }}>
                                        @lang('site.completed')
                                    </option>
                                    <option
                                        value="{{ \App\Models\WithdrawRequest::STATUS_PENDING }}" {{ request()->status == \App\Models\WithdrawRequest::STATUS_PENDING ? 'selected' : '' }}>
                                        @lang('site.pending')
                                    </option>
                                    <option
                                        value="{{ \App\Models\WithdrawRequest::STATUS_REJECTED }}" {{ request()->status == \App\Models\WithdrawRequest::STATUS_REJECTED ? 'selected' : '' }}>
                                        @lang('site.rejected')
                                    </option>
                                </select>
                            </form>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="statement-table withdraw-table table-responsive mb-5">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('site.name')</th>
                                        <th scope="col">@lang('site.amount')</th>
                                        <th scope="col">@lang('site.withdraw_method')</th>
                                        <th scope="col">@lang('site.status')</th>
                                        <th scope="col">@lang('site.request_time')</th>
                                        <th scope="col">@lang('site.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($requests as $request)
                                        <tr>
                                            <td>{{ $request->instructor->name }}</td>
                                            <td>{{ $request->amount }} @lang('site.le')</td>
                                            <td>{{ __('site.method_'.$request->withdraw_method) }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $request->status === 'completed' ? 'success' : ($request->status === 'pending' ? 'warning' : 'danger') }}">
                                                    @lang('site.' . $request->status)
                                                </span>
                                            </td>
                                            <td>{{ $request->created_at->format('d/m/Y h:i A') }}</td>
                                            <td>
                                                <button class="btn btn-info show-details"
                                                        data-instructor_name="{{ $request->instructor->name }}"
                                                        data-amount="{{ $request->amount }}"
                                                        data-withdraw_method="{{ $request->withdraw_method }}"
                                                        data-mobile="{{ $request->mobile }}"
                                                        data-name="{{ $request->name }}"
                                                        data-account_number="{{ $request->account_number }}"
                                                        data-bank_name="{{ $request->bank_name }}"
                                                        data-swift_iban="{{ $request->swift_iban }}"
                                                        data-toggle="modal"
                                                        data-target=".item-details-modal"
                                                >
                                                    <i class="la la-eye"></i>
                                                    @lang('site.show')
                                                </button>
                                                @if($request->status === \App\Models\WithdrawRequest::STATUS_PENDING)
                                                    <a href="{{ route('admin.withdrawal_requests.approve', $request->id) }}">
                                                        <button class="btn btn-success">
                                                            <i class="la la-check-circle"></i>
                                                            @lang('site.approve')
                                                        </button>
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.withdrawal_requests.reject', $request->id) }}"
                                                        method="POST" class="d-inline-block">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="la la-times-circle"></i>
                                                            @lang('site.reject')
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">@lang('site.no_requests')</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
                <div class="col-12 mb-5">
                    {{ $requests->links('vendor.pagination.default') }}
                </div>
            </div><!-- end row -->
            @include('layouts.admin._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->

    <!-- request-show-modal -->
    <div class="modal-form text-center">
        <div class="modal fade item-details-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content p-4">
                    <div class="modal-top border-0 mb-4 p-0 d-flex justify-content-center">
                        <div class="alert-content w-100">
                            <span class="la la-money warning-icon"></span>
                            <hr>
                            <h3 class="text-left mb-2">@lang('site.details')</h3>
                            <table class="table table-bordered w-100" id="withdraw_details">
                                <tr id="instructor_name">
                                    <td class="w-25">@lang('site.instructor')</td>
                                    <td class="data"></td>
                                </tr>
                                <tr id="amount">
                                    <td class="w-25">@lang('site.amount')</td>
                                    <td class="data"></td>
                                </tr>
                                <tr id="withdraw_method">
                                    <td class="w-25">@lang('site.withdraw_method')</td>
                                    <td class="data"></td>
                                </tr>
                                <tr id="mobile" class="d-none">
                                    <td class="w-25">@lang('site.mobile')</td>
                                    <td class="data"></td>
                                </tr>
                                <tr id="name" class="d-none">
                                    <td class="w-25">@lang('site.name') <span
                                            class="font-size-12 d-block text-danger">@lang('site.for_bank')</span>
                                    </td>
                                    <td class="data"></td>
                                </tr>
                                <tr id="bank_name" class="d-none">
                                    <td class="w-25">@lang('site.bank_name')</td>
                                    <td class="data"></td>
                                </tr>
                                <tr id="account_number" class="d-none">
                                    <td class="w-25">@lang('site.account_number')</td>
                                    <td class="data"></td>
                                </tr>
                                <tr id="swift_iban" class="d-none">
                                    <td class="w-25">@lang('site.swift_iban')</td>
                                    <td class="data"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div><!-- end modal-content -->
            </div><!-- end modal-dialog -->
        </div><!-- end modal -->
    </div><!-- end modal-form -->
@endsection

@push('scripts')
    <script>
        $(document).on("click", ".show-details", function (e) {
            e.preventDefault();
            let instructor_name = $(this).data('instructor_name'),
                amount = $(this).data('amount'),
                withdraw_method = $(this).data('withdraw_method'),
                mobile = $(this).data('mobile'),
                name = $(this).data('name'),
                bank_name = $(this).data('bank_name'),
                account_number = $(this).data('account_number'),
                swift_iban = $(this).data('swift_iban');
            let table_rows = $("#withdraw_details tr"),
                table_instructor_name = $("#instructor_name"),
                table_amount = $("#amount"),
                table_withdraw_method = $("#withdraw_method"),
                table_mobile = $("#mobile"),
                table_name = $("#name"),
                table_bank_name = $("#bank_name"),
                table_account_number = $("#account_number"),
                table_swift_iban = $("#swift_iban");

            if (withdraw_method === 'bank') {
                table_rows.removeClass('d-none');
                table_mobile.addClass('d-none');
                table_instructor_name.children('.data').html(instructor_name);
                table_amount.children('.data').html(amount + " {{ __('site.le') }}");
                table_withdraw_method.children('.data').html("{{ __('site.method_bank') }}");
                table_name.children('.data').html(name);
                table_bank_name.children('.data').html(bank_name);
                table_account_number.children('.data').html(account_number);
                table_swift_iban.children('.data').html(swift_iban);
            } else if (withdraw_method === 'vodafone') {
                table_mobile.removeClass('d-none')
                table_instructor_name.children('.data').html(instructor_name);
                table_amount.children('.data').html(amount + " {{ __('site.le') }}");
                table_withdraw_method.children('.data').html("{{ __('site.method_vodafone') }}");
                table_mobile.children('.data').html(mobile);
            }
        });
    </script>
@endpush
