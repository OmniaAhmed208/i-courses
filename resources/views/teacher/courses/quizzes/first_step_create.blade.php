@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Create Quiz')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.quiz_type')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="quiz-type-wrap">
                                <div class="row">
                                    <div class="col-lg-6 column-td-half">
                                        <div class="payment-option">
                                            <label for="for_all_students" class="radio-trigger">
                                                <input type="radio" id="for_all_students"
                                                       name="quiz_type_view" value="all" checked>
                                                <span class="checkmark"></span>
                                                <span class="widget-title font-size-18">
                                                    @lang('site.quiz_for_all_students')
                                                </span>
                                            </label>
                                        </div>
                                    </div><!-- end col-lg-2 -->
                                    <div class="col-lg-6 column-td-half">
                                        <div class="payment-option">
                                            <label for="for_group_of_students" class="radio-trigger">
                                                <input type="radio" id="for_group_of_students"
                                                       name="quiz_type_view" value="group">
                                                <span class="checkmark"></span>
                                                <span class="widget-title font-size-18">
                                                    @lang('site.quiz_for_group_of_students')
                                                </span>
                                            </label>
                                        </div>
                                    </div><!-- end col-lg-2 -->
                                </div><!-- end row -->
                                <hr>
                                <div class="row groups_row" style="display: none;">
                                    <div class="col-12">
                                        <label class="label-text" for="group_id">@lang('site.groups')</label>
                                        <div class="form-group">
                                            <div class="sort-ordering user-form-short">
                                                <select class="sort-ordering-select" id="group_id">
                                                    @if($groups)
                                                        @foreach($groups as $group)
                                                            <option
                                                                value="{{ $group->id }}">{{ $group->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('group_id')
                                                <span class="text-danger font-size-12">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <form
                                        action="{{ route('teacher.courses.quizzes.first_step_store', $course->slug) }}"
                                        method="post" id="form">
                                        @csrf
                                        <input type="hidden" name="quiz_type" value="all">
                                        <input type="hidden" name="group_id"
                                               value="{{ ($groups && count($groups) > 0) ? $groups->first()->id : '' }}">
                                        <div class="col-lg-12">
                                            <button class="theme-btn" type="submit">
                                                @lang('site.next')
                                                @if(app()->getLocale() == 'en')
                                                    <i class="las la-arrow-circle-right"></i>
                                                @else
                                                    <i class="las la-arrow-circle-left"></i>
                                                @endif
                                            </button>
                                        </div>
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
        $('input[type=radio][name=quiz_type_view]').change(function () {
            if (this.value === 'group') {
                $('input[name=quiz_type]').val("group");
                $('.groups_row').show();
            } else {
                $('input[name=quiz_type]').val("all");
                $('.groups_row').hide();
            }
        });
        $("#group_id").on('change', function () {
            $('input[name=group_id]').val(this.value);
        });

    </script>
    <script>
        // if (window.history && window.history.pushState) {
        //     $(window).on('popstate', function () {
        //         var hashLocation = location.hash;
        //         var hashSplit = hashLocation.split("#!/");
        //         var hashName = hashSplit[1];
        //
        //         if (hashName !== '') {
        //             var hash = window.location.hash;
        //             if (hash === '') {
        //                 if (window.confirm("Test")) {
        //                     window.history.back();
        //                 } else {
        //                     window.history.pushState('forward', null, '');
        //                 }
        //
        //             }
        //         }
        //     });
        //     window.history.pushState('forward', null, '');
        // }

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
