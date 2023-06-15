@extends('layouts.admin.app')
@section('title', setting('website_name') . ' Settings')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title">@lang('site.website_settings')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="section-tab section-tab-2">
                                <ul class="nav nav-tabs" role="tablist" id="review">
                                    <li role="presentation">
                                        <a href="#general_settings" role="tab" data-toggle="tab" class="active"
                                           aria-selected="true">
                                            @lang('site.general_settings')
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#website_pictures" role="tab" data-toggle="tab"
                                           aria-selected="false">
                                            @lang('site.website_pictures')
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#animated_code" role="tab" data-toggle="tab" aria-selected="false">
                                            @lang('site.animated_code')
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#mobile_apps_links" role="tab" data-toggle="tab" aria-selected="false">
                                            @lang('site.mobile_apps_links')
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#social_links" role="tab" data-toggle="tab" aria-selected="false">
                                            @lang('site.social_links')
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dashboard-tab-content mt-5">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active show" id="general_settings">
                                        <div class="user-form">
                                            <div class="user-profile-action-wrap">
                                                <h3 class="widget-title font-size-18 padding-bottom-40px">@lang('site.general_settings')</h3>
                                            </div><!-- end user-profile-action-wrap -->
                                            <div class="contact-form-action">
                                                <form method="post"
                                                      action="{{ route('admin.settings.update_general_settings') }}">
                                                    @csrf
                                                    @method('put')
                                                    <div class="row">
                                                        <div class="col-lg-12 col-sm-12">
                                                            <div class="input-box">
                                                                <label class="label-text" for="website_name">
                                                                    @lang('site.website_name')
                                                                    <span class="primary-color-2 ml-1">*</span>
                                                                </label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('website_name') error @enderror"
                                                                        type="text"
                                                                        name="website_name" id="website_name"
                                                                        value="{{ old('website_name', setting('website_name')) }}">
                                                                    <span class="las la-address-card input-icon"></span>
                                                                    @error('website_name')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text" for="header_title_ar">
                                                                    @lang('site.header_title_ar')
                                                                    <span class="primary-color-2 ml-1">*</span>
                                                                </label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('header_title_ar') error @enderror"
                                                                        id="header_title"
                                                                        type="text" name="header_title_ar"
                                                                        value="{{ old('header_title_ar', setting('header_title_ar')) }}">
                                                                    <span class="las la-heading input-icon"></span>
                                                                    @error('header_title_ar')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text" for="header_title_en">
                                                                    @lang('site.header_title_en')
                                                                    <span class="primary-color-2 ml-1">*</span>
                                                                </label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('header_title_en') error @enderror"
                                                                        id="header_title"
                                                                        type="text" name="header_title_en"
                                                                        value="{{ old('header_title_en', setting('header_title_en')) }}">
                                                                    <span class="las la-heading input-icon"></span>
                                                                    @error('header_title_en')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text" for="header_slogan_ar">
                                                                    @lang('site.header_slogan_ar')
                                                                </label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('header_slogan_ar') error @enderror"
                                                                        id="header_slogan_ar"
                                                                        type="text"
                                                                        name="header_slogan_ar"
                                                                        value="{{ old('header_slogan_ar', setting('header_slogan_ar')) }}">
                                                                    <span class="las la-heading input-icon"></span>
                                                                    @error('header_slogan_ar')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text" for="header_slogan_en">
                                                                    @lang('site.header_slogan_en')
                                                                </label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('header_slogan_en') error @enderror"
                                                                        id="header_slogan_en"
                                                                        type="text"
                                                                        name="header_slogan_en"
                                                                        value="{{ old('header_slogan_en', setting('header_slogan_en')) }}">
                                                                    <span class="las la-heading input-icon"></span>
                                                                    @error('header_slogan_en')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text" for="can_upload_pp">
                                                                    @lang('site.can_upload_pp')
                                                                </label>
                                                                <div class="form-group">
                                                                    <select name="can_upload_pp" id="can_upload_pp"
                                                                            class="form-control p-2 @error('can_upload_pp') error @enderror">
                                                                        <option
                                                                            value="on" {{ setting('can_upload_pp') == 'on' ? 'selected' : '' }}>@lang('site.active')</option>
                                                                        <option
                                                                            value="off" {{ setting('can_upload_pp') == 'off' ? 'selected' : '' }}>@lang('site.inactive')</option>
                                                                    </select>
                                                                    @error('can_upload_pp')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-12 col-sm-12">
                                                            <div class="input-box">
                                                                <label class="label-text" for="website_color">
                                                                    @lang('site.website_color')
                                                                </label>
                                                                <div class="form-group">
                                                                    <select class="form-control"
                                                                            name="website_color" id="website_color">
                                                                        <option
                                                                            value="green"
                                                                            data-color="#51be78"
                                                                            {{ setting('website_color') == 'green' ? 'selected' : '' }}
                                                                        >
                                                                            @lang('site.green')</option>
                                                                        <option
                                                                            value="blue"
                                                                            data-color="#1198d1"
                                                                            {{ setting('website_color') == 'blue' ? 'selected' : '' }}
                                                                        >
                                                                            @lang('site.blue')</option>
                                                                        <option
                                                                            value="red"
                                                                            data-color="#e76e67"
                                                                            {{ setting('website_color') == 'red' ? 'selected' : '' }}
                                                                        >
                                                                            @lang('site.red')</option>
                                                                        <option
                                                                            value="gold"
                                                                            data-color="#FBB03B"
                                                                            {{ setting('website_color') == 'gold' ? 'selected' : '' }}
                                                                        >
                                                                            @lang('site.gold')</option>
                                                                        <option
                                                                            value="brown"
                                                                            data-color="#793725"
                                                                            {{ setting('website_color') == 'brown' ? 'selected' : '' }}
                                                                        >
                                                                            @lang('site.brown')</option>
                                                                    </select>
                                                                    @error('website_color')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
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
                                    <div role="tabpanel" class="tab-pane fade" id="website_pictures">
                                        <div class="user-form padding-bottom-60px">
                                            <div class="user-profile-action-wrap">
                                                <h3 class="widget-title font-size-18">@lang('site.website_pictures')</h3>
                                            </div><!-- end user-profile-action-wrap -->
                                            <hr>
                                            <div class="contact-form-action">
                                                <h4 class="font-size-16 mb-2">@lang('site.website_logo')</h4>
                                                <img
                                                    src="{{ setting('website_logo') ? asset(setting('website_logo')) : asset('images/logo.png') }}"
                                                    alt="Logo" style="max-height: 70px;margin: 25px 0;">
                                                <div class="row mt-3">
                                                    <form action="{{ route('admin.settings.update_website_pictures') }}"
                                                          method="post" enctype="multipart/form-data" class="w-100">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="_image_type" value="website_logo">
                                                        <div class="col-lg-12 col-sm-12">
                                                            <div class="input-box">
                                                                <div class="form-group mb-0">
                                                                    <div class="upload-btn-box course-photo-btn">
                                                                        <input type="file" name="image"
                                                                               class="filer_input"
                                                                               data-jfiler-extensions="jpg, jpeg, png">
                                                                        @error('image')
                                                                        <span
                                                                            class="text-danger font-size-12">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="btn-box">
                                                                <button class="theme-btn" type="submit">
                                                                    @lang('site.change_logo')
                                                                </button>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                    </form>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="contact-form-action">
                                                <h4 class="font-size-16 mb-2">@lang('site.homepage_picture')</h4>
                                                <img
                                                    src="{{ setting('homepage_picture') ? asset(setting('homepage_picture')) : asset('images/slider-img4.jpg') }}"
                                                    alt="homepage picture" style="max-width: 100%">
                                                <div class="row mt-3">
                                                    <form action="{{ route('admin.settings.update_website_pictures') }}"
                                                          method="post" enctype="multipart/form-data" class="w-100">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="_image_type"
                                                               value="homepage_picture">
                                                        <div class="col-lg-12 col-sm-12">
                                                            <div class="input-box">
                                                                <div class="form-group mb-0">
                                                                    <div class="upload-btn-box course-photo-btn">
                                                                        <input type="file" name="image"
                                                                               class="filer_input"
                                                                               data-jfiler-extensions="jpg, jpeg, png">
                                                                        @error('image')
                                                                        <span
                                                                            class="text-danger font-size-12">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="btn-box">
                                                                <button class="theme-btn" type="submit">
                                                                    @lang('site.change_homepage_picture')
                                                                </button>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                    </form>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="contact-form-action">
                                                <h4 class="font-size-16 mb-2">@lang('site.breadcrumb_picture')</h4>
                                                <img
                                                    src="{{ setting('breadcrumb_picture') ? asset(setting('breadcrumb_picture')) : asset('images/breadcrumb-bg.jpg') }}"
                                                    alt="homepage picture" style="max-width: 100%">
                                                <div class="row mt-3">
                                                    <form action="{{ route('admin.settings.update_website_pictures') }}"
                                                          method="post" enctype="multipart/form-data" class="w-100">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="_image_type"
                                                               value="breadcrumb_picture">
                                                        <div class="col-lg-12 col-sm-12">
                                                            <div class="input-box">
                                                                <div class="form-group mb-0">
                                                                    <div class="upload-btn-box course-photo-btn">
                                                                        <input type="file" name="image"
                                                                               class="filer_input"
                                                                               data-jfiler-extensions="jpg, jpeg, png">
                                                                        @error('image')
                                                                        <span
                                                                            class="text-danger font-size-12">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="btn-box">
                                                                <button class="theme-btn" type="submit">
                                                                    @lang('site.change_breadcrumb_picture')
                                                                </button>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end tab-pane-->
                                    <div role="tabpanel" class="tab-pane fade" id="animated_code">
                                        <div class="user-form">
                                            <div class="user-profile-action-wrap">
                                                <h3 class="widget-title font-size-18">@lang('site.animated_code')</h3>
                                            </div><!-- end user-profile-action-wrap -->
                                            <div class="contact-form-action">
                                                <form action="{{ route('admin.settings.update_animated_code_status') }}"
                                                      method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div class="input-box">
                                                                <label class="label-text"
                                                                       for="show_code">@lang('site.show_code')
                                                                    <span class="primary-color-2 ml-1">*</span>
                                                                </label>
                                                                <div class="form-group">
                                                                    <select
                                                                        class="form-control p-2 @error('show_code') error @enderror"
                                                                        name="show_code"
                                                                        id="show_code">
                                                                        <option
                                                                            value="on" {{ setting('code.status') == 'on' ? 'selected' : '' }}>@lang('site.activated')</option>
                                                                        <option
                                                                            value="off" {{ setting('code.status') == 'off' ? 'selected' : '' }}>@lang('site.deactivated')</option>
                                                                    </select>
                                                                    @error('show_code')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-8 -->
                                                        <div class="col-sm-4 d-flex align-items-center">
                                                            <div id="student_code" class="mb-2 mb-sm-0 mt-0 mt-sm-2"
                                                                 style="font-size: 18px;position: relative !important;">
                                                                XXX
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="btn-box">
                                                                <button class="theme-btn"
                                                                        type="submit">
                                                                    @lang('site.save_changes')
                                                                </button>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                    </div><!-- end row -->
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- end tab-pane-->
                                    <div role="tabpanel" class="tab-pane fade" id="mobile_apps_links">
                                        <div class="user-profile-action-wrap">
                                            <h3 class="widget-title font-size-18 padding-bottom-20px">@lang('site.mobile_apps_links')</h3>
                                        </div><!-- end user-profile-action-wrap -->
                                        <div class="user-form">
                                            <div class="contact-form-action">
                                                <form action="{{ route('admin.settings.update_mobile_links') }}"
                                                      method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="row">
                                                        <div class="col-lg-6 col-sm-12">
                                                            <div class="input-box">
                                                                <label class="label-text"
                                                                       for="google_play_link">@lang('site.google_play_link')</label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('google_play_link') error @enderror"
                                                                        id="google_play_link" type="text"
                                                                        name="google_play_link"
                                                                        value="{{ old('google_play_link', setting('google_play_link')) }}">
                                                                    <span
                                                                        class="lab la-google-play input-icon"></span>
                                                                    @error('google_play_link')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-6 col-sm-12">
                                                            <div class="input-box">
                                                                <label class="label-text"
                                                                       for="app_store_link">@lang('site.app_store_link')</label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('app_store_link') error @enderror"
                                                                        id="app_store_link"
                                                                        type="text" name="app_store_link"
                                                                        value="{{ old('app_store_link', setting('app_store_link')) }}">
                                                                    <span class="lab la-app-store input-icon"></span>
                                                                    @error('app_store_link')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
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
                                    <div role="tabpanel" class="tab-pane fade" id="social_links">
                                        <div class="user-profile-action-wrap">
                                            <h3 class="widget-title font-size-18 padding-bottom-20px">@lang('site.social_links')</h3>
                                        </div><!-- end user-profile-action-wrap -->
                                        <div class="user-form">
                                            <div class="contact-form-action">
                                                <form action="{{ route('admin.settings.update_social_links') }}"
                                                      method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="row">
                                                        <div class="col-lg-6 col-sm-12">
                                                            <div class="input-box">
                                                                <label class="label-text"
                                                                       for="facebook">@lang('site.facebook')</label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('facebook') error @enderror"
                                                                        id="facebook" type="text"
                                                                        name="facebook"
                                                                        value="{{ old('facebook', setting('facebook')) }}">
                                                                    <span
                                                                        class="lab la-facebook input-icon"></span>
                                                                    @error('facebook')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-6 col-sm-12">
                                                            <div class="input-box">
                                                                <label class="label-text"
                                                                       for="instagram">@lang('site.instagram')</label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('instagram') error @enderror"
                                                                        id="instagram"
                                                                        type="text" name="instagram"
                                                                        value="{{ old('instagram', setting('instagram')) }}">
                                                                    <span class="lab la-instagram input-icon"></span>
                                                                    @error('instagram')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-6 col-sm-12">
                                                            <div class="input-box">
                                                                <label class="label-text"
                                                                       for="whatsapp">@lang('site.whatsapp')</label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('whatsapp') error @enderror"
                                                                        id="whatsapp" type="text"
                                                                        name="whatsapp"
                                                                        value="{{ old('whatsapp', setting('whatsapp')) }}">
                                                                    <span
                                                                        class="lab la-whatsapp input-icon"></span>
                                                                    @error('whatsapp')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-6 col-sm-12">
                                                            <div class="input-box">
                                                                <label class="label-text"
                                                                       for="youtube">@lang('site.youtube')</label>
                                                                <div class="form-group">
                                                                    <input
                                                                        class="form-control @error('youtube') error @enderror"
                                                                        id="youtube"
                                                                        type="text" name="youtube"
                                                                        value="{{ old('youtube', setting('youtube')) }}">
                                                                    <span class="lab la-youtube input-icon"></span>
                                                                    @error('youtube')
                                                                    <span
                                                                        class="text-danger font-size-12">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
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
                                </div><!-- end tab-content -->
                            </div><!-- end dashboard-tab-content -->
                        </div>
                    </div><!-- end card-box-shared -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
            @include('layouts.admin._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-colorselector.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('js/bootstrap-colorselector.min.js') }}"></script>
    <script>
        $('#website_color').colorselector();
    </script>
@endpush

