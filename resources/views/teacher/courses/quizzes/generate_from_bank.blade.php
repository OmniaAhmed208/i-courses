@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Create Quiz')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.generate_questions_from_bank')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="quiz-type-wrap">
                                @if (session('generate_error'))
                                    <div class="row">
                                        <div class="alert alert-danger w-100" role="alert">
                                            {{ session('generate_error') }}
                                        </div>
                                    </div>
                                @endif
                                <form
                                    action="{{ route('teacher.courses.quizzes.generate_questions_from_bank', ['course' => $course->slug, 'quiz' => $quiz->id]) }}"
                                    method="post" class="w-100" id="form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="label-text"
                                                   for="section_name">
                                                @lang('site.section_name_in_quiz')
                                                <span class="primary-color-2 ml-1">*</span>
                                            </label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="section_name"
                                                       name="section_name" value="{{ old('section_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="label-text" for="group_id">
                                                @lang('site.questions_bank_group')
                                                <span class="primary-color-2 ml-1">*</span>
                                            </label>
                                            <div class="form-group">
                                                <div class="sort-ordering user-form-short">
                                                    <select class="sort-ordering-select" id="group_id" name="group_id">
                                                        @foreach($groups as $group)
                                                            <option
                                                                value="{{ $group->id }}">{{ $group->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="label-text" for="from">
                                                @lang('site.number_of_questions')
                                                <span class="primary-color-2 ml-1">*</span>
                                            </label>
                                            <div class="form-group">
                                                <input type="number" min="1" id="from" class="form-control"
                                                       autocomplete="off" name="number_of_questions"
                                                       value="{{ old('number_of_questions') }}">
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <button class="theme-btn">
                                                <i class="la la-cog"></i>
                                                @lang('site.generate')
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <div class="row justify-content-center">
                                    <form
                                        action="{{ route('teacher.courses.quizzes.finish_quiz', ['course' => $course->slug, 'quiz' => $quiz->id]) }}"
                                        id="finish">
                                        <button class="theme-btn">
                                            <i class="la la-check"></i>
                                            @lang('site.finish')
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div><!-- end card-box-shared-body -->
                    </div><!-- end card-box-shared -->
                </div><!-- end col-lg-12 -->
            </div>
            @include('layouts.teacher._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection
@push('scripts')
    <script>
        let form = document.getElementById("form");
        let finish = document.getElementById("form");
        var ok = false;
        form.addEventListener('submit', function (e) {
            ok = true;
        });
        finish.addEventListener('submit', function (e) {
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

