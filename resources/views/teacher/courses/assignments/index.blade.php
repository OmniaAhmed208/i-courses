@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Course Assignments')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-12">
                    <a href="{{ route('teacher.courses.assignments.first_step_create', $course->slug) }}">
                        <button class="theme-btn">
                            <i class="la la-plus"></i>
                            @lang('site.add_new_assignment')
                        </button>
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.assignments')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="statement-table purchase-table table-responsive mb-5">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('site.name')</th>
                                        <th scope="col">@lang('site.assignment_start_time')</th>
                                        <th scope="col">@lang('site.assignment_end_time')</th>
                                        <th scope="col">@lang('site.assignment_mark')</th>
                                        <th scope="col">@lang('site.data')</th>
                                        <th scope="col">@lang('site.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($assignments as $assignment)
                                        <tr>
                                            <td>{{ ucfirst($assignment->name) }}</td>
                                            <td>{{ $assignment->start_time->format('d/m/Y h:i A') }}</td>
                                            <td>{{ $assignment->end_time->format('d/m/Y h:i A') }}</td>
                                            <td>{{ $assignment->total_mark }}</td>
                                            <td>
                                                <a href="{{ route('teacher.courses.assignments.answers', ['course' => $course->slug, 'assignment' => $assignment->id]) }}">
                                                    <button class="btn btn-sm btn-primary">
                                                        <i class="la la-sticky-note"></i>
                                                        @lang('site.answers')
                                                    </button>
                                                </a>

                                            </td>
                                            <td>
                                                @if($assignment->step == \App\Models\Assignment::STEP_THREE)
                                                    @if(\Carbon\Carbon::now() < $assignment->start_time)
                                                        <a href="{{ route('teacher.courses.assignments.create_questions', ['course' => $course->slug, 'assignment' => $assignment->id]) }}">
                                                            <button class="btn btn-sm btn-info">
                                                                <i class="la la-edit"></i>
                                                                @lang('site.edit_questions')
                                                            </button>
                                                        </a>
                                                    @endif
                                                    <form
                                                        action="{{ route('teacher.courses.assignments.destroy', ['course' => $course->slug, 'assignment' => $assignment->id]) }}"
                                                        method="post" class="d-inline-block delete">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="la la-trash-o"></i>
                                                            @lang('site.delete')
                                                        </button>
                                                    </form>
                                                    {{--                                                @else--}}
                                                    {{--                                                    <a href="{{ route('teacher.courses.assignments.choose_questions_method', ['course' => $course->slug, 'assignment' => $assignment->id]) }}">--}}
                                                    {{--                                                        <button class="btn btn-primary">--}}
                                                    {{--                                                            <i class="la la-sync"></i>--}}
                                                    {{--                                                            @lang('site.continue')--}}
                                                    {{--                                                        </button>--}}
                                                    {{--                                                    </a>--}}
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">@lang('site.no_assignments')</td>
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
                text: "@lang('site.delete_assignment_confirm_msq')",
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
