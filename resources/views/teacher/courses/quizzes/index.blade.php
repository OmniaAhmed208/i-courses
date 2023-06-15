@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Course Quizzes')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-12">
                    <a href="{{ route('teacher.courses.quizzes.first_step_create', $course->slug) }}">
                        <button class="theme-btn">
                            <i class="la la-plus"></i>
                            @lang('site.add_new_quiz')
                        </button>
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.quizzes')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="statement-table purchase-table table-responsive mb-5">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('site.name')</th>
                                        <th scope="col">@lang('site.quiz_start_time')</th>
                                        <th scope="col">@lang('site.quiz_end_time')</th>
                                        <th scope="col">@lang('site.quiz_mark')</th>
                                        <th scope="col">@lang('site.data')</th>
                                        <th scope="col">@lang('site.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($quizzes as $index => $quiz)
                                        <tr>
                                            <td>{{ ucfirst($quiz->name) }}</td>
                                            <td>{{ $quiz->start_time->format('d/m/Y h:i A') }}</td>
                                            <td>{{ $quiz->end_time->format('d/m/Y h:i A') }}</td>
                                            <td>{{ $quiz->total_mark }}</td>
                                            <td>
                                                <a href="{{ route('teacher.courses.quizzes.answers', ['course' => $course->slug, 'quiz' => $quiz->id]) }}">
                                                    <button class="btn btn-sm btn-primary">
                                                        <i class="la la-sticky-note"></i>
                                                        @lang('site.answers')
                                                    </button>
                                                </a>
                                                <a href="{{ route('teacher.courses.quizzes.answers.download', ['course' => $course, 'quiz' => $quiz->id]) }}">
                                                    <button class="btn btn-sm btn-info">
                                                        <i class="la la-file-excel-o"></i>
                                                        @lang('site.download_excel')
                                                    </button>
                                                </a>
                                                <a href="{{ route('teacher.courses.quizzes.statistics', ['course' => $course->slug, 'quiz' => $quiz->id]) }}">
                                                    <button class="btn btn-sm btn-warning">
                                                        <i class="las la-chart-pie"></i>
                                                        @lang('site.statistics')
                                                    </button>
                                                </a>
                                            </td>
                                            <td>
                                                @if($quiz->step == \App\Models\Quiz::STEP_THREE)
                                                    @if(now()->lt($quiz->start_time))
                                                        <a href="{{ route('teacher.courses.quizzes.create_questions', ['course' => $course->slug, 'quiz' => $quiz->id]) }}">
                                                            <button class="btn btn-sm btn-info">
                                                                <i class="la la-edit"></i>
                                                                @lang('site.edit_questions')
                                                            </button>
                                                        </a>
                                                    @endif
                                                    <form
                                                        action="{{ route('teacher.courses.quizzes.destroy', ['course' => $course->slug, 'quiz' => $quiz->id]) }}"
                                                        method="post" class="d-inline-block delete">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="la la-trash-o"></i>
                                                            @lang('site.delete')
                                                        </button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('teacher.courses.quizzes.choose_questions_method', ['course' => $course->slug, 'quiz' => $quiz->id]) }}">
                                                        <button class="btn btn-sm btn-primary">
                                                            <i class="la la-sync"></i>
                                                            @lang('site.continue')
                                                        </button>
                                                    </a>
                                                    <form
                                                        action="{{ route('teacher.courses.quizzes.destroy', ['course' => $course->slug, 'quiz' => $quiz->id]) }}"
                                                        method="post" class="d-inline-block delete">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="la la-trash-o"></i>
                                                            @lang('site.delete')
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">@lang('site.no_quizzes')</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
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
    <script>
        //delete
        $('.delete').click(function (e) {

            let that = $(this);

            e.preventDefault();

            let n = new Noty({
                text: "@lang('site.delete_quiz_confirm_msq')",
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
