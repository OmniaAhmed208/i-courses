@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' ' . $quiz->name)
@section('content')
    <div class="dashboard-content-wrap">
        <div class="quiz-ans-wrap padding-top-80px padding-bottom-80px">
            <div class="container">
                <form
                    action="{{ route('teacher.courses.quizzes.submit_final_mark', ['course' => $course, 'quiz' => $quiz->id, 'quiz_attempt' => $quiz_attempt->id]) }}"
                    method="post">
                    @csrf

                    @foreach($quiz->sections as $section)
                        @if(count($section->questions) > 0)
                            <h1 class="mb-3">{{ $section->title }}</h1>
                            <div class="row mb-4">
                                @foreach($section->questions as $index => $question)

                                    <div class="col-lg-12">
                                        <div class="quiz-ans-content">
                                            <div class="d-flex align-items-center">
                                            <span
                                                class="quiz-count icon-element icon--element bg-color-1 text-white mr-2">
                                                {{ $index + 1 }}
                                            </span>
                                                <div
                                                    class="widget-title font-weight-semi-bold w-100 d-flex justify-content-between question_header_border py-3">
                                                    <div>{!! $question->title !!}</div>
                                                    <span
                                                        class="font-size-14 {{ !$quiz_attempt->is_final_mark && $question->type == 'essay' ? 'text-danger' : '' }}">
                                                    {{ !$quiz_attempt->is_final_mark && $question->type == 'essay' ? __('site.question_didnt_marked') : '' }} ({{ $quiz_attempt->getAnswerById($question->id) ? $quiz_attempt->getAnswerById($question->id)->mark : '0' }}/{{ $question->mark }})
                                                </span>
                                                </div>
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
                                            @if($question->type == 'mcq')
                                                <ul class="quiz-result-list pt-4 pl-3 mb-4">
                                                    @foreach($question->choices as $key => $choice)
                                                        <li class="primary-color mb-2">
                                                            @if($choice->correct)
                                                                <span
                                                                    class="icon-element icon--element icon-success mr-2">
                                                                <i class="la la-check"></i>
                                                            </span>
                                                            @elseif($quiz_attempt->getAnswerById($question->id) && !$choice->correct && $quiz_attempt->getAnswerById($question->id)->answer == $choice->title)
                                                                <span
                                                                    class="icon-element icon--element icon-error mr-2">
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
                                                <ul class="quiz-result-list pt-4 pl-3 mb-4">
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
                                                <ul class="quiz-result-list pt-4 pl-3 mb-4">
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
                                                        <hr>
                                                        <li>
                                                            <div class="col-lg-6 col-sm-12">
                                                                <label
                                                                    for="{{ $question->id }}">@lang('site.mark')</label>
                                                                <input type="number" min="0" max="{{$question->mark}}"
                                                                       id="{{ $question->id }}"
                                                                       name="{{ $question->id }}"
                                                                       class="form-control "
                                                                       required>
                                                            </div>
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
                        <button class="theme-btn" type="submit">
                            <i class="las la-check"></i>
                            @lang('site.submit_marks')
                        </button>
                    </div>
                </form>
            </div><!-- end container -->
        </div>
    </div>
@endsection
