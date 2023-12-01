@extends('layouts.app')
@section('title', setting('website_name') . ' Register')
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
                            <h2 class="section__title">@lang('site.auth.register')</h2>
                        </div>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{ route('home') }}">@lang('site.home')</a></li>
                            <li>@lang('site.auth.register')</li>
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
           START SIGN UP AREA
    ================================= -->
    <section class="sign-up section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title text-center">
                            <h3 class="widget-title font-size-25">@lang('site.auth.reg_header_title')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="contact-form-action">
                                <form method="post" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.auth.first_name')<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control @error('first_name') error @enderror"
                                                           type="text" name="first_name"
                                                           value="{{ old('first_name') }}" required
                                                           autocomplete="first_name"
                                                           autofocus
                                                           placeholder="@lang('site.auth.first_name')">
                                                    <span class="la la-user input-icon"></span>
                                                    @error('first_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div><!-- end col-md-12 -->
                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.auth.last_name')<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control @error('last_name') error @enderror"
                                                           type="text"
                                                           name="last_name"
                                                           value="{{ old('last_name') }}" required
                                                           autocomplete="last_name"
                                                           autofocus
                                                           placeholder="@lang('site.auth.last_name')">
                                                    <span class="la la-user input-icon"></span>
                                                    @error('last_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div><!-- end col-md-12 -->
                                        <div class="col-lg-12">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.auth.email_address')<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control @error('email') error @enderror"
                                                           type="email" name="email"
                                                           value="{{ old('email') }}" required autocomplete="email"
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
                                                <label class="label-text">@lang('site.auth.password')
                                                    <span class="primary-color-2 ml-1">*</span>
                                                </label>
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
                                                <div
                                                    class="custom-checkbox {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                                    <input type="checkbox" class="d-none" id="chb2" name="accept_terms"
                                                        {{ old('accept_terms') ? 'checked' : '' }}>
                                                    <label for="chb2">@lang('site.auth.agrement')<a
                                                            href="#">@lang('site.auth.terms_of_use')</a> @lang('site.and')
                                                        <a href="#">@lang('site.auth.privacy_policy')</a>.
                                                    </label>
                                                    @error('accept_terms')
                                                    <span class="text-danger d-block">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div><!-- end col-md-12 -->
                                        <div class="col-lg-12 ">
                                            <div class="btn-box {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                                <button class="theme-btn"
                                                        type="submit">@lang('site.auth.register')</button>
                                            </div>
                                        </div><!-- end col-md-12 -->
                                        <div class="col-lg-12">
                                            <p class="mt-4 {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">@lang('site.auth.already_have_account')
                                                <a href="{{ route('login') }}"
                                                   class="primary-color-2">@lang('site.auth.login')</a>
                                            </p>
                                        </div><!-- end col-md-12 -->
                                    </div><!-- end row -->
                                </form>
                            </div><!-- end contact-form -->
                        </div>
                    </div>
                </div><!-- end col-md-7 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end sign-up -->
    <!-- ================================
           START SIGN UP AREA
    ================================= -->
@endsection
