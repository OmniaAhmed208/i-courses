@extends('layouts.course.app')
@section('title', setting('website_name') . ' ' . $assignment->name)
@section('content')
    <section class="quiz-wrap">
        <div class="quiz-content-wrap bg-black padding-top-60px padding-bottom-60px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="quiz-content text-center">
                            <p class="lead font-weight-regular font-size-18 text-color-rgba mb-0 pb-2"
                               id="header_title">@lang('site.assignments_will_finish_after')</p>
                            <h2 class="section__title text-white padding-bottom-30px" id="getting-started">
                                {{ $assignment->end_time->diffForHumans() }}
                            </h2>
                        </div>
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end quiz-content-wrap -->
        <div class="quiz-action-nav bg-white py-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="quiz-action-content d-flex align-items-center justify-content-between">
                            <ul class="quiz-nav d-flex align-items-center">
                                <li>
                                    <i class="las la-paste font-size-20 mr-2"></i>
                                    {{ $assignment->name }}
                                </li>
                            </ul>
                        </div>
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end quiz-action-nav -->
        <div class="quiz-ans-wrap padding-top-80px padding-bottom-80px">
            <div class="container">
                @foreach($assignment->sections as $section)
                    @if(count($section->questions) > 0)
                        <h1 class="mb-3 {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">{{ $section->title }}</h1>
                        <div class="row mb-4">
                            @php
                                $questions = $section->questions->shuffle();
                            @endphp
                            @foreach($questions as $index => $question)
                                @if(!auth()->user()->studentAnswersAssignmentQuestion($assignment, $question))
                                    <form id="answer_form"
                                          action="{{ route('courses.assignments.submit_single_question', ['course' => $course, 'assignment' => $assignment->id, 'question' => $question->id]) }}"
                                          method="post" enctype="multipart/form-data" class="col-12 mb-4">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12 mb-4">
                                                <div class="quiz-ans-content">
                                                    <div class="d-flex align-items-center">
                                                    <span
                                                        class="quiz-count icon-element icon--element bg-color-1 text-white mr-2">{{ $index + 1 }}
                                                    </span>
                                                        <div
                                                            class="widget-title font-weight-semi-bold w-100 d-flex justify-content-between question_header_border py-3">
                                                            <div>{!! $question->title !!}</div>
                                                            <span class="font-size-14">({{ $question->mark }})</span>
                                                        </div>
                                                    </div>
                                                    @if($question->type == 'mcq')
                                                        <ul class="py-3 ml-3 {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                                            @foreach($question->choices as $key => $choice)
                                                                <li>
                                                                    <div class="custom-checkbox">
                                                                        <input type="radio" name="answer"
                                                                               value="{{ $key + 1 }}" required>
                                                                        <label>
                                                                            {{ $choice->title }}
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @elseif($question->type == 'true_false')
                                                        <ul class="py-3 ml-3 {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                                            <li>
                                                                <div class="custom-checkbox">
                                                                    <input type="radio" name="answer"
                                                                           value="true" required>
                                                                    <label>@lang('site.true')</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-checkbox">
                                                                    <input type="radio" name="answer"
                                                                           value="false" required>
                                                                    <label>@lang('site.false')</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    @elseif($question->type == 'essay')
                                                        <ul class="py-3 ml-3 {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                                            <li>
                                                            <textarea rows="7" class="form-control"
                                                                      name="answer">
                                                            </textarea>
                                                            </li>
                                                            <li>
                                                                <div class="input-box">
                                                                    <label
                                                                        class="label-text">@lang('site.or_upload_images')
                                                                        <span
                                                                            class="primary-color-2 ml-1">*</span>
                                                                    </label>
                                                                    <div class="form-group mb-0">
                                                                        <div class="upload-btn-box course-photo-btn">
                                                                            <input type="file"
                                                                                   name="images"
                                                                                   class="answer"
                                                                                   data-jfiler-extensions="jpg, jpeg, png">
                                                                            @error('image')
                                                                            <span
                                                                                class="text-danger font-size-12">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    @endif
                                                </div>
                                            </div><!-- end col-lg-12 -->

                                            <div class="col-12  {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                                <button type="submit" class="theme-btn">
                                                    @lang('site.submit_answer')
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            @endforeach
                        </div><!-- end row -->
                        <hr>
                    @endif
                @endforeach

            </div><!-- end container -->
        </div><!-- end quiz-ans-wrap -->
    </section><!-- end quiz-wrap -->
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.filer.min.js') }}"></script>
@endpush
