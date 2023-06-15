<meta http-equiv="content-type" content="text/html; charset=utf-8">
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
@if(setting('website_color') == 'green')
    <link rel="stylesheet" href="{{ asset('css/style-green.css') }}">
@elseif(setting('website_color') == 'blue')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@elseif(setting('website_color') == 'red')
    <link rel="stylesheet" href="{{ asset('css/style-red.css') }}">
@elseif(setting('website_color') == 'gold')
    <link rel="stylesheet" href="{{ asset('css/style-gold.css') }}">
@elseif(setting('website_color') == 'brown')
    <link rel="stylesheet" href="{{ asset('css/style-brown.css') }}">
@endif
@if(app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('css/style-rtl.css') }}">
@endif
