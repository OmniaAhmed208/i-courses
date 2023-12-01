@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Edit Course Section')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex flex-column justify-content-center">
                            <h3 class="widget-title">@lang('site.edit') {{ $section->name }}</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="user-form">
                                <div class="contact-form-action">
                                    <form method="POST"
                                          action="{{ route('teacher.courses.sections.update', ['course' => $course->slug, 'section' => $section->id]) }}">
                                        @csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.name')<span
                                                            class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <input class="form-control @error('name') error @enderror"
                                                               type="text" name="name"
                                                               placeholder="@lang('site.name')"
                                                               value="{{ old('name', $section->name) }}"
                                                               required>
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
                                                            <option
                                                                value="">@lang('site.select_section_parent')</option>
                                                            @foreach($sections as $sub_section)
                                                                @if($sub_section->id != $section->id)
                                                                    <option
                                                                        value="{{ $sub_section->id }}"
                                                                        {{ $section->parent && $sub_section->id == $section->parent->id ? 'selected' : '' }}
                                                                    >
                                                                        {{ $sub_section->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="theme-btn">
                                                    <i class="la la-edit"></i>
                                                    @lang('site.edit')
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
