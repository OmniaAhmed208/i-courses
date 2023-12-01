<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card-box-shared">
            <div class="card-box-shared-title d-flex justify-content-between">
                <h3 class="widget-title">@lang('site.add_new_question')</h3>
            </div>
            <form
                action="{{ route('teacher.questions_bank.groups.questions.create', ['group' => $group]) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
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
                                                      placeholder="@lang('site.question_title')">{{ old('title') }}</textarea>
                                            <span class="la la-question input-icon"></span>
                                            @error('title')
                                            <span class="text-danger error_message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
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
                                </div>
                                <div class="col-lg-12 col-sm-12">
                                    <div class="input-box">
                                        <label class="label-text">@lang('site.question_image')</label>
                                        <div class="form-group mb-0">
                                            <div class="upload-btn-box course-photo-btn">
                                                <input type="file" name="image"
                                                       class="filer_input"
                                                       data-jfiler-extensions="jpg, jpeg, png">
                                                @error('image')
                                                <span
                                                    class="text-danger font-size-12">{{ $message }}</span>
                                                @enderror
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
                    <button type="submit" class="theme-btn">@lang('site.add_question')</button>
                </div><!-- end card-box-shared-body -->
            </form>
        </div><!-- end card-box-shared -->
    </div><!-- end col-lg-12 -->
</div>
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

        let quiz_sections_options = $('#group_id').html();

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
