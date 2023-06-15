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
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.course_sections')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="user-form">
                                <div class="contact-form-action">
                                    <form method="post"
                                          action="{{ route('teacher.courses.second_step', $course->slug) }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="row section-inputs">
                                            <div class="col-12">
                                                @if(count($course->sections) > 0)
                                                    @foreach($course->sections as $section)
                                                        <div class="row section">
                                                            <div class="col-8">
                                                                <div class="input-box">
                                                                    <label class="label-text">
                                                                        @lang('site.section_name')
                                                                        <span class="primary-color-2 ml-1">*</span>
                                                                    </label>
                                                                    <div class="form-group">
                                                                        <input class="form-control"
                                                                               type="text" name="sections[]" required
                                                                               value="{{ $section->name }}">
                                                                        <span class="la la-file-text input-icon"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
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
                                                @endif
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
@endpush
