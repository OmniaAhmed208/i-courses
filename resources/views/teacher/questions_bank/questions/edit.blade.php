@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Edit Question')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex justify-content-between">
                            <h3 class="widget-title">@lang('site.update_question')</h3>
                        </div>
                        <form
                            action="{{ route('teacher.questions_bank.groups.questions.update', ['question' => $question->id, 'group' => $group->id]) }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >
                            @csrf
                            @method('put')
                            <div class="card-box-shared-body">
                                <div class="user-form">
                                    <div class="contact-form-action">
                                        <div class="row form-content">
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.question_title')
                                                        <span class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <textarea class="form-control @error('title') error @enderror"
                                                                  name="title"
                                                                  placeholder="@lang('site.question_title')">{!! $question->title !!}</textarea>
                                                        <span class="la la-question input-icon"></span>
                                                        @error('title')
                                                        <span class="text-danger error_message">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-8 -->
                                            <div class="col-lg-6 col-sm-6">
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
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-box">
                                                    <label class="label-text">
                                                        @lang('site.question_image')
                                                        @if($question->picture)
                                                            <a href="{{ asset('storage/' . $question->picture) }}"
                                                               target="_blank">
                                                                <img src="{{ asset('storage/' . $question->picture) }}"
                                                                     alt="{{ $section->title }}" width="100">
                                                            </a>
                                                        @endif
                                                    </label>
                                                    <div class="form-group mb-0">
                                                        <div class="upload-btn-box course-photo-btn">
                                                            <input type="file" name="image"
                                                                   class="filer_input"
                                                                   data-jfiler-extensions="jpg, jpeg, png">
                                                            <span class="font-size-14 d-block text-danger">
                                                                <i class="las la-exclamation-triangle"></i>
                                                                @lang('site.course_pic_notic')
                                                            </span>
                                                            @error('image')
                                                            <span
                                                                class="text-danger font-size-12">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="col-lg-12 col-sm-12 mcq {{ $question->type != 'mcq' ? 'd-none' : '' }}">
                                                @if($question->type == 'mcq')

                                                    <div class="input-box">
                                                        <label class="label-text">@lang('site.choices')</label>
                                                        <div class="form-group">
                                                            @foreach($question->choices as $index => $choice)
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
                                                            <select name="correct_answer[]"
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
    <script src="https://cdn.tiny.cloud/1/1h6tmod2ozsqffu3vimeaa71j4wcjoyuyj5s6kiw3n3yxdq7/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
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
                            <select name="correct_answer[]"
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

        tinymce.init({
            selector: 'textarea',
            height: 500,
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
            },
            toolbar: "undo redo | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | fontsizeselect",
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            ],
            tinycomments_author: 'MAX',
            directionality: "{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}",
            language: "{{ app()->getLocale() }}"
        });
    </script>
@endpush

