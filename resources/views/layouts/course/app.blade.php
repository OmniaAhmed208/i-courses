<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    @include('layouts.course._head')
    <title>@yield('title', 'MAX')</title>
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


@yield('content')


<!-- start scroll top -->
@include('layouts._scrolltop')
<!-- end scroll top -->


<!-- template js files -->
@include('layouts.course._scripts')

@include('partials._session')

@stack('scripts')
</body>
</html>
