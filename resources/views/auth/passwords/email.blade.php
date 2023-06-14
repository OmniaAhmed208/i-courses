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
                            <h2 class="section__title">@lang('site.auth.reset_password')</h2>
                        </div>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{ route('home') }}">@lang('site.home')</a></li>
                            <li>@lang('site.auth.reset_password')</li>
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
                            <p class="line-height-26">
                                @lang('site.auth.reset_password_text')
                                <a href="#" class="primary-color-2">@lang('site.auth.contact_us')</a>
                            </p>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="contact-form-action">
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.auth.email_address')<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control @error('email') error @enderror"
                                                           type="email" name="email"
                                                           value="{{ old('email') }}" required autocomplete="email"
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
                                            <div class="form-group {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                                <button class="theme-btn"
                                                        type="submit">@lang('site.auth.reset_password')</button>
                                            </div>
                                        </div><!-- end col-lg-12 -->
                                        <div class="col-lg-6">
                                            <p class="{{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                                <a
                                                    href="{{ route('login') }}"
                                                    class="primary-color-2">
                                                    @lang('site.auth.login')
                                                </a>
                                            </p>
                                        </div><!-- end col-lg-6 -->
                                        @if(Route::has('register'))
                                            <div class="col-lg-6">
                                                <p class="text-right register-text {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">@lang('site.auth.not_member')
                                                    <a
                                                        href="{{ route('register') }}"
                                                        class="primary-color-2">@lang('site.auth.register')</a>
                                                </p>
                                            </div><!-- end col-lg-6 -->
                                        @endif
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
