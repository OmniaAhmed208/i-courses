@extends('layouts.app')
@section('title', setting('website_name') . " Courses")
@section('content')
    <!-- ================================
    START BREADCRUMB AREA
================================= -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <div class="section-heading">
                            <h2 class="section__title">@lang('site.teacher_courses')</h2>
                        </div>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{ route('home') }}">@lang('site.home')</a></li>
                            <li>@lang('site.teacher_courses')</li>
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
            START COURSE AREA
    ======================================-->
    <section class="course-area padding-top-120px padding-bottom-120px">
        <div class="course-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="filter-bar d-flex justify-content-between align-items-center">
                            <ul class="filter-bar-tab nav nav-tabs align-items-center" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active icon-element" id="grid-view-tab" data-toggle="tab"
                                       href="#grid-view" role="tab" aria-controls="grid-view" aria-selected="true">
                                        <span data-toggle="tooltip" data-placement="top" title="Grid View">
                                            <i class="la la-th-large"></i>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link icon-element" id="list-view-tab" data-toggle="tab"
                                       href="#list-view" role="tab" aria-controls="list-view" aria-selected="false">
                                       <span data-toggle="tooltip" data-placement="top" title="List View">
                                            <i class="la la-th-list"></i>
                                       </span>
                                    </a>
                                </li>
                            </ul>
                            <div class="sort-ordering">
                                <form action="{{ route('courses.index') }}">
                                    <select class="sort-ordering-select" name="sorting" onchange="this.form.submit()">
                                        <option value="newest" {{ request()->sorting == 'newest' ? 'selected' : '' }}>
                                            @lang('site.newest_courses')
                                        </option>
                                        <option value="oldest" {{ request()->sorting == 'oldest' ? 'selected' : '' }}>
                                            @lang('site.oldest_courses')
                                        </option>
                                        <option
                                            value="high-rated" {{ request()->sorting == 'high-rated' ? 'selected' : '' }}>
                                            @lang('site.highest_rated')
                                        </option>
                                        <option
                                            value="high-to-low" {{ request()->sorting == 'high-to-low' ? 'selected' : '' }}>
                                            @lang('site.price_high_to_low')
                                        </option>
                                        <option
                                            value="low-to-high" {{ request()->sorting == 'low-to-high' ? 'selected' : '' }}>
                                            @lang('site.price_low_to_high')
                                        </option>
                                    </select>
                                </form>
                            </div><!-- end sort-ordering -->
                        </div><!-- end filter-bar -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
                <div class="course-content-wrapper mt-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view"
                                     aria-labelledby="grid-view-tab">
                                    <div class="row">
                                        @forelse($courses as $course)
                                            <div class="col-lg-6">
                                                <div class="card-item card-preview"
                                                     data-tooltip-content="#tooltip_content_1">
                                                    <div class="card-image">
                                                        <a href="{{ route('courses.show', $course->slug) }}"
                                                           class="card__img"><img
                                                                src="{{ asset($course->image) }}"
                                                                alt="{{ $course->title }}"></a>
                                                    </div><!-- end card-image -->
                                                    <div class="card-content">
                                                        <p class="card__label">
                                                            <span
                                                                class="card__label-text">@lang('site.' . $course->level)</span>
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
                                                                <span
                                                                    class="star__rating">{{ $course->total_rate }}</span>
                                                                <span
                                                                    class="star__count">({{ $course->rates_count }})</span>
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
                                            </div><!-- end col-lg-6 -->
                                        @empty
                                            <div class="col-lg-6">
                                                @lang('site.no_courses')
                                            </div>
                                        @endforelse
                                    </div><!-- end course-block -->
                                </div><!-- end tab-pane -->
                                <div role="tabpanel" class="tab-pane fade" id="list-view"
                                     aria-labelledby="list-view-tab">
                                    <div class="row">
                                        @forelse($courses as $course)
                                            <div class="col-lg-12">
                                                <div class="card-item card-list-layout card-preview"
                                                     data-tooltip-content="#tooltip_content_1">
                                                    <div class="card-image">
                                                        <a href="{{ route('courses.show', $course->slug) }}"
                                                           class="card__img">
                                                            <img src="{{ asset($course->image) }}"
                                                                 alt="{{ $course->title }}">
                                                        </a>
                                                    </div><!-- end card-image -->
                                                    <div class="card-content">
                                                        <p class="card__label">
                                                            <span
                                                                class="card__label-text">@lang('site.' . $course->level)</span>

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
                                                                <span
                                                                    class="star__rating">{{ $course->total_rate }}</span>
                                                                <span
                                                                    class="star__count">({{ $course->rates_count }})</span>
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
                                            </div><!-- end col-lg-12 -->
                                        @empty
                                            <div class="col-lg-12">
                                                @lang('site.no_courses')
                                            </div>
                                        @endforelse
                                    </div><!-- end course-block -->
                                </div><!-- end tab-pane -->
                            </div><!-- end tab-content -->
                        </div><!-- end col-lg-8 -->
                        <div class="col-lg-4">
                            <form action="{{ route('courses.index') }}">
                                <div class="sidebar">
                                    <div class="sidebar-widget {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                        <h3 class="widget-title">@lang('site.search_field')</h3>
                                        <span class="section-divider"></span>
                                        <div class="contact-form-action">
                                            <div class="form-group">
                                                <input class="form-control" type="search" name="search"
                                                       placeholder="@lang('site.search_courses')"
                                                       value="{{ request()->search }}">
                                                <button type="submit"
                                                        class="search-icon">
                                                    <span class="la la-search"></span>
                                                </button>
                                            </div>
                                        </div><!-- end contact-form-action -->
                                    </div><!-- end sidebar-widget -->
                                    <div class="sidebar-widget {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                        <h3 class="widget-title">@lang('site.categories')</h3>
                                        <span class="section-divider"></span>
                                        <ul class="filter-by-category">
                                            @foreach($categories as $index => $category)
                                                <li>
                                                    <div class="custom-checkbox">
                                                        <input type="checkbox" class="d-none"
                                                               name="category_id[{{$category->id}}]"
                                                               value="{{ $category->id }}" onChange="this.form.submit()"
                                                               {{ request()->filled('category_id.' . $category->id) ? 'checked' : '' }}
                                                               id="chb{{ $index + 1 }}">
                                                        <label for="chb{{ $index + 1 }}"
                                                               class="primary-color">{{ $category->name }}</label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div><!-- end sidebar-widget -->
                                    <div class="sidebar-widget {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                        <h3 class="widget-title">@lang('site.filter_by_price')</h3>
                                        <span class="section-divider"></span>
                                        <ul class="filter-by-rating filter-by-rating-2">
                                            <li>
                                                <div class="d-flex align-items-center">
                                                    <input type="number" min="0" class="form-control" name="min_price"
                                                           placeholder="@lang('site.from')"
                                                           value="{{ request()->min_price }}">
                                                    <p class="mx-3"></p>
                                                    <input type="number" min="0" class="form-control" name="max_price"
                                                           placeholder="@lang('site.to')"
                                                           value="{{ request()->max_price }}">
                                                </div>
                                                <div class="d-flex justify-content-center mt-3">
                                                    <button type="submit"
                                                            class="theme-btn d-flex align-items-center"><span
                                                            class="la la-search text-light mr-2"></span>@lang('site.apply_price')
                                                    </button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div><!-- end sidebar-widget -->
                                    <div class="sidebar-widget {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                        <h3 class="widget-title">@lang('site.level')</h3>
                                        <span class="section-divider"></span>
                                        <ul class="filter-by-level">
                                            <li>
                                                <div class="custom-checkbox">
                                                    <input type="checkbox"
                                                           class="d-none"
                                                           id="chb_all_levels"
                                                           name="level[all]"
                                                           value="all"
                                                           onChange="this.form.submit()"
                                                        {{ request()->filled('level.all') ? 'checked' : '' }}>
                                                    <label for="chb_all_levels"
                                                           class="primary-color">@lang('site.all_levels')</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-checkbox">
                                                    <input type="checkbox"
                                                           class="d-none"
                                                           id="chb_beginner"
                                                           name="level[beginner]"
                                                           value="beginner"
                                                           onChange="this.form.submit()"
                                                        {{ request()->filled('level.beginner') ? 'checked' : '' }}>
                                                    <label for="chb_beginner"
                                                           class="primary-color">@lang('site.beginner')</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-checkbox">
                                                    <input type="checkbox"
                                                           class="d-none"
                                                           id="chb_intermediate"
                                                           name="level[intermediate]"
                                                           value="intermediate"
                                                           onChange="this.form.submit()"
                                                        {{ request()->filled('level.intermediate') ? 'checked' : '' }}>
                                                    <label for="chb_intermediate"
                                                           class="primary-color">@lang('site.intermediate')</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-checkbox">
                                                    <input type="checkbox"
                                                           class="d-none"
                                                           id="chb_expert"
                                                           name="level[expert]"
                                                           value="expert"
                                                           onChange="this.form.submit()"
                                                        {{ request()->filled('level.expert') ? 'checked' : '' }}>
                                                    <label for="chb_expert"
                                                           class="primary-color">@lang('site.expert')</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div><!-- end sidebar-widget -->
                                    <div class="sidebar-widget {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                        <h3 class="widget-title">@lang('site.language')</h3>
                                        <span class="section-divider"></span>
                                        <div class="sort-ordering">
                                            <select class="sort-ordering-select" name="language"
                                                    onChange="this.form.submit()">
                                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                    <option
                                                        {{ request()->language == $localeCode ? 'selected' : '' }}
                                                        value="{{ $localeCode }}"
                                                        {{ $localeCode  == app()->getLocale() ? 'selected' : '' }}>
                                                        {{ $properties['native'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- end sidebar-widget -->
                                    <div class="sidebar-widget {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                        <h3 class="widget-title">@lang('site.filter_by_rating')</h3>
                                        <span class="section-divider"></span>
                                        <ul class="filter-by-rating filter-by-rating-2">
                                            <li>
                                            <span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                            </span>
                                                <span class="ml-1">
                                                <span class="mr-1 primary-color">5.0</span>
                                            </span>
                                                <label class="review-label">
                                                    <input type="radio" checked="checked" name="rating" value="5"
                                                           onChange="this.form.submit()"
                                                        {{ request()->rating == 5 ? 'checked' : '' }}>
                                                    <span class="review-mark"></span>
                                                </label>
                                            </li>
                                            <li>
                                            <span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star-o"></span>
                                            </span>
                                                <span class="ml-1">
                                                <span class="mr-1 primary-color">4.0 @lang('site.&up')</span>
                                            </span>
                                                <label class="review-label">
                                                    <input type="radio" name="rating" value="4"
                                                           onChange="this.form.submit()"
                                                        {{ request()->rating == 4 ? 'checked' : '' }}>
                                                    <span class="review-mark"></span>
                                                </label>
                                            </li>
                                            <li>
                                            <span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star-o"></span>
                                                <span class="la la-star-o"></span>
                                            </span>
                                                <span class="ml-1">
                                                <span class="mr-1 primary-color">3.0 @lang('site.&up')</span>
                                            </span>
                                                <label class="review-label">
                                                    <input type="radio" name="rating" value="3"
                                                           onChange="this.form.submit()"
                                                        {{ request()->rating == 3 ? 'checked' : '' }}>
                                                    <span class="review-mark"></span>
                                                </label>
                                            </li>
                                            <li>
                                         <span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star-o"></span>
                                             <span class="la la-star-o"></span>
                                             <span class="la la-star-o"></span>
                                        </span>
                                                <span class="ml-1">
                                            <span class="mr-1 primary-color">2.0 @lang('site.&up')</span>
                                        </span>
                                                <label class="review-label">
                                                    <input type="radio" name="rating" value="2"
                                                           onChange="this.form.submit()"
                                                        {{ request()->rating == 2 ? 'checked' : '' }}>
                                                    <span class="review-mark"></span>
                                                </label>
                                            </li>
                                            <li>
                                            <span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star-o"></span>
                                                <span class="la la-star-o"></span>
                                                <span class="la la-star-o"></span>
                                                <span class="la la-star-o"></span>
                                            </span>
                                                <span class="ml-1">
                                                <span class="mr-1 primary-color">1.0 @lang('site.&up')</span>
                                            </span>
                                                <label class="review-label">
                                                    <input type="radio" name="rating" value="1"
                                                           onChange="this.form.submit()"
                                                        {{ request()->rating == 1 ? 'checked' : '' }}>
                                                    <span class="review-mark"></span>
                                                </label>
                                            </li>
                                            <li>
                                            <span>
                                                <span class="la la-star-o"></span>
                                                <span class="la la-star-o"></span>
                                                <span class="la la-star-o"></span>
                                                <span class="la la-star-o"></span>
                                                <span class="la la-star-o"></span>
                                            </span>
                                                <span class="ml-1">
                                                <span class="mr-1 primary-color">0 @lang('site.&up')</span>
                                            </span>
                                                <label class="review-label">
                                                    <input type="radio" name="rating" value="0"
                                                           onChange="this.form.submit()"
                                                        {{ request()->rating == 0 || is_null(request()->rating) ? 'checked' : '' }}>
                                                    <span class="review-mark"></span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div><!-- end sidebar-widget -->
                                </div>
                            </form>
                        </div><!-- end col-lg-4 -->
                    </div><!-- end row -->
                    <div class="row">
                        <div class="col-lg-12">
                            {{ $courses->appends(request()->query())->links('vendor.pagination.default') }}
                        </div><!-- end col-lg-12 -->
                    </div><!-- end row -->
                </div><!-- end card-content-wrapper -->
            </div><!-- end container -->
        </div><!-- end course-wrapper -->
    </section><!-- end courses-area -->
    <!--======================================
    END COURSE AREA
    ======================================-->
@endsection
