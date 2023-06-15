@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Course Resources')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-12">
                    <a href="{{ route('teacher.courses.resources.create', $course->slug) }}">
                        <button class="theme-btn">
                            <i class="la la-plus"></i>
                            @lang('site.add_new_resource')
                        </button>
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.course_resources')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="statement-table purchase-table table-responsive mb-5">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('site.name')</th>
                                        <th scope="col">@lang('site.size')</th>
                                        <th scope="col">@lang('site.uploaded_at')</th>
                                        <th scope="col">@lang('site.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($resources as $resource)
                                        <tr>
                                            <td>
                                                <span>
                                                    @if($resource->extension == 'docx' || $resource->extension == 'doc')
                                                        <i class="far fa-file-word fa-2x"></i>
                                                    @elseif($resource->extension == 'xls' || $resource->extension == 'xlsx' || $resource->extension == 'csv')
                                                        <i class="far fa-file-excel fa-2x"></i>
                                                    @elseif($resource->extension == 'csv')
                                                        <i class="fas fa-file-csv fa-2x"></i>
                                                    @elseif($resource->extension == 'ppt' || $resource->extension == 'pptx')
                                                        <i class="far fa-file-powerpoint fa-2x"></i>
                                                    @elseif($resource->extension == 'jpeg' || $resource->extension == 'jpg' || $resource->extension == 'png')
                                                        <i class="far fa-file-image fa-2x"></i>
                                                    @elseif($resource->extension == 'pdf')
                                                        <i class="far fa-file-pdf fa-2x"></i>
                                                    @endif
                                                </span>
                                                {{ $resource->name }}
                                            </td>
                                            <td>{{ $resource->size }}</td>
                                            <td>{{ $resource->created_at->format('d/m/Y h:i A') }}</td>
                                            <td>
                                                <a href="{{ route('teacher.courses.resources.download', ['course' => $course->slug, 'resource' => $resource->id]) }}">
                                                    <button class="btn btn-info">
                                                        <i class="la la-download"></i>
                                                        @lang('site.download')
                                                    </button>
                                                </a>
                                                <form
                                                    action="{{ route('teacher.courses.resources.destroy', ['course' => $course->slug, 'resource' => $resource->id]) }}"
                                                    method="post" class="d-inline-block">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger">
                                                        <i class="la la-trash-o"></i>
                                                        @lang('site.delete')
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">@lang('site.no_resources')</td>
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
