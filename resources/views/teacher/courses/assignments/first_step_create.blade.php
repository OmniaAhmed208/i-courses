@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Create Assignment')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.assignment_type')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="quiz-type-wrap">
                                <div class="row">
                                    <div class="col-lg-6 column-td-half">
                                        <div class="payment-option">
                                            <label for="for_all_students" class="radio-trigger">
                                                <input type="radio" id="for_all_students"
                                                       name="assignment_type_view" value="all" checked>
                                                <span class="checkmark"></span>
                                                <span class="widget-title font-size-18">
                                                    @lang('site.assignment_for_all_students')
                                                </span>
                                            </label>
                                        </div>
                                    </div><!-- end col-lg-2 -->
                                    <div class="col-lg-6 column-td-half">
                                        <div class="payment-option">
                                            <label for="for_group_of_students" class="radio-trigger">
                                                <input type="radio" id="for_group_of_students"
                                                       name="assignment_type_view" value="group">
                                                <span class="checkmark"></span>
                                                <span class="widget-title font-size-18">
                                                    @lang('site.assignment_for_group_of_students')
                                                </span>
                                            </label>
                                        </div>
                                    </div><!-- end col-lg-2 -->
                                </div><!-- end row -->
                                <hr>
                                <div class="row groups_row" style="display: none;">
                                    <div class="col-12">
                                        <label class="label-text" for="group_id">@lang('site.groups')</label>
                                        <div class="form-group">
                                            <div class="sort-ordering user-form-short">
                                                <select class="sort-ordering-select" id="group_id">
                                                    @if($groups)
                                                        @foreach($groups as $group)
                                                            <option
                                                                value="{{ $group->id }}">{{ $group->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('group_id')
                                                <span class="text-danger font-size-12">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <form
                                        action="{{ route('teacher.courses.assignments.first_step_store', $course->slug) }}"
                                        method="post">
                                        @csrf
                                        <input type="hidden" name="assignment_type" value="all">
                                        <input type="hidden" name="group_id"
                                               value="{{ ($groups && count($groups) > 0) ? $groups->first()->id : '' }}">
                                        <div class="col-lg-12">
                                            <button class="theme-btn" type="submit">
                                                @lang('site.next')
                                                @if(app()->getLocale() == 'en')
                                                    <i class="las la-arrow-circle-right"></i>
                                                @else
                                                    <i class="las la-arrow-circle-left"></i>
                                                @endif
                                            </button>
                                        </div>
                                    </form>
                                </div>
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
        $('input[type=radio][name=assignment_type_view]').change(function () {
            if (this.value === 'group') {
                $('input[name=assignment_type]').val("group");
                $('.groups_row').show();
            } else {
                $('input[name=assignment_type]').val("all");
                $('.groups_row').hide();
            }
        });
        $("#group_id").on('change', function () {
            $('input[name=group_id]').val(this.value);
        });

    </script>
@endpush
