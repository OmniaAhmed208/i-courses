@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Answer Question')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex justify-content-between">
                            <h3 class="widget-title">@lang('site.answer_question')</h3>
                        </div>
                        <form
                            action="{{ route('teacher.courses.qas.answer', ['course' => $course->slug, 'qa' => $qa->id]) }}"
                            method="POST">
                            @csrf
                            <div class="card-box-shared-body">
                                <p class="text-dark h4">{{ $qa->question }}</p>
                                <p>{{ $qa->created_at->diffForHumans() }}</p>
                                <hr>
                                <div class="user-form">
                                    <div class="contact-form-action">
                                        <div class="row form-content">
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-box">
                                                    <label class="label-text" for="answer">
                                                        @lang('site.answer')
                                                        <span class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <textarea name="answer" id="answer" rows="7"
                                                                  class="form-control @error('answer') error @enderror">{{ old('answer') }}</textarea>
                                                        <span class="la la-question-circle input-icon"></span>
                                                        @error('answer')
                                                        <span class="text-danger error_message">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="theme-btn">@lang('site.answer_question')</button>
                            </div><!-- end card-box-shared-body -->
                        </form>
                    </div><!-- end card-box-shared -->
                </div><!-- end col-lg-12 -->
            </div>
        </div>
    </div>
@endsection
