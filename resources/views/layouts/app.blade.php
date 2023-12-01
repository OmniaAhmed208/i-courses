<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    @include('layouts._head')
    <title>@yield('title', 'MAX')</title>
@stack('styles')
<!-- end inject -->
</head>
<body>
<form id="logout-form" action="{{ route('logout') }}" method="POST"
      style="display: none;">
    @csrf
</form>
<!-- start cssload-loader -->
@include('layouts._preloader')
<!-- end cssload-loader -->

<!--======================================
        START HEADER AREA
    ======================================-->
@include('layouts._header')
<!--======================================
        END HEADER AREA
======================================-->

@yield('content')

<!-- ================================
         END FOOTER AREA
================================= -->
@include('layouts._footer')
<!-- ================================
          END FOOTER AREA
================================= -->

<!-- start scroll top -->
@include('layouts._scrolltop')
<!-- end scroll top -->

<!-- template js files -->
@include('layouts._scripts')

@include('partials._session')

@stack('scripts')
@if(setting('whatsapp'))
    <a href="https://api.whatsapp.com/send?phone=+2{{ setting('whatsapp') }}" target="_blank" style="position:fixed;
        width:50px;
        height:50px;
        bottom:80px;
        right:30px;
        background-color:#51be78;
        color:#FFF;
        border-radius:50px;
        text-align:center;
      font-size:25px;
        box-shadow: 2px 2px 3px #999;
      z-index:100;">
        <i class="fab fa-whatsapp" style="margin-top:13px;"></i>
    </a>
@endif
</body>
</html>
