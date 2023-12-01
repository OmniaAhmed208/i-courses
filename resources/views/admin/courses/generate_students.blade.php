@extends('layouts.admin.app')
@section('title', __('site.main_title') . 'Courses')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex align-items-center">
                            <h3 class="widget-title">"{{ $course->title }}" <span
                                    class="font-size-14">@lang('site.generated_students')</span></h3>
                            <div class="ml-3">
                                <a href="{{ route('admin.courses.download_students', $course->slug) }}?course={{ $course->slug }}">
                                    <button type="submit"
                                            class="theme-btn d-flex align-items-center justify-content-center">
                                        <i class="la la-file-excel-o la-2x mr-2"></i>
                                        @lang('site.download_excel')
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="card-box-shared-body">
                            <h3 class="widget-title font-size-18 mb-3">@lang('site.generate_students')</h3>
                            <form action="{{ route('admin.courses.generate_students', $course->slug) }}" method="post">
                                @csrf
                                <input type="hidden" name="course" value="{{ $course->slug }}">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="number" min="1" name="number" id="number"
                                                   class="form-control @error('number') is-invalid @enderror"
                                                   autocomplete="off" autofocus
                                                   placeholder="@lang('site.number_of_students')"
                                                   required>
                                            @error('number')
                                            <span class="text-danger font-size-12">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="submit"
                                                    class="theme-btn d-flex align-items-center justify-content-center"
                                                    id="generate">
                                                <i class="la la-cogs la-2x mr-2"></i>
                                                @lang('site.generate')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="statement-table withdraw-table table-responsive mb-5">
                                <div class="statement-header pb-4">
                                    <h3 class="widget-title font-size-18">@lang('site.generated_students')</h3>
                                </div>
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
                                <form action="">
                                    <div class="form-group d-inline-block col-lg-6 col-sm-12">
                                        <label for="search">@lang('site.search')</label>
                                        <input type="search" name="search" id="search"
                                               class="form-control"
                                               placeholder="@lang('site.auth.email')" value="{{ request()->search }}">
                                    </div>
                                    <button type="submit" class="btn theme-btn">@lang('site.search')</button>
                                </form>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('site.auth.email')</th>
                                        <th scope="col">@lang('site.auth.password')</th>
                                        <th scope="col">@lang('site.code')</th>
                                        <th scope="col">@lang('site.last_login_ip')</th>
                                        <th scope="col">@lang('site.generated_at')</th>
                                        <th scope="col">@lang('site.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($generated_students as $student)
                                        <tr>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ substr($student->email, 0, strpos($student->email, '@')) . $student->code }}</td>
                                            <td>{{ strtoupper($student->code) }}</td>
                                            <td>{{ $student->last_login_ip ?? __('site.not_loggedin_yet') }}</td>
                                            <td>{{ $student->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.students.edit', $student->id) }}">
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
                                                <form action="{{ route('admin.students.destroy', $student->id) }}"
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
                                            <td colspan="6" class="text-center">@lang('site.no_students')</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{ $generated_students->links('vendor.pagination.default') }}
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
        $("#generate").on('click', function () {
            $('.preloader').fadeIn();
        });
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
