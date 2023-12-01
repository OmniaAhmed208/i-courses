<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $lesson->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/plyr.css') }}"/>
    <style>
        body {
            padding: 0;
            margin: 0;
        }

        .plyr {
            width: 100%;
            height: 100vh;
        }
    </style>
</head>
<body>
@if($lesson->type == 'link' || $lesson->type == 'internal_link')
    <video controls crossorigin playsinline id="player">
        <source src="{{ $lesson->type == 'internal_link' ? asset($lesson->link) : $lesson->link  }}" type="video/mp4"
                size="1080"/>
    </video>
@elseif($lesson->type == 'vimeo')
    <div id="player" data-plyr-provider="vimeo" data-plyr-embed-id="{{ $lesson->link }}"></div>
@elseif($lesson->type == 'youtube')
    <div id="player" data-plyr-provider="youtube" data-plyr-embed-id="{{ $lesson->link }}"></div>
@endif
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/plyr.js') }}"></script>
<script>
    @if($code && setting('code.status') == 'on')
    var student_code = "{{ $code }}";
    @endif
    var boundaries = {},
        interval = undefined,
        type = "{{ $lesson->type }}",
        player = new Plyr("#player", {
            controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume']
        });

    @if($code && setting('code.status') == 'on')
    if (type === "link" || type === "internal_link") {
        $(".plyr .plyr__video-wrapper").append(`
                <div id="student_code" style="z-index: 99999999999; color: white; background-color: black;padding: 5px; position: fixed; border-radius: 5px;font-size: 25px;transition: top 2s, left 2s;">${student_code}</div>
            `);
    } else if (type === "youtube" || type === "vimeo") {
        $(".plyr__video-wrapper.plyr__video-embed").append(`
                  <div id="student_code" style="z-index: 99999999999; color: white; background-color: black;padding: 5px; position: fixed; border-radius: 5px;font-size: 25px;transition: top 2s, left 2s;">${student_code}</div>
            `);
    }

    function updateBoundaries() {
        boundaries = {};
        if ($(".plyr__poster").length > 0) {
            boundaries = $(".plyr__poster")[0].getBoundingClientRect();
        }
    }

    function moveCode() {
        interval = setInterval(function () {
            if ($("#student_code").length > 0) {
                var y = randomIntFromInterval(
                    boundaries.top + 50,
                    boundaries.bottom - 50
                    ),
                    x = randomIntFromInterval(
                        boundaries.left + 50,
                        boundaries.right - 50
                    );
                $("#student_code").css({top: `${y}px`, left: `${x}px`});
            }
        }, 2000);
    }

    function stopMoving() {
        clearInterval(interval);
    }

    function randomIntFromInterval(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    player.on("exitfullscreen", (event) => {
        updateBoundaries();
    });

    updateBoundaries();
    stopMoving();
    moveCode();
    @endif
    @if($user)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let student_watched_ajax_sent = false;
    PlyrInterval = setInterval(function () {
        let percentage = (player.currentTime / 60) / (player.duration / 60) * 100;
        console.log(percentage);
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
                    lesson: "{{ $lesson->id }}",
                    user_id: "{{ $user->id }}"
                },
                success: function (data) {
                    student_watched_ajax_sent = true;
                }
            });
        }
    }, 1000);
    @endif
</script>
</body>
</html>
