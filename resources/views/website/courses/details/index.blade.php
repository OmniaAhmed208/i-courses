@extends('layouts.course.app')
@section('title', setting('website_name') . ' ' . $course->title)
@section('content')
    @php
        $section = \App\Models\CourseSection::with('lessons')->where('course_id', $course->id)->get()->filter(function ($sec){
            return $sec->isLastLevelChild();
        })->first();
    @endphp
    <x-course-header :title="$course->title"/>
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
    <script src="https://player.vimeo.com/api/player.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        let deviceWidth = window.innerWidth;
        let containerWidth = document.getElementsByClassName('course-dashboard-container')[0].offsetWidth;
        if(document.getElementById("vimeoIframe")) {
            document.getElementById("vimeoIframe").width =  containerWidth - document.getElementsByClassName('course-dashboard-sidebar-column')[0].offsetWidth;
        }
        let containerHeight;
        if(containerWidth < 300) {
            containerWidth = 300;
        }
        if(deviceWidth < 991) {
            containerHeight  = deviceWidth / (16/9);
        } else if(document.getElementById("vimeoIframe")) {
            const iframeWidth = parseInt(document.getElementById("vimeoIframe").width);
            containerHeight  =  iframeWidth / (16/9);
        }

        if(document.getElementById("vimeoIframe")) {
            document.getElementById("vimeoIframe").height =  containerHeight;
        }

        window.onresize = function () {
            deviceWidth = window.innerWidth;
            containerWidth = document.getElementsByClassName('course-dashboard-container')[0].offsetWidth;
            if(document.getElementById("vimeoIframe")) {
                document.getElementById("vimeoIframe").width =  containerWidth - document.getElementsByClassName('course-dashboard-sidebar-column')[0].offsetWidth;
            }
            if(containerWidth < 300) {
                containerWidth = 300;
            }
            if(deviceWidth < 991) {
                containerHeight  = deviceWidth / (16/9);
            } else if(document.getElementById("vimeoIframe")) {
                const iframeWidth = parseInt(document.getElementById("vimeoIframe").width);
                containerHeight  = iframeWidth / (16/9);
            }
            if(document.getElementById("vimeoIframe")) {
                document.getElementById("vimeoIframe").height =  containerHeight;
            }
        }
    </script>
    <script>
        @if(setting('code.status') == 'on')
        var student_code = $("#code").val();
        var boundaries = {};
        var interval = undefined;
        @endif
        var student_watched_ajax_sent = false;
        var lesson_id = "{{ $section->lessons->first() ? $section->lessons->first()->id : null }}";
        var videoLink = "{{ $section->lessons->first() ? $section->lessons->first()->link : null }}";
        var user_id = "{{ auth()->user()->id }}";
        var video_container = $('.lecture-video-item');
        var type = $($('.course-lesson')[0]).data('type');
        var vimeoPlayer;
        if (type === 'vimeo') {
            vimeoPlayer = new Vimeo.Player(document.querySelector('iframe'));
            var vimeoDuration = 0;
            var vimeoCurrentTime = 0;
            var vimeoPercentage = 0;
            var vimeoPlyrInterval;
        } else {
            video_container.empty();
            video_container.append(`
                <video controls crossorigin playsinline id="player">
                    <source src="${videoLink}" type="video/mp4" size="1080"/>
                </video>
            `);
            const defaultOptions = {};
            const video = document.querySelector("video");
            const source = video.getElementsByTagName("source")[0].src;
            if (Hls.isSupported()) {
                const hls = new Hls();
                hls.loadSource(source);
                hls.on(Hls.Events.MANIFEST_PARSED, function (event, data) {
                    const availableQualities = hls.levels.map((l) => l.height)
                    defaultOptions.quality = {
                        default: availableQualities[0],
                        options: availableQualities,
                        // this ensures Plyr to use Hls to update quality level
                        forced: true,
                        onChange: (e) => {
                            window.hls.levels.forEach((level, levelIndex) => {
                                if (level.height === e) {
                                    console.log("Found quality match with " + e);
                                    window.hls.currentLevel = levelIndex;
                                }
                            });
                        },
                    }
                    const player = new Plyr(video, defaultOptions);
                });
                hls.attachMedia(video);
                window.hls = hls;
            } else {
                const player = new Plyr(video, defaultOptions);
            }
        }
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
            vimeoPlayer = undefined;
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
                        } else if (type === 'youtube') {
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
                        } else if (type === 'vimeo') {
                            const link_as_array = link.split("/")
                            let vimeo_id = link_as_array[link_as_array.length - 1];
                            video_container.empty();
                            video_container.append(`
                                <iframe
                                    src="https://player.vimeo.com/video/${vimeo_id}"
                                    width="1200"
                                    height="500"
                                    id="vimeoIframe"
                                    frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                            `);
                            document.getElementById("vimeoIframe").width = document.getElementsByClassName('lecture-viewer-container')[0].offsetWidth;
                            document.getElementById("vimeoIframe").height = document.getElementsByClassName('lecture-viewer-container')[0].offsetHeight * 1.7;
                            vimeoPlayer = new Vimeo.Player(document.querySelector('iframe'));
                            vimeoPlayer.getDuration().then(function (du) {
                                vimeoDuration = du;
                            });
                            vimeoPlayer.on('play', function () {
                                clearInterval(vimeoPlyrInterval);
                                start_vimeo_detection_progress();
                            });
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
                        vimeoPlayer = undefined;
                        video_container.empty()
                        swal("@lang('site.lesson_not_avaliable')", {
                            buttons: false,
                        });
                    }
                }
            });
        });
        @if(setting('code.status') == 'on')
        if (type !== 'vimeo') {
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
        } else {
            vimeoPlayer.getDuration().then(function (du) {
                vimeoDuration = du;
            });
            vimeoPlayer.on('play', function () {
                clearInterval(vimeoPlyrInterval);
                start_vimeo_detection_progress();
            });
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
