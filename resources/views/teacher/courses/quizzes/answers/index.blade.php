@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Course Quiz Answers')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex align-items-center">
                            <h3 class="widget-title mr-5">@lang('site.answers')</h3>
                            <a href="{{ route('teacher.courses.quizzes.answers.download', ['course' => $course, 'quiz' => $quiz->id]) }}">
                                <button class="theme-btn d-flex align-items-center">
                                    <i class="la la-file-excel-o la-2x"></i>
                                    @lang('site.download_excel')
                                </button>
                            </a>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="statement-table purchase-table table-responsive mb-5">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('site.name')</th>
                                        <th scope="col">@lang('site.auth.email')</th>
                                        <th scope="col">@lang('site.total_marks')</th>
                                        <th scope="col">@lang('site.status')</th>
                                        <th scope="col">@lang('site.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($answers as $answer)
                                        <tr>
                                            <td>{{ ucfirst($answer->student->name) }}</td>
                                            <td>{{ $answer->student->email }}</td>
                                            <td class="{{ ($answer->mark / $quiz->total_mark * 100) >= 50 ? 'text-success' : 'text-danger' }}">
                                                {{ $answer->mark }} / {{ $quiz->total_mark }}
                                            </td>
                                            <td>
                                                @if($answer->is_final_mark)
                                                    <span class="badge badge-success">@lang('site.done')!</span>
                                                @else

                                                    <span
                                                        class="badge badge-warning">@lang('site.need_your_action')</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('teacher.courses.quizzes.results', ['course' => $course, 'quiz' => $quiz->id, 'quiz_attempt' => $answer->id]) }}">
                                                    <button class="btn btn-info">
                                                        <i class="las la-pen-alt"></i>
                                                        @lang('site.show_result')
                                                    </button>
                                                </a>
                                                @if(!$answer->is_final_mark)
                                                    <a href="{{ route('teacher.courses.quizzes.answer', ['course' => $course, 'quiz' => $quiz->id, 'quiz_attempt' => $answer->id]) }}">
                                                        <button class="btn btn-primary">
                                                            <i class="las la-pen-alt"></i>
                                                            @lang('site.mark_answers')
                                                        </button>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">@lang('site.no_answers')</td>
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
