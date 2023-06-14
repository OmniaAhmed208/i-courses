@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Create Quiz')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.choose_quiz_for_copy')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="quiz-type-wrap">
                                <form
                                    action="{{ route('teacher.courses.quizzes.copy', ['course' => $course->slug, 'quiz' => $quiz->id]) }}"
                                    method="post" class="w-100" id="form">
                                    <div class="row">
                                        @csrf
                                        <div class="col-12">
                                            <label class="label-text" for="quiz_id">@lang('site.quizzes')</label>
                                            <div class="form-group">
                                                <div class="sort-ordering user-form-short">
                                                    <select class="sort-ordering-select" id="quiz_id" name="quiz_id">
                                                        @foreach($quizzes as $quiz)
                                                            <option
                                                                value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('quiz_id')
                                                    <span class="text-danger font-size-12">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <button class="theme-btn" type="submit">
                                                @lang('site.finish')
                                                <i class="las la-check"></i>
                                            </button>
                                        </div>
                                    </div><!-- end row -->
                                </form>

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
        var ok = false;
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
