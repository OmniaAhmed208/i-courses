@extends('layouts.app')
@section('title', setting('website_name') . ' Reset Password')
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
                            <h2 class="section__title">Reset Password</h2>
                        </div>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{ route('home') }}">Home</a></li>
                            <li>Reset Password</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!-- ================================
           START RECOVER AREA
    ================================= -->
    <section class="recover-area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto">
                    <div class="card-box-shared {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title font-size-25 pb-2">@lang('site.auth.reset_password')!</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="contact-form-action">
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.auth.email_address')<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control @error('email') error @enderror"
                                                           type="email" name="email"
                                                           value="{{ $email ?? old('email') }}" required
                                                           autocomplete="email"
                                                           autofocus
                                                           placeholder="@lang('site.auth.email_address')">
                                                    <span class="la la-envelope input-icon"></span>
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-12 -->
                                        <div class="col-lg-12">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.auth.password')<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control @error('password') error @enderror"
                                                           type="password" name="password"
                                                           required autocomplete="new-password"
                                                           placeholder="@lang('site.auth.password')">
                                                    <span class="la la-lock input-icon"></span>
                                                    @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div><!-- end col-md-12 -->
                                        <div class="col-lg-12">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.auth.confirm_password')<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control" type="password"
                                                           name="password_confirmation" required
                                                           autocomplete="new-password"
                                                           placeholder="@lang('site.auth.confirm_password')">
                                                    <span class="la la-lock input-icon"></span>
                                                </div>
                                            </div>
                                        </div><!-- end col-md-12 -->
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <button class="theme-btn"
                                                        type="submit">@lang('site.auth.reset_password')</button>
                                            </div>
                                        </div><!-- end col-lg-12 -->
                                    </div><!-- end row -->
                                </form>
                            </div><!-- end contact-form -->
                        </div>
                    </div>
                </div><!-- end col-lg-7 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end recover-area -->
    <!-- ================================
           START RECOVER AREA
    ================================= -->
@endsection
