@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Create Quiz Sections')
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
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.quiz_sections')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="user-form">
                                <div class="contact-form-action">
                                    <form method="post"
                                          action="{{ route('teacher.courses.quizzes.store_sections', ['course'=>$course->slug, 'quiz' => $quiz->id]) }}"
                                          enctype="multipart/form-data" id="form">
                                        @csrf
                                        <div class="row section-inputs">
                                            <div class="col-12">
                                                <div class="row section">
                                                    <div class="col-8">
                                                        <div class="input-box">
                                                            <label class="label-text">
                                                                @lang('site.section_name')
                                                                <span class="primary-color-2 ml-1">*</span>
                                                            </label>
                                                            <div class="form-group">
                                                                <input class="form-control"
                                                                       type="text" name="sections[]" required>
                                                                <span class="la la-file-text input-icon"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col-12 -->
                                        </div><!-- end row -->
                                        <div class="row">
                                            <div class="col-12">
                                                <button class="btn btn-info" id="add-new-input">
                                                    @lang('site.add_new_section')
                                                    <i class="las la-plus"></i>
                                                </button>
                                            </div>
                                        </div><!-- end row -->
                                        <hr>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <button class="theme-btn" type="submit">
                                                    @lang('site.next')
                                                    @if(app()->getLocale() == 'en')
                                                        <i class="las la-arrow-circle-right"></i>
                                                    @else
                                                        <i class="las la-arrow-circle-left"></i>
                                                    @endif
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
            @include('layouts.teacher._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection
@push('scripts')
    <script>
        $('#add-new-input').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $('.section-inputs .col-12').append(`
                <div class="row section">
                    <div class="col-8">
                        <div class="input-box">
                            <label class="label-text">
                                @lang('site.section_name')
            <span class="primary-color-2 ml-1">*</span>
        </label>
        <div class="form-group">
            <input class="form-control"
                   type="text" name="sections[]" required>
            <span class="la la-file-text input-icon"></span>
        </div>
    </div>
</div>
<div class="col-4 d-flex align-items-center mt-3">
    <button class="btn btn-danger delete-row">
        <i class="la la-trash-o"></i>
@lang('site.remove')
            </button>
        </div>
    </div>
`);
        });
        $(document).on('click', '.delete-row', function (e) {
            e.preventDefault();
            $(this).parent().parent().remove()
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
