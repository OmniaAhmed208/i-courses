@extends('layouts.admin.app')
@section('title', setting('website_name') . ' Course Group')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex align-items-center">
                            <h3 class="widget-title">
                                @lang('site.edit_bulk_students')
                            </h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="statement-table withdraw-table table-responsive mb-5">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="group_id">@lang('site.groups')</label>
                                            <select id="group_id" class="form-control col-xl-8 col-12">
                                                <option value="">@lang('site.without_group')</option>
                                                @foreach($groups as $group)
                                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <table class="table" id="table">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th class="d-none"></th>
                                                <th scope="col">@lang('site.auth.name')</th>
                                                <th scope="col">@lang('site.mobile')</th>
                                                <th scope="col">@lang('site.auth.email')</th>
                                                <th scope="col">@lang('site.code')</th>
                                                <th scope="col">@lang('site.group')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($generated_students as $student)
                                                <tr>
                                                    <td></td>
                                                    <td class="d-none">{{ $student->id }}</td>
                                                    <td>{{ strpos($student->name, ' ') == 0 ? "--" : $student->name }}</td>
                                                    <td>{{ $student->mobile ?? "--" }}</td>
                                                    <td>{{ $student->email }}</td>
                                                    <td>{{ strtoupper($student->code) }}</td>
                                                    <td>{{ $student->group->name ?? __('site.without_group') }}</td>
                                                </tr>
                                            @endforeach
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

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css"/>


    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: #fff !important;
            background: #51be78 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #fff !important;
            background: #51be78 !important;

        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #51be78 !important;
            font-weight: bold;
            background-color: #fff;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.next, .dataTables_wrapper .dataTables_paginate .paginate_button.previous:hover {
            background-color: #51be78 !important;
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.previous.disabled {
            cursor: not-allowed;
        }

        table.dataTable tbody > tr.selected, table.dataTable tbody > tr > .selected {
            background-color: #51be78;
        }
    </style>
@endpush
@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script>
        let locale = document.documentElement.lang == 'ar' ? 'Arabic.json' : 'English.json'
        $(document).ready(function () {
            let table = $('#table').DataTable({
                "language": {
                    "url": `//cdn.datatables.net/plug-ins/1.10.18/i18n/${locale}`
                },
                dom: 'Bfrtip',
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }],
                select: {
                    style: 'multi',
                    selector: 'td:first-child'
                },
                order: [[1, 'asc']],
                buttons: [
                    {
                        text: '<i class="la la-layer-group"></i> @lang("site.change_selected_students_group")',
                        className: 'btn btn-info my-3',
                        action: function () {
                            let rows = table.rows({selected: true}).data();
                            let student_ids = []
                            let group_id = $('#group_id').val()
                            rows.map((row) => {
                                student_ids.push(row[1]);
                            });
                            if (student_ids.length > 0) {

                                let formData = new FormData()
                                formData.append('group_id', group_id);
                                formData.append('student_ids', student_ids);
                                console.log(formData);
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    processData: false,
                                    contentType: false,
                                    dataType: 'json',
                                    cache: false,
                                    type: 'POST',
                                    url: "{{ route('admin.courses.students.update_group_bulk', $course->slug) }}",
                                    data: formData,
                                    success: function () {
                                        window.location.reload();
                                    }
                                });
                            }
                        }
                    },
                    {
                        text: '<i class="la la-trash-alt"></i> @lang("site.delete_selected_students")',
                        className: 'btn btn-danger my-3',
                        action: function () {
                            let rows = table.rows({selected: true}).data();
                            let student_ids = []
                            rows.map((row) => {
                                student_ids.push(row[1]);
                            });

                            if (student_ids.length > 0) {
                                let formData = new FormData()
                                formData.append('student_ids', student_ids);
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    processData: false,
                                    contentType: false,
                                    dataType: 'json',
                                    cache: false,
                                    type: 'POST',
                                    url: "{{ route('admin.courses.students.delete_bulk', $course->slug) }}",
                                    data: formData,
                                    success: function () {
                                        window.location.reload();
                                    }
                                });
                            }
                        }
                    },
                    {
                        text: '<i class="la la-ban"></i>  @lang("site.block_selected_students")',
                        className: 'btn btn-warning my-3',
                        action: function () {
                            let rows = table.rows({selected: true}).data();
                            let student_ids = []
                            rows.map((row) => {
                                student_ids.push(row[1]);
                            });
                            if (student_ids.length > 0) {
                                let formData = new FormData()
                                formData.append('student_ids', student_ids);
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    processData: false,
                                    contentType: false,
                                    dataType: 'json',
                                    cache: false,
                                    type: 'POST',
                                    url: "{{ route('admin.courses.students.block_bulk', $course->slug) }}",
                                    data: formData,
                                    success: function () {
                                        window.location.reload();
                                    }
                                });
                            }
                        }
                    },
                    {
                        text: '<i class="la la-check"></i> @lang("site.unblock_selected_students")',
                        className: 'btn btn-success my-3',
                        action: function () {
                            let rows = table.rows({selected: true}).data();
                            let student_ids = []
                            rows.map((row) => {
                                student_ids.push(row[1]);
                            });
                            if (student_ids.length > 0) {
                                let formData = new FormData()
                                formData.append('student_ids', student_ids);
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    processData: false,
                                    contentType: false,
                                    dataType: 'json',
                                    cache: false,
                                    type: 'POST',
                                    url: "{{ route('admin.courses.students.unblock_bulk', $course->slug) }}",
                                    data: formData,
                                    success: function () {
                                        window.location.reload();
                                    }
                                });
                            }
                        }
                    }
                ]
            });
        });
    </script>
@endpush
