@extends('layouts.app')
@section('title', setting('website_name') . " Home")
@section('content')
    <!--================================
             START SLIDER AREA
    =================================-->
    <section class="slider-area">
        <div class="single-slide-item single-slide-item-2 slide-bg4">
            <div id="perticles-js-2"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading">
                            <h2 class="section__title {{ app()->getLocale() == 'ar' ? ' text-left' : '' }}">
                                {{ app()->getLocale() == 'en' ? setting('header_title_en') : setting('header_title_ar') }}
                            </h2>
                            <p class="section__desc {{ app()->getLocale() == 'ar' ? ' text-left' : '' }}">
                                {{ app()->getLocale() == 'en' ? setting('header_slogan_en') : setting('header_slogan_ar') }}
                            </p>
                        </div>
                        <div class="hero-search-form">
                            <div class="contact-form-action">
                                <form method="get" action="{{ route('courses.seach') }}">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <div class="form-group mb-0">
                                                    <input class="form-control" type="text" name="search"
                                                           placeholder="@lang('site.what_you_want_learn')">
                                                    <span class="la la-search search-icon"></span>
                                                </div>
                                            </div><!-- end input-box -->
                                        </div>
                                    </div>
                                </form>
                            </div><!-- end contact-form-action -->
                        </div>
                    </div><!-- col-lg-12 -->
                </div><!-- row -->
            </div><!-- container -->
            <div class="our-post-content">
                <span class="hw-circle"></span>
                <span class="hw-circle"></span>
                <span class="hw-circle"></span>
                <div class="how-we-work-wrap">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="our-post-item">
                                    <i class="la la-mouse-pointer icon-element"></i>
                                    <div class="our__text">
                                        <h4 class="widget-title {{ app()->getLocale() == 'ar' ? ' text-left' : '' }}">@lang('site.alot_of_courses')</h4>
                                        <p class="{{ app()->getLocale() == 'ar' ? ' text-left' : '' }}">@lang('site.explore_topics')</p>
                                    </div><!-- our__text -->
                                </div><!-- our-post-item -->
                            </div><!-- col-lg-4 -->
                            <div class="col-lg-4">
                                <div class="our-post-item">
                                    <i class="la la-users icon-element"></i>
                                    <div class="our__text">
                                        <h4 class="widget-title {{ app()->getLocale() == 'ar' ? ' text-left' : '' }}">@lang('site.expert_instruction')</h4>
                                        <p class="{{ app()->getLocale() == 'ar' ? ' text-left' : '' }}">@lang('site.find_instructor')</p>
                                    </div><!-- our__text -->
                                </div><!-- our-post-item -->
                            </div><!-- col-lg-4 -->
                            <div class="col-lg-4">
                                <div class="our-post-item">
                                    <i class="la la-graduation-cap icon-element"></i>
                                    <div class="our__text">
                                        <h4 class="widget-title {{ app()->getLocale() == 'ar' ? ' text-left' : '' }}">@lang('site.be_leader')</h4>
                                        <p class="{{ app()->getLocale() == 'ar' ? ' text-left' : '' }}">@lang('site.learn_schedule')</p>
                                    </div><!-- our__text -->
                                </div><!-- our-post-item -->
                            </div><!-- col-lg-4 -->
                        </div><!-- row -->
                    </div>
                </div><!-- end how-we-work-wrap -->
            </div><!-- our-post-content -->
        </div><!-- end single-slide-item -->
    </section><!-- end slider-area -->
    <!--================================
            END SLIDER AREA
    =================================-->

    <!--======================================
            START COURSE AREA
    ======================================-->
    <section class="course-area">
        <div class="course-wrapper section-bg padding-top-40px padding-bottom-40px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tab">
                            <ul class="nav nav-tabs justify-content-center text-center" role="tablist" id="review">
                                <li role="presentation">
                                    <a href="#tab1" role="tab" data-toggle="tab" class="theme-btn radius-rounded active"
                                       aria-selected="true">
                                        @lang('site.trending_courses')
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab2" role="tab" data-toggle="tab" class="theme-btn radius-rounded"
                                       aria-selected="false">
                                        @lang('site.most_popular_courses')
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab3" role="tab" data-toggle="tab" class="theme-btn radius-rounded"
                                       aria-selected="false">
                                        @lang('site.most_recent_courses')
                                    </a>
                                </li>
                            </ul>
                        </div><!-- end section-tab -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end course-wrapper -->
        <div class="card-content-wrapper padding-top-40px padding-bottom-115px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="tab1">
                                <div class="row">
                                    @foreach($trending_courses as $course)
                                        <div class="col-lg-4 column-td-half">
                                            <div class="card-item card-preview"
                                                 data-tooltip-content="#tooltip_content_2">
                                                <div class="card-image">
                                                    <a href="#" class="card__img"><img
                                                            src="{{ asset($course->image) }}" alt=""></a>
                                                </div><!-- end card-image -->
                                                <div class="card-content">
                                                    <p class="card__label">
                                                        <span class="card__label-text">@lang('site.' . $course->level)</span>
                                                    </p>
                                                    <h3 class="card__title">
                                                        <a href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                                                    </h3>
                                                    <p class="card__author">
                                                        <a href="#">{{ $course->instructor->name }}</a>
                                                    </p>
                                                    <div class="rating-wrap d-flex mt-2 mb-3">
                                                        <ul class="review-stars">
                                                            @for($i = 0; $i < (int)$course->total_rate; $i++)
                                                                <li><span class="la la-star"></span></li>
                                                            @endfor
                                                            @for($i = 0; $i < (5 - (int)$course->total_rate); $i++)
                                                                <li><span class="la la-star-o"></span></li>
                                                            @endfor
                                                        </ul>
                                                        <span class="star-rating-wrap">
                                                            <span class="star__rating">
                                                                {{ $course->total_rate }}
                                                            </span>
                                                            <span class="star__count">
                                                                ({{ $course->rates_count }})
                                                            </span>
                                                        </span>
                                                    </div><!-- end rating-wrap -->
                                                    <div class="card-action">
                                                        <ul class="card-duration d-flex justify-content-between align-items-center">
                                                            <li>
                                                                <span class="meta__date">
                                                                    <i class="la la-play-circle"></i> {{ $course->lessons_count }} @lang('site.lessons')
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="meta__date">
                                                                    <i class="la la-clock-o"></i> {{ \Carbon\Carbon::createFromTimestamp($course->total_duration)->setTimezone('UTC')->format("H") }} @lang('site.hours') {{ \Carbon\Carbon::createFromTimestamp($course->total_duration)->setTimezone('UTC')->format("i") }} @lang('site.min')
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div><!-- end card-action -->
                                                    <div
                                                        class="card-price-wrap d-flex justify-content-between align-items-center">
                                                            <span
                                                                class="card__price">{{ $course->price }} @lang('site.le')</span>
                                                        @if(auth()->user() && auth()->user()->is_enrolled($course))
                                                            <a href="{{ route('courses.study', $course->slug) }}"
                                                               class="text-btn">@lang('site.watch_course')</a>
                                                        @else
                                                            <a href="{{ route('courses.add_to_cart', $course->slug) }}"
                                                               class="text-btn">@lang('site.add_to_cart')</a>
                                                        @endif
                                                    </div><!-- end card-price-wrap -->
                                                </div><!-- end card-content -->
                                            </div><!-- end card-item -->
                                        </div><!-- end col-lg-4 -->
                                    @endforeach
                                </div><!-- end course-block -->
                            </div><!-- end tab-pane -->
                            <div role="tabpanel" class="tab-pane fade" id="tab2">
                                <div class="row">
                                    @foreach($most_popular_courses as $course)
                                        <div class="col-lg-4 column-td-half">
                                            <div class="card-item card-preview"
                                                 data-tooltip-content="#tooltip_content_2">
                                                <div class="card-image">
                                                    <a href="#" class="card__img"><img
                                                            src="{{ asset($course->image) }}" alt=""></a>
                                                </div><!-- end card-image -->
                                                <div class="card-content">
                                                    <p class="card__label">
                                                        <span class="card__label-text">@lang('site.' . $course->level)</span>
                                                    </p>
                                                    <h3 class="card__title">
                                                        <a href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                                                    </h3>
                                                    <p class="card__author">
                                                        <a href="#">{{ $course->instructor->name }}</a>
                                                    </p>
                                                    <div class="rating-wrap d-flex mt-2 mb-3">
                                                        <ul class="review-stars">
                                                            @for($i = 0; $i < (int)$course->total_rate; $i++)
                                                                <li><span class="la la-star"></span></li>
                                                            @endfor
                                                            @for($i = 0; $i < (5 - (int)$course->total_rate); $i++)
                                                                <li><span class="la la-star-o"></span></li>
                                                            @endfor
                                                        </ul>
                                                        <span class="star-rating-wrap">
                                                            <span class="star__rating">
                                                                {{ $course->total_rate }}
                                                            </span>
                                                            <span class="star__count">
                                                                ({{ $course->rates_count }})
                                                            </span>
                                                        </span>
                                                    </div><!-- end rating-wrap -->
                                                    <div class="card-action">
                                                        <ul class="card-duration d-flex justify-content-between align-items-center">
                                                            <li>
                                                                <span class="meta__date">
                                                                    <i class="la la-play-circle"></i> {{ $course->lessons_count }} @lang('site.lessons')
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="meta__date">
                                                                    <i class="la la-clock-o"></i> {{ \Carbon\Carbon::createFromTimestamp($course->total_duration)->setTimezone('UTC')->format("H") }} @lang('site.hours') {{ \Carbon\Carbon::createFromTimestamp($course->total_duration)->setTimezone('UTC')->format("i") }} @lang('site.min')
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div><!-- end card-action -->
                                                    <div
                                                        class="card-price-wrap d-flex justify-content-between align-items-center">
                                                            <span
                                                                class="card__price">{{ $course->price }} @lang('site.le')</span>
                                                        @if(auth()->user() && auth()->user()->is_enrolled($course))
                                                            <a href="{{ route('courses.study', $course->slug) }}"
                                                               class="text-btn">@lang('site.watch_course')</a>
                                                        @else
                                                            <a href="{{ route('courses.add_to_cart', $course->slug) }}"
                                                               class="text-btn">@lang('site.add_to_cart')</a>
                                                        @endif
                                                    </div><!-- end card-price-wrap -->
                                                </div><!-- end card-content -->
                                            </div><!-- end card-item -->
                                        </div><!-- end col-lg-4 -->
                                    @endforeach
                                </div><!-- end course-block -->
                            </div><!-- end tab-pane -->
                            <div role="tabpanel" class="tab-pane fade" id="tab3">
                                <div class="row">
                                    @foreach($most_recent_courses as $course)
                                        <div class="col-lg-4 column-td-half">
                                            <div class="card-item card-preview"
                                                 data-tooltip-content="#tooltip_content_2">
                                                <div class="card-image">
                                                    <a href="#" class="card__img"><img
                                                            src="{{ asset($course->image) }}" alt=""></a>
                                                </div><!-- end card-image -->
                                                <div class="card-content">
                                                    <p class="card__label">
                                                        <span class="card__label-text">@lang('site.' . $course->level)</span>
                                                    </p>
                                                    <h3 class="card__title">
                                                        <a href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                                                    </h3>
                                                    <p class="card__author">
                                                        <a href="#">{{ $course->instructor->name }}</a>
                                                    </p>
                                                    <div class="rating-wrap d-flex mt-2 mb-3">
                                                        <ul class="review-stars">
                                                            @for($i = 0; $i < (int)$course->total_rate; $i++)
                                                                <li><span class="la la-star"></span></li>
                                                            @endfor
                                                            @for($i = 0; $i < (5 - (int)$course->total_rate); $i++)
                                                                <li><span class="la la-star-o"></span></li>
                                                            @endfor
                                                        </ul>
                                                        <span class="star-rating-wrap">
                                                            <span class="star__rating">
                                                                {{ $course->total_rate }}
                                                            </span>
                                                            <span class="star__count">
                                                                ({{ $course->rates_count }})
                                                            </span>
                                                        </span>
                                                    </div><!-- end rating-wrap -->
                                                    <div class="card-action">
                                                        <ul class="card-duration d-flex justify-content-between align-items-center">
                                                            <li>
                                                                <span class="meta__date">
                                                                    <i class="la la-play-circle"></i> {{ $course->lessons_count }} @lang('site.lessons')
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="meta__date">
                                                                    <i class="la la-clock-o"></i> {{ \Carbon\Carbon::createFromTimestamp($course->total_duration)->setTimezone('UTC')->format("H") }} @lang('site.hours') {{ \Carbon\Carbon::createFromTimestamp($course->total_duration)->setTimezone('UTC')->format("i") }} @lang('site.min')
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div><!-- end card-action -->
                                                    <div
                                                        class="card-price-wrap d-flex justify-content-between align-items-center">
                                                            <span
                                                                class="card__price">{{ $course->price }} @lang('site.le')</span>
                                                        @if(auth()->user() && auth()->user()->is_enrolled($course))
                                                            <a href="{{ route('courses.study', $course->slug) }}"
                                                               class="text-btn">@lang('site.watch_course')</a>
                                                        @else
                                                            <a href="{{ route('courses.add_to_cart', $course->slug) }}"
                                                               class="text-btn">@lang('site.add_to_cart')</a>
                                                        @endif
                                                    </div><!-- end card-price-wrap -->
                                                </div><!-- end card-content -->
                                            </div><!-- end card-item -->
                                        </div><!-- end col-lg-4 -->
                                    @endforeach
                                </div><!-- end course-block -->
                            </div><!-- end tab-pane -->
                        </div><!-- end tab-content -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="btn-box mt-4 text-center">
                            <a href="{{ route('courses.index') }}" class="theme-btn">@lang('site.browse_courses')</a>
                        </div><!-- end btn-box -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end card-content-wrapper -->
    </section><!-- end courses-area -->
    <!--======================================
            END COURSE AREA
    ======================================-->

    <!-- ================================
           START FUNFACT AREA
    ================================= -->
    <section class="funfact-area text-center overflow-hidden padding-top-85px padding-bottom-85px">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 column-td-half">
                    <div class="counter-item">
                        <span class="la la-bullhorn count__icon"></span>
                        <h4 class="count__title counter">{{ $instructors_count }}</h4>
                        <p class="count__meta">@lang('site.expert_instructors')</p>
                    </div><!-- end counter-item -->
                </div><!-- end col-lg-4 -->

                <div class="col-lg-4 column-td-half">
                    <div class="counter-item">
                        <span class="la la-users count__icon"></span>
                        <h4 class="count__title counter text-color-2">{{ $students_enrolled }}</h4>
                        <p class="count__meta">@lang('site.students_enrolled')</p>
                    </div><!-- end counter-item -->
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 column-td-half">
                    <div class="counter-item">
                        <span class="la la-certificate count__icon"></span>
                        <h4 class="count__title counter text-color-3">20</h4>
                        <p class="count__meta">@lang('site.years_of_experience')</p>
                    </div><!-- end counter-item -->
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end funfact-area -->
    <!-- ================================
           START FUNFACT AREA
    ================================= -->

    <!--======================================
            START GET-START AREA
    ======================================-->
    <section class="get-start-area get-start-area2 padding-top-120px padding-bottom-110px overflow-hidden">
        <div class="box-icons">
            <div class="box-one"></div>
            <div class="box-two"></div>
            <div class="box-three"></div>
            <div class="box-four"></div>
        </div><!-- end box-icons -->
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="get-start-content {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                        <div class="section-heading">
                            <h5 class="section__meta section__metalight">@lang('site.start_online_learning')</h5>
                            <h2 class="section__title text-white">@lang('site.get_start_p1')
                                <br>@lang('site.get_start_p2')<br>@lang('site.get_start_p3')</h2>
                            <span class="section-divider section-divider-light"></span>
                        </div><!-- end section-heading -->
                        @guest
                        <div class="btn-box margin-top-20px">
                            <a href="{{ route('register') }}"
                               class="theme-btn theme-btn-hover-light">@lang('site.get_started')</a>
                        </div>
                        @endguest
                        @auth
                            <div class="btn-box margin-top-20px">
                                <a href="{{ route('courses.index') }}"
                                   class="theme-btn theme-btn-hover-light">@lang('site.get_started')</a>
                            </div>
                        @endauth
                    </div><!-- end get-start-content -->
                </div><!-- end col-lg-10 -->
                <div class="col-lg-2">
                    <div class="promo-video-btn d-flex h-100 align-items-center justify-content-end">
                        <a class="mfp-iframe video-play-btn watch-video-btn"
                           href="{{ setting('youtube') ?? "#" }}" title="Watch Video" target="_blank">
                            <i class="la la-youtube"></i>
                        </a>
                    </div><!-- end promo-video-btn -->
                </div><!-- end col-lg-2 -->
            </div><!-- end row -->
        </div><!-- end container -->
        <div class="box-icons2">
            <div class="box-one"></div>
            <div class="box-two"></div>
            <div class="box-three"></div>
            <div class="box-four"></div>
            <div class="box-five"></div>
        </div><!-- end box-icons2 -->
    </section><!-- end get-start-area -->
    <!--======================================
            END GET-START AREA
    ======================================-->

    <div class="section-block"></div>

    <!--======================================
            START CHOOSE AREA
    ======================================-->
    <section class="choose-area section-padding text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h5 class="section__meta">@lang('site.why_choose_us')</h5>
                        <h2 class="section__title">@lang('site.how_max_works')</h2>
                        <span class="section-divider"></span>
                    </div><!-- end section-heading -->
                </div><!-- end col-md-12 -->
            </div><!-- end row -->
            <div class="row margin-top-100px">
                <div class="col-lg-4 column-td-half">
                    <div class="post-card post-card-layout-2">
                        <div class="post-card-content">
                            <img src="{{ asset('images/img23.jpg') }}" alt="" class="img-fluid">
                            <h2 class="widget-title mt-4 mb-2">@lang('site.personalized_learning')</h2>
                            <p>@lang('site.personalized_learning_text')</p>
                        </div><!-- end post-card-content -->
                    </div>
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 column-td-half">
                    <div class="post-card post-card-layout-2">
                        <div class="post-card-content">
                            <img src="{{ asset('images/img37.jpg') }}" alt="" class="img-fluid">
                            <h2 class="widget-title mt-4 mb-2">@lang('site.trusted_content')</h2>
                            <p>@lang('site.trusted_content_text')</p>
                        </div><!-- end post-card-content -->
                    </div>
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 column-td-half">
                    <div class="post-card post-card-layout-2">
                        <div class="post-card-content">
                            <img src="{{ asset('images/img34.jpg') }}" alt="" class="img-fluid">
                            <h2 class="widget-title mt-4 mb-2">@lang('site.empower_teachers')</h2>
                            <p>@lang('site.empower_teachers_text')</p>
                        </div><!-- end post-card-content -->
                    </div>
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
            @guest
                <div class="row">
                    <div class="col-lg-12">
                        <div class="btn-box mt-3 d-flex align-items-center justify-content-center text-left">
                            <div class="btn-box-inner mr-3">
                                <span class="d-block mb-2">@lang('site.are_you_instructor')</span>
                                <a href="{{ route('register') }}" class="theme-btn line-height-40 text-capitalize">
                                    @lang('site.start_teaching')
                                </a>
                            </div>
                            <div class="btn-box-inner">
                                <span class="d-block mb-2">@lang('site.are_you_student')</span>
                                <a href="{{ route('register') }}" class="theme-btn line-height-40 text-capitalize">
                                    @lang('site.start_learning')
                                </a>
                            </div>
                        </div>
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
            @endguest
        </div><!-- end container -->
    </section>
    <!-- ================================
           START CHOOSE AREA
    ================================= -->
@endsection

@push('scripts')
    <script>
        $('.slide-bg4').css("backgroundImage", "url('{{ setting('homepage_picture') ? asset(setting('homepage_picture')) : asset('images/slider-img4.jpg') }}')");
    </script>
@endpush

