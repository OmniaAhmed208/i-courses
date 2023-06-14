@extends('layouts.app')
@section('title', setting('website_name') . " My Courses")
@section('content')
    <!-- ================================
    START BREADCRUMB AREA
================================= -->
    <section class="breadcrumb-area my-courses-bread" style="padding-top: 35px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="breadcrumb-content my-courses-bread-content d-flex justify-content-center align-items-center">
                        <div class="section-heading">
                            <h2 class="section__title">@lang('site.my_courses')</h2>
                        </div>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!-- ================================
           START MY COURSES
    ================================= -->
    <section class="my-courses-area padding-top-30px padding-bottom-90px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="my-course-content-wrap">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active show" id="all-courses">
                                <div class="my-course-content-body">
                                    <div class="my-course-container">
                                        <div class="row">
                                            @foreach($courses as $course)
                                                <div class="col-lg-4 column-td-half">
                                                    <div class="card-item">
                                                        <div class="card-image">
                                                            <a href="{{ route('courses.study', $course->slug) }}"
                                                               class="card__img">
                                                                <img src="{{ asset($course->small_image) }}" alt="">
                                                                <div class="play-button">
                                                                    <svg version="1.1" id="Layer_1"
                                                                         xmlns="http://www.w3.org/2000/svg" x="0px"
                                                                         y="0px"
                                                                         viewBox="-307.4 338.8 91.8 91.8"
                                                                         style=" enable-background:new -307.4 338.8 91.8 91.8;"
                                                                         xml:space="preserve">
                                                                <style type="text/css">
                                                                    .st0 {
                                                                        opacity: 0.6;
                                                                        fill: #000000;
                                                                        border-radius: 100px;
                                                                        enable-background: new;
                                                                    }

                                                                    .st1 {
                                                                        fill: #FFFFFF;
                                                                    }
                                                                </style>
                                                                        <g>
                                                                            <circle class="st0" cx="-261.5" cy="384.7"
                                                                                    r="45.9"/>
                                                                            <path class="st1"
                                                                                  d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z"/>
                                                                        </g>
                                                            </svg>
                                                                </div>
                                                            </a>
                                                        </div><!-- end card-image -->
                                                        <div class="card-content p-4">
                                                            <h3 class="card__title mt-0">
                                                                <a href="{{ route('courses.show', $course->slug) }}">
                                                                    {{ $course->title }}
                                                                </a>
                                                            </h3>
                                                            <div class="rating-wrap d-flex mt-3">
                                                                <a href="{{ route('courses.study', $course->slug) }}"
                                                                   class="btn rating-btn">
                                                                    <i class="la la-eye mr-1"></i>@lang('site.watch_course')
                                                                </a>
                                                            </div><!-- end rating-wrap -->
                                                        </div><!-- end card-content -->
                                                    </div><!-- end card-item -->
                                                </div><!-- end col-lg-4 -->
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end tab-pane -->
                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end my-courses-area -->
    <!-- ================================
           START MY COURSES
    ================================= -->
@endsection
