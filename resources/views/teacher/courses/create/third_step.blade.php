@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Create Course')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            @if ($errors->any())
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex justify-content-between">
                            <h3 class="widget-title">@lang('site.lesson') 1</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="user-form">
                                <div class="contact-form-action">
                                    <form method="post">
                                        <div class="row form-content">
                                            <div class="col-lg-4 col-sm-4">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.lesson_title')
                                                        <span class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" name="title"
                                                               placeholder="@lang('site.lesson_title')">
                                                        <span class="la la-play input-icon"></span>
                                                        <span class="text-danger error_message"></span>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-4 -->
                                            <div class="col-lg-4 col-sm-4">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.lesson_duration')<span
                                                            class="primary-color-2 ml-1">*</span></label>
                                                    <div class="form-group">
                                                        <input class="form-control" type="number" min="1" name="time"
                                                               placeholder="eg: 7">
                                                        <span class="la la-play input-icon"></span>
                                                        <span class="text-danger error_message"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-4">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.lesson_section')
                                                        <span class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <div class="sort-ordering user-form-short">
                                                            <select class="sort-ordering-select" name="section_id"
                                                                    id="course_section">
                                                                @foreach($sections as $section)
                                                                    <option
                                                                        value="{{ $section->id }}">{{ $section->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger font-size-12 d-none"></span>
                                                            <span class="text-danger error_message"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-4 -->
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.video_type')</label>
                                                    <div class="form-group">
                                                        <div class="sort-ordering user-form-short">
                                                            <select class="sort-ordering-select upload_type"
                                                                    name="type">
                                                                <option value="vimeo">@lang('site.vimeo_link')</option>
                                                                <option
                                                                    value="youtube">@lang('site.youtube_link')</option>
                                                                <option
                                                                    value="link">@lang('site.external_link')</option>
                                                                <option value="internal_link" id="upload_option">
                                                                    @lang('site.upload')
                                                                </option>
                                                            </select>
                                                            <span class="text-danger font-size-12 d-none"></span>
                                                            <span class="text-danger error_message"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-4 -->
                                            <div class="col-lg-6 col-sm-6 url">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.lesson_url')<span
                                                            class="primary-color-2 ml-1">*</span></label>
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" name="url"
                                                               placeholder="@lang('site.lesson_url')">
                                                        <span class="la la-link input-icon"></span>
                                                        <span class="text-danger error_message"></span>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-6 col-sm-6 views">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.number_of_views')<span
                                                            class="primary-color-2 ml-1">*</span></label>
                                                    <div class="form-group">
                                                        <input class="form-control" type="number" min="0"
                                                               name="number_of_views" value="0">
                                                        <span class="la la-eye input-icon"></span>
                                                        <small>@lang('site.number_of_views_notic')</small>
                                                        <span class="text-danger error_message"></span>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-12">
                                                <div class="input-box">
                                                    <label for='is_free'>@lang('site.free_lesson')</label>

                                                    <input type='checkbox' class='main-switch' name="is_free">
                                                    <span class="text-danger error_message"></span>
                                                </div>
                                            </div>
                                        </div><!-- end row -->
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                <button class="theme-btn upload">
                                                    <i class="las la-cloud-upload-alt"></i>
                                                    @lang('site.upload')
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!-- end card-box-shared-body -->
                    </div><!-- end card-box-shared -->
                </div><!-- end col-lg-12 -->
            </div>
            <div class="row mt-3 add-new-lesson-form">
                <div class="col-lg-12">
                    <button class="theme-btn" id="add-new-lesson">
                        <i class="la la-plus-circle"></i>
                        @lang('site.add_new_lesson')
                    </button>
                </div>
            </div>
            <hr>
            <div class="row my-3">
                <div class="col-lg-12 text-center">
                    <form action="{{ route('teacher.courses.third_step', $course->slug) }}" method="POST">
                        @csrf
                        <input type="hidden" name="lessons_added" id="lessons_added" value="0">
                        <button class="theme-btn" type="submit">
                            <i class="la la-check-circle"></i>
                            @lang('site.add_course_platform')
                        </button>
                    </form>
                </div>
            </div>
            @include('layouts.teacher._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/switchery.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('js/switchery.min.js') }}"></script>
    <script>
        let elem = document.querySelector('.main-switch'),
            init = new Switchery(elem);
        let counter = 1;
        let course_sections_options = $('#course_section').html();

        function init_after_dynamic_addition() {
            $('.sort-ordering-select').selectpicker({
                liveSearch: true,
                liveSearchPlaceholder: 'Search',
                liveSearchStyle: 'contains',
                size: 5
            });
            let elems = Array.prototype.slice.call(document.querySelectorAll(`.js-switch-${counter}`));
            elems.forEach(function (html) {
                let switchery = new Switchery(html);
            });
            counter++;
        }

        $('#add-new-lesson').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            $('.add-new-lesson-form').before(`
                <hr>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="card-box-shared">
                            <div class="card-box-shared-title d-flex justify-content-between">
                                <h3 class="widget-title">@lang('site.lesson') ${counter + 1}</h3>
                                <button class="btn btn-danger delete-lesson-row" data-done="false">
                                    <i class="la la-trash-o"></i>
                                    @lang('site.delete')
            </button>
        </div>
        <div class="card-box-shared-body">
            <div class="user-form">
                <div class="contact-form-action">
                    <form method="post">
                        <div class="row form-content">
                            <div class="col-lg-4 col-sm-4">
                                <div class="input-box">
                                    <label class="label-text">@lang('site.lesson_title')<span
                                                                class="primary-color-2 ml-1">*</span></label>
                                                        <div class="form-group">
                                                            <input class="form-control" type="text" name="title"
                                                                    placeholder="@lang('site.lesson_title')">
                                                            <span class="la la-play input-icon"></span>
                                                            <span class="text-danger error_message"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-4">
                                                    <div class="input-box">
                                                        <label class="label-text">@lang('site.lesson_duration')<span
                                                                class="primary-color-2 ml-1">*</span></label>
                                                        <div class="form-group">
                                                            <input class="form-control" type="number" min="1" name="time"
                                                                    placeholder="eg: 7">
                                                            <span class="la la-play input-icon"></span>
                                                            <span class="text-danger error_message"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-4">
                                                    <div class="input-box">
                                                        <label class="label-text">@lang('site.lesson_section')<span
                                                                class="primary-color-2 ml-1">*</span></label>
                                                        <div class="form-group">
                                                            <div class="sort-ordering user-form-short">
                                                                <select class="sort-ordering-select" name="section_id"
                                                                        id="course_section">
                                                                    ${course_sections_options}
                                                                </select>
                                                                <span class="text-danger font-size-12 d-none"></span>
                                                                <span class="text-danger error_message"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6">
                                                    <div class="input-box">
                                                        <label class="label-text">@lang('site.video_type')</label>
                                                        <div class="form-group">
                                                            <div class="sort-ordering user-form-short">
                                                                <select class="sort-ordering-select upload_type"
                                                                        name="type">
                                                                    <option value="vimeo">@lang('site.vimeo_link')</option>
                                                                    <option value="youtube">@lang('site.youtube_link')</option>
                                                                    <option value="link">@lang('site.external_link')</option>
                                                                    <option value="internal_link" id="upload_option">
                                                                        @lang('site.upload')
            </option>
        </select>
        <span class="text-danger font-size-12 d-none"></span>
        <span class="text-danger error_message"></span>
    </div>
</div>
</div>
</div>
<div class="col-lg-6 col-sm-6 url">
<div class="input-box">
<label class="label-text">@lang('site.lesson_url')<span
                                                                class="primary-color-2 ml-1">*</span></label>
                                                        <div class="form-group">
                                                            <input class="form-control" type="text" name="url"
                                                                    placeholder="@lang('site.lesson_url')">
                                                            <span class="la la-link input-icon"></span>
                                                            <span class="text-danger error_message"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6 views">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.number_of_views')<span
                                                            class="primary-color-2 ml-1">*</span></label>
                                                    <div class="form-group">
                                                        <input class="form-control" type="number" min="0"
                                                               name="number_of_views" value="0">
                                                        <span class="la la-eye input-icon"></span>
                                                        <small>@lang('site.number_of_views_notic')</small>
                                                        <span class="text-danger error_message"></span>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="col-12">
                                                    <div class="input-box">
                                                        <label for='is_free'>@lang('site.free_lesson')</label>

                                                        <input type='checkbox' class='js-switch-${counter}' name="is_free">
                                                        <span class="text-danger error_message"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button class="theme-btn upload">
                                                        <i class="las la-cloud-upload-alt"></i>
                                                        @lang('site.upload')
            </button>
        </div>
    </div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
`);

            init_after_dynamic_addition();
        });

        $(document).on('click', '.delete-lesson-row', function (e) {
            e.preventDefault();
            let done = $(this).data('done'),
                row = $(this).parent().parent().parent().parent();

            if (done) {
                let lesson_id = $(this).data('lesson_id');
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
                        row.remove();
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
            } else {
                row.remove();
            }
        });

        $(document).on('change', '.upload_type', function (e) {
            e.stopPropagation()
            let selected_value = $(this).val();
            if (selected_value === 'internal_link') {
                $(this).parent().parent().parent().parent().parent().siblings('.url').remove();
                $(this).parent().parent().parent().parent().parent().after(`
                    <div class="col-lg-6 col-sm-6 video_file">
                        <div class="input-box">
                            <label class="label-text">@lang('site.select_video_from_computer')
                <span class="primary-color-2 ml-1">*</span>
            </label>
            <div class="form-group">
                <input type="file" class="video_input" />
                <span class="text-danger error_message d-block"></span>
            </div>
        </div>
    </div>
`)
            } else if ($(this).parent().parent().parent().parent().parent().siblings('.url').length === 0) {
                $(this).parent().parent().parent().parent().parent().siblings('.video_file').remove();
                $(this).parent().parent().parent().parent().parent().after(`
                    <div class="col-lg-6 col-sm-6 url">
                        <div class="input-box">
                            <label class="label-text">@lang('site.lesson_url')<span
                                    class="primary-color-2 ml-1">*</span></label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="url"
                                       placeholder="@lang('site.lesson_url')">
                                <span class="la la-link input-icon"></span>
                                <span class="text-danger error_message"></span>
                            </div>
                        </div>
                    </div>
                `);
            }
        });

        $(document).on('click', '.upload', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var formData = new FormData();
            var form = $(this).parent().parent().parent()
            $('.error_message').empty();
            $('.main_error_message').remove();

            //creating data object
            formData.append("name", form.children('.form-content').children('.col-lg-4').children('.input-box').children('.form-group').children('input[name="title"]').val());
            formData.append("number_of_views", form.children('.form-content').children('.col-lg-6').children('.input-box').children('.form-group').children('input[name="number_of_views"]').val());
            formData.append("time", form.children('.form-content').children('.col-lg-4').children('.input-box').children('.form-group').children('input[name="time"]').val());
            formData.append("section_id", form.children('.form-content').children('.col-lg-4').children('.input-box').children('.form-group').children('.user-form-short').children('.sort-ordering-select').children('select[name="section_id"]').val());
            formData.append("type", form.children('.form-content').children('.col-lg-6').children('.input-box').children('.form-group').children('.user-form-short').children('.sort-ordering-select').children('select[name="type"]').val());
            formData.append("is_free", form.children('.form-content').children('.col-12').children('.input-box').children('input[name="is_free"]').is(":checked") ? 1 : 0);
            if (formData.get("type") !== "internal_link") {
                formData.append("link", form.children('.form-content').children('.col-lg-6').children('.input-box').children('.form-group').children('input[name="url"]').val());
            } else {
                formData.append("video", form.children('.form-content').children('.col-lg-6').children('.input-box').children('.form-group').children('input[type=file]')[0].files[0]);
                if (!isVideo(formData.get("video").type)) {
                    alert("@lang('site.support_mp4')");
                    return;
                }
            }
            let that = $(this);
            that.hide();
            that.parent().append(`<h4 class="mb-1">@lang('site.uploading')</h4>`)
            that.parent().append(`
                <div class="progress">
                    <div
                        class="progress-bar progress-bar-striped progress-bar-animated bg-color-1"
                        role="progressbar" aria-valuenow="0" aria-valuemin="0"
                        aria-valuemax="100" style="width: 0%">
                        0%
                    </div>
                </div>
            `);
            var progressBar = $(this).parent().children('.progress').children('.progress-bar');
            //sending ajax request
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = parseInt((evt.loaded / evt.total) * 100);
                            progressBar.attr('aria-valuenow', percentComplete).css('width', percentComplete + "%").html(percentComplete + "%");
                        }
                    }, false);
                    return xhr;
                },
                processData: false,
                contentType: false,
                dataType: 'json',
                cache: false,
                type: 'POST',
                url: "{{ route('teacher.lessons.store_ajax', $course->slug) }}",
                data: formData,
                success: function (data) {
                    $("#lessons_added").val(1);
                    that.parent().children('h4').remove();
                    that.parent().children('.progress').remove();
                    that.parent().append(`<h4 class="mb-1"><i class="la la-check-circle"></i>@lang('site.done')!</h4>`);
                    that.remove();
                    form.children('.form-content').children('.col-lg-6').children('.input-box').children('.form-group').children('input[type=file]').prop('disabled', true);
                    form.parent().parent().parent().siblings('.card-box-shared-title').children('button').attr('data-done', true);
                    form.parent().parent().parent().siblings('.card-box-shared-title').children('button').attr('data-lesson_id', data.lesson_id);
                    new Noty({
                        type: 'success',
                        layout: '{{ app()->getLocale() == 'ar' ? 'topLeft' : 'topRight' }}',
                        text: `${data.message}`,
                        timeout: 2000,
                        killer: true
                    }).show();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    that.show();
                    that.parent().children('h4').remove();
                    that.parent().children('.progress').remove();
                    that.parent().append(`<h4 class="mb-1 text-danger main_error_message"><i class="la la-times-circle"></i> ${xhr.responseJSON.message}</h4>`);
                    var keys = Object.keys(xhr.responseJSON.errors);
                    var error_msg = [];
                    for (var i = 0; i < keys.length; i++) {
                        error_msg = Object.values(xhr.responseJSON.errors)[i][0];
                        switch (keys[i]) {
                            case "name":
                                form.children('.form-content').children('.col-lg-4').children('.input-box').children('.form-group').children('input[name="title"]').siblings('span.error_message').html(error_msg);
                                break;
                            case "time":
                                form.children('.form-content').children('.col-lg-4').children('.input-box').children('.form-group').children('input[name="time"]').siblings('span.error_message').html(error_msg);
                                break;
                            case "is_free":
                                form.children('.form-content').children('.col-12').children('.input-box').children('input[name="is_free"]').siblings('span.error_message').html(error_msg);
                                break;
                            case "link":
                                form.children('.form-content').children('.col-lg-6').children('.input-box').children('.form-group').children('input[name="url"]').siblings('span.error_message').html(error_msg);
                                break;
                            case "number_of_views":
                                form.children('.form-content').children('.col-lg-6').children('.input-box').children('.form-group').children('input[name="number_of_views"]').siblings('span.error_message').html(error_msg);
                                break;
                            case "video":
                                form.children('.form-content').children('.col-lg-6').children('.input-box').children('.form-group').children('input[type=file]').siblings('span.error_message').html(error_msg);
                                break;
                        }
                    }
                }
            });
        });

        function getExtension(filename) {
            var parts = filename.split('/');
            return parts[parts.length - 1];
        }

        function isVideo(filename) {
            if (filename && filename.length > 0) {
                var ext = getExtension(filename);
                switch (ext.toLowerCase()) {
                    case 'mp4':
                        return true;
                }
            }
            return false;
        }
    </script>
@endpush
