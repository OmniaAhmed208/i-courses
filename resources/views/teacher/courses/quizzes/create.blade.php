@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Create Quiz')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.basic_info')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="user-form">
                                <div class="contact-form-action">
                                    <form method="post"
                                          action="{{ route('teacher.courses.quizzes.store', $course->slug) }}"
                                          enctype="multipart/form-data" id="form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-box">
                                                    <label class="label-text">
                                                        @lang('site.quiz_name')
                                                        <span class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <input class="form-control @error('name') error @enderror"
                                                               type="text" name="name"
                                                               placeholder="@lang('site.quiz_name')"
                                                               value="{{ old('name') }}"
                                                        >
                                                        <span class="la la-file-text-o input-icon"></span>
                                                        @error('name')
                                                        <span class="text-danger font-size-12">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.quiz_start_date')<span
                                                            class="primary-color-2 ml-1">*</span></label>
                                                    <div class="form-group">
                                                        <input
                                                            class="form-control datepicker1 @error('start_date') error @enderror"
                                                            type="text" name="start_date"
                                                            placeholder="@lang('site.quiz_start_date')"
                                                            value="{{ old('start_date') }}"
                                                        >
                                                        <span class="las la-calendar input-icon"></span>
                                                        @error('start_date')
                                                        <span class="text-danger font-size-12">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.quiz_start_time')<span
                                                            class="primary-color-2 ml-1">*</span></label>
                                                    <div class="form-group">
                                                        <input
                                                            class="form-control @error('start_time') error @enderror"
                                                            type="time" name="start_time"
                                                            placeholder="@lang('site.quiz_start_time')"
                                                            value="{{ old('start_time') }}"
                                                        >
                                                        <span class="las la-calendar input-icon"></span>
                                                        @error('start_time')
                                                        <span class="text-danger font-size-12">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-6 -->


                                            <div class="col-lg-6 col-sm-6">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.quiz_end_date')<span
                                                            class="primary-color-2 ml-1">*</span></label>
                                                    <div class="form-group">
                                                        <input
                                                            class="form-control datepicker2 @error('end_date') error @enderror"
                                                            type="text" name="end_date"
                                                            placeholder="@lang('site.quiz_end_date')"
                                                            value="{{ old('end_date') }}"
                                                        >
                                                        <span class="las la-calendar input-icon"></span>
                                                        @error('end_date')
                                                        <span class="text-danger font-size-12">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.quiz_end_time')<span
                                                            class="primary-color-2 ml-1">*</span></label>
                                                    <div class="form-group">
                                                        <input
                                                            class="form-control @error('end_time') error @enderror"
                                                            type="time" name="end_time"
                                                            placeholder="@lang('site.quiz_end_time')"
                                                            value="{{ old('end_time') }}"
                                                        >
                                                        <span class="las la-calendar input-icon"></span>
                                                        @error('end_time')
                                                        <span class="text-danger font-size-12">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-6 -->


                                            <div class="col-lg-6 col-sm-6">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.quiz_duration_in_minutes')
                                                        <span class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <input type="number" min="1"
                                                               class="form-control @error('duration_in_minutes') error @enderror"
                                                               name="duration_in_minutes"
                                                               placeholder="@lang('site.quiz_duration_in_minutes')"
                                                               value="{{ old('duration_in_minutes') }}">
                                                        <span class="las la-clock input-icon"></span>
                                                        @error('duration_in_minutes')
                                                        <span class="text-danger font-size-12">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.quiz_description')
                                                        <span class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <textarea
                                                            class="form-control @error('description') error @enderror"
                                                            name="description"
                                                            id="description" rows="5"
                                                            placeholder="@lang('site.quiz_description')">{{ old('description') }}</textarea>
                                                        <span class="las la-file-alt input-icon"></span>
                                                        <small>@lang('site.quiz_description_notice')</small>
                                                        @error('description')
                                                        <span class="text-danger font-size-12">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
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
                                        </div><!-- end row -->
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
@push('styles')
    <style>
        .cmp-date-time-picker .cmp-dp-date-wrapper .cmp-dp-date-item-cur {
            background-color: #51be78 !important;
            color: #fff !important;
        }

        .cmp-date-time-picker .cmp-dp-date-wrapper .cmp-dp-date-item:hover {
            background-color: #eee !important;
            color: #51be78 !important;
            font-weight: 700;
        }

        .cmp-date-time-picker .cmp-dp-btn-wrap .cmp-dp-btn {
            background: #51be78 !important;
            border: 1px solid #51be78 !important;
        }

        .cmp-date-time-picker .cmp-dp-btn-wrap .cmp-dp-btn-disabled {
            color: #f6f6f6 !important;
            background: #cecece !important;
            border: 1px solid #cecece !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $('.datepicker1').dateTimePicker({
            format: 'dd/MM/yyyy',
        });
        $('.datepicker2').dateTimePicker({
            format: 'dd/MM/yyyy',
        });
    </script>
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
