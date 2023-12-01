@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Announcements')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            @include('teacher.courses.announcements._create', compact('groups', 'course'))
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.announcements')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="statement-table purchase-table table-responsive mb-5">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('site.announcement')</th>
                                        <th scope="col">@lang('site.group')</th>
                                        <th scope="col">@lang('site.created_at')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($announcements as $index => $announcement)
                                        <tr>
                                            <td>{{ $index + 1}}</td>
                                            <td>{{ $announcement->body }}</td>
                                            <td>{{ $announcement->group ? $announcement->group->name : __('site.all_students') }}</td>
                                            <td>{{ $announcement->created_at->format('d/m/Y h:i A') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">@lang('site.no_announcements')</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{ $announcements->links('vendor.pagination.default') }}
                            </div>
                        </div><!-- end card-box-shared-body -->
                    </div><!-- end card-box-shared -->
                </div><!-- end col-lg-12 -->
            </div>
            @include('layouts.teacher._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection
