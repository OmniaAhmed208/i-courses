@extends('layouts.teacher.app')
@section('title', __('site.main_title') . 'Update Questions')
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
            @if(count($quiz->questions) > 0)
                @foreach($quiz->questions as $index => $qestion)
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="card-box-shared">
                                <div class="card-box-shared-title d-flex justify-content-between">
                                    <h3 class="widget-title">@lang('site.question') {{ $index + 1 }}</h3>
                                </div>
                                <div class="card-box-shared-body">
                                    <div class="user-form">
                                        <form
                                            action="{{ route('teacher.courses.quizzes.update_questions', ['course' => $course->slug, 'quiz' => $quiz->id, 'question' => $qestion->id]) }}">
                                            <div class="contact-form-action">
                                                <div class="row form-content">
                                                    <div class="col-lg-8 col-sm-8">
                                                        <div class="input-box">
                                                            <label class="label-text">@lang('site.question_title')
                                                                <span class="primary-color-2 ml-1">*</span>
                                                            </label>
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="title"
                                                                       placeholder="@lang('site.question_title')"
                                                                       value="{{ old('title', $qestion->title) }}">
                                                                <span class="la la-question input-icon"></span>
                                                                <span class="text-danger error_message"></span>
                                                            </div>
                                                        </div>
                                                    </div><!-- end col-lg-8 -->
                                                    <div class="col-lg-4 col-sm-4">
                                                        <div class="input-box">
                                                            <label class="label-text">@lang('site.question_marks')
                                                                <span class="primary-color-2 ml-1">*</span>
                                                            </label>
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="mark"
                                                                       placeholder="lang('site.question_marks')"
                                                                       value="{{ old('mark', $qestion->mark) }}">
                                                                <span class="la la-pen-alt input-icon"></span>
                                                                <span class="text-danger error_message"></span>
                                                            </div>
                                                        </div>
                                                    </div><!-- end col-lg-4 -->
                                                    <div class="col-lg-6 col-sm-6">
                                                        <div class="input-box">
                                                            <label class="label-text">@lang('site.question_type')
                                                                <span class="primary-color-2 ml-1">*</span>
                                                            </label>
                                                            <div class="form-group">
                                                                <div class="sort-ordering user-form-short">
                                                                    <select class="sort-ordering-select type"
                                                                            name="type">
                                                                        <option
                                                                            value="mcq" {{ $qestion->type == 'mcq' ? 'selected' : '' }}>
                                                                            @lang('site.mcq')
                                                                        </option>
                                                                        <option
                                                                            value="true_false" {{ $qestion->type == 'true_false' ? 'selected' : '' }}>
                                                                            @lang('site.true_false')
                                                                        </option>
                                                                        <option
                                                                            value="essay" {{ $qestion->type == 'essay' ? 'selected' : '' }}>
                                                                            @lang('site.essay')
                                                                        </option>
                                                                    </select>
                                                                    <span
                                                                        class="text-danger font-size-12 d-none"></span>
                                                                    <span class="text-danger error_message"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end col-lg-4 -->
                                                    <div class="col-lg-6 col-sm-6">
                                                        <div class="input-box">
                                                            <label class="label-text">@lang('site.question_section')
                                                                <span
                                                                    class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <div class="sort-ordering user-form-short">
                                                                    <select class="sort-ordering-select"
                                                                            name="quiz_section_id" id="quiz_section">
                                                                        @foreach($quiz->sections as $section)
                                                                            <option
                                                                                value="{{ $section->id }}" {{ $qestion->quiz_section_id == $section->id ? 'selected' : '' }}>{{ $section->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span
                                                                        class="text-danger font-size-12 d-none"></span>
                                                                    <span class="text-danger error_message"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end col-lg-4 -->

                                                    <div
                                                        class="col-lg-12 col-sm-12 {{ $qestion->type != 'mcq' ? 'd-none' : '' }} mcq">
                                                        <div class="input-box">
                                                            <label class="label-text">@lang('site.choices')</label>
                                                            <div class="form-group">
                                                                @if($qestion->type == 'mcq')
                                                                    @foreach(json_decode($qestion->choices) as $index =>$choice)
                                                                        <div class="row align-items-center">
                                                                            <div class="col-1">
                                                                                <input type="radio"
                                                                                       name="correct_answers[0]"
                                                                                       value="{{ $index + 1 }}" {{ $choice->correct ? 'checked' : '' }}>
                                                                            </div>
                                                                            <div class="col-11">
                                                                                <input type="text"
                                                                                       class="form-control mb-1"
                                                                                       placeholder="Answer {{ $index + 1 }}"
                                                                                       name="answers[]"
                                                                                       value="{{ old('answers[' . ($index + 1) . ']', $choice->title) }}">
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    <div class="row align-items-center">
                                                                        <div class="col-1">
                                                                            <input type="radio"
                                                                                   name="correct_answers[0]"
                                                                                   value="1">
                                                                        </div>
                                                                        <div class="col-11">
                                                                            <input type="text"
                                                                                   class="form-control mb-1"
                                                                                   placeholder="Answer 1"
                                                                                   name="answers[]">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row align-items-center">
                                                                        <div class="col-1">
                                                                            <input type="radio"
                                                                                   name="correct_answers[0]"
                                                                                   value="2">
                                                                        </div>
                                                                        <div class="col-11">
                                                                            <input type="text"
                                                                                   class="form-control mb-1"
                                                                                   placeholder="Answer 2"
                                                                                   name="answers[]">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row align-items-center">
                                                                        <div class="col-1">
                                                                            <input type="radio"
                                                                                   name="correct_answers[0]"
                                                                                   value="3">
                                                                        </div>
                                                                        <div class="col-11">
                                                                            <input type="text"
                                                                                   class="form-control mb-1"
                                                                                   placeholder="Answer 3"
                                                                                   name="answers[]">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row align-items-center">
                                                                        <div class="col-1">
                                                                            <input type="radio"
                                                                                   name="correct_answers[0]"
                                                                                   value="4">
                                                                        </div>
                                                                        <div class="col-11">
                                                                            <input type="text"
                                                                                   class="form-control"
                                                                                   placeholder="Answer 4"
                                                                                   name="answers[]">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-lg-4 col-sm-4 {{ $qestion->type != 'true_false' ? 'd-none' : '' }} true_false">
                                                        <div class="input-box">
                                                            <label
                                                                class="label-text">@lang('site.correct_answer')</label>
                                                            <div class="form-group">
                                                                <select name="correct_answers[1]"
                                                                        class="form-control">
                                                                    <option
                                                                        value="true" {{ $qestion->type == 'true_false' && json_decode($qestion->choices)->correct_val == 'true' ? 'selected' : '' }}>
                                                                        @lang('site.true')
                                                                    </option>
                                                                    <option
                                                                        value="false" {{ $qestion->type == 'true_false' && json_decode($qestion->choices)->correct_val == 'false' ? 'selected' : '' }}>
                                                                        @lang('site.false')
                                                                    </option>
                                                                </select>
                                                                <span class="la la-question input-icon"></span>
                                                                <span class="text-danger error_message"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end row -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button class="theme-btn">
                                                            <i class="la la-update"></i>
                                                            @lang('site.update')
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div><!-- end card-box-shared-body -->
                            </div><!-- end card-box-shared -->
                        </div><!-- end col-lg-12 -->
                    </div>
                @endforeach
            @endif

            @include('layouts.teacher._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection
@push('scripts')
    <script>


        $(document).on('change', '.type', function () {
            let selected_value = $(this).val();
            if (selected_value === 'mcq') {
                $(this).parent().parent().parent().parent().parent().siblings('.mcq').removeClass('d-none');
                $(this).parent().parent().parent().parent().parent().siblings('.true_false').addClass('d-none');
            } else if (selected_value === 'true_false') {
                $(this).parent().parent().parent().parent().parent().siblings('.true_false').removeClass('d-none');
                $(this).parent().parent().parent().parent().parent().siblings('.mcq').addClass('d-none');
            } else {
                $(this).parent().parent().parent().parent().parent().siblings('.true_false').addClass('d-none');
                $(this).parent().parent().parent().parent().parent().siblings('.mcq').addClass('d-none');
            }
        });
    </script>
@endpush
