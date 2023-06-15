@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Create Assignment')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.choose_assignment_for_copy')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="quiz-type-wrap">
                                <form
                                    action="{{ route('teacher.courses.assignments.copy', ['course' => $course->slug, 'assignment' => $assignment->id]) }}"
                                    method="post" class="w-100">
                                    <div class="row">
                                        @csrf
                                        <div class="col-12">
                                            <label class="label-text"
                                                   for="assignment_id">@lang('site.assignments')</label>
                                            <div class="form-group">
                                                <div class="sort-ordering user-form-short">
                                                    <select class="sort-ordering-select" id="assignment_id"
                                                            name="assignment_id">
                                                        @foreach($assignments as $assignment)
                                                            <option
                                                                value="{{ $assignment->id }}">{{ $assignment->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('assignment_id')
                                                    <span class="text-danger font-size-12">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <button class="theme-btn" type="submit">
                                                @lang('site.finish')
                                                <i class="las la-check"></i>
                                            </button>
                                        </div>
                                    </div><!-- end row -->
                                </form>

                            </div>
                        </div><!-- end card-box-shared-body -->
                    </div><!-- end card-box-shared -->
                </div><!-- end col-lg-12 -->
            </div>
            @include('layouts.teacher._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection
