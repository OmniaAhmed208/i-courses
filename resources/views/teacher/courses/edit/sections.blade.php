@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Create Course')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            @if ($errors->any())
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.course_sections')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            @if(count($course->sections) > 0)
                                <div class="statement-table purchase-table table-responsive mb-5">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">@lang('site.name')</th>
                                            <th scope="col">@lang('site.number_of_lessons')</th>
                                            <th scope="col">@lang('site.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($course->sections as $section)
                                            <tr>
                                                <td>{{ $section->name }}</td>
                                                <td>{{ count($section->lessons) }}</td>
                                                <td>
                                                    <button class="btn btn-warning edit"
                                                            data-section_id="{{ $section->id }}"
                                                            data-name="{{ $section->name }}"
                                                            data-toggle="modal"
                                                            data-target=".item-update-modal">
                                                        <i class="la la-edit"></i>
                                                        @lang('site.edit')
                                                    </button>
                                                    <form
                                                        action="{{ route('teacher.courses.sections.destroy', ['course' => $course->slug, 'section' => $section->id]) }}"
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
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            <hr>
                            <div class="user-form">
                                <div class="contact-form-action">
                                    <form method="post"
                                          action="{{ route('teacher.courses.add_sections', $course->slug) }}">
                                        @csrf
                                        <div class="row section-inputs">
                                            <div class="col-12">
                                                <div class="row section">
                                                    <div class="col-8">
                                                        <div class="input-box">
                                                            <label class="label-text">
                                                                @lang('site.section_name')
                                                                <span class="primary-color-2 ml-1">*</span>
                                                            </label>
                                                            <div class="form-group">
                                                                <input class="form-control"
                                                                       type="text" name="sections[]" required>
                                                                <span class="la la-file-text input-icon"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col-12 -->
                                        </div><!-- end row -->
                                        <div class="row">
                                            <div class="col-12">
                                                <button class="btn btn-info" id="add-new-input">
                                                    @lang('site.add_new_section')
                                                    <i class="las la-plus"></i>
                                                </button>
                                            </div>
                                        </div><!-- end row -->
                                        <hr>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <button class="theme-btn" type="submit">
                                                    <i class="las la-plus-circle"></i>
                                                    @lang('site.add')
                                                </button>
                                            </div>
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
    <div class="modal-form text-center">
        <div class="modal fade item-update-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content p-4">
                    <div class="modal-top d-flex justify-content-center border-0 mb-4 p-0">
                        <div class="alert-content">
                            <span class="la la-edit warning-icon"></span>
                            <h4 class="widget-title font-size-20 mt-2 mb-1">@lang('site.edit_section_name')</h4>
                        </div>
                    </div>
                    <form action="{{ route('teacher.courses.sections.update_section', $course->slug) }}"
                          method="post" class="d-inline-block">
                        @csrf
                        @method('put')
                        <input type="hidden" name="section_id" id="section_id" value="">
                        <input type="text" class="form-control" name="name" id="section_name" value=""
                               autocomplete="off">
                        <div class="btn-box mt-2">
                            <button type="button" class="btn primary-color font-weight-bold mr-3" data-dismiss="modal">
                                @lang('site.cancel')
                            </button>
                            <button type="submit"
                                    class="theme-btn bg-color-1 border-0 text-white">@lang('site.update')</button>
                        </div>
                    </form>
                </div><!-- end modal-content -->
            </div><!-- end modal-dialog -->
        </div><!-- end modal -->
    </div><!-- end modal-form -->
@endsection
@push('scripts')
    <script>
        $('#add-new-input').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $('.section-inputs .col-12').append(`
                <div class="row section">
                    <div class="col-8">
                        <div class="input-box">
                            <label class="label-text">
                                @lang('site.section_name')
            <span class="primary-color-2 ml-1">*</span>
        </label>
        <div class="form-group">
            <input class="form-control"
                   type="text" name="sections[]" required>
            <span class="la la-file-text input-icon"></span>
        </div>
    </div>
</div>
<div class="col-4 d-flex align-items-center mt-3">
    <button class="btn btn-danger delete-row">
        <i class="la la-trash-o"></i>
@lang('site.remove')
            </button>
        </div>
    </div>
`);
        });
        $(document).on('click', '.delete-row', function (e) {
            e.preventDefault();
            $(this).parent().parent().remove()
        });

        $(".edit").on('click', function (e) {
            e.preventDefault();
            let section_id = $(this).data('section_id'),
                name = $(this).data('name');
            $("#section_id").val(section_id);
            $("#section_name").val(name);
        });

        //delete
        $('.delete').click(function (e) {

            let that = $(this);

            e.preventDefault();

            let n = new Noty({
                text: "@lang('site.delete_section_confirm_msq')",
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
