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
                            action="{{ route('teacher.courses.quizzes.store_question', ['course' => $course->slug, 'quiz' => $quiz->id]) }}"
                            method="POST">
                            @csrf
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
                                                               value="{{ old('title') }}"
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
                                                               value="{{ old('mark') }}"
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
                                                                <option value="mcq">@lang('site.mcq')</option>
                                                                <option
                                                                    value="true_false">@lang('site.true_false')</option>
                                                                <option value="essay">@lang('site.essay')</option>
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
                                                                        value="{{ $section->id }}">{{ $section->title }}</option>
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
                                            <div class="col-lg-12 col-sm-12 mcq">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.choices')</label>
                                                    <div class="form-group">
                                                        <div class="row align-items-center">
                                                            <div class="col-1">
                                                                <input type="radio" name="correct_answer"
                                                                       value="1">
                                                            </div>
                                                            <div class="col-11">
                                                                <input type="text" class="form-control mb-1"
                                                                       placeholder="@lang('site.answer') 1"
                                                                       name="answers[]">
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="col-1">
                                                                <input type="radio" name="correct_answer"
                                                                       value="2">
                                                            </div>
                                                            <div class="col-11">
                                                                <input type="text" class="form-control mb-1"
                                                                       placeholder="@lang('site.answer') 2"
                                                                       name="answers[]">
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="col-1">
                                                                <input type="radio" name="correct_answer"
                                                                       value="3">
                                                            </div>
                                                            <div class="col-11">
                                                                <input type="text" class="form-control mb-1"
                                                                       placeholder="@lang('site.answer') 3"
                                                                       name="answers[]">
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="col-1">
                                                                <input type="radio" name="correct_answer"
                                                                       value="4">
                                                            </div>
                                                            <div class="col-11">
                                                                <input type="text" class="form-control"
                                                                       placeholder="@lang('site.answer') 4"
                                                                       name="answers[]">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-4 d-none true_false">

                                            </div>
                                            <div class="col-lg-4 col-sm-4 d-none essay">

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
                                <button type="submit" class="theme-btn">@lang('site.add_question_to_quiz')</button>
                            </div><!-- end card-box-shared-body -->
                        </form>
                    </div><!-- end card-box-shared -->
                </div><!-- end col-lg-12 -->
            </div>
            <hr>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex justify-content-between">
                            <h3 class="widget-title">@lang('site.questions')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="statement-table withdraw-table table-responsive mb-5">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="pl-1">@lang('site.question_title')</th>
                                        <th scope="col">@lang('site.question_section')</th>
                                        <th scope="col">@lang('site.question_type')</th>
                                        <th scope="col">@lang('site.question_marks')</th>
                                        <th scope="col">@lang('site.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($questions as $question)
                                        <tr>
                                            <td>{{ $question->title }}</td>
                                            <td>{{ $question->section->title }}</td>
                                            <td>{{ __('site.' . $question->type) }}</td>
                                            <td>{{ $question->mark }}</td>
                                            <td>
                                                <a href="{{ route('teacher.courses.quizzes.edit_question', ['course' => $course->slug, 'quiz' => $quiz->id, 'question' => $question->id]) }}">
                                                    <button class="btn btn-info btn-sm">
                                                        <i class="far fa-edit"></i>
                                                        @lang('site.update')
                                                    </button>
                                                </a>
                                                <form
                                                    class="d-inline"
                                                    action="{{ route('teacher.courses.quizzes.delete_question', ['course' => $course->slug, 'quiz' => $quiz->id, 'question' => $question->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm delete">
                                                        <i class="far fa-trash-alt"></i>
                                                        @lang('site.delete')
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">@lang('site.no_questions')</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row my-3">
                <div class="col-lg-12 text-center">
                    <form
                        action="{{ route('teacher.courses.quizzes.finish_quiz', ['course' => $course->slug, 'quiz' => $quiz->id]) }}">
                        <button class="theme-btn" type="submit">
                            <i class="la la-check-circle"></i>
                            @lang('site.finish')
                        </button>
                    </form>
                </div>
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

        $('.delete').click(function (e) {

            let that = $(this);

            e.preventDefault();

            let n = new Noty({
                text: "@lang('site.delete_question_confirm_msq')",
                type: "warning",
                killer: true,
                buttons: [
                    Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function () {
                        that.closest('form').submit();
                    }),

                    Noty.button("@lang('site.no')", 'btn btn-info mr-2', function () {
                        n.close();
                    })
                ]
            });
            n.show();
        });//end of delete
    </script>
@endpush
