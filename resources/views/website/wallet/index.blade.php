@extends('layouts.app')
@section('title', setting('website_name') . ' Wallet')
@section('content')
    <!-- ================================
    START BREADCRUMB AREA
================================= -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <div class="section-heading">
                            <h2 class="section__title">@lang('site.wallet')</h2>
                        </div>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{ route('home') }}">@lang('site.home')</a></li>
                            <li>@lang('site.wallet')</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->
    <div class="cart-area padding-top-120px padding-bottom-60px {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}"
         style="overflow-x: hidden">
        <div class="container">
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
                                        <a href="#recharge" role="tab" data-toggle="tab" class="active"
                                           aria-selected="true">
                                            @lang('site.recharge')
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#requests" role="tab" data-toggle="tab"
                                           aria-selected="true">
                                            @lang('site.recharge_requests')
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dashboard-tab-content mt-5">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active show" id="recharge">
                                        <div class="row mt-5">
                                            <div class="col-lg-4 column-lmd-2-half column-md-2-full">
                                                <div
                                                    class="icon-box icon-box-layout-2 bg-color-1 d-flex align-items-center">
                                                    <div class="icon-element flex-shrink-0">
                                                        <i class="la la-dollar"></i>
                                                    </div><!-- end icon-element-->
                                                    <div class="info-content">
                                                        <h4 class="info__title mb-2">@lang('site.balance')</h4>
                                                        <span class="info__count">{{ $balance }} @lang('site.le')</span>
                                                    </div><!-- end info-content -->
                                                </div>
                                            </div><!-- end col-lg-4 -->
                                            <div class="col-lg-4 column-lmd-2-half column-md-2-full">
                                                <div
                                                    class="icon-box icon-box-layout-2 d-flex align-items-center" style="background-color: rgb(230, 0, 0)">
                                                    <div class="icon-element flex-shrink-0">
                                                        <img src="{{ asset('images/vodafone_icon.svg') }}" alt="vodafone" width="50">
                                                    </div><!-- end icon-element-->
                                                    <div class="info-content">
                                                        <h4 class="info__title mb-2">@lang('site.method_vodafone')</h4>
                                                        <span class="info__count"> 01005615033</span>
                                                    </div><!-- end info-content -->
                                                </div>
                                            </div><!-- end col-lg-4 -->
                                        </div><!-- end row -->
                                        <div class="user-profile-action-wrap">
                                            <h3 class="widget-title font-size-18 padding-bottom-40px">
                                                @lang('site.recharge_your_balance')
                                            </h3>
                                        </div><!-- end user-profile-action-wrap -->
                                        <div class="user-form">
                                            <div class="contact-form-action">
                                                <form method="post" action="{{ route('wallet.recharge') }}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="input-box">
                                                                <label class="label-text">
                                                                    @lang('site.amount')
                                                                    <span class="primary-color-2 ml-1">*</span>
                                                                </label>
                                                                <div class="form-group mb-2">
                                                                    <div class="upload-btn-box course-photo-btn">
                                                                        <input type="number"
                                                                               min="10"
                                                                               class="form-control @error('amount') error @enderror"
                                                                               name="amount"
                                                                               value="{{ old('amount') }}"
                                                                               autocomplete="off"
                                                                               required>
                                                                        <span class="la la-money input-icon"></span>
                                                                        @error('amount')
                                                                        <span
                                                                            class="text-danger font-size-12">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                        <div class="col-lg-12">
                                                            <div class="input-box">
                                                                <label class="label-text">@lang('site.receipt_image')
                                                                    <span
                                                                        class="primary-color-2 ml-1">*</span>
                                                                </label>
                                                                <div class="form-group mb-0">
                                                                    <div class="upload-btn-box course-photo-btn">
                                                                        <input type="file" name="image"
                                                                               class="filer_input"
                                                                               data-jfiler-extensions="jpg, jpeg, png">
                                                                        @error('image')
                                                                        <span
                                                                            class="text-danger font-size-12">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                    </div><!-- end row -->
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="btn-box">
                                                                <button class="theme-btn" type="submit">
                                                                    @lang('site.request_recharge')
                                                                </button>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- end tab-pane-->
                                    <div role="tabpanel" class="tab-pane fade" id="requests">
                                        <div class="card-box-shared-body">
                                            <div class="statement-table withdraw-table table-responsive mb-5">
                                                <div class="statement-header pb-4">
                                                    <h3 class="widget-title font-size-18">@lang('site.pending_requests')</h3>
                                                </div>
                                                @if(count($requests) > 0)
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">@lang('site.amount')</th>
                                                            <th scope="col">@lang('site.receipt_image')</th>
                                                            <th scope="col">@lang('site.status')</th>
                                                            <th scope="col">@lang('site.created_at')</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($requests as $request)
                                                            <tr>
                                                                <td>
                                                                    {{ $request->amount }}
                                                                </td>
                                                                <td>
                                                                    <img
                                                                        src="{{ asset('storage/'.$request->receipt_image) }}"
                                                                        alt="Request" style="width: 200px">
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge text-white {{ $request->status == 'done' ? 'bg-success' : ($request->status == 'pending' || $request->status == 'draft' ? 'bg-warning' : 'bg-danger') }}">
                                                                        @lang('site.' . $request->status)
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    {{ $request->created_at->format("d/m/Y") }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <ul class="list-items pb-5">
                                                        <li>@lang('site.no_requests')</li>
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>
                                    </div><!-- end tab-pane-->
                                </div><!-- end tab-content -->
                            </div><!-- end dashboard-tab-content -->
                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </div><!-- end wrapper -->
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.filer.min.js') }}"></script>
@endpush
