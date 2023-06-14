@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Sections')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex flex-column justify-content-center">
                            <h3 class="widget-title">@lang('site.course_sections')</h3>

                            <a href="{{ route('teacher.courses.sections.create', $course->slug) }}" class="mt-3">
                                <button class="theme-btn">
                                    <i class="la la-plus"></i>
                                    @lang('site.create')
                                </button>
                            </a>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="statement-table withdraw-table table-responsive mb-5">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" class="pl-1">@lang('site.name')</th>
                                        <th scope="col">@lang('site.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($sections as $index => $section)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="pl-0">{{ $section->name }}</td>
                                            <td>
                                                <a href="{{ route('teacher.courses.sections.edit', ['course' => $course->slug, "section" => $section->id]) }}">
                                                    <button class="btn btn-info">
                                                        <i class="la la-edit"></i>
                                                        @lang('site.edit')
                                                    </button>
                                                </a>
                                                <form
                                                    action="{{ route('teacher.courses.sections.destroy', ['course' => $course->slug, "section" => $section->id]) }}"
                                                    method="post" class="d-inline-block"
                                                    id="cat_delete_{{ $section->id }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger delete"
                                                            data-toggle="modal"
                                                            data-target=".item-delete-modal"
                                                            data-cat_id="{{ $section->id }}"
                                                    >
                                                        <i class="la la-trash-o"></i>
                                                        @lang('site.delete')
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @if(!$section->isLastLevelChild())
                                            @include('teacher.courses.create.sections._sub_sections', ['sections' => $section->children, 'level' => 2, 'course' => $course])
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">@lang('site.no_categories')</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{ $sections->links('vendor.pagination.default') }}
                            </div>
                        </div>

                        @if($course->step == \App\Models\Course::STEP_ONE)
                            <div class="row justify-content-center mb-3">
                                <form method="post"
                                      action="{{ route('teacher.courses.second_step', $course->slug) }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <button class="theme-btn" type="submit">
                                                @lang('site.next')
                                                @if(app()->getLocale() == 'en')
                                                    <i class="las la-arrow-circle-right"></i>
                                                @else
                                                    <i class="las la-arrow-circle-left"></i>
                                                @endif
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @include('layouts.admin._dashboard_footer')
        </div>
    </div>
    <div class="modal-form text-center">
        <div class="modal fade item-delete-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content p-4">
                    <div class="modal-top border-0 mb-4 p-0">
                        <div class="alert-content">
                            <span class="la la-exclamation-circle warning-icon"></span>
                            <h4 class="widget-title font-size-20 mt-2 mb-1">
                                @lang('site.sections_delete_confirm')
                            </h4>
                            <p class="modal-sub">@lang('site.proceed_confirm')</p>
                        </div>
                    </div>
                    <div class="btn-box">
                        <button type="button" class="btn primary-color font-weight-bold mr-3" data-dismiss="modal">
                            @lang('site.cancel')
                        </button>
                        <button type="submit" class="theme-btn bg-color-6 border-0 text-white" id="delete-category">
                            <input type="hidden" id="cat_id" value="">
                            @lang('site.delete')
                        </button>
                    </div>
                </div><!-- end modal-content -->
            </div><!-- end modal-dialog -->
        </div><!-- end modal -->
    </div><!-- end modal-form -->
@endsection
@push('scripts')
    <script>
        $('.delete').on('click', function (e) {
            e.preventDefault();
            let cat_id = $(this).data('cat_id');
            $('#cat_id').val(cat_id);
        });
        $('#delete-category').on('click', function () {
            let cat_id = $('#cat_id').val();
            let form_id = "#cat_delete_" + cat_id;
            $(form_id).submit();
        });
    </script>
@endpush
