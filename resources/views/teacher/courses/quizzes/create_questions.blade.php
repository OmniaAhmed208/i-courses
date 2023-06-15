@extends('layouts.teacher.app')
@section('title', __('site.main_title') . 'Create Course')
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
            <form
                action="{{ route('teacher.courses.quizzes.store_questions', ['course' => $course->slug, 'quiz' => $quiz->id]) }}"
                method="POST" id="add_questions">
                @csrf
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="card-box-shared">
                            <div class="card-box-shared-title d-flex justify-content-between">
                                <h3 class="widget-title">@lang('site.question') 1</h3>
                            </div>
                            <div class="card-box-shared-body">
                                <div class="user-form">
                                    <div class="contact-form-action">
                                        <div class="row form-content">
                                            <div class="col-lg-8 col-sm-8">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.question_title')
                                                        <span class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" name="titles[]"
                                                               placeholder="@lang('site.question_title')">
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
                                                        <input class="form-control" type="text" name="marks[]"
                                                               placeholder="@lang('site.question_marks')">
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
                                                            <select class="sort-ordering-select type" name="types[]">
                                                                <option value="mcq">@lang('site.mcq')</option>
                                                                <option
                                                                    value="true_false">@lang('site.true_false')</option>
                                                                <option value="essay">@lang('site.essay')</option>
                                                            </select>
                                                            <span class="text-danger font-size-12 d-none"></span>
                                                            <span class="text-danger error_message"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-4 -->
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.question_section')<span
                                                            class="primary-color-2 ml-1">*</span></label>
                                                    <div class="form-group">
                                                        <div class="sort-ordering user-form-short">
                                                            <select class="sort-ordering-select"
                                                                    name="section_ids[]" id="quiz_section">
                                                                @foreach($sections as $section)
                                                                    <option
                                                                        value="{{ $section->id }}">{{ $section->title }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger font-size-12 d-none"></span>
                                                            <span class="text-danger error_message"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-4 -->
                                            <div class="col-lg-12 col-sm-12 mcq">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.choices')</label>
                                                    <div class="form-group">
                                                        <div class="row align-items-center">
                                                            <div class="col-1">
                                                                <input type="radio" name="correct_answers[1][]"
                                                                       value="1">
                                                            </div>
                                                            <div class="col-11">
                                                                <input type="text" class="form-control mb-1"
                                                                       placeholder="@lang('site.answer') 1"
                                                                       name="answers_1[]">
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="col-1">
                                                                <input type="radio" name="correct_answers[1][]"
                                                                       value="2">
                                                            </div>
                                                            <div class="col-11">
                                                                <input type="text" class="form-control mb-1"
                                                                       placeholder="@lang('site.answer') 2"
                                                                       name="answers_1[]">
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="col-1">
                                                                <input type="radio" name="correct_answers[1][]"
                                                                       value="3">
                                                            </div>
                                                            <div class="col-11">
                                                                <input type="text" class="form-control mb-1"
                                                                       placeholder="@lang('site.answer') 3"
                                                                       name="answers_1[]">
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="col-1">
                                                                <input type="radio" name="correct_answers[1][]"
                                                                       value="4">
                                                            </div>
                                                            <div class="col-11">
                                                                <input type="text" class="form-control"
                                                                       placeholder="@lang('site.answer') 4"
                                                                       name="answers_1[]">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-4 d-none true_false">

                                            </div>
                                            <div class="col-lg-4 col-sm-4 d-none essay">

                                            </div>
                                        </div><!-- end row -->
                                    </div>
                                </div>
                            </div><!-- end card-box-shared-body -->
                        </div><!-- end card-box-shared -->
                    </div><!-- end col-lg-12 -->
                </div>
                <div class="row mt-3 add-new-question-form">
                    <div class="col-lg-12">
                        <button class="theme-btn" id="add-new-question">
                            <i class="la la-plus-circle"></i>
                            @lang('site.add_new_question')
                        </button>
                    </div>
                </div>
                <hr>
                <div class="row my-3">
                    <div class="col-lg-12 text-center">
                        <button class="theme-btn" type="submit">
                            <i class="la la-check-circle"></i>
                            @lang('site.finish')
                        </button>

                    </div>
                </div>
            </form>
            @include('layouts.teacher._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection
@push('scripts')
    <script>
        let counter = 2;

        function init_after_dynamic_addition() {
            $('.sort-ordering-select').selectpicker({
                liveSearch: true,
                liveSearchPlaceholder: 'Search',
                liveSearchStyle: 'contains',
                size: 5
            });
            counter++;
        }

        $(document).on('change', '.type', function () {
            let selected_value = $(this).val();
            if (selected_value === 'mcq') {
                $(this).parent().parent().parent().parent().parent().siblings('.true_false').empty()
                $(this).parent().parent().parent().parent().parent().siblings('.mcq').append(`
                    <div class="input-box">
                        <label class="label-text">@lang('site.choices')</label>
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <input type="radio" name="correct_answers[${counter}][]"
                                           value="1">
                                </div>
                                <div class="col-11">
                                    <input type="text" class="form-control mb-1"
                                           placeholder="@lang('site.answer') 1" name="answers_${counter}[][]">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <input type="radio" name="correct_answers[${counter}][]"
                                           value="2">
                                </div>
                                <div class="col-11">
                                    <input type="text" class="form-control mb-1"
                                           placeholder="@lang('site.answer') 2" name="answers_${counter}[]">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <input type="radio" name="correct_answers[${counter}][]"
                                           value="3">
                                </div>
                                <div class="col-11">
                                    <input type="text" class="form-control mb-1"
                                           placeholder="@lang('site.answer') 3" name="answers_${counter}[]">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <input type="radio" name="correct_answers[${counter}][]"
                                           value="4">
                                </div>
                                <div class="col-11">
                                    <input type="text" class="form-control"
                                           placeholder="@lang('site.answer') 4" name="answers_${counter}[]">
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                $(this).parent().parent().parent().parent().parent().siblings('.mcq').removeClass('d-none');
                $(this).parent().parent().parent().parent().parent().siblings('.true_false').addClass('d-none');
            } else if (selected_value === 'true_false') {
                $(this).parent().parent().parent().parent().parent().siblings('.mcq').empty()
                $(this).parent().parent().parent().parent().parent().siblings('.true_false').append(`
                    <div class="input-box">
                        <label class="label-text">@lang('site.correct_answer')</label>
                        <div class="form-group">
                            <select name="correct_answers[]"
                                    class="form-control">
                                <option value="true">@lang('true')</option>
                                <option value="false">@lang('false')</option>
                            </select>
                            <span class="la la-question input-icon"></span>
                            <span class="text-danger error_message"></span>
                        </div>
                    </div>
                `)
                $(this).parent().parent().parent().parent().parent().siblings('.true_false').removeClass('d-none');
                $(this).parent().parent().parent().parent().parent().siblings('.mcq').addClass('d-none');
            } else {
                $(this).parent().parent().parent().parent().parent().siblings('.essay').append(`
                    <input type="hidden" name="correct_answers[]" value=""/>
                `)
                $(this).parent().parent().parent().parent().parent().siblings('.true_false').empty()
                $(this).parent().parent().parent().parent().parent().siblings('.mcq').empty()
            }
        });


        let quiz_sections_options = $('#quiz_section').html();

        $("#add-new-question").on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(".add-new-question-form").before(`
                <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex justify-content-between">
                            <h3 class="widget-title">@lang('site.question') ${counter}</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="user-form">
                                <div class="contact-form-action">
                                    <div class="row form-content">
                                        <div class="col-lg-8 col-sm-8">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.question_title')
            <span class="primary-color-2 ml-1">*</span>
        </label>
        <div class="form-group">
            <input class="form-control" type="text" name="titles[]"
                   placeholder="@lang('site.question_title')">
                                                    <span class="la la-question input-icon"></span>
                                                    <span class="text-danger error_message"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-4">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.question_marks')
            <span class="primary-color-2 ml-1">*</span>
        </label>
        <div class="form-group">
            <input class="form-control" type="text" name="marks[]"
                   placeholder="@lang('site.question_marks')">
                                                    <span class="la la-pen-alt input-icon"></span>
                                                    <span class="text-danger error_message"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.question_type')
            <span class="primary-color-2 ml-1">*</span>
        </label>
        <div class="form-group">
            <div class="sort-ordering user-form-short">
                <select class="sort-ordering-select type" name="types[]">
                    <option value="mcq">@lang('site.mcq')</option>
                                                            <option value="true_false">@lang('site.true_false')</option>
                                                            <option value="essay">@lang('site.essay')</option>
                                                        </select>
                                                        <span class="text-danger font-size-12 d-none"></span>
                                                        <span class="text-danger error_message"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.question_section')<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <div class="sort-ordering user-form-short">
                                                        <select class="sort-ordering-select" name="section_ids[]">
                                                                ${quiz_sections_options}
                                                        </select>
                                                        <span class="text-danger font-size-12 d-none"></span>
                                                        <span class="text-danger error_message"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 mcq">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.choices')</label>
                                                <div class="form-group">
                                                    <div class="row align-items-center">
                                                        <div class="col-1">
                                                            <input type="radio" name="correct_answers[${counter}][]" value="1">
                                                        </div>
                                                        <div class="col-11">
                                                            <input type="text" class="form-control mb-1"
                                                                   placeholder="@lang('site.answer') 1" name="answers_${counter}[]">
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center">
                                                        <div class="col-1">
                                                            <input type="radio" name="correct_answers[${counter}][]" value="2">
                                                        </div>
                                                        <div class="col-11">
                                                            <input type="text" class="form-control mb-1"
                                                                   placeholder="@lang('site.answer') 2" name="answers_${counter}[]">
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center">
                                                        <div class="col-1">
                                                            <input type="radio" name="correct_answers[${counter}][]" value="3">
                                                        </div>
                                                        <div class="col-11">
                                                            <input type="text" class="form-control mb-1"
                                                                   placeholder="@lang('site.answer') 3" name="answers_${counter}[]">
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center">
                                                        <div class="col-1">
                                                            <input type="radio" name="correct_answers[${counter}][]" value="4">
                                                        </div>
                                                        <div class="col-11">
                                                            <input type="text" class="form-control"
                                                                   placeholder="@lang('site.answer') 4" name="answers_${counter}[]">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-4 d-none true_false">

                                        </div>
                                        <div class="col-lg-4 col-sm-4 d-none essay">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `)
            init_after_dynamic_addition();
        });
    </script>
@endpush
