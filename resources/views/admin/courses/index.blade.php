@extends('layouts.admin.app')
@section('title', setting('website_name') . ' Courses')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex align-items-center">
                            <h3 class="widget-title">@lang('site.courses')</h3>
                            <form action="{{ route('admin.courses.index') }}" method="get" class="ml-3">
                                <select name="status" id="status"
                                        class="form-control {{ app()->getLocale() == 'ar' ? 'pt-0 pb-0' : '' }}"
                                        onchange="this.form.submit()">
                                    <option value="">
                                        @lang('site.all')
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
                                        <a href="{{ route('admin.courses.show', $course->slug) }}" class="card__img">
                                            <img src="{{ asset($course->image) }}" alt=""></a>
                                    </div><!-- end card-image -->
                                    <div class="card-content">
                                        <h3 class="card__title mt-0">
                                            <a href="{{ route('admin.courses.show', $course->slug) }}">{{ $course->title }}</a>
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
                                                        class="badge text-white {{ $course->status == 'published' ? 'bg-success' : ($course->status == 'pending' ? 'bg-warning' : 'bg-danger') }}">@lang('site.' .$course->status)</span>
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
                                            <p class="card__price">{{ number_format($course->price, 2, '.', '') }}
                                                @lang('site.le')</p>
                                            <div class="edit-action">
                                                <ul class="edit-list">
                                                    <li>
                                                        <a href="{{ route('admin.courses.show', $course->slug) }}"
                                                           class="theme-btn edit-btn">
                                                            <i class="la la-eye mr-1 font-size-16"></i>
                                                            @lang('site.view')
                                                        </a>
                                                    </li>
                                                    @if($course->status != 'published')
                                                        <li>
                                                            <form
                                                                action="{{ route('admin.courses.approve', $course->slug) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('put')
                                                                <button class="theme-btn view-btn" type="submit">
                                                                    <i class="la la-check mr-1 font-size-16"></i>
                                                                    @lang('site.approve')
                                                                </button>
                                                            </form>
                                                        </li>
                                                    @endif
                                                    @if($course->status != 'rejected')
                                                        <li>
                                                            <span class="theme-btn cancel-btn"
                                                                  data-toggle="modal"
                                                                  data-target=".item-reject-modal"
                                                                  data-id="{{ $course->id }}"
                                                            >
                                                                <i class="la la-times mr-1 font-size-16"></i>
                                                                @lang('site.reject')
                                                            </span>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <span class="theme-btn delete-btn"
                                                              data-toggle="modal"
                                                              data-target=".item-delete-modal"
                                                              data-id="{{ $course->id }}"
                                                        >
                                                            <i class="la la-trash mr-1 font-size-16"></i>
                                                            @lang('site.delete')
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!-- end card-price-wrap -->
                                        @if($course->status == 'published')
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="btn-box mt-3">
                                                        <a href="{{ route('admin.courses.generate_students_page', $course->slug) }}"
                                                           class="theme-btn d-flex align-items-center justify-content-center">
                                                            <i class="la la-cogs la-2x mr-2"></i>
                                                            @lang('site.students_management')
                                                        </a>
                                                    </div><!-- end btn-box -->
                                                </div><!-- end col-lg-12 -->
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
            @include('layouts.admin._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
    <!-- account-delete-modal -->
    <div class="modal-form text-center">
        <div class="modal fade item-delete-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content p-4">
                    <div class="modal-top border-0 mb-4 p-0">
                        <div class="alert-content">
                            <span class="la la-exclamation-circle warning-icon"></span>
                            <h4 class="widget-title font-size-20 mt-2 mb-1">@lang('site.course_delete_msg')</h4>
                            <p class="modal-sub">@lang('site.proceed_confirm')</p>
                        </div>
                    </div>
                    <div class="btn-box">
                        <button type="button" class="btn primary-color font-weight-bold mr-3" data-dismiss="modal">
                            @lang('site.cancel')
                        </button>
                        <form action="{{ route('admin.courses.destroy') }}" method="post" class="d-inline-block">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="course_id" id="delete_course_form" value="">
                            <button type="submit"
                                    class="theme-btn bg-color-6 border-0 text-white">@lang('site.delete')</button>
                        </form>
                    </div>
                </div><!-- end modal-content -->
            </div><!-- end modal-dialog -->
        </div><!-- end modal -->
    </div><!-- end modal-form -->

    <div class="modal-form text-center">
        <div class="modal fade item-reject-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content p-4">
                    <div class="modal-top d-flex justify-content-center border-0 mb-4 p-0">
                        <div class="alert-content">
                            <span class="la la-exclamation-circle warning-icon"></span>
                            <h4 class="widget-title font-size-20 mt-2 mb-1">@lang('site.course_reject_msg')</h4>
                            <p class="modal-sub">@lang('site.instructor_reason')</p>
                        </div>
                    </div>
                    <form action="{{ route('admin.courses.reject') }}"
                          method="post" class="d-inline-block">
                        @csrf
                        @method('put')
                        <input type="hidden" name="course_id" id="reject_course_form" value="">
                        <textarea name="note" id="note" rows="3" class="form-control"></textarea>
                        <div class="btn-box mt-2">
                            <button type="button" class="btn primary-color font-weight-bold mr-3" data-dismiss="modal">
                                @lang('site.cancel')
                            </button>
                            <button type="submit"
                                    class="theme-btn bg-color-6 border-0 text-white">@lang('site.reject')</button>
                        </div>
                    </form>
                </div><!-- end modal-content -->
            </div><!-- end modal-dialog -->
        </div><!-- end modal -->
    </div><!-- end modal-form -->
@endsection

@push('scripts')
    <script>
        $(document).on("click", ".delete-btn", function () {
            let id = $(this).data('id');
            $("#delete_course_form").val(id);
        });

        $(document).on("click", ".cancel-btn", function () {
            let id = $(this).data('id');
            $("#reject_course_form").val(id);
        });
    </script>
@endpush
