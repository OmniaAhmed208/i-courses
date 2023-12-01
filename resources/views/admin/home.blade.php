@extends('layouts.admin.app')
@section('title', setting('website_name') . ' Dashboard')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <h3 class="widget-title">@lang('site.dashboard')</h3>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-4 column-lmd-2-half column-md-2-full">
                    <div class="icon-box d-flex align-items-center">
                        <div class="icon-element icon-element-bg-3 flex-shrink-0">
                            <i class="la la-graduation-cap"></i>
                        </div><!-- end icon-element-->
                        <div class="info-content">
                            <h4 class="info__title mb-2">@lang('site.total_teachers')</h4>
                            <span class="info__count">{{ $total_teachers }}</span>
                        </div><!-- end info-content -->
                    </div>
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 column-lmd-2-half column-md-2-full">
                    <div class="icon-box d-flex align-items-center">
                        <div class="icon-element icon-element-bg-4 flex-shrink-0">
                            <i class="la la-users"></i>
                        </div><!-- end icon-element-->
                        <div class="info-content">
                            <h4 class="info__title mb-2">@lang('site.total_students')</h4>
                            <span class="info__count">{{ $total_students }}</span>
                        </div><!-- end info-content -->
                    </div>
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 column-lmd-2-half column-md-2-full">
                    <div class="icon-box d-flex align-items-center">
                        <div class="icon-element icon-element-bg-5 flex-shrink-0">
                            <i class="la la-file-video-o"></i>
                        </div><!-- end icon-element-->
                        <div class="info-content">
                            <h4 class="info__title mb-2">@lang('site.total_courses')</h4>
                            <span class="info__count">{{ $total_courses }}</span>
                        </div><!-- end info-content -->
                    </div>
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->


            @include('layouts.admin._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection
