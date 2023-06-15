@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Create Quiz')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.generate_questions_method')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="quiz-type-wrap">
                                <form
                                    action="{{ route('teacher.courses.quizzes.redirect_after_choose_method', ['course' => $course->slug, 'quiz' => $quiz->id]) }}"
                                    method="post" class="w-100" id="form">
                                    <div class="row">
                                        @csrf
                                        <div class="col-lg-4 column-td-half">
                                            <div class="payment-option">
                                                <label for="for_normal_method" class="radio-trigger">
                                                    <input type="radio" id="for_normal_method"
                                                           name="type" value="normal" checked>
                                                    <span class="checkmark"></span>
                                                    <span class="widget-title font-size-18">
                                                    @lang('site.add_question_manually')
                                                </span>
                                                </label>
                                            </div>
                                        </div><!-- end col-lg-4 -->
                                        <div class="col-lg-4 column-td-half">
                                            <div class="payment-option">
                                                <label for="for_copy_method" class="radio-trigger">
                                                    <input type="radio" id="for_copy_method"
                                                           name="type" value="copy">
                                                    <span class="checkmark"></span>
                                                    <span class="widget-title font-size-18">
                                                    @lang('site.copy_questions_form_other_exam')
                                                </span>
                                                </label>
                                            </div>
                                        </div><!-- end col-lg-4 -->
                                        <div class="col-lg-4 column-td-half">
                                            <div class="payment-option">
                                                <label for="for_bank_method" class="radio-trigger">
                                                    <input type="radio" id="for_bank_method"
                                                           name="type" value="bank">
                                                    <span class="checkmark"></span>
                                                    <span class="widget-title font-size-18">
                                                    @lang('site.generate_questions_from_bank')
                                                </span>
                                                </label>
                                            </div>
                                        </div><!-- end col-lg-4 -->
                                        <div class="col-lg-12 text-center">
                                            <button class="theme-btn" type="submit">
                                                @lang('site.next')
                                                @if(app()->getLocale() == 'en')
                                                    <i class="las la-arrow-circle-right"></i>
                                                @else
                                                    <i class="las la-arrow-circle-left"></i>
                                                @endif
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

