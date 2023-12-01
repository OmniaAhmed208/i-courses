@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Create Course')
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
                                    <form method="post" action="{{ route('teacher.courses.first_step') }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.course_pic')<span
                                                            class="primary-color-2 ml-1">*</span></label>
                                                    <div class="form-group mb-0">
                                                        <div class="upload-btn-box course-photo-btn">
                                                            <input type="file" name="image" class="filer_input"
                                                                   data-jfiler-extensions="jpg, jpeg, png">
                                                            @error('image')
                                                            <span class="text-danger font-size-12">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-12 -->
                                            <hr>
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.course_title')
                                                        <span class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <input class="form-control @error('title') error @enderror"
                                                               type="text" name="title"
                                                               placeholder="@lang('site.course_title')"
                                                               value="{{ old('title') }}"
                                                        >
                                                        <span class="la la-file-text-o input-icon"></span>
                                                        @error('title')
                                                        <span class="text-danger font-size-12">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.course_category')</label>
                                                    <div class="form-group">
                                                        <div class="sort-ordering user-form-short">
                                                            <select class="sort-ordering-select" name="category_id">
                                                                @foreach($categories as $category)
                                                                    <option
                                                                        value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('category_id')
                                                            <span class="text-danger font-size-12">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.course_price')<span
                                                            class="primary-color-2 ml-1">*</span></label>
                                                    <div class="form-group">
                                                        <input class="form-control @error('price') error @enderror"
                                                               type="text" name="price"
                                                               placeholder="e.g 250"
                                                               value="{{ old('price') }}">
                                                        <span class="la la-dollar input-icon"></span>
                                                        @error('price')
                                                        <span class="text-danger font-size-12">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-12 -->
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.course_language')
                                                        <span class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <div class="sort-ordering user-form-short">
                                                            <select class="sort-ordering-select" name="language">
                                                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                                    <option
                                                                        value="{{ $localeCode }}"
                                                                        {{ $localeCode  == old('language') ? 'selected' : '' }}>
                                                                        {{ $properties['native'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('language')
                                                            <span class="text-danger font-size-12">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="input-box">
                                                    <label class="label-text">
                                                        @lang('site.course_level')
                                                        <span class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <div class="sort-ordering user-form-short">
                                                            <select class="sort-ordering-select" name="level">
                                                                <option
                                                                    value="all" {{ old('level') == 'all' ? 'selcted' : '' }}>
                                                                    @lang('site.all_levels')
                                                                </option>
                                                                <option
                                                                    value="beginner" {{ old('level') == 'beginner' ? 'selcted' : '' }}>
                                                                    @lang('site.beginner')
                                                                </option>
                                                                <option
                                                                    value="intermediate" {{ old('level') == 'intermediate' ? 'selcted' : '' }}>
                                                                    @lang('site.intermediate')
                                                                </option>
                                                                <option
                                                                    value="expert" {{ old('level') == 'expert' ? 'selcted' : '' }}>
                                                                    @lang('site.expert')
                                                                </option>
                                                            </select>
                                                            @error('level')
                                                            <span class="text-danger font-size-12">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-12">
                                                <div class="input-box">
                                                    <label class="label-text">
                                                        @lang('site.course_requirements')
                                                        <span class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                    <textarea
                                                        class="message-control form-control @error('requirements') error @enderror"
                                                        name="requirements"
                                                        placeholder="@lang('site.course_requirements_placeholder')">{{ old('requirements') }}</textarea>
                                                        <span class="la la-pencil input-icon"></span>
                                                        @error('requirements')
                                                        <span class="text-danger font-size-12">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-12 -->
                                            <div class="col-lg-12">
                                                <div class="input-box">
                                                    <label class="label-text">
                                                        @lang('site.course_description')
                                                        <span class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                    <textarea
                                                        class="message-control form-control @error('description') error @enderror"
                                                        name="description"
                                                        placeholder="@lang('site.course_description_placeholder')">{{ old('description') }}</textarea>
                                                        <span class="la la-pencil input-icon"></span>
                                                        @error('description')
                                                        <span class="text-danger font-size-12">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-12 -->
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
@push('scripts')
    <script src="https://cdn.tiny.cloud/1/ow3lol1pn2phugdee2b1xqtb4f8p1ppbgozz5osdavpggs26/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 500,
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
            },
            toolbar: "undo redo | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | fontsizeselect",
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            ],
            tinycomments_author: 'MAX',
        });
    </script>
@endpush
