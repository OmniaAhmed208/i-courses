@extends('layouts.admin.app')
@section('title', setting('website_name') . ' Become Teacher Requests')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex flex-column justify-content-center">
                            <h3 class="widget-title">@lang('site.become_teacher_requests')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="statement-table withdraw-table table-responsive mb-5">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('site.name')</th>
                                        <th scope="col">@lang('site.auth.email')</th>
                                        <th scope="col">@lang('site.mobile')</th>
                                        <th scope="col">@lang('site.address')</th>
                                        <th scope="col">@lang('site.country')</th>
                                        <th scope="col">@lang('site.city')</th>
                                        <th scope="col">@lang('site.gender')</th>
                                        <th scope="col">@lang('site.request_time')</th>
                                        <th scope="col">@lang('site.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($requests as $request)
                                        <tr>
                                            <td class="pl-0">{{ $request->user->name }}</td>
                                            <td class="pl-0">{{ $request->user->email }}</td>
                                            <td class="pl-0">{{ $request->mobile }}</td>
                                            <td class="pl-0">{{ $request->address }}</td>
                                            <td class="pl-0">{{ $request->country }}</td>
                                            <td class="pl-0">{{ $request->city }}</td>
                                            <td class="pl-0">{{ $request->gender }}</td>
                                            <td class="pl-0">{{ $request->created_at->format('d/m/Y - h:i A') }}</td>
                                            <td>
                                                <a href="{{ route('admin.become_teacher_requests.approve', ['request' => $request->id, 'user' => $request->user_id]) }}">
                                                    <button class="btn btn-info">
                                                        <i class="la la-check"></i>
                                                        @lang('site.approve')
                                                    </button>
                                                </a>
                                                <a href="{{ route('admin.become_teacher_requests.reject', ['request' => $request->id, 'user' => $request->user_id]) }}">
                                                    <button class="btn btn-danger">
                                                        <i class="la la-times"></i>
                                                        @lang('site.reject')
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">@lang('site.no_requests')</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{ $requests->links('vendor.pagination.default') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.admin._dashboard_footer')
        </div>
    </div>
@endsection
