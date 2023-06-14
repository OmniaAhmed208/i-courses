@extends('layouts.admin.app')
@section('title', setting('website_name') . ' Recharge Requests')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex align-items-center">
                            <h3 class="widget-title">@lang('site.recharge_requests')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            @forelse($requests as $request)
                                <div class="card-item card-list-layout">
                                    <div class="card-image">
                                        <a href="javascript:void(0)" class="card__img"
                                           data-toggle="modal"
                                           data-target=".item-image-modal">
                                            <img src="{{ asset('storage/'.$request->receipt_image) }}"
                                                 alt="receipt_image">
                                        </a>
                                    </div><!-- end card-image -->
                                    <div class="card-content">
                                        <h3 class="card__title mt-0">
                                            @lang('site.user'): {{ $request->user->name }}
                                        </h3>
                                        <div class="card-price-wrap d-flex align-items-center">
                                            <p class="card__price">
                                                @lang('site.recharge_amount'): {{ $request->amount }} @lang('site.le')
                                            </p>
                                        </div><!-- end card-price-wrap -->
                                        <p class="card__author">
                                            <a href="#">@lang('site.request_time')
                                                : {{ $request->created_at->format('d/m/Y - h:i A') }}</a>
                                        </p>
                                        @if($request->status == \App\Models\RechargeRequest::STATUS_DONE)
                                            <p class="card__author">
                                                <a href="#">@lang('site.approved_at')
                                                    : {{ $request->updated_at->format('d/m/Y - h:i A') }}</a>
                                            </p>
                                        @endif
                                        <div class="card-action">
                                            <ul class="card-duration d-flex">
                                                <li>
                                                <span class="meta__date mr-2">
                                                    <span class="status-text">@lang('site.status'):</span>
                                                    <span
                                                        class="badge text-white {{ $request->status == \App\Models\RechargeRequest::STATUS_DONE ? 'bg-success' : 'bg-warning' }}">@lang('site.' . $request->status)</span>
                                                </span>
                                                </li>
                                            </ul>
                                        </div><!-- end card-action -->
                                        @if($request->status == \App\Models\RechargeRequest::STATUS_PENDING)
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="btn-box mt-3">
                                                        <form
                                                            action="{{ route('admin.recharge_requests.approve', $request->id) }}"
                                                            id="add_balance_{{ $request->id }}">
                                                            <button
                                                                class="theme-btn d-flex align-items-center justify-content-center add_balance"
                                                                data-toggle="modal"
                                                                data-target=".item-confirm-modal"
                                                                data-username="{{ $request->user->name }}"
                                                                data-balance="{{ $request->amount }}"
                                                                data-reqId="{{ $request->id }}"
                                                            >
                                                                <i class="la la-plus la-2x mr-2"></i>
                                                                <span>@lang('site.add') <span
                                                                        class="font-weight-bold"> {{ $request->amount }} @lang('site.le') </span>
                                                        @lang('site.to') {{ $request->user->name }}</span>
                                                            </button>
                                                        </form>
                                                    </div><!-- end btn-box -->
                                                </div><!-- end col-lg-12 -->
                                            </div>
                                        @endif
                                    </div><!-- end card-content -->
                                </div><!-- end card-item -->
                            @empty
                                <p>@lang('site.no_requests')</p>
                            @endforelse
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

    <!-- account-delete-modal -->
    <div class="modal-form text-center">
        <div class="modal fade item-image-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content p-4">
                    <div class="modal-top border-0 mb-4 p-0">
                        <div class="alert-content">
                            <span class="la la-cash-register warning-icon"></span>
                            <h4 class="widget-title font-size-20 mt-2 mb-1">
                                <img src="" alt="receipt_image" id="modal_receipt_image" class="img-fluid">
                            </h4>
                        </div>
                    </div>
                </div><!-- end modal-content -->
            </div><!-- end modal-dialog -->
        </div><!-- end modal -->
    </div><!-- end modal-form -->

    <div class="modal-form text-center">
        <div class="modal fade item-confirm-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content p-4">
                    <div class="modal-top d-flex justify-content-center border-0 mb-4 p-0">
                        <div class="alert-content">
                            <span class="la la-exclamation-circle warning-icon"></span>
                            <h4 class="widget-title font-size-20 mt-2 mb-1">@lang('site.you_will_add') <span
                                    id="modal_amount"></span>
                                @lang('site.le') @lang('site.to')
                                <span id="modal_username"></span></h4>
                            <p class="modal-sub">@lang('site.proceed_confirm')</p>
                        </div>
                    </div>
                    <div class="btn-box mt-2">
                        <button type="button" class="btn primary-color font-weight-bold mr-3" data-dismiss="modal">
                            @lang('site.cancel')
                        </button>
                        <button type="submit" class="theme-btn bg-color-1 border-0 text-white" id="modal_add_balance">
                            <i class="la la-plus"></i>
                            @lang('site.add_balance')
                        </button>
                    </div>
                </div><!-- end modal-content -->
            </div><!-- end modal-dialog -->
        </div><!-- end modal -->
    </div><!-- end modal-form -->
@endsection

@push('scripts')
    <script>
        $(document).on("click", ".card__img", function () {
            let img_src = $(this).children('img').attr('src');
            $("#modal_receipt_image").attr('src', img_src);
        });

        $(document).on("click", ".add_balance", function (e) {
            e.preventDefault();
            let username = $(this).data('username'),
                balance = $(this).data('balance'),
                form_id = $(this).data('reqid');
            $("#modal_amount").text(balance);
            $("#modal_username").text(username);
            $("#modal_add_balance").attr('data-form', form_id);
        });

        $("#modal_add_balance").on("click", function (e) {
            e.preventDefault();
            let form_id = "#add_balance_" + $(this).data('form');
            $(form_id).submit();
        });
    </script>
@endpush
