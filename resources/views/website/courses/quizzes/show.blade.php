@extends('layouts.course.app')
@section('title', setting('website_name') . ' ' . $quiz->name)
@section('content')
    <section class="quiz-wrap">
        <div class="quiz-content-wrap bg-black padding-top-60px padding-bottom-60px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="quiz-content text-center">
                            <p class="lead font-weight-regular font-size-18 text-color-rgba mb-0 pb-2"
                               id="header_title">@lang('site.exam_will_finish_after')</p>
                            <h2 class="section__title text-white padding-bottom-30px" id="getting-started"></h2>
                        </div>
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end quiz-content-wrap -->
        <div class="quiz-action-nav bg-white py-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="quiz-action-content d-flex align-items-center justify-content-between">
                            <ul class="quiz-nav d-flex align-items-center">
                                <li>
                                    <i class="las la-paste font-size-20 mr-2"></i>
                                    {{ $quiz->name }}
                                </li>
                            </ul>
                        </div>
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end quiz-action-nav -->
        <div class="quiz-ans-wrap padding-top-80px padding-bottom-80px">
            <div class="container">
                <form id="answer_form"
                      action="{{ route('courses.quizzes.attempt', ['course' => $course, 'quiz' => $quiz->id]) }}"
                      method="post" enctype="multipart/form-data">
                    @csrf
                    @foreach($quiz->sections as $section)
                        @if(count($section->questions) > 0)
                            <h1 class="mb-3 {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">{{ $section->title }}</h1>
                            <div class="row mb-4">
                                @php
                                    $questions = $section->questions->shuffle();
                                @endphp
                                @foreach($questions as $index => $question)
                                    <div class="col-lg-12 mb-4">
                                        <div class="quiz-ans-content">
                                            <div class="d-flex align-items-center">
                                    <span
                                        class="quiz-count icon-element icon--element bg-color-1 text-white mr-2">{{ $index + 1 }}</span>
                                                <div
                                                    class="widget-title font-weight-semi-bold w-100 d-flex justify-content-between question_header_border py-3">
                                                    <div>{!! $question->title !!}</div>
                                                    <span class="font-size-14">({{ $question->mark }})</span>
                                                </div>
                                            </div>
                                            @if($question->picture)
                                                <div class="d-block">
                                                    <a href="{{ asset('storage/' . $question->picture) }}"
                                                       target="_blank">
                                                        <img src="{{ asset('storage/' . $question->picture) }}"
                                                             alt="{{ $quiz->name }}">
                                                    </a>
                                                </div>
                                            @endif
                                            @if($question->type == 'mcq')
                                                <ul class="py-3 ml-3 {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                                    @foreach($question->choices as $key => $choice)
                                                        <li>
                                                            <div class="custom-checkbox">
                                                                <input type="radio" name="{{ $question->id }}"
                                                                       value="{{ $key + 1 }}">
                                                                <label>
                                                                    {{ $choice->title }}
                                                                </label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @elseif($question->type == 'true_false')
                                                <ul class="py-3 ml-3 {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                                    <li>
                                                        <div class="custom-checkbox">
                                                            <input type="radio" name="{{ $question->id }}"
                                                                   value="true">
                                                            <label>@lang('site.true')</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="custom-checkbox">
                                                            <input type="radio" name="{{ $question->id }}"
                                                                   value="false">
                                                            <label>@lang('site.false')</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            @elseif($question->type == 'essay')
                                                <ul class="py-3 ml-3 {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                                    <li>
                                                        <textarea rows="7" class="form-control"
                                                                  name="{{ $question->id }}"></textarea>
                                                    </li>
                                                    <li>
                                                        <div class="input-box">
                                                            <label class="label-text">@lang('site.or_upload_images')
                                                                <span
                                                                    class="primary-color-2 ml-1">*</span>
                                                            </label>
                                                            <div class="form-group mb-0">
                                                                <div class="upload-btn-box course-photo-btn">
                                                                    <input type="file" name="{{ $question->id }}_images"
                                                                           class="answer"
                                                                           data-jfiler-extensions="jpg, jpeg, png">
                                                                    @error('image')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            @endif
                                        </div>
                                    </div><!-- end col-lg-12 -->
                                @endforeach
                            </div><!-- end row -->
                            <hr>
                        @endif
                    @endforeach
                    <div class="row">
                        <div class="col-12  {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                            <button type="submit" class="theme-btn">
                                @lang('site.submit_answers')
                            </button>
                        </div>
                    </div>
                </form>
            </div><!-- end container -->
        </div><!-- end quiz-ans-wrap -->
    </section><!-- end quiz-wrap -->
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.filer.min.js') }}"></script>
    <script>
        var ok = false;
        var timeInMilliseconds = parseInt("{{ $remaining_time }}");
        var seconds = timeInMilliseconds / 1000;
        $("input textarea").val("");

        function timer() {
            var days = Math.floor(seconds / 24 / 60 / 60);
            var hoursLeft = Math.floor((seconds) - (days * 86400));
            var hours = Math.floor(hoursLeft / 3600);
            var minutesLeft = Math.floor((hoursLeft) - (hours * 3600));
            var minutes = Math.floor(minutesLeft / 60);
            var remainingSeconds = parseInt(seconds % 60);

            function pad(n) {
                return (n < 10 ? "0" + n : n);
            }

            document.getElementById('getting-started').innerHTML = pad(hours) + ":" + pad(minutes) + ":" + pad(remainingSeconds);
            if (hours === 0 && minutes === 0 && remainingSeconds === 0) {
                clearInterval(countdownTimer);
                document.getElementById('getting-started').innerHTML = "Finished";
                document.getElementById('header_title').innerHTML = "";
                ok = true;
                $("#answer_form").submit();
            } else {
                seconds--;
            }
        }

        var countdownTimer = setInterval('timer()', 1000);


        let form = document.getElementById("answer_form");
        form.addEventListener('submit', function (e) {
            
            ok = true;
        });
        window.onbeforeunload = function (e) {
            if (!ok) {
                var message = "Are you sure ?";
                var firefox = /Firefox[\/\s](\d+)/.test(navigator.userAgent);
                if (firefox) {
                    //Add custom dialog
                    //Firefox does not accept window.showModalDialog(), window.alert(), window.confirm(), and window.prompt() furthermore
                    var dialog = document.createElement("div");
                    document.body.appendChild(dialog);
                    dialog.id = "dialog";
                    dialog.style.visibility = "hidden";
                    dialog.innerHTML = message;
                    var left = document.body.clientWidth / 2 - dialog.clientWidth / 2;
                    dialog.style.left = left + "px";
                    dialog.style.visibility = "visible";
                    var shadow = document.createElement("div");
                    document.body.appendChild(shadow);
                    shadow.id = "shadow";
                    //tip with setTimeout
                    setTimeout(function () {
                        document.body.removeChild(document.getElementById("dialog"));
                        document.body.removeChild(document.getElementById("shadow"));
                    }, 0);
                }
                return message;
            }
        };
    </script>
@endpush
