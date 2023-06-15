@extends('layouts.app')
@section('title', setting('website_name') . ' Verify')
@section('content')
    <!-- ================================
           START RECOVER AREA
    ================================= -->
    @if (session('resent'))
        <script>
            setTimeout(function () {
                new Noty({
                    type: 'success',
                    layout: '{{ app()->getLocale() == 'ar' ? 'topLeft' : 'topRight' }}',
                    text: "@lang('site.fresh_link_resend')",
                    timeout: 3000,
                    killer: true
                }).show();
            }, 1000);
        </script>
    @endif
    <section class="recover-area section--padding {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title text-center font-size-25 pb-2">@lang('site.verify_email')</h3>
                            <hr>
                            <p class="line-height-26 d-inline">
                                <span
                                    class="h5">@lang('site.before_processing') </span><br>
                                @lang('site.if_not_received_mail')
                            </p>
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit"
                                        class="btn btn-link primary-color-2 font-weight-bold p-0">@lang('site.click_here_to_request_another')</button>
                            </form>
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
