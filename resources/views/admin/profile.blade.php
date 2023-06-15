@extends('layouts.admin.app')
@section('title', setting('website_name') . ' Profile')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.settings')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="section-tab section-tab-2">
                                <ul class="nav nav-tabs" role="tablist" id="review">
                                    <li role="presentation">
                                        <a href="#profile" role="tab" data-toggle="tab" class="active"
                                           aria-selected="true">
                                            @lang('site.profile')
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#password" role="tab" data-toggle="tab" aria-selected="false">
                                            @lang('site.auth.password')
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dashboard-tab-content mt-5">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active show" id="profile">
                                        <div class="user-form">
                                            @if(setting('can_upload_pp') == 'on')
                                                <div class="user-profile-action-wrap mb-5">
                                                    <h3 class="widget-title font-size-18 padding-bottom-40px">@lang('site.profile')</h3>
                                                    <div class="user-profile-action d-flex justify-content-center">
                                                        <div class="img_container" style="position: relative">
                                                            <img src="{{ auth()->user()->avatar }}"
                                                                 alt="{{ auth()->user()->name }}"
                                                                 class="profile_pic"
                                                                 style="width: 200px; height: 200px">
                                                            <div
                                                                class="text-center upload_img">
                                                                <i class="las la-edit"></i>
                                                            </div>
                                                            <input type="file" name="image" id="upload_image"
                                                                   accept="image/*" class="d-none"/>
                                                        </div>
                                                    </div><!-- end user-profile-action -->
                                                </div><!-- end user-profile-action-wrap -->

                                                <div class="row mt-5 mb-5">
                                                    <div class="col-lg-12">
                                                        <div class="section-block"></div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="contact-form-action">
                                                <form method="post" action="{{ route('admin.profile.update') }}">
                                                    @csrf
                                                    @method('put')
                                                    <div class="row">
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text">@lang('site.auth.first_name')
                                                                    <span
                                                                        class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('first_name') error @enderror"
                                                                        type="text"
                                                                        name="first_name"
                                                                        value="{{ old('first_name', auth()->user()->first_name) }}">
                                                                    <span class="la la-user input-icon"></span>
                                                                    @error('first_name')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text">@lang('site.auth.last_name')
                                                                    <span
                                                                        class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('last_name') error @enderror"
                                                                        type="text"
                                                                        name="last_name"
                                                                        value="{{ old('last_name', auth()->user()->last_name) }}">
                                                                    <span class="la la-user input-icon"></span>
                                                                    @error('last_name')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text">@lang('site.mobile')<span
                                                                        class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('mobile') error @enderror"
                                                                        type="text" name="mobile"
                                                                        value="{{ old('mobile', auth()->user()->mobile) }}">
                                                                    <span class="la la-phone input-icon"></span>
                                                                    @error('mobile')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label
                                                                    class="label-text">@lang('site.auth.email_address')
                                                                </label>
                                                                <p>{{ auth()->user()->email }}</p>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-12">
                                                            <div class="btn-box">
                                                                <button class="theme-btn"
                                                                        type="submit">@lang('site.save_changes')
                                                                </button>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                    </div><!-- end row -->
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- end tab-pane-->
                                    <div role="tabpanel" class="tab-pane fade" id="password">
                                        <div class="user-form padding-bottom-60px">
                                            <div class="user-profile-action-wrap">
                                                <h3 class="widget-title font-size-18 padding-bottom-40px">
                                                    @lang('site.change_password')
                                                </h3>
                                            </div><!-- end user-profile-action-wrap -->
                                            <div class="contact-form-action">
                                                <form method="post"
                                                      action="{{ route('admin.profile.change_password') }}">
                                                    @csrf
                                                    @method('put')
                                                    <div class="row">
                                                        <div class="col-lg-8 col-sm-12">
                                                            <div class="input-box">
                                                                <label class="label-text" for="old_password">
                                                                    @lang('site.auth.old_password')
                                                                    <span
                                                                        class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input id="old_password" class="form-control"
                                                                           type="password"
                                                                           name="old_password"
                                                                           placeholder="Old password">
                                                                    <span class="la la-lock input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-4 -->
                                                        <div class="col-lg-8 col-sm-12">
                                                            <div class="input-box">
                                                                <label class="label-text" for="password">
                                                                    @lang('site.auth.new_password')
                                                                    <span class="primary-color-2 ml-1">*</span>
                                                                </label>
                                                                <div class="form-group">
                                                                    <input id="password" class="form-control"
                                                                           type="password"
                                                                           name="password"
                                                                           placeholder="New password">
                                                                    <span class="la la-lock input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-4 -->
                                                        <div class="col-lg-8 col-sm-12">
                                                            <div class="input-box">
                                                                <label class="label-text" for="password_confirmation">
                                                                    @lang('site.auth.password_confirmation')
                                                                    <span class="primary-color-2 ml-1">*</span>
                                                                </label>
                                                                <div class="form-group">
                                                                    <input id="password_confirmation"
                                                                           class="form-control" type="password"
                                                                           name="password_confirmation"
                                                                           placeholder="Confirm new password">
                                                                    <span class="la la-lock input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-4 -->
                                                        <div class="col-lg-12">
                                                            <div class="btn-box">
                                                                <button class="theme-btn" type="submit">
                                                                    @lang('site.change_password')
                                                                </button>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                    </div><!-- end row -->
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- end tab-pane-->
                                </div><!-- end tab-content -->
                            </div><!-- end dashboard-tab-content -->
                        </div>
                    </div><!-- end card-box-shared -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
            @include('layouts.admin._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
    @if(setting('can_upload_pp') == 'on')
        <div class="modal-form text-center">
            <div id="uploadimageModal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content p-4">
                        <div class="modal-header">
                            <h4 class="modal-title">@lang('site.update_p_picture')</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center text-center">
                                    <div id="image_demo" style="width:450px;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div style="padding-top:30px;">
                                        <button class="btn theme-btn crop_image">@lang('site.update_p_picture')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end modal-content -->
                </div><!-- end modal-dialog -->
            </div><!-- end modal -->
        </div><!-- end modal-form -->
    @endif
@endsection
@if(setting('can_upload_pp') == 'on')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/croppie.css') }}">
    @endpush
    @push('scripts')
        <script src="{{ asset('js/croppie.min.js') }}"></script>
        <script src="{{ asset('js/exif.js') }}"></script>
        <script>
            $(document).ready(function () {
                $(".upload_img").on('click', function () {
                    $('#upload_image').click();
                });

                $image_crop = $('#image_demo').croppie({
                    enableExif: true,
                    viewport: {
                        width: 250,
                        height: 250,
                        type: 'circle'
                    },
                    boundary: {
                        width: 400,
                        height: 400
                    }
                });

                $('#upload_image').on('change', function () {
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        $image_crop.croppie('bind', {
                            url: event.target.result
                        }).then(function () {
                        });
                    }
                    reader.readAsDataURL(this.files[0]);
                    $('#uploadimageModal').modal('show');
                });

                $('.crop_image').click(function (event) {
                    $image_crop.croppie('result', {
                        type: 'canvas',
                        size: 'viewport'
                    }).then(function (response) {
                        console.log(response);
                        $.ajax({
                            url: "{{ route('admin.profile.upload_picture') }}",
                            type: "POST",
                            data: {
                                "image": response,
                                "_method": "PUT",
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function (data) {
                                $('#uploadimageModal').modal('hide');
                                $('.profile_pic').attr("src", data.img);

                                new Noty({
                                    type: 'success',
                                    layout: '{{ app()->getLocale() == 'ar' ? 'topLeft' : 'topRight' }}',
                                    text: data.message,
                                    timeout: 5000,
                                    killer: true
                                }).show();
                            }
                        });
                    })
                });

            });
        </script>
    @endpush
@endif
