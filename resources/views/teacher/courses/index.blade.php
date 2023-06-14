@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Courses')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-12">
                    <a href="{{ route('teacher.courses.create') }}" class="theme-btn">
                        <i class="la la-plus-circle"></i>
                        @lang('site.add_new_course')
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex align-items-center">
                            <h3 class="widget-title">@lang('site.courses')</h3>
                            <form action="{{ route('teacher.courses.index') }}" method="get" class="ml-3">
                                <select name="status" id="status"
                                        class="form-control {{ app()->getLocale() == 'ar' ? 'pt-0 pb-0' : '' }}"
                                        onchange="this.form.submit()">
                                    <option value="">
                                        @lang('site.all')
                                    </option>
                                    <option
                                        value="{{ \App\Models\Course::STATUS_DRAFT }}" {{ request()->status == \App\Models\Course::STATUS_DRAFT ? 'selected' : '' }}>
                                        @lang('site.drafted')
                                    </option>
                                    <option
                                        value="{{ \App\Models\Course::STATUS_REJECTED }}" {{ request()->status == \App\Models\Course::STATUS_REJECTED ? 'selected' : '' }}>
                                        @lang('site.rejected')
                                    </option>
                                    <option
                                        value="{{ \App\Models\Course::STATUS_PENDING }}" {{ request()->status == \App\Models\Course::STATUS_PENDING ? 'selected' : '' }}>
                                        @lang('site.pending')
                                    </option>
                                    <option
                                        value="{{ \App\Models\Course::STATUS_PUBLISHED }}" {{ request()->status == \App\Models\Course::STATUS_PUBLISHED ? 'selected' : '' }}>
                                        @lang('site.published')
                                    </option>
                                </select>
                            </form>
                        </div>
                        <div class="card-box-shared-body">
                            @forelse($courses as $course)
                                <div class="card-item card-list-layout">
                                    <div class="card-image">
                                        <a href="{{ route('teacher.courses.show', $course->slug) }}" class="card__img">
                                            <img src="{{ $course->image }}" alt=""></a>
                                    </div><!-- end card-image -->
                                    <div class="card-content">
                                        <h3 class="card__title mt-0">
                                            <a href="{{ route('teacher.courses.show', $course->slug) }}">{{ $course->title }}</a>
                                        </h3>
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
                                            <span class="star__rating">{{ $course->total_rate }}</span>
                                            <span class="star__count">({{ $course->rates_count }})</span>
                                        </span>
                                        </div><!-- end rating-wrap -->
                                        <div class="card-action">
                                            <ul class="card-duration d-flex">
                                                <li>
                                                <span class="meta__date mr-2">
                                                    <span class="status-text">@lang('site.status'):</span>
                                                    <span
                                                        class="badge text-white {{ $course->status == 'published' ? 'bg-success' : ($course->status == 'pending' || $course->status == 'draft' ? 'bg-warning' : 'bg-danger') }}">@lang('site.' . $course->status)</span>
                                                </span>
                                                </li>
                                                <li>
                                                    <span class="meta__date mr-2">
                                                        <span class="status-text">@lang('site.duration'):</span>
                                                        <span
                                                            class="status-text primary-color-3">{{ \Carbon\Carbon::createFromTimestamp($course->total_duration)->setTimezone('UTC')->format("H") }} @lang('site.hours') {{ \Carbon\Carbon::createFromTimestamp($course->total_duration)->setTimezone('UTC')->format("i") }} @lang('site.min')</span>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div><!-- end card-action -->
                                        <div class="card-price-wrap d-flex align-items-center">
                                            <p class="card__price">{{ number_format($course->price, 2, '.', '') }} @lang('site.le')</p>
                                            <div class="edit-action">
                                                <ul class="edit-list">
                                                    @if($course->status != \App\Models\Course::STATUS_DRAFT)
                                                        <li>
                                                            <a href="{{ route('teacher.courses.show', $course->slug) }}"
                                                               class="theme-btn edit-btn">
                                                                <i class="la la-eye mr-1 font-size-16"></i>
                                                                @lang('site.view')
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('teacher.courses.edit_basic_info', $course->slug) }}">
                                                            <span class="theme-btn cancel-btn my-2">
                                                                <i class="la la-edit mr-1 font-size-16"></i>
                                                                @lang('site.edit_course_data')
                                                            </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('teacher.courses.sections.index', $course->slug) }}">
                                                                <span class="theme-btn cancel-btn my-2">
                                                                    <i class="la la-list mr-1 font-size-16"></i>
                                                                    @lang('site.edit_course_sections')
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('teacher.courses.add_lessons', $course->slug) }}">
                                                            <span class="theme-btn cancel-btn my-2">
                                                                <i class="la la-video mr-1 font-size-16"></i>
                                                                @lang('site.add_course_lesson')
                                                            </span>
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a href="{{ route('teacher.courses.complete', $course->slug) }}">
                                                                <span class="theme-btn view-btn">
                                                                    <i class="la la-sync mr-1 font-size-16"></i>
                                                                    @lang('site.complete_course_data')
                                                                </span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div><!-- end card-price-wrap -->
                                        <hr>
                                        @if($course->status != \App\Models\Course::STATUS_DRAFT)
                                            <div class="">
                                                <a href="{{ route('teacher.courses.resources.index', $course->slug) }}">
                                                    <button class="theme-btn">
                                                        <i class="las la-book"></i>
                                                        @lang('site.resources')
                                                    </button>
                                                </a>
                                                <a href="{{ route('teacher.courses.quizzes.index', $course->slug) }}">
                                                    <button class="theme-warning-btn">
                                                        <i class="la la-bolt"></i>
                                                        @lang('site.quizzes')
                                                    </button>
                                                </a>
                                                <a href="{{ route('teacher.courses.assignments.index', $course->slug) }}">
                                                    <button class="theme-danger-btn">
                                                        <i class="la la-bolt"></i>
                                                        @lang('site.assignments')
                                                    </button>
                                                </a>
                                                <a href="{{ route('teacher.courses.announcements.index', $course->slug) }}">
                                                    <button class="theme-warning-btn">
                                                        <i class="la la-bullhorn"></i>
                                                        @lang('site.announcements')
                                                    </button>
                                                </a>
                                                <a href="{{ route('teacher.courses.attendance_report', $course->slug) }}">
                                                    <button class="theme-btn mt-2">
                                                        <i class="la la-file-excel-o"></i>
                                                        @lang('site.download_attendance_report_excel')
                                                    </button>
                                                </a>
                                                <a href="{{ route('teacher.courses.qas.index', $course->slug) }}">
                                                    <button class="theme-danger-btn mt-2">
                                                        <i class="las la-question-circle"></i>
                                                        @lang('site.question_n_answers')
                                                    </button>
                                                </a>
                                            </div>
                                        @endif
                                    </div><!-- end card-content -->
                                </div><!-- end card-item -->
                            @empty
                                <p>@lang('site.no_courses')</p>
                            @endforelse
                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
                <div class="col-12 mb-5">
                    {{ $courses->appends(request()->query())->links('vendor.pagination.default') }}
                </div>
            </div><!-- end row -->
            @include('layouts.teacher._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection
