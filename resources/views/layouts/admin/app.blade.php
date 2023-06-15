<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    @include('layouts.admin._head')
    <title>@yield('title')</title>
    @stack('styles')
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
@include('layouts.admin._header')
<!--======================================
        END HEADER AREA
======================================-->

<!-- ================================
    START DASHBOARD AREA
================================= -->
<section class="dashboard-area">
    @include('layouts.admin._sidebar')
    @yield('content')
</section><!-- end dashboard-area -->
<!-- ================================
    END DASHBOARD AREA
================================= -->

<!-- start scroll top -->
@include('layouts._scrolltop')
<!-- end scroll top -->
<!-- template js files -->
@include('layouts.admin._scripts')
@include('partials._session')
@stack('scripts')
</body>
</html>
