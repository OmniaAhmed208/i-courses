@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Q/A')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.question_n_answers')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="statement-table purchase-table table-responsive mb-5">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('site.student_name')</th>
                                        <th scope="col">@lang('site.question')</th>
                                        <th scope="col">@lang('site.status')</th>
                                        <th scope="col">@lang('site.created_at')</th>
                                        <th scope="col">@lang('site.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($qas as $index => $qa)
                                        <tr>
                                            <td>{{ $index + 1}}</td>
                                            <td>{{ $qa->student->name }}</td>
                                            <td>{{ strlen($qa->question) > 30 ? substr($qa->question, 0, 30) . "..." : $qa->question }}</td>
                                            <td>
                                                @if($qa->answer)
                                                    <span class="badge badge-success">
                                                        @lang('site.done')
                                                    </span>
                                                @else
                                                    <span class="badge badge-warning">
                                                        @lang('site.need_your_action')
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ $qa->created_at->format('d/m/Y h:i A') }}</td>
                                            <td>
                                                @if($qa->answer)
                                                    <a href="{{ route('teacher.courses.qas.edit', ['course' => $course->slug, 'qa' => $qa->id]) }}">
                                                        <button
                                                            class="btn btn-sm btn-warning">
                                                            <i class="la la-edit"></i>
                                                            @lang('site.edit_answer')
                                                        </button>
                                                    </a>
                                                @else
                                                    <a href="{{ route('teacher.courses.qas.answer_page', ['course' => $course->slug, 'qa' => $qa->id]) }}">
                                                        <button
                                                            class="btn btn-sm btn-info">
                                                            <i class="la la-question"></i>
                                                            @lang('site.answer_question')
                                                        </button>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">@lang('site.no_questions')</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{ $qas->links('vendor.pagination.default') }}
                            </div>
                        </div><!-- end card-box-shared-body -->
                    </div><!-- end card-box-shared -->
                </div><!-- end col-lg-12 -->
            </div>
            @include('layouts.teacher._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection
