@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' add resource')
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
                            <h3 class="widget-title">@lang('site.add_new_resource')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="user-form">
                                <div class="contact-form-action">
                                    <form action="{{ route('teacher.courses.resources.store', $course->slug) }}"
                                          method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="input-box">
                                                    <label class="label-text mb-0">@lang('site.files')
                                                        <span class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <span class="d-block font-size-13 mb-1">@lang("site.available_extentions") (pdf, doc, docx, xls, xlsx, ppt, pptx, csv, jpg, jpeg, png)</span>
                                                    <div class="form-group ">
                                                        <div class="upload-btn-box resource-photo-btn">
                                                            <input type="file" name="files[]"
                                                                   class="resources_input" multiple="multiple">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-12 -->
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="col-lg-12">
                                                    <button class="theme-btn" type="submit">
                                                        <i class="la la-upload"></i>
                                                        @lang('site.upload_files')
                                                    </button>
                                                </div><!-- end col-lg-12 -->
                                            </div>
                                        </div>
                                    </form><!-- end row -->
                                </div>
                            </div>
                        </div><!-- end card-box-shared-body -->
                    </div><!-- end card-box-shared -->
                </div><!-- end col-lg-12 -->
            </div>
            @include('layouts.teacher._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection
