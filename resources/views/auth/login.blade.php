@extends('layouts.app')
@section('title', setting('website_name') . ' Login')
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
                            <h2 class="section__title">@lang('site.auth.login')</h2>
                        </div>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{ route('home') }}">@lang('site.home')</a></li>
                            <li>@lang('site.auth.login')</li>
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
           START LOGIN AREA
    ================================= -->
    <section class="login-area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title text-center">
                            <h3 class="widget-title font-size-25">@lang('site.auth.header_title')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="contact-form-action">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.auth.email')<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control @error('email') error @enderror"
                                                           type="text" name="email"
                                                           value="{{ old('email') }}" required autocomplete="email"
                                                           autofocus
                                                           placeholder="@lang('site.auth.email_address')">
                                                    <span class="la la-envelope input-icon"></span>
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div><!-- end col-md-12 -->
                                        <div class="col-lg-12">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.auth.password')<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input type="password"
                                                           class="form-control @error('password') error @enderror"
                                                           name="password"
                                                           required autocomplete="current-password"
                                                           placeholder="@lang('site.auth.password')">
                                                    <span class="la la-lock input-icon"></span>
                                                    @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div><!-- end col-md-12 -->
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="custom-checkbox d-flex justify-content-between">
                                                    <input type="checkbox" id="chb1"
                                                           name="remember"
                                                           class="d-none" {{ old('remember') ? 'checked' : '' }}>
                                                    <label for="chb1">@lang('site.auth.remember')</label>
                                                    @if (Route::has('password.request'))
                                                        <a href="{{ route('password.request') }}"
                                                           class="primary-color-2">@lang('site.auth.forgot')</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div><!-- end col-md-12 -->
                                        <div class="col-lg-12 ">
                                            <div class="btn-box">
                                                <button class="theme-btn"
                                                        type="submit">@lang('site.auth.login_button')</button>
                                            </div>
                                        </div><!-- end col-md-12 -->
                                        @if (Route::has('register'))
                                            <div class="col-lg-12">
                                                <p class="mt-4">@lang('site.auth.dont_have_account')
                                                    <a
                                                        href="{{ route('register') }}"
                                                        class="primary-color-2">@lang('site.auth.register')
                                                    </a>
                                                </p>
                                            </div><!-- end col-md-12 -->
                                        @endif
                                    </div><!-- end row -->
                                </form>
                            </div><!-- end contact-form -->
                        </div>
                    </div>
                </div><!-- end col-lg-7 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end login-area -->
    <!-- ================================
           END LOGIN AREA
    ================================= -->
@endsection
