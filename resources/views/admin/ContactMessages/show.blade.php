@extends('layouts.admin.app')
@section('title', setting('website_name') . ' Contact Message')
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
                            <div class="user-form">
                                <div class="contact-form-action">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td style="width: 25%">@lang('site.from')</td>
                                            <td>{{ $contact->name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 25%">@lang('site.auth.email')</td>
                                            <td>{{ $contact->email }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 25%">@lang('site.mobile')</td>
                                            <td>{{ $contact->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 25%">@lang('site.message')</td>
                                            <td>{{ $contact->message }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 25%">@lang('site.sent_at')</td>
                                            <td>{{ $contact->created_at->format('d/m/Y h:i A') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.admin._dashboard_footer')
        </div>
    </div>
@endsection
