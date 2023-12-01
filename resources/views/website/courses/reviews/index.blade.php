@extends('layouts.app')
@section('title', setting('website_name') . " Reviews")
@section('content')
    <!-- ================================
    START BREADCRUMB AREA
================================= -->
    <section class="breadcrumb-area breadcrumb-detail-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content breadcrumb-detail-content">
                        <div class="section-heading">
                            <a href="{{ route('courses.show', $course->slug) }}"><h2
                                    class="section__title mt-1">{{ $course->title }}</h2></a>
                        </div>
                        <ul class="breadcrumb__list mt-2">
                            <li>Created by <a href="#">{{ $course->instructor->name }}</a></li>
                            <li>
                                @for($i = 0; $i < (int)$course->total_rate; $i++)
                                    <i class="la la-star"></i>
                                @endfor
                                @for($i = 0; $i < (5 - (int)$course->total_rate); $i++)
                                    <i class="la la-star-o"></i>
                                @endfor
                                {{ $course->total_rate }} ({{ $course->rates_count }} ratings)
                            </li>
                            <li>{{ $course->students_count }} Students enrolled</li>
                            <li><i class="la la-globe"></i> {{ __('site.lang_' . $course->language) }}</li>
                            <li>Last updated {{ $course->updated_at->format('d F, Y') }}</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!--======================================
            START COURSE DETAIL
    ======================================-->
    <section class="course-detail margin-bottom-110px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="course-detail-content-wrap margin-top-100px">
                        <div class="review-wrap">
                            <div class="comments-wrapper margin-top-50px">
                                <h3 class="widget-title"> Reviews</h3>
                                <ul class="comments-list padding-top-30px">
                                    <li>
                                        @forelse($rates as $rate)
                                            <div class="comment">
                                                <div class="comment-avatar">
                                                    <img class="avatar__img" alt=""
                                                         src="{{ $rate->user->avatar }}">
                                                </div>
                                                <div class="comment-body w-75">
                                                    <div class="meta-data">
                                                        <h3 class="comment__author">{{ $rate->user->name }}</h3>
                                                        <p class="comment__date">{{ $rate->created_at->format('d F Y - h:i A') }}</p>
                                                        <ul class="review-stars review-stars1">
                                                            @for($i = 0; $i < (int)$course->total_rate; $i++)
                                                                <li><span class="la la-star"></span></li>
                                                            @endfor
                                                            @for($i = 0; $i < (5 - (int)$course->total_rate); $i++)
                                                                <li><span class="la la-star-o"></span></li>
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                    <p class="comment-content">
                                                        {{ $rate->comment }}
                                                    </p>
                                                </div>
                                            </div><!-- end comment -->
                                        @empty
                                            <h3 class="text-center mb-3">There is no any reviews</h3>
                                        @endforelse
                                    </li>
                                </ul>
                                <div class="review-form">
                                    <h3 class="widget-title">Add a Review</h3>
                                    <div class="contact-form-action margin-top-35px">
                                        <form method="post" action="{{ route('courses.post_review', $course->slug) }}">
                                            @csrf
                                            <div class="rating-shared rating-shared-box d-inline-block">
                                                <fieldset>
                                                    <input type="radio" id="star5" name="rate"
                                                           value="5"
                                                        {{ old('rate') == '1' ? 'checked' : '' }}>
                                                    <label for="star5" title="5 Star" class="star"></label>
                                                    <input type="radio" id="star4" name="rate"
                                                           value="4"
                                                        {{ old('rate') == '2' ? 'checked' : '' }}>
                                                    <label for="star4" title="4 Star" class="star"></label>
                                                    <input type="radio" id="star3" name="rate"
                                                           value="3"
                                                        {{ old('rate') == '3' ? 'checked' : '' }}>
                                                    <label for="star3" title="3 Star" class="star"></label>
                                                    <input type="radio" id="star2" name="rate"
                                                           value="2"
                                                        {{ old('rate') == '4' ? 'checked' : '' }}>
                                                    <label for="star2" title="2 Star" class="star"></label>
                                                    <input type="radio" id="star1" name="rate"
                                                           value="1"
                                                        {{ old('rate') == '5' ? 'checked' : '' }}>
                                                    <label for="star1" title="1 Star" class="star"></label>
                                                </fieldset>
                                            </div>
                                            @error('rate')
                                            <span class="text-danger d-block">{{ $message }}</span>
                                            @enderror
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="input-box">
                                                        <label class="label-text">Message<span
                                                                class="primary-color-2 ml-1">*</span></label>
                                                        <div class="form-group">
                                                            <textarea
                                                                class="message-control form-control @error('comment') error @enderror"
                                                                name="comment"
                                                                placeholder="Write message"></textarea>
                                                            <i class="la la-pencil input-icon"></i>
                                                            @error('comment')
                                                            <span class="text-danger d-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div><!-- end col-lg-12 -->
                                                <div class="col-lg-12">
                                                    <div class="btn-box">
                                                        <button class="theme-btn" type="submit">Submit review</button>
                                                    </div>
                                                </div><!-- end col-md-12 -->
                                            </div><!-- end row -->
                                        </form>
                                    </div><!-- end contact-form-action -->
                                </div><!-- end review-form -->
                            </div><!-- end comments-wrapper -->
                        </div><!-- end review-wrap -->
                    </div><!-- end course-detail-content-wrap -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end course-detail -->
    <!--======================================
            END COURSE DETAIL
    ======================================-->

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $(".star").on('click', function (e) {
                e.preventDefault();
                $("#" + $(this).attr('for')).prop("checked", true);
            });
        });
    </script>
@endpush
