@extends('layouts.teacher.app')
@section('title', __('site.main_title') . 'Create Course')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex justify-content-between">
                            <h3 class="widget-title">@lang('site.add_new_question')</h3>
                        </div>
                        <form
                            action="{{ route('teacher.courses.quizzes.update_question', ['course' => $course->slug, 'quiz' => $quiz->id, 'question' => $question->id]) }}"
                            method="POST">
                            @csrf
                            @method('put')
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
                                                        <input class="form-control @error('title') error @enderror"
                                                               type="text" name="title"
                                                               value="{{ $question->title }}"
                                                               placeholder="@lang('site.question_title')">
                                                        <span class="la la-question input-icon"></span>
                                                        @error('title')
                                                        <span class="text-danger error_message">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-8 -->
                                            <div class="col-lg-4 col-sm-4">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.question_marks')
                                                        <span class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <input class="form-control @error('mark') error @enderror"
                                                               type="number" min="1" name="mark"
                                                               value="{{ $question->mark }}"
                                                               placeholder="@lang('site.question_marks')">
                                                        <span class="la la-pen-alt input-icon"></span>
                                                        @error('mark')
                                                        <span class="text-danger error_message">{{ $message }}</span>
                                                        @enderror
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
                                                            <select
                                                                class="sort-ordering-select type @error('type') error @enderror"
                                                                name="type">
                                                                <option
                                                                    value="mcq" {{ $question->type == 'mcq' ? 'selected' : '' }}>@lang('site.mcq')</option>
                                                                <option
                                                                    value="true_false" {{ $question->type == 'true_false' ? 'selected' : '' }}>@lang('site.true_false')</option>
                                                                <option
                                                                    value="essay" {{ $question->type == 'essay' ? 'selected' : '' }}>@lang('site.essay')</option>
                                                            </select>
                                                            @error('type')
                                                            <span
                                                                class="text-danger error_message">{{ $message }}</span>
                                                            @enderror
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
                                                            <select
                                                                class="sort-ordering-select @error('section_id') error @enderror"
                                                                name="section_id" id="quiz_section">
                                                                @foreach($sections as $section)
                                                                    <option
                                                                        value="{{ $section->id }}" {{ $question->section_id == $section->id ? 'selected' : '' }}>{{ $section->title }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('section_id')
                                                            <span
                                                                class="text-danger error_message">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-4 -->
                                            <div
                                                class="col-lg-12 col-sm-12 mcq {{ $question->type != 'mcq' ? 'd-none' : '' }}">
                                                @if($question->type == 'mcq')

                                                    <div class="input-box">
                                                        <label class="label-text">@lang('site.choices')</label>
                                                        <div class="form-group">
                                                            @foreach(json_decode($question->choices) as $index => $choice)
                                                                <div class="row align-items-center">
                                                                    <div class="col-1">
                                                                        <input type="radio"
                                                                               {{ $choice->correct ? 'checked' : '' }} name="correct_answer"
                                                                               value="{{ $index + 1 }}">
                                                                    </div>
                                                                    <div class="col-11">
                                                                        <input type="text" class="form-control mb-1"
                                                                               value="{{ $choice->title }}"
                                                                               placeholder="@lang('site.answer') 1"
                                                                               name="answers[]">
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                @endif
                                            </div>
                                            <div
                                                class="col-lg-4 col-sm-4 true_false {{ $question->type != 'true_false' ? 'd-none' : '' }}">
                                                @if($question->type == 'true_false')
                                                    <div class="input-box">
                                                        <label class="label-text">@lang('site.correct_answer')</label>
                                                        <div class="form-group">
                                                            <select name="correct_answer"
                                                                    class="form-control">
                                                                <option
                                                                    value="true" {{ $question->choices->correct_val == 'true' ? 'selected' : '' }}>@lang('site.true')</option>
                                                                <option
                                                                    value="false" {{ $question->choices->correct_val == 'false' ? 'selected' : '' }}>@lang('site.false')</option>
                                                            </select>
                                                            <span class="la la-question input-icon"></span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div
                                                class="col-lg-4 col-sm-4 essay {{ $question->type != 'essay' ? 'd-none' : '' }}"></div>

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
                                <button type="submit" class="theme-btn">@lang('site.update_question')</button>
                            </div><!-- end card-box-shared-body -->
                        </form>
                    </div><!-- end card-box-shared -->
                </div><!-- end col-lg-12 -->
            </div>
            @include('layouts.teacher._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection
@push('scripts')
    <script>
        $(document).on('change', '.type', function () {
            let selected_value = $(this).val();
            if (selected_value === 'mcq') {
                $(this).parent().parent().parent().parent().parent().siblings('.true_false').empty()
                $(this).parent().parent().parent().parent().parent().siblings('.essay').empty()
                $(this).parent().parent().parent().parent().parent().siblings('.mcq').append(`
                    <div class="input-box">
                        <label class="label-text">@lang('site.choices')</label>
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <input type="radio" name="correct_answer[]"
                                           value="1">
                                </div>
                                <div class="col-11">
                                    <input type="text" class="form-control mb-1"
                                           placeholder="@lang('site.answer') 1" name="answers[]">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <input type="radio" name="correct_answer[]"
                                           value="2">
                                </div>
                                <div class="col-11">
                                    <input type="text" class="form-control mb-1"
                                           placeholder="@lang('site.answer') 2" name="answers[]">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <input type="radio" name="correct_answer[]"
                                           value="3">
                                </div>
                                <div class="col-11">
                                    <input type="text" class="form-control mb-1"
                                           placeholder="@lang('site.answer') 3" name="answers[]">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <input type="radio" name="correct_answer[]"
                                           value="4">
                                </div>
                                <div class="col-11">
                                    <input type="text" class="form-control"
                                           placeholder="@lang('site.answer') 4" name="answers[]">
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
                            <select name="correct_answer"
                                    class="form-control">
                                <option value="true">@lang('site.true')</option>
                                <option value="false">@lang('site.false')</option>
                            </select>
                            <span class="la la-question input-icon"></span>
                            <span class="text-danger error_message"></span>
                        </div>
                    </div>
                `)
                $(this).parent().parent().parent().parent().parent().siblings('.true_false').removeClass('d-none');
                $(this).parent().parent().parent().parent().parent().siblings('.mcq').addClass('d-none');
            } else {
                $(this).parent().parent().parent().parent().parent().siblings('.true_false').empty()
                $(this).parent().parent().parent().parent().parent().siblings('.mcq').empty()
            }
        });

        let quiz_sections_options = $('#quiz_section').html();
    </script>
@endpush
