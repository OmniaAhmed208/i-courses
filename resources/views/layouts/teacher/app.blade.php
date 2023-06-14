<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    @include('layouts.teacher._head')
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
@include('layouts.teacher._header')
<!--======================================
        END HEADER AREA
======================================-->

<!-- ================================
    START DASHBOARD AREA
================================= -->
<section class="dashboard-area">
    @include('layouts.teacher._sidebar')
    @yield('content')
</section><!-- end dashboard-area -->
<!-- ================================
    END DASHBOARD AREA
================================= -->

<!-- start scroll top -->
@include('layouts._scrolltop')
<!-- end scroll top -->
<!-- template js files -->
@include('layouts.teacher._scripts')
@include('partials._session')
@stack('scripts')
</body>
</html>
