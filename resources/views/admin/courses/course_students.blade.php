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
                                {{ $course->getTranslation('title', 'en') }}
                            </h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="statement-table withdraw-table table-responsive mb-5">
                                <div class="row mb-4 flex-row-reverse">
                                    <div class="col">
                                        <form
                                            action="{{ route('admin.courses.delete_all_generated_students', $course->slug) }}"
                                            method="POST" class="d-inline-block mb-2">
                                            @csrf
                                            <button type="submit" class="btn btn-danger delete_all">
                                                <i class="la la-trash-o"></i>
                                                @lang('site.delete_all')
                                            </button>
                                        </form>
                                        <form
                                            action="{{ route('admin.courses.unblock_all_generated_students', $course->slug) }}"
                                            method="POST" class="d-inline-block mb-2">
                                            @csrf
                                            <button type="submit" class="btn btn-success unblock_all">
                                                <i class="la la-check"></i>
                                                @lang('site.unblock_all')
                                            </button>
                                        </form>
                                        <form
                                            action="{{ route('admin.courses.block_all_generated_students', $course->slug) }}"
                                            method="POST" class="d-inline-block mb-2">
                                            @csrf
                                            <button type="submit" class="btn btn-warning block_all">
                                                <i class="la la-ban"></i>
                                                @lang('site.block_all')
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <form action="">
                                            <div class="form-group d-inline-block col-lg-6 col-sm-12">
                                                <label for="search">@lang('site.search')</label>
                                                <input type="search" name="search" id="search"
                                                       class="form-control"
                                                       placeholder="@lang('site.email_or_code')"
                                                       value="{{ request()->search }}">
                                            </div>
                                            <button type="submit" class="btn theme-btn">@lang('site.search')</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">@lang('site.auth.name')</th>
                                                <th scope="col">@lang('site.mobile')</th>
                                                <th scope="col">@lang('site.auth.email')</th>
                                                <th scope="col">@lang('site.auth.password')</th>
                                                <th scope="col">@lang('site.code')</th>
                                                <th scope="col">@lang('site.group')</th>
                                                <th scope="col">@lang('site.last_login_ip')</th>
                                                <th scope="col">@lang('site.action')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($generated_students as $student)
                                                <tr>
                                                    <td>{{ strpos($student->name, ' ') == 0 ? "--" : $student->name }}</td>
                                                    <td>{{ $student->mobile ?? "--" }}</td>
                                                    <td>{{ $student->email }}</td>
                                                    {{--                                                    <td>{{ substr($student->email, 0, strpos($student->email, '@')) . $student->code }}</td>--}}
                                                    <td>{{ strlen(substr($student->email, 0, strpos($student->email, '@'))) > 6 ? substr($student->email, 0, strpos($student->email, '@')) . $student->code : $student->code . substr($student->email, 1, 3)}}</td>
                                                    {{--                                                    <td>{{ $student->code . substr($student->email, 1, 3) }}</td>--}}
                                                    <td>{{ strtoupper($student->code) }}</td>
                                                    <td>{{ $student->group->name ?? __('site.without_group') }}</td>
                                                    <td>{{ $student->last_login_ip ?? __('site.not_loggedin_yet') }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.courses.students.edit', ['course' => $course->slug, 'student' => $student->id]) }}">
                                                            <button class="btn btn-info btn-sm">
                                                                <i class="la la-edit"></i>
                                                                @lang('site.edit')
                                                            </button>
                                                        </a>
                                                        @if($student->is_banned)
                                                            <a href="{{ route('admin.students.unblock', $student->id) }}">
                                                                <button class="btn btn-success btn-sm">
                                                                    <i class="la la-check"></i>
                                                                    @lang('site.unblock')
                                                                </button>
                                                            </a>
                                                        @else
                                                            <a href="{{ route('admin.students.block', $student->id) }}">
                                                                <button class="btn btn-warning btn-sm">
                                                                    <i class="la la-ban"></i>
                                                                    @lang('site.block')
                                                                </button>
                                                            </a>
                                                        @endif
                                                        <form
                                                            action="{{ route('admin.students.destroy', $student->id) }}"
                                                            method="post" class="d-inline-block">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger btn-sm delete">
                                                                <i class="la la-trash-o"></i>
                                                                @lang('site.delete')
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="9" class="text-center">@lang('site.no_students')</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                        {{ $generated_students->links('vendor.pagination.default') }}
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
                text: "{{ __('site.delete_student_confirm') }}",
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

        $('.delete_all').click(function (e) {
            let that = $(this);

            e.preventDefault();

            let n = new Noty({
                text: "{{ __('site.delete_all_students_confirm') }}",
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
        });//end of delete all

        $('.block_all').click(function (e) {
            let that = $(this);

            e.preventDefault();

            let n = new Noty({
                text: "{{ __('site.block_all_students_confirm') }}",
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
        });//end of block all

        $('.unblock_all').click(function (e) {
            let that = $(this);

            e.preventDefault();

            let n = new Noty({
                text: "{{ __('site.unblock_all_students_confirm') }}",
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
        });//end of unblock all
    </script>
@endpush
