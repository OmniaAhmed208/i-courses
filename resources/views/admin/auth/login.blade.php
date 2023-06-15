<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="MAX">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google fonts -->
    @if(app()->getLocale() == 'ar')
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap"
              rel="stylesheet">
    @else
        <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&display=swap"
              rel="stylesheet">
    @endif


<!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <title>{{ setting('website_name') }} Admin Login</title>
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.min.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/noty.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-green.css') }}">
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('css/style-rtl.css') }}">
    @endif
</head>
<body>
@include('layouts._preloader')


<!-- ================================
           START RECOVER AREA
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
                            <form method="POST" action="{{ route('admin.login') }}">
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
                                                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label for="chb1">@lang('site.auth.remember')</label>
                                                @if (Route::has('admin.password.request'))
                                                    <a href="{{ route('admin.password.request') }}"
                                                       class="primary-color-2"> @lang('site.auth.forgot')</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div><!-- end col-md-12 -->
                                    <div class="col-lg-12">
                                        <div class="btn-box">
                                            <button
                                                    class="theme-btn {{ app()->getLocale() == 'ar' ? "float-right" : '' }}"
                                                    type="submit">@lang('site.auth.login_button')</button>
                                        </div>
                                    </div><!-- end col-md-12 -->
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
       START RECOVER AREA
================================= -->

<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/noty.min.js') }}"></script>
<script>
    $(window).on('load', function () {
        $('.preloader').delay('500').fadeOut(2000);
    });
</script>
@include('partials._session')
</body>
</html>

