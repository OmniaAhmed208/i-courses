@extends('layouts.admin.app')
@section('title', setting('website_name') . ' Courses')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex align-items-center">
                            <h3 class="widget-title">"{{ $course->title }}" <span
                                    class="font-size-14">@lang('site.generated_students')</span></h3>
                            <div class="ml-3">
                                <a href="{{ route('admin.courses.download_students', $course->slug) }}?course={{ $course->slug }}">
                                    <button type="submit"
                                            class="theme-btn d-flex align-items-center justify-content-center">
                                        <i class="la la-file-excel-o la-2x mr-2"></i>
                                        @lang('site.download_excel')
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="card-box-shared-body">
                            <h3 class="widget-title font-size-18 mb-3">@lang('site.generate_students')</h3>
                            <form action="{{ route('admin.courses.generate_students', $course->slug) }}" method="post">
                                @csrf
                                <input type="hidden" name="course" value="{{ $course->slug }}">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input type="text" name="group_name" id="group_name"
                                                   class="form-control @error('group_name') is-invalid @enderror"
                                                   autocomplete="off"
                                                   placeholder="@lang('site.group_name')"
                                            >
                                            @error('group_name')
                                            <span class="text-danger font-size-12">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input type="number" min="1" name="students_number" id="number"
                                                   class="form-control @error('students_number') is-invalid @enderror"
                                                   autocomplete="off"
                                                   placeholder="@lang('site.number_of_students') *"
                                                   required>
                                            @error('students_number')
                                            <span class="text-danger font-size-12">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button type="submit"
                                                    class="theme-btn d-flex align-items-center justify-content-center"
                                                    id="generate">
                                                <i class="la la-cogs la-2x mr-2"></i>
                                                @lang('site.generate')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="statement-table withdraw-table d-flex table-responsive mb-5">
                                <div class="statement-header">
                                    <a href="{{ route('admin.courses.generated_students', $course->slug) }}">
                                        <button class="theme-btn d-flex align-items-center justify-content-center">
                                            <i class="las la-user-graduate la-2x mr-2"></i>
                                            @lang('site.all_students')
                                        </button>
                                    </a>
                                </div>
                                <div class="statement-header pl-3">
                                    <a href="{{ route('admin.courses.groups', $course->slug) }}">
                                        <button class="theme-btn d-flex align-items-center justify-content-center">
                                            <i class="las la-users la-2x mr-2"></i>
                                            @lang('site.groups')
                                        </button>
                                    </a>
                                </div>
                                <div class="statement-header pl-3">
                                    <a href="{{ route('admin.courses.students.edit_bulk', $course->slug) }}">
                                        <button class="theme-btn d-flex align-items-center justify-content-center">
                                            <i class="las la-edit la-2x mr-2"></i>
                                            @lang('site.edit_bulk_students')
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex align-items-center">
                            <h3 class="widget-title">
                                @lang('site.update_students_data')
                            </h3>
                        </div>
                        <div class="card-box-shared-body">
                            <form action="{{ route('admin.courses.upload_students', $course->slug) }}"
                                  enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="col-lg-12 col-sm-12">
                                    <div class="input-box">
                                        <label class="label-text">@lang('site.upload_file')</label>
                                        <div class="form-group mb-0">
                                            <div class="upload-btn-box resource-photo-btn">
                                                <input type="file" name="file"
                                                       class="excel_input"
                                                       data-jfiler-extensions="xlsx, xls">
                                                @error('file')
                                                <span
                                                    class="text-danger font-size-12">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="theme-btn d-flex align-items-center">
                                    <i class="las la-cloud-upload-alt la-2x mr-2"></i>
                                    @lang('site.upload_excel')
                                </button>
                            </form>
                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
            @include('layouts.admin._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection

@push('scripts')
    <script>
        $("#generate").on('click', function () {
            $('.preloader').fadeIn();
        });
    </script>
@endpush
