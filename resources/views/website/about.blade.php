@extends('layouts.app')
@section('title', setting('website_name') . ' About Us')
@section('content')

    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <div class="section-heading">
                            <h2 class="section__title">@lang('site.about_us')</h2>
                        </div>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{ route('home') }}">@lang('site.home')</a></li>
                            <li>@lang('site.about_us')</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->


    <section class="about-area about-area2 padding-top-120px padding-bottom-110px overflow-hidden {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-content-box padding-right-50px">
                    <div class="section-heading">
                        <h5 class="section__meta">@lang('site.about_us')</h5>
                        <h2 class="section__title">i-courses</h2>
                        <span class="section-divider"></span>
                        <p class="section__desc mb-3">
                            @lang('site.about_us_content')
                        </p>
                        <p class="section__desc">
                            @if(app()->getLocale() == 'ar')
                                رئيس مجلس الإدارة/ <b>محمد الجلاد</b>
                            @elseif(app()->getLocale() == 'en')
                                CEO: <b>Mr Mohammed El-Gallad</b>
                            @endif
                        </p>
                    </div><!-- end section-heading -->
                </div>
            </div><!-- end col-lg-6 -->
            <div class="col-lg-6">
                <div class="about-img-wrap about-img-wrap-3">
                    <div class="img-box img-box-5">
                        <img src="{{ asset('images/img17.png') }}" alt="">
                    </div>
                </div>
            </div><!-- end col-lg-6 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end about-area -->


@endsection
