@extends('layouts.course.app')
@section('title', setting('website_name') . ' ' . $quiz->name)
@section('content')
    <section class="quiz-wrap">
        <div class="quiz-content-wrap bg-black padding-top-60px padding-bottom-60px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="quiz-content text-center">
                            @php
                                $percentage = ($quiz->total_mark > 0) ? number_format($quiz_attempt->mark  / $quiz->total_mark * 100, 2) : 0;
                            @endphp
                            <h2 class="section__title text-white padding-bottom-30px {{ $percentage >= 50 ? 'primary-color-2' : 'text-danger' }}">
                                {{ $percentage }} %
                            </h2>
                            <p class="lead font-weight-regular font-size-18 text-color-rgba mb-0 pb-2">
                                @lang('site.your_scores'): {{ $quiz_attempt->mark }}/{{ $quiz->total_mark }}
                            </p>
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
                                    {{ $quiz->name }}
                                </li>
                                <li>
                                    <i class="la la-check-circle font-size-20 mr-2"></i>
                                    {{ $quiz_attempt->mark }} / {{ $quiz->total_mark }} @lang('site.scores')
                                </li>
                                @if(!$quiz_attempt->is_final_mark)
                                    <li class="text-danger">@lang('site.not_final_score')
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end quiz-action-nav -->
        <div class="quiz-ans-wrap padding-top-80px padding-bottom-80px">
            <div class="container">
                @foreach($quiz->sections as $section)
                    @if(count($section->questions) > 0)
                        <h1 class="mb-3 {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">{{ $section->title }}</h1>
                        <div class="row mb-4">
                            @foreach($section->questions as $index => $question)
                                <div class="col-lg-12">
                                    <div class="quiz-ans-content">
                                        <div class="d-flex align-items-center">
                                    <span
                                        class="quiz-count icon-element icon--element bg-color-1 text-white mr-2">{{ $index + 1 }}</span>
                                            <div
                                                class="widget-title font-weight-semi-bold w-100 d-flex justify-content-between question_header_border py-3">
                                                <div>{!! $question->title !!}</div>
                                                @if($quiz_attempt->getAnswerById($question->id))
                                                    <span
                                                        class="font-size-14 {{ !$quiz_attempt->is_final_mark && $question->type == 'essay' ? 'text-danger' : '' }}">
                                                    {{ !$quiz_attempt->is_final_mark && $question->type == 'essay' ? __('site.question_didnt_marked') : '' }} ({{ $quiz_attempt->getAnswerById($question->id)->mark }}/{{ $question->mark }})
                                                    </span>
                                                @else
                                                    <span class="font-size-14 text-danger">
                                                        @lang('site.you_didnt_answer') (0/{{ $question->mark }})
                                                    </span>
                                                @endif
                                                @if($question->picture)
                                                    <div class="d-block">
                                                        <a href="{{ asset('storage/' . $question->picture) }}"
                                                           target="_blank">
                                                            <img src="{{ asset('storage/' . $question->picture) }}"
                                                                 alt="{{ $quiz->name }}">
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        @if($question->type == 'mcq')
                                            <ul class="quiz-result-list pt-4 pl-3 mb-4 {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                                @foreach($question->choices as $key => $choice)
                                                    <li class="primary-color mb-2">

                                                        @if($choice->correct)
                                                            <span class="icon-element icon--element icon-success mr-2">
                                                                <i class="la la-check"></i>
                                                            </span>
                                                        @elseif($quiz_attempt->getAnswerById($question->id) && !$choice->correct && $quiz_attempt->getAnswerById($question->id)->answer == $choice->title)
                                                            <span class="icon-element icon--element icon-error mr-2">
                                                                {{ $key + 1 }}
                                                            </span>
                                                        @else
                                                            <span class="icon-element icon--element mr-2">
                                                                {{ $key + 1 }}
                                                            </span>
                                                        @endif
                                                        {{ $choice->title }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @elseif($question->type == 'true_false')
                                            <ul class="quiz-result-list pt-4 pl-3 mb-4 {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                                <li class="primary-color mb-2">
                                                    @if($question->choices->correct_val == "true")
                                                        <span class="icon-element icon--element icon-success mr-2">
                                                            <i class="la la-check"></i>
                                                        </span>
                                                    @elseif($quiz_attempt->getAnswerById($question->id) && $quiz_attempt->getAnswerById($question->id)->answer == "true" && $question->choices->correct_val == "false")
                                                        <span class="icon-element icon--element icon-error mr-2">
                                                            A
                                                        </span>
                                                    @else
                                                        <span class="icon-element icon--element mr-2">
                                                            A
                                                        </span>
                                                    @endif
                                                    @lang('site.true')
                                                </li>
                                                <li class="primary-color mb-2">
                                                    @if($question->choices->correct_val == "false")
                                                        <span class="icon-element icon--element icon-success mr-2">
                                                            <i class="la la-check"></i>
                                                        </span>
                                                    @elseif($quiz_attempt->getAnswerById($question->id) && $quiz_attempt->getAnswerById($question->id)->answer == "false" && $question->choices->correct_val == "true")
                                                        <span class="icon-element icon--element icon-error mr-2">
                                                            B
                                                        </span>
                                                    @else
                                                        <span class="icon-element icon--element mr-2">
                                                            B
                                                        </span>
                                                    @endif
                                                    @lang('site.false')
                                                </li>
                                            </ul>
                                        @elseif($question->type == 'essay' && $quiz_attempt->getAnswerById($question->id))
                                            <ul class="quiz-result-list pt-4 pl-3 mb-4 {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                                <li class="primary-color mb-2">
                                                    {{ $quiz_attempt->getAnswerById($question->id)->answer }}
                                                </li>
                                                @if(count($quiz_attempt->getAnswerById($question->id)->images) > 0)
                                                    <li class="primary-color mb-2">
                                                        <ul class="images-ul">
                                                            @foreach($quiz_attempt->getAnswerById($question->id)->images as $image)
                                                                <li>
                                                                    <a href="{{ asset('storage/'. $image) }}"
                                                                       target="_blank">
                                                                        <img src="{{ asset('storage/'. $image) }}"
                                                                             alt="">
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endif
                                            </ul>
                                        @endif
                                    </div>
                                </div><!-- end col-lg-12 -->
                            @endforeach
                        </div><!-- end row -->
                    @endif
                @endforeach
                <div class="row justify-content-center">
                    <a href="{{ route('courses.study', $course) }}">
                        <button class="theme-warning-btn">
                            <i class="las la-arrow-circle-left"></i>
                            @lang('site.back_to_course')
                        </button>
                    </a>
                </div>
            </div><!-- end container -->
        </div><!-- end quiz-ans-wrap -->
    </section><!-- end quiz-wrap -->
@endsection
