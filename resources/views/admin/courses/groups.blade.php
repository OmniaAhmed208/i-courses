@extends('layouts.admin.app')
@section('title', setting('website_name') . ' Courses')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex align-items-center">
                            <h3 class="widget-title">
                                @lang('site.groups')
                            </h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="statement-table withdraw-table table-responsive mb-5">
                                <div class="row">
                                    <div class="col">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">@lang('site.group_name')</th>
                                                <th scope="col">@lang('site.number_of_students')</th>
                                                <th scope="col">@lang('site.action')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($groups as $group)
                                                <tr>
                                                    <td>{{ $group->name }}</td>
                                                    <td>{{ $group->students_count }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.courses.groups.students', ['course' => $course->slug, 'group' => $group->id]) }}">
                                                            <button class="btn btn-info">
                                                                <i class="las la-users"></i>
                                                                @lang('site.students')
                                                            </button>
                                                        </a>
                                                        <form
                                                            action="{{ route('admin.courses.groups.destroy', ['course' => $course->slug, 'group' => $group->id]) }}"
                                                            method="post" class="d-inline-block">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger delete">
                                                                <i class="la la-trash-o"></i>
                                                                @lang('site.delete')
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">@lang('site.no_groups')</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
            @include('layouts.admin._dashboard_footer')
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
                text: "{{ __('site.student_group_delete_confirm') }}",
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
    </script>
@endpush
