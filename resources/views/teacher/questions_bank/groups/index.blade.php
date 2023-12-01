@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Questions Bank')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            @include('teacher.questions_bank.groups._create')
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.questions_bank_groups')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="statement-table purchase-table table-responsive mb-5">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('site.course')</th>
                                        <th scope="col">@lang('site.group_name')</th>
                                        <th scope="col">@lang('site.number_of_questions')</th>
                                        <th scope="col">@lang('site.created_at')</th>
                                        <th scope="col">@lang('site.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($groups as $group)
                                        <tr>
                                            <td>{{ $group->course->title }}</td>
                                            <td>{{ $group->name }}</td>
                                            <td>{{ $group->questions_count }}</td>
                                            <td>{{ $group->created_at->format('d/m/Y h:i A') }}</td>
                                            <td>
                                                <a href="{{ route('teacher.questions_bank.groups.questions.index', ['group' => $group->id]) }}">
                                                    <button class="btn btn-sm btn-info">
                                                        <i class="la la-question-circle"></i>
                                                        @lang('site.questions')
                                                    </button>
                                                </a>
                                                <a href="{{ route('teacher.questions_bank.groups.edit', ['group' => $group->id]) }}">
                                                    <button class="btn btn-sm btn-warning">
                                                        <i class="la la-edit"></i>
                                                        @lang('site.edit')
                                                    </button>
                                                </a>
                                                <form
                                                    action="{{ route('teacher.questions_bank.groups.delete', ['group' => $group->id]) }}"
                                                    method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger delete" type="submit">
                                                        <i class="las la-trash-alt"></i>
                                                        @lang('site.delete')
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">@lang('site.no_groups')</td>
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
        $('.delete').click(function (e) {
            let that = $(this);

            e.preventDefault();

            let n = new Noty({
                text: "{{ __('site.question_group_delete_confirm') }}",
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

