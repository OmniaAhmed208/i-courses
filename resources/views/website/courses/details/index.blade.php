@extends('layouts.course.app')
@section('title', setting('website_name') . ' ' . $course->getTranslation('title', 'en'))
@section('content')
    @php
        $section = \App\Models\CourseSection::with('lessons')->where('course_id', $course->id)->get()->filter(function ($sec){
            return $sec->isLastLevelChild();
        })->first();
    @endphp
    <x-course-header :title="$course->getTranslation('title', 'en')"/>
    <section class="course-dashboard">
        <div class="course-dashboard-wrap">
            <div class="course-dashboard-container d-flex">
                <div class="course-dashboard-column">
                    <x-course-lesson :lesson="$section->lessons->first()"/>

                    <x-course-data :course="$course"/>
                </div>
                <x-course-sidebar :sections="$course->sections"/>
            </div>
        </div>
    </section>
    @if(setting('code.status') == 'on')
        <input type="hidden" id="code" value="{{ $code }}">
    @endif
@endsection

@push('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        @if(setting('code.status') == 'on')
        var student_code = $("#code").val();
        var boundaries = {};
        var interval = undefined;
        @endif
        var student_watched_ajax_sent = false;
        var lesson_id = "{{ $section->lessons->first() ? $section->lessons->first()->id : null }}";
        var user_id = "{{ auth()->user()->id }}";
        var video_container = $('.lecture-video-item');
        var type = $($('.course-lesson')[0]).data('type');
        var player = new Plyr('#player');
        @if(setting('code.status') == 'on')
        $("#student_code").remove();

        if (type === 'link' || type === 'internal_link') {
            if (student_code) {
                $('.plyr .plyr__video-wrapper').append(`
                        <div id="student_code" style="z-index: 99999999999; color: white; background-color: black;padding: 5px; position: fixed; border-radius: 5px;font-size: 25px;transition: top 2s, left 2s;">${student_code}</div>
                    `);
            } else {
                $('.plyr .plyr__video-wrapper').append(`
                        <div class="d-none" id="student_code" style="z-index: 99999999999; color: white; background-color: black;padding: 5px; position: fixed; border-radius: 5px;font-size: 25px;transition: top 2s, left 2s;">${student_code}</div>
                    `);
            }
        }
        if (type === 'youtube' || type === 'vimeo') {
            if (student_code) {
                $('.plyr__video-wrapper.plyr__video-embed').append(`
                        <div id="student_code" style="z-index: 99999999999; color: white; background-color: black;padding: 5px; position: fixed; border-radius: 5px;font-size: 18px;transition: top 2s, left 2s;">${student_code}</div>
                    `);
            } else {
                $('.plyr__video-wrapper.plyr__video-embed').append(`
                        <div class="d-none" id="student_code" style="z-index: 99999999999; color: white; background-color: black;padding: 5px; position: fixed; border-radius: 5px;font-size: 18px;transition: top 2s, left 2s;">${student_code}</div>
                    `);
            }
        }
        updateBoundaries();
        stopMoving()
        moveCode()
        @endif
        if(lesson_id) {
            $.ajax({
                url: `/lessons/${lesson_id}/users/${user_id}/is_available`,
                cache: false,
                success: function (data) {
                    if (!data.available) {
                        player = undefined;
                        video_container.empty()
                        swal("@lang('site.lesson_not_avaliable')", {
                            buttons: false,
                        });
                    }
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
            $.ajax({
                type: 'POST',
                url: "{{ route('courses.lessons.student_clicked_lesson') }}",
                cache: false,
                data: {
                    lesson: lesson_id,
                }
            });
        }

        $(document).on("click", ".course-lesson", function () {
            player = undefined;
            @if(setting('code.status') == 'on')
            $("#student_code").remove();
            @endif
            $(".course-lesson").removeClass('active');
            $(this).addClass('active');
            let link = $(this).data('link');
            let video_container = $('.lecture-video-item');
            lesson_id = $(this).data('id');
            type = $(this).data('type');
            $.ajax({
                url: `/lessons/${lesson_id}/users/${user_id}/is_available`,
                cache: false,
                success: function (data) {
                    if (data.available) {
                        @if(setting('code.status') == 'on')
                        updateBoundaries();
                        stopMoving();
                        moveCode();
                        @endif
                        if (type === 'link' || type === 'internal_link') {
                            video_container.empty();
                            video_container.append(`
                                <video controls crossorigin playsinline id="player">
                                    <source src="${link}" type="video/mp4" size="1080"/>
                                </video>
                            `);
                            player = new Plyr('#player');
                            @if(setting('code.status') == 'on')
                            if (student_code) {
                                $('.plyr .plyr__video-wrapper').append(`
                                    <div id="student_code" style="z-index: 99999999999; color: white; background-color: black;padding: 5px; position: fixed; border-radius: 5px;font-size: 18px;transition: top 2s, left 2s;">${student_code}</div>
                                `);
                            } else {
                                $('.plyr .plyr__video-wrapper').append(`
                                    <div class="d-none" id="student_code" style="z-index: 99999999999; color: white; background-color: black;padding: 5px; position: fixed; border-radius: 5px;font-size: 18px;transition: top 2s, left 2s;">${student_code}</div>
                                `);
                            }
                            @endif
                        } else if (type === 'youtube' || type === 'vimeo') {
                            video_container.empty();
                            video_container.append(`
                                <div id="player" data-plyr-provider="${type}" data-plyr-embed-id="${link}"></div>
                            `);
                            player = new Plyr('#player');
                            @if(setting('code.status') == 'on')
                            if (student_code) {
                                $('.plyr__video-wrapper.plyr__video-embed').append(`
                                    <div id="student_code" style="z-index: 99999999999; color: white; background-color: black;padding: 5px; position: fixed; border-radius: 5px;font-size: 18px;transition: top 2s, left 2s;">${student_code}</div>
                                `);
                            } else {
                                $('.plyr__video-wrapper.plyr__video-embed').append(`
                                    <div class="d-none" id="student_code" style="z-index: 99999999999; color: white; background-color: black;padding: 5px; position: fixed; border-radius: 5px;font-size: 18px;transition: top 2s, left 2s;">${student_code}</div>
                                `);
                            }
                            @endif
                        }
                        student_watched_ajax_sent = false;

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: 'POST',
                            url: "{{ route('courses.lessons.student_clicked_lesson') }}",
                            cache: false,
                            data: {
                                lesson: lesson_id,
                            }
                        });

                    } else {
                        player = undefined;
                        video_container.empty()
                        swal("@lang('site.lesson_not_avaliable')", {
                            buttons: false,
                        });
                    }
                }
            });
        });
        @if(setting('code.status') == 'on')
        player.on('exitfullscreen', event => {
            updateBoundaries();
        });

        function updateBoundaries() {
            boundaries = {};
            if ($(".plyr__poster").length > 0) {
                boundaries = $(".plyr__poster")[0].getBoundingClientRect();
            }
        }

        function moveCode() {
            interval = setInterval(function () {
                if ($("#student_code").length > 0) {
                    var y = randomIntFromInterval(boundaries.top + 50, boundaries.bottom - 50),
                        x = randomIntFromInterval(boundaries.left + 50, boundaries.right - 50);
                    $("#student_code").css({top: `${y}px`, left: `${x}px`});
                }
            }, 2000);
        }

        function stopMoving() {
            clearInterval(interval);
        }

        $(window).scroll(function () {
            updateBoundaries()
        });
        $(window).resize(function () {
            updateBoundaries()
        });

        function randomIntFromInterval(min, max) {
            return Math.floor(Math.random() * (max - min + 1) + min);
        }

        @endif

            PlyrInterval = setInterval(function () {
            let percentage = (player.currentTime / 60) / (player.duration / 60) * 100;
            if (percentage >= 80 && !student_watched_ajax_sent) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ route('courses.lessons.student_watched_lesson') }}",
                    cache: false,
                    data: {
                        lesson: lesson_id,
                    },
                    success: function (data) {
                        student_watched_ajax_sent = true;
                    }
                });
            }
        }, 5000);
        $(document).on('click', '.back-to-question-btn', function () {
            let q_id = $(this).data('id');
            $(".replay-question-wrap-" + q_id).hide();
            $('.question-overview-result-wrap').show();
        });

        $(document).on('click', '.question_body', function () {
            let q_id = $(this).data('id');
            $('.question-overview-result-wrap').hide();
            $('.replay-question-wrap-' + q_id).show();
        });
    </script>
@endpush
