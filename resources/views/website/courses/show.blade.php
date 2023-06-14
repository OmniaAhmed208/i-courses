@extends('layouts.app')
@section('title', setting('website_name') . " Courses")
@section('content')
    <!-- ================================
    START BREADCRUMB AREA
================================= -->
    <section class="breadcrumb-area breadcrumb-detail-area {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content breadcrumb-detail-content">
                        <div class="section-heading">
                            {{--                            <span class="badge-label">bestseller</span>--}}
                            <h2 class="section__title mt-1">{{ $course->title }}</h2>
                            {{--                            <h4 class="widget-title mt-2">Master Digital Marketing: Strategy, Social Media Marketing,--}}
                            {{--                                SEO, YouTube, Email, Facebook Marketing, Analytics & More!</h4>--}}
                        </div>
                        <ul class="breadcrumb__list mt-2">
                            <li>@lang('site.created_by'): <a href="#">{{ $course->instructor->name }}</a></li>
                            <li>
                                @for($i = 0; $i < (int)$course->total_rate; $i++)
                                    <i class="la la-star"></i>
                                @endfor
                                @for($i = 0; $i < (5 - (int)$course->total_rate); $i++)
                                    <i class="la la-star-o"></i>
                                @endfor
                                {{ $course->total_rate }} ({{ count($all_rates) }} @lang('site.ratings'))
                            </li>
                            <li>{{ $course->students_count }} @lang('site.students_enrolled')</li>
                            <li><i class="la la-globe"></i> {{ __('site.lang_' . $course->language) }}</li>
                            <li>@lang('site.last_updated'): {{ $course->updated_at->format('d F, Y') }}</li>
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
                <div class="col-lg-8">
                    <div
                        class="course-detail-content-wrap margin-top-100px {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                        <div class="requirement-wrap margin-bottom-40px">
                            <h3 class="widget-title">@lang('site.requirements')</h3>
                            {!! $course->requirements !!}
                        </div><!-- end requirement-wrap -->
                        <div class="description-wrap margin-bottom-40px">
                            <h3 class="widget-title">@lang('site.description')</h3>
                            {!! $course->description !!}
                        </div><!-- end description-wrap -->
                        <div class="curriculum-wrap margin-bottom-60px">
                            <div class="curriculum-header d-flex align-items-center justify-content-between">
                                <div class="curriculum-header-left">
                                    <h3 class="widget-title">@lang('site.curriculum')</h3>
                                </div>
                                <div class="curriculum-header-right">
                                    <span
                                        class="curriculum-total__text"><strong>@lang('site.total'):</strong> {{ $course->lessons_count }} @lang('site.lessons')</span>
                                    <span class="curriculum-total__hours"><strong>@lang('site.total_hours'):</strong> {{ \Carbon\Carbon::createFromTimestamp($course->total_duration)->setTimezone('UTC')->format("H:i:s") }}</span>
                                </div>
                            </div><!-- end curriculum-header -->
                            <div class="curriculum-content">
                                @foreach($course->sections as $section)
                                    @if($section->parent_id == null)
                                        <div class="accordion accordion-shared"
                                             id="accordionExample-{{ $section->id }}">
                                            <div class="card">
                                                <div class="card-header" id="section-{{ $section->id }}">
                                                    <h2 class="mb-0">
                                                        <button
                                                            class="btn btn-link d-flex align-items-center justify-content-between collapsed"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#collapse-{{ $section->id }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse-{{ $section->id }}">
                                                            <i class="fa fa-angle-up"></i>
                                                            <i class="fa fa-angle-down"></i>
                                                            {{ $section->name }}
                                                            <span>{{ count($section->lessons) }} @lang('site.lessons')</span>
                                                        </button>
                                                    </h2>
                                                </div><!-- end card-header -->
                                                <div id="collapse-{{ $section->id }}" class="collapse"
                                                     aria-labelledby="section-{{ $section->id }}"
                                                     data-parent="#accordionExample-{{ $section->id }}">
                                                    <div class="card-body">
                                                        <ul class="list-items">
                                                            @if(count($section->lessons) > 0 && $section->isLastLevelChild())
                                                                @foreach($section->lessons as $lesson)
                                                                    @if($lesson->is_free)
                                                                        <li>
                                                                            <a href="javascript:void(0)"
                                                                               class="primary-color-2 d-flex align-items-center justify-content-between lesson"
                                                                               data-toggle="modal"
                                                                               data-target=".preview-modal-form"
                                                                               data-link="{{ $lesson->type === 'internal_link' ? asset($lesson->link) : $lesson->link }}"
                                                                               data-title="{{ $lesson->name }}"
                                                                               data-type="{{ $lesson->type }}">
                                                                            <span>
                                                                                <i class="fa fa-play-circle mr-2"></i>
                                                                                {{ $lesson->name }}
                                                                                <span
                                                                                    class="badge-label">@lang('site.preview')</span>
                                                                            </span>
                                                                                <span
                                                                                    class="course-duration">{{ \Carbon\Carbon::createFromTimestamp($lesson->time)->setTimezone('UTC')->format("i:s") }}</span>
                                                                            </a>
                                                                        </li>
                                                                    @else
                                                                        <li>
                                                                            <a href="javascript:void(0)"
                                                                               class="d-flex align-items-center justify-content-between">
                                                                            <span>
                                                                                <i class="fa fa-play-circle mr-2"></i>
                                                                                {{ $lesson->name }}
                                                                                <span
                                                                                    class="badge-label badge-secondary">@lang('site.locked')</span>
                                                                            </span>
                                                                                <span
                                                                                    class="course-duration">{{ \Carbon\Carbon::createFromTimestamp($lesson->time)->setTimezone('UTC')->format("i:s") }}</span>
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                @include('website.courses._sub_sections', ['sections' => $section->child])
                                                            @endif
                                                        </ul>
                                                    </div><!-- end card-body -->
                                                </div><!-- end collapse -->
                                            </div><!-- end card -->
                                        </div><!-- end accordion -->
                                    @endif
                                @endforeach
                            </div><!-- end curriculum-content -->
                        </div><!-- end curriculum-wrap -->
                        <div class="section-block"></div>
                        <div class="instructor-wrap padding-top-50px padding-bottom-45px">
                            <h3 class="widget-title">@lang('site.about_instructor')</h3>
                            <div class="instructor-content margin-top-30px d-flex">
                                <div class="instructor-img">
                                    <a href="#" class="instructor__avatar">
                                        <img src="{{ $course->instructor->avatar }}" alt="">
                                    </a>
                                    <ul class="list-items">
                                        {{--                                        <li><span class="la la-star"></span> 4.6 Instructor Rating</li>--}}
                                        {{--                                        <li><span class="la la-user"></span> 45,786 Students</li>--}}
                                        {{--                                        <li><span class="la la-comment-o"></span> 2,533 Reviews</li>--}}
                                        {{--                                        <li><span class="la la-play-circle-o"></span> 24 Courses</li>--}}
                                        {{--                                        <li>--}}
                                        {{--                                            <span class="la la-eye"></span>--}}
                                        {{--                                            <a href="#"> View all Courses</a>--}}
                                        {{--                                        </li>--}}
                                    </ul>
                                </div><!-- end instructor-img -->
                                <div class="instructor-details">
                                    <div class="instructor-titles">
                                        <h3 class="widget-title"><a href="#">{{ $course->instructor->name }}</a></h3>
                                        <p class="instructor__subtitle">
                                            @lang('site.joined') {{ $course->instructor->created_at->diffForHumans() }}</p>
                                    </div><!-- end instructor-titles -->
                                    <div class="instructor-desc">
                                        <div class="collapse" id="show-more-content">
                                            @if($course->instructor->teacher->descreption)
                                                {{ $course->instructor->teacher->descreption }}
                                            @endif
                                        </div>
                                        @if($course->instructor->teacher->descreption)
                                            <div class="btn-box pt-2 d-inline-block">
                                                <a class="collapsed link-collapsed" data-toggle="collapse"
                                                   href="#show-more-content" role="button" aria-expanded="false"
                                                   aria-controls="show-more-content">
                                                    <span class="link-collapse-read-more">@lang('site.read_more')</span>
                                                    <span class="link-collapse-active">@lang('site.read_less')</span>
                                                    <div class="ml-1">
                                                        <i class="la la-plus"></i>
                                                        <i class="la la-minus"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                    </div><!-- end instructor-desc -->
                                </div><!-- end instructor-details -->
                            </div><!-- end instructor-content -->
                        </div><!-- end instructor-wrap -->
                        <div class="review-wrap">
                            <h3 class="widget-title">@lang('site.students_feedback')</h3>
                            <div class="review-content margin-top-40px margin-bottom-50px d-flex">
                                <div class="review-rating-summary">
                                    <div class="review-rating-summary-inner d-flex align-items-end">
                                        <div class="stats-average__count">
                                            <span class="stats-average__count-count">{{ $course->total_rate }}</span>
                                        </div><!-- end stats-average__count -->
                                        <div class="stats-average__rating d-flex">
                                            <ul class="review-stars d-flex">
                                                @for($i = 0; $i < (int)$course->total_rate; $i++)
                                                    <li><span class="la la-star"></span></li>
                                                @endfor
                                                @for($i = 0; $i < (5 - (int)$course->total_rate); $i++)
                                                    <li><span class="la la-star-o"></span></li>
                                                @endfor
                                            </ul>
                                            <span class="star-rating-wrap">
                                            <span class="star__rating">({{ count($all_rates) }})</span>
                                        </span>
                                        </div><!-- end stats-average__rating -->
                                    </div><!-- end review-rating-summary-inner -->
                                    <div class="course-rating-text">
                                        <p class="course-rating-text__text">@lang('site.course_rating')</p>
                                    </div><!-- end course-rating-text -->
                                </div><!-- end review-rating-summary -->
                                <div class="review-rating-widget">
                                    <div class="review-rating-rate">
                                        <ul>
                                            <li class="review-rating-rate__items">
                                                <div class="review-rating-inner__item">
                                                    <div class="review-rating-rate__item-text">
                                                        5 @lang('site.stars')</div>
                                                    <div class="review-rating-rate__item-fill">
                                                        <span
                                                            class="review-rating-rate__item-fill__fill rating-fill-width1"
                                                            style="width: {{ $rate_percentage['five'] . "%" }}"></span>
                                                    </div>
                                                    <div
                                                        class="review-rating-rate__item-percent-text">{{ $rate_percentage['five'] . "%" }}</div>
                                                </div>
                                            </li>
                                            <li class="review-rating-rate__items">
                                                <div class="review-rating-inner__item">
                                                    <div class="review-rating-rate__item-text">
                                                        4 @lang('site.stars')</div>
                                                    <div class="review-rating-rate__item-fill">
                                                        <span
                                                            class="review-rating-rate__item-fill__fill rating-fill-width2"
                                                            style="width: {{ $rate_percentage['four'] . "%" }}"></span>
                                                    </div>
                                                    <div
                                                        class="review-rating-rate__item-percent-text">{{ $rate_percentage['four'] . "%" }}</div>
                                                </div>
                                            </li>
                                            <li class="review-rating-rate__items">
                                                <div class="review-rating-inner__item">
                                                    <div class="review-rating-rate__item-text">
                                                        3 @lang('site.stars')</div>
                                                    <div class="review-rating-rate__item-fill">
                                                        <span
                                                            class="review-rating-rate__item-fill__fill rating-fill-width3"
                                                            style="width: {{ $rate_percentage['three'] . "%" }}"></span>
                                                    </div>
                                                    <div
                                                        class="review-rating-rate__item-percent-text">{{ $rate_percentage['three'] . "%" }}</div>
                                                </div>
                                            </li>
                                            <li class="review-rating-rate__items">
                                                <div class="review-rating-inner__item">
                                                    <div class="review-rating-rate__item-text">
                                                        2 @lang('site.stars')</div>
                                                    <div class="review-rating-rate__item-fill">
                                                        <span
                                                            class="review-rating-rate__item-fill__fill rating-fill-width4"
                                                            style="width: {{ $rate_percentage['two'] . "%" }}"></span>
                                                    </div>
                                                    <div
                                                        class="review-rating-rate__item-percent-text">{{ $rate_percentage['two'] . "%" }}</div>
                                                </div>
                                            </li>
                                            <li class="review-rating-rate__items">
                                                <div class="review-rating-inner__item">
                                                    <div class="review-rating-rate__item-text">
                                                        1 @lang('site.stars')</div>
                                                    <div class="review-rating-rate__item-fill">
                                                        <span
                                                            class="review-rating-rate__item-fill__fill rating-fill-width5"
                                                            style="width: {{ $rate_percentage['one'] . "%" }}"></span>
                                                    </div>
                                                    <div
                                                        class="review-rating-rate__item-percent-text">{{ $rate_percentage['one'] . "%" }}</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div><!-- end review-rating-rate -->
                                </div><!-- end review-rating-widget -->
                            </div><!-- end review-content -->
                            <div class="section-block"></div>
                            <div class="comments-wrapper margin-top-50px">
                                <h3 class="widget-title"> @lang('site.reviews')</h3>
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
                                            <h3 class="text-center mb-3">@lang('site.no_reviews')</h3>
                                        @endforelse
                                    </li>
                                </ul>
                                @if(count($all_rates) > 3)
                                    <div class="see-more-review-btn margin-bottom-50px">
                                        <div class="btn-box text-center">
                                            <a href="{{ route('courses.reviews.index', $course->slug) }}">
                                                <button type="button" class="theme-btn theme-btn-light">
                                                    @lang('site.show_reviews')
                                                </button>
                                            </a>
                                        </div><!-- end btn-box -->
                                    </div>
                                @endif
                                @if(auth()->user() && $enrolled)
                                    <div class="review-form">
                                        <h3 class="widget-title">@lang('site.add_review')</h3>

                                        <div class="contact-form-action margin-top-35px">
                                            <form method="post"
                                                  action="{{ route('courses.post_review', $course->slug) }}">
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
                                                            <label class="label-text">@lang('site.message')<span
                                                                    class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                            <textarea
                                                                class="message-control form-control @error('comment') error @enderror"
                                                                name="comment"
                                                                placeholder="@lang('site.write_message')"></textarea>
                                                                <i class="la la-pencil input-icon"></i>
                                                                @error('comment')
                                                                <span class="text-danger d-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div><!-- end col-lg-12 -->
                                                    <div class="col-lg-12">
                                                        <div class="btn-box">
                                                            <button class="theme-btn"
                                                                    type="submit">@lang('site.submit_review')
                                                            </button>
                                                        </div>
                                                    </div><!-- end col-md-12 -->
                                                </div><!-- end row -->
                                            </form>
                                        </div><!-- end contact-form-action -->
                                    </div><!-- end review-form -->
                                @endif
                            </div><!-- end comments-wrapper -->
                        </div><!-- end review-wrap -->
                    </div><!-- end course-detail-content-wrap -->
                </div><!-- end col-lg-8 -->
                <div class="col-lg-4">
                    <div class="sidebar-component {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                        <div class="sidebar">
                            <div class="sidebar-widget sidebar-preview">
                                <div class="sidebar-preview-titles">
                                    <h3 class="widget-title">@lang('site.course_info')</h3>
                                    <span class="section-divider"></span>
                                </div>
                                <div class="preview-video-and-details">
                                    <div class="preview-course-video">
                                        <a href="{{ route('courses.show', $course->slug) }}">
                                            <img src="{{ asset($course->image) }}" alt="course-img">
                                        </a>
                                    </div>
                                    <div class="preview-course-content">
                                        <p class="preview-course__price d-flex align-items-center">
                                            <span class="price-current">{{ $course->price }} @lang('site.le')</span>
                                            {{--                                            <span class="price-before">$104.99</span>--}}
                                            {{--                                            <span class="price-discount">24% off</span>--}}
                                        </p>
                                        @if(!is_null($course->expire_after_days) && $course->expire_after_days > 0)
                                            <p class="preview-price-discount__text">
                                                @lang('site.you_will_access_this_course_for') <span
                                                    class="discount-left__text-text">{{ $course->expire_after_days }} @lang('site.days')</span>
                                            </p>
                                        @endif
                                        <div class="buy-course-btn mb-3 text-center">

                                            @if(auth()->user() && $enrolled)
                                                <a href="{{ route('courses.study', $course->slug) }}"
                                                   class="theme-btn w-100 theme-btn-light">
                                                    @lang('site.watch_course')
                                                </a>
                                            @else
                                                <a href="{{ route('courses.add_to_cart', $course->slug) }}">
                                                    <button class="theme-btn w-100 mb-3">
                                                        @lang('site.add_to_cart')
                                                    </button>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="preview-course-incentives">
                                            <h3 class="widget-title font-size-18">@lang('site.this_course_includes')</h3>
                                            <ul class="list-items pb-3">
                                                <li>
                                                    <i class="la la-play-circle-o"></i>{{ \Carbon\Carbon::createFromTimestamp($course->total_duration)->setTimezone('UTC')->format("H:i:s") }}
                                                    @lang('site.course_duration')
                                                </li>
                                                <li><i class="la la-file-text"></i>{{ $course->resources_count }}
                                                    @lang('site.downloadable_resources')
                                                </li>
                                                @if(is_null($course->expire_after_days) || $course->expire_after_days == 0)
                                                    <li><i class="la la-key"></i>@lang('site.full_lifetime_access')</li>
                                                @endif
                                                <li>
                                                    <i class="la la-mobile"></i>
                                                    @lang('site.access_on_mobile')
                                                </li>
                                                <li>
                                                    <i class="la la-certificate"></i>@lang('site.certificate_of_Completion')
                                                </li>
                                            </ul>
                                        </div><!-- end preview-course-incentives -->
                                    </div><!-- end preview-course-content -->
                                </div><!-- end preview-video-and-details -->
                            </div><!-- end sidebar-widget -->
                            <div class="sidebar-widget sidebar-feature">
                                <h3 class="widget-title">@lang('site.course_features')</h3>
                                <span class="section-divider"></span>
                                <ul class="list-items">
                                    <li>
                                        <span><i class="la la-clock-o"></i>@lang('site.duration')</span>
                                        <span>{{ \Carbon\Carbon::createFromTimestamp($course->total_duration)->setTimezone('UTC')->format("H:i:s") }}</span>
                                    </li>
                                    <li>
                                        <span><i class="la la-play-circle-o"></i>@lang('site.lessons')</span>
                                        <span>{{ $course->lessons_count }}</span>
                                    </li>
                                    <li>
                                        <span><i class="la la-file-text"></i>@lang('site.resources')</span>
                                        <span>{{ $course->resources_count }}</span>
                                    </li>
                                    <li>
                                        <span><i class="la la-puzzle-piece"></i>@lang('site.quizzes')</span>
                                        <span>{{ $course->quizzes_count }}</span>
                                    </li>
                                    <li>
                                        <span> <i class="la la-language"></i>@lang('site.language')</span>
                                        <span>@lang('site.lang_' . $course->language)</span>
                                    </li>
                                    <li>
                                        <span><i class="la la-level-up"></i>@lang('site.level')</span>
                                        <span>@lang('site.' . $course->level)</span>
                                    </li>
                                    <li>
                                        <span> <i class="la la-users"></i>@lang('site.students')</span>
                                        <span>{{ $course->students_count }}</span>
                                    </li>
                                    <li>
                                        <span><i class="la la-certificate"></i>@lang('site.certificate')</span>
                                        <span>@lang('site.yes')</span>
                                    </li>
                                </ul>
                            </div><!-- end sidebar-widget -->
                            @if(count($latest_courses) > 0)
                                <div class="sidebar-widget recent-widget">
                                    <h3 class="widget-title">@lang('site.latest_courses')</h3>
                                    <span class="section-divider"></span>
                                    @foreach($latest_courses as $latest_course)
                                        <div class="recent-item">
                                            <div class="recent-img">
                                                <a href="{{ route('courses.show', $latest_course->slug) }}">
                                                    <img src="{{ asset($latest_course->small_image) }}"
                                                         alt="{{ $latest_course->title }}">
                                                </a>
                                            </div><!-- end recent-img -->
                                            <div class="recentpost-body">
                                                <span
                                                    class="recent__meta"> {{ $latest_course->updated_at->format('d F, Y') }} @lang('site.by') <a
                                                        href="#">{{ $latest_course->instructor->name }}</a></span>
                                                <h4 class="recent__link">
                                                    <a href="{{ route('courses.show', $latest_course->slug) }}">{{ $latest_course->title }}</a>
                                                </h4>
                                                <p class="recent-course__price">{{ $latest_course->price }} @lang('site.le')</p>
                                            </div><!-- end recent-img -->
                                        </div><!-- end recent-item -->
                                    @endforeach
                                    <div class="btn-box text-center">
                                        <a href="{{ route('courses.index') }}"
                                           class="theme-btn d-block">@lang('site.view_all_courses')</a>
                                    </div><!-- end btn-box -->
                                </div><!-- end sidebar-widget -->
                            @endif
                        </div><!-- end sidebar -->
                    </div><!-- end sidebar-component -->
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end course-detail -->
    <!--======================================
            END COURSE DETAIL
    ======================================-->

    <div class="modal-form">
        <div class="modal fade preview-modal-form" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-top">
                        <h5 class="modal-title" id="lesson_title">Course Preview: The Complete Digital Finance Marketing
                            Course</h5>
                        <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="la la-close"></span>
                        </button>
                    </div>
                    <div class="modal-body lesson">
                    </div>
                </div>
            </div>
        </div><!-- end modal -->
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/plyr.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('js/plyr.js') }}"></script>
    <script>
        $(document).on("click", ".lesson", function () {
            let title = $(this).data('title');
            let link = $(this).data('link');
            let type = $(this).data('type');
            $("#lesson_title").text(title);
            let modal_body = $('.modal-body.lesson');
            if (type === 'link' || type === 'internal_link') {
                modal_body.empty();
                modal_body.append(`
                    <video controls crossorigin playsinline id="player">
                        <source src="${link}" type="video/mp4" size="576"/>
                    </video>
                `);
                let player = new Plyr('#player');
            } else if (type === 'youtube') {
                modal_body.empty();
                modal_body.append(`
                <div class="plyr__video-embed" id="player">
                    <iframe
                        src="https://www.youtube.com/embed/${link}"
                        allowfullscreen
                        allowtransparency
                        allow="autoplay">
                    </iframe>
                </div>
                `);
            } else if (type === 'vimeo') {
                modal_body.empty();
                modal_body.append(`
                    <div id="player" data-plyr-provider="vimeo" data-plyr-embed-id="${link}"></div>
                `);
                let player = new Plyr('#player');
            }

        });

        $(".modal").on("hidden.bs.modal", function () {
            $(this).children('.modal-dialog').children('.modal-content').children('.modal-body.lesson').empty();
            console.log()
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".star").on('click', function (e) {
                e.preventDefault();
                $("#" + $(this).attr('for')).prop("checked", true);
            });
        });
    </script>
@endpush
