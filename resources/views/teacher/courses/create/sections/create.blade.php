@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Create Course Sections')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex flex-column justify-content-center">
                            <h3 class="widget-title">@lang('site.add_new_section')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="user-form">
                                <div class="contact-form-action">
                                    <form method="POST"
                                          action="{{ route('teacher.courses.sections.store', $course->slug) }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.name')<span
                                                            class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <input class="form-control @error('name') error @enderror"
                                                               type="text" name="name"
                                                               placeholder="@lang('site.name')" required>
                                                        <span class="la la-file-text-o input-icon"></span>
                                                        @error('name')
                                                        <span class="text-danger font-size-12">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="label-text">@lang('site.section_parent')</label>
                                                <div class="form-group">
                                                    <div class="sort-ordering user-form-short">
                                                        <select class="sort-ordering-select" name="parent_id">
                                                            <option selected
                                                                    value="">@lang('site.select_section_parent')</option>
                                                            @foreach($sections as $section)
                                                                <option
                                                                    value="{{ $section->id }}">{{ $section->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('parent_id')
                                                        <span class="text-danger font-size-12">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="theme-btn">
                                                    <i class="la la-plus"></i>
                                                    @lang('site.create')
                                                </button>
                                            </div>
                                        </div>
                                    </form><!-- end row -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.admin._dashboard_footer')
        </div>
    </div>
@endsection
