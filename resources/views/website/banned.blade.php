<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="MAX">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('website_name') }} BLocked Account</title>
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

    <!-- inject:css -->
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.min.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.filer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tooltipster.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/noty.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-green.css') }}">
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('css/style-rtl.css') }}">
    @endif
</head>
<body>
<section class="error-area padding-top-70px padding-bottom-90px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="error-content text-center">
                    <div class="section-heading">
                        <i class="fas fa-ban fa-5x text-danger"></i>
                        <h3 class="section__title pb-3">Your account has been blocked because unusual login was
                            detected</h3>
                        <p class="section__desc">
                            Sorry, your account was blocked because you are sharing your account credentials with
                            your firends
                        </p>
                    </div>
                    <div class="btn-box">
                        <a href="{{ route('home') }}" class="theme-btn">back to home</a>
                    </div>
                </div><!-- end error-content -->
            </div><!-- end col-lg-7 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
</body>
</html>
