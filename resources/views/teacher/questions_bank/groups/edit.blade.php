@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Edit Group')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex justify-content-between">
                            <h3 class="widget-title">@lang('site.edit_group')</h3>
                        </div>
                        <form
                            action="{{ route('teacher.questions_bank.groups.update', ['group' => $group->id]) }}"
                            method="POST">
                            @csrf
                            @method('put')
                            <div class="card-box-shared-body">
                                <div class="user-form">
                                    <div class="contact-form-action">
                                        <div class="row form-content">
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.group_name')
                                                        <span class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <input class="form-control @error('name') error @enderror"
                                                               type="text" name="name"
                                                               value="{{ $group->name }}"
                                                               placeholder="@lang('site.group_name')">
                                                        <span class="la la-question input-icon"></span>
                                                        @error('name')
                                                        <span class="text-danger error_message">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-box">
                                                    <label class="label-text" for="course_id">@lang('site.courses')
                                                        <span class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <div class="sort-ordering user-form-short">
                                                            <select name="course_id" id="course_id"
                                                                    class="sort-ordering-select">
                                                                @foreach($courses as $course)
                                                                    <option
                                                                        value="{{ $course->id }}">{{ $course->getTranslation('title', 'en') }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('name')
                                                            <span
                                                                class="text-danger error_message">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($errors->any())
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
                                        </div><!-- end row -->
                                    </div>
                                </div>
                                <button type="submit" class="theme-btn">@lang('site.edit_group')</button>
                            </div><!-- end card-box-shared-body -->
                        </form>
                    </div><!-- end card-box-shared -->
                </div><!-- end col-lg-12 -->
            </div>
        </div>
    </div>
@endsection
