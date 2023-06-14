@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Questions Bank')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            @include('teacher.questions_bank.questions._create', compact('group'))
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.questions_bank')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="statement-table purchase-table table-responsive mb-5">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('site.question_title')</th>
                                        <th scope="col">@lang('site.question_type')</th>
                                        <th scope="col">@lang('site.question_marks')</th>
                                        <th scope="col">@lang('site.group_name')</th>
                                        <th scope="col">@lang('site.created_at')</th>
                                        <th scope="col">@lang('site.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($groupedQuestions as $question)
                                        <tr>
                                            <td>{{ $question->question_number_in_group}}</td>
                                            <td>{!! $question->title !!}</td>
                                            <td>{{ __('site.' . $question->type) }}</td>
                                            <td>{{ $question->mark }}</td>
                                            <td>{{ $question->group->name }}</td>
                                            <td>{{ $question->created_at->format('d/m/Y h:i A') }}</td>
                                            <td>
                                                <a href="{{ route('teacher.questions_bank.groups.questions.edit', ['question' => $question->id, 'group' => $group]) }}">
                                                    <button class="btn btn-sm btn-info">
                                                        <i class="la la-edit"></i>
                                                        @lang('site.edit')
                                                    </button>
                                                </a>
                                                <form method="POST"
                                                      action="{{ route('teacher.questions_bank.groups.questions.delete', ['question' => $question->id, 'group' => $group]) }}"
                                                      class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger delete">
                                                        <i class="las la-trash-alt"></i>
                                                        @lang('site.delete')
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">@lang('site.no_questions')</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{ $groupedQuestions->links('vendor.pagination.default') }}
                            </div>
                        </div><!-- end card-box-shared-body -->
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
        $('.delete').click(function (e) {
            let that = $(this);
            e.preventDefault();
            let n = new Noty({
                text: "{{ __('site.question_delete_confirm') }}",
                type: "warning",
                killer: true,
                buttons: [
                    Noty.button("{{ __('site.yes') }}", 'btn btn-success mr-2', function () {
                        that.closest('form').submit();
                    }),

                    Noty.button("{{ __('site.no') }}", 'btn btn-info mr-2', function () {
                        n.close();
                    })
                ]
            });
            n.show();
        });//end of delete

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
