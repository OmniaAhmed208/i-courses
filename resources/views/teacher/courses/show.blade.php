@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Courses')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex flex-column justify-content-center">
                            <h2 class="widget-title">{{ $course->title }}</h2>
                            <span class="meta__date mr-2">
                                <span class="primary-color">@lang('site.status'):</span>
                                <span
                                    class="badge text-white {{ $course->status == 'published' ? 'bg-success' : ($course->status == 'pending' ? 'bg-warning' : 'bg-danger') }}">@lang('site.' . $course->status)</span>
                            </span>
                            @if($course->status != \App\Models\Course::STATUS_DRAFT)
                                <hr/>
                                <div class="flex-grow-1 mt-2">
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
                                                         data-parent="#accordionExample-{{ $section->id }}" style="">
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
                                                                                    <span
                                                                                        class="badge-label bg-color-6 delete_lesson"
                                                                                        data-lesson_id="{{ $lesson->id }}">
                                                                                    @lang('site.delete')
                                                                                </span>
                                                                                </div>
                                                                            </a>

                                                                        </li>
                                                                    @endforeach
                                                                @else
                                                                    @include('teacher.courses._sub_sections', ['sections' => $section->child])
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
                                <ul class="edit-list mx-3">
                                    <li>
                                        <a href="{{ route('teacher.courses.edit_basic_info', $course->slug) }}">
                                                <span class="theme-btn cancel-btn">
                                                    <i class="la la-edit mr-1 font-size-16"></i>
                                                    @lang('site.edit_course_data')
                                                </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('teacher.courses.sections.index', $course->slug) }}">
                                                <span class="theme-btn cancel-btn">
                                                    <i class="la la-list mr-1 font-size-16"></i>
                                                    @lang('site.edit_course_sections')
                                                </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('teacher.courses.add_lessons', $course->slug) }}">
                                                <span class="theme-btn cancel-btn">
                                                    <i class="la la-video mr-1 font-size-16"></i>
                                                    @lang('site.add_course_lesson')
                                                </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        @include('layouts.teacher._dashboard_footer')
    </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
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

        $(".delete_lesson").on('click', function (e) {
            e.stopPropagation();
            let that = $(this);
            let name = that.parent().siblings('.right_hand').children('.name').html();
            let n = new Noty({
                text: `{{ __('site.delete_confirm') }} ${name}?`,
                type: "warning",
                killer: true,
                buttons: [
                    Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function () {
                        n.close();
                        let li = that.parent().parent().parent();
                        let lesson_id = that.data('lesson_id');
                        let formData = new FormData();
                        formData.append('lesson_id', lesson_id);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            cache: false,
                            type: 'POST',
                            url: "{{ route('teacher.lessons.remove_ajax') }}",
                            data: formData,
                            success: function (data) {
                                li.remove();
                                new Noty({
                                    type: 'success',
                                    layout: '{{ app()->getLocale() == 'ar' ? 'topLeft' : 'topRight' }}',
                                    text: `${data.message}`,
                                    timeout: 2000,
                                    killer: true
                                }).show();
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                new Noty({
                                    type: 'error',
                                    layout: '{{ app()->getLocale() == 'ar' ? 'topLeft' : 'topRight' }}',
                                    text: `${xhr.responseJSON.message}`,
                                    timeout: 2000,
                                    killer: true
                                }).show();
                            }
                        });
                    }),

                    Noty.button("@lang('site.no')", 'btn btn-info mr-2', function () {
                        n.close();
                    })
                ]
            });
            n.show()
        });
    </script>
@endpush
