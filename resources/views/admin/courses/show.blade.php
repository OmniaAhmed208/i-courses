@extends('layouts.admin.app')
@section('title', setting('website_name') . ' Courses')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex flex-column justify-content-center">
                            <h2 class="widget-title">{{ $course->title }}</h2>
                            <h5 class="card__author">
                                <span class="h5">@lang('site.by'):</span>
                                <a href="#">
                                    {{ $course->instructor->name }}
                                </a>
                            </h5>
                            <span class="meta__date mr-2">
                                <span class="primary-color">@lang('site.status'):</span>
                                <span
                                    class="badge text-white {{ $course->status == 'published' ? 'bg-success' : ($course->status == 'pending' ? 'bg-warning' : 'bg-danger') }}">@lang('site.' . $course->status)</span>
                            </span>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="course_picture mb-3">
                                <p class="h3">{{ number_format($course->price, 2, '.', '') }} @lang('site.le')</p>
                                <img src="{{ asset($course->small_image) }}" alt="{{ $course->title }}"
                                     class="img-fluid">
                            </div>
                            <hr>
                            <div class="requirement-wrap margin-bottom-40px row">
                                <div class="col-md-6">
                                    <ul class="list-items mt-3">
                                        <li>
                                        <span
                                            class="primary-color">@lang('site.category'): </span> {{ ucfirst($course->category->name) }}
                                        </li>
                                        <li>
                                            <span
                                                class="primary-color">@lang('site.level'): </span> @lang('site.' . $course->level)
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-items mt-3">
                                        <li>
                                            <span
                                                class="primary-color">@lang('site.language'): </span> @lang('site.lang_' . $course->language)
                                        </li>
                                        {{--                                        <li>--}}
                                        {{--                                        <span--}}
                                        {{--                                            class="primary-color">Course Expires After: </span> {{ $course->expire_after_days ? $course->expire_after_days . ' Days after purchase' : 'Life Time' }}--}}
                                        {{--                                        </li>--}}
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <div class="requirement-wrap margin-bottom-40px">
                                <h3 class="widget-title">@lang('site.requirements')</h3>
                                {!! $course->requirements !!}
                            </div>
                            <div class="description-wrap margin-bottom-40px">
                                <h3 class="widget-title">@lang('site.description')</h3>
                                {!! $course->description !!}
                            </div>
                            <div class="curriculum-wrap margin-bottom-60px">
                                <div class="curriculum-header d-flex align-items-center justify-content-between">
                                    <div class="curriculum-header-left">
                                        <h3 class="widget-title">@lang('site.curriculum')</h3>
                                    </div>
                                    <div class="curriculum-header-right">
                                        <span
                                            class="curriculum-total__text"><strong>@lang('site.total'):</strong> {{ $course->lessons_count }} @lang('site.lesson')</span>
                                    </div>
                                </div><!-- end curriculum-header -->
                                <div class="curriculum-content">
                                    <div class="accordion accordion-shared" id="accordionExample">
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
                                                             data-parent="#accordionExample-{{ $section->id }}"
                                                             style="">
                                                            <div class="card-body">
                                                                <ul class="list-items">
                                                                    @if(count($section->lessons) > 0 && $section->isLastLevelChild())
                                                                        @foreach($section->lessons as $lesson)
                                                                            <li>
                                                                                <a href="javascript:void(0)"
                                                                                   class="primary-color-2 d-flex align-items-center justify-content-between lesson"
                                                                                   data-toggle="modal"
                                                                                   data-target=".preview-modal-form"
                                                                                   data-link="{{ $lesson->type === 'internal_link' ? asset($lesson->link) : $lesson->link }}"
                                                                                   data-title="{{ $lesson->name }}"
                                                                                   data-type="{{ $lesson->type }}"
                                                                                >
                                                                            <span class="right_hand">
                                                                                <i class="fa fa-play-circle mr-2"></i>
                                                                                <span
                                                                                    class="name">{{ $lesson->name }}</span>
                                                                                <span
                                                                                    class="badge-label">@lang('site.preview')</span>
                                                                            </span>
                                                                                    <div class="left_hand">
                                                                                <span
                                                                                    class="course-duration">{{ date("i:s", $lesson->time) }}</span>
                                                                                    </div>
                                                                                </a>

                                                                            </li>
                                                                        @endforeach
                                                                    @else
                                                                        @include('admin.courses._sub_sections', ['sections' => $section->child])
                                                                    @endif
                                                                </ul>
                                                            </div><!-- end card-body -->
                                                        </div><!-- end collapse -->
                                                    </div><!-- end card -->
                                                </div><!-- end card -->
                                            @endif
                                        @endforeach
                                    </div><!-- end accordion -->
                                </div><!-- end curriculum-content -->
                            </div>
                            <hr>
                            <div class="requirement-wrap margin-bottom-40px">
                                <div class="edit-action">
                                    <ul class="edit-list">
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
                                                      data-id="{{ $course->id }}">
                                                    <i class="la la-times mr-1 font-size-16"></i>
                                                    @lang('site.reject')
                                                </span>
                                            </li>
                                        @endif
                                        <li>
                                            <span class="theme-btn delete-btn" data-toggle="modal"
                                                  data-id="{{ $course->id }}"
                                                  data-target=".item-delete-modal">
                                                <i class="la la-trash mr-1 font-size-16"></i>
                                                @lang('site.delete')
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
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
                    <form action="{{ route('admin.courses.reject', $course->slug) }}"
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

        $(document).on("click", ".delete-btn", function () {
            let id = $(this).data('id');
            $("#delete_course_form").val(id);
        });

        $(document).on("click", ".cancel-btn", function () {
            let id = $(this).data('id');
            $("#reject_course_form").val(id);
        });

        $(".modal").on("hidden.bs.modal", function () {
            $(this).children('.modal-dialog').children('.modal-content').children('.modal-body.lesson').empty();
        });
    </script>
    {{--    <script>--}}
    {{--        let player = new Plyr('#player');--}}
    {{--    </script>--}}
@endpush
