@extends('layouts.admin.app')
@section('title', setting('website_name') . ' Contact Messages')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex flex-column justify-content-center">
                            <h3 class="widget-title">@lang('site.contact_messages')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="statement-table withdraw-table table-responsive mb-5">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('site.name')</th>
                                        <th scope="col">@lang('site.auth.email')</th>
                                        <th scope="col">@lang('site.mobile')</th>
                                        <th scope="col">@lang('site.message')</th>
                                        <th scope="col">@lang('site.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($messages as $message)
                                        <tr>
                                            <td class="pl-0">{{ $message->name }}</td>
                                            <td class="pl-0">{{ $message->email }}</td>
                                            <td class="pl-0">{{ $message->phone }}</td>
                                            <td class="pl-0">{{ Illuminate\Support\Str::words($message->message, 10) }}</td>
                                            <td>
                                                <a href="{{ route('admin.contact.show', $message->id) }}">
                                                    <button class="btn btn-info">
                                                        <i class="la la-eye"></i>
                                                        @lang('site.show')
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">@lang('site.no_contact_messages')</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{ $messages->links('vendor.pagination.default') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.admin._dashboard_footer')
        </div>
    </div>
@endsection
