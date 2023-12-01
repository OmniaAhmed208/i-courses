@extends('layouts.app')
@section('title', setting('website_name') . ' Become a teacher')
@section('content')
    <!-- ================================
    START BREADCRUMB AREA
================================= -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <div class="section-heading">
                            <h2 class="section__title">@lang('site.become_a_teacher')</h2>
                        </div>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{ route('home') }}">@lang('site.home')</a></li>
                            <li>@lang('site.become_a_teacher')</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!--======================================
            START INFO AREA
     ======================================-->
    <section class="info-area section-bg text-center section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2 class="section__title">@lang('site.create_courses')</h2>
                        <span class="section-divider"></span>
                    </div>
                </div>
            </div><!-- end row -->
            <div class="row margin-top-30px">
                <div class="col-lg-4 column-td-half">
                    <div class="info-box before-none info-box-color-1">
                        <div class="icon-element mx-auto">
                            <i class="la la-lightbulb-o"></i>
                        </div>
                        <h3 class="info__title">@lang('site.plan_your_course')</h3>
                        <p class="info__text mb-0">
                            @lang('site.plan_your_course_desc')
                        </p>
                    </div><!-- end info-box -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-4 column-td-half">
                    <div class="info-box before-none info-box-color-2">
                        <div class="icon-element mx-auto">
                            <i class="la la-video-camera"></i>
                        </div>
                        <h3 class="info__title">@lang('site.record_your_video')</h3>
                        <p class="info__text mb-0">@lang('site.record_your_video_desc')</p>
                    </div><!-- end info-box -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-4 column-td-half">
                    <div class="info-box before-none info-box-color-3">
                        <div class="icon-element mx-auto">
                            <i class="la la-users"></i>
                        </div>
                        <h3 class="info__title">@lang('site.build_community')</h3>
                        <p class="info__text mb-0">@lang('site.build_community_desc')</p>
                    </div><!-- end info-box -->
                </div><!-- end col-lg-3 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end info-area -->
    <!--======================================
            END INFO AREA
    ======================================-->

    <div class="section-block"></div>

    <!-- ================================
           START REGISTER AREA
    ================================= -->
    <section class="register-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading text-center">
                        <h5 class="section__meta">@lang('site.auth.register')</h5>
                        <h2 class="section__title">@lang('site.fill_teacher_form')</h2>
                        <span class="section-divider"></span>
                    </div>
                </div>
            </div>
            <div class="row margin-top-30px">
                <div class="col-lg-10 mx-auto">
                    <div class="card-box-shared mb-0">
                        <div class="card-box-shared-body">
                            <div class="contact-form-action">
                                <form method="POST" action="{{ route('become-teacher.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.mobile')<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control @error('mobile') error @enderror"
                                                           type="text" name="mobile"
                                                           value="{{ old('mobile') }}"
                                                           placeholder="@lang('site.mobile')" required autofocus>
                                                    <span class="la la-phone input-icon"></span>
                                                    @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-12 -->
                                        <div class="col-lg-12">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.address')<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control @error('address') error @enderror"
                                                           type="text" name="address"
                                                           value="{{ old('address') }}"
                                                           placeholder="@lang('site.address')" required>
                                                    <span class="la la-map input-icon"></span>
                                                    @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-6 -->
                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.city')<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control @error('city') error @enderror"
                                                           type="text" name="city"
                                                           value="{{ old('city') }}"
                                                           placeholder="@lang('site.city')" required>
                                                    <span class="la la-map-marker input-icon"></span>
                                                    @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-6 -->
                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <label class="label-text">
                                                    @lang('site.country')
                                                    <span class="primary-color-2 ml-1">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <div class="sort-ordering user-form-short">
                                                        <select class="sort-ordering-select" name="country" required>
                                                            <option selected value="">@lang('site.select_country')</option>
                                                            <option value="Egypt">@lang('site.egypt')</option>
                                                        </select>
                                                        @error('country')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-6 -->
                                        <div class="col-lg-12 {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                            <div class="input-box">
                                                <label class="label-text">@lang('site.select_gender')<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <label for="radio-1" class="radio-trigger mb-0 mr-2">
                                                        <input type="radio" id="radio-1" name="gender"
                                                               value="male"
                                                            {{ old('gender') == 'male' ? 'checked' : '' }}>
                                                        <span class="checkmark"></span>
                                                        <span class="font-size-15 primary-color-3">@lang('site.male')</span>
                                                    </label>
                                                    <label for="radio-2" class="radio-trigger mb-0">
                                                        <input type="radio" id="radio-2" name="gender"
                                                               value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                                        <span class="checkmark"></span>
                                                        <span class="font-size-15 primary-color-3">@lang('site.female')</span>
                                                    </label>
                                                    @error('gender')
                                                    <span class="text-danger d-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-12 -->
                                        <div class="col-lg-12 {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}" style="overflow-x: hidden;">
                                            <div class="form-group">
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="chb1"
                                                           name="accept_terms" {{ old('accept_terms') ? 'checked' : '' }}>
                                                    <label for="chb1">@lang('site.auth.agrement')<a
                                                            href="#">@lang('site.auth.terms_of_use')</a> @lang('site.and')
                                                        <a href="#">@lang('site.auth.privacy_policy')</a>.
                                                    </label>
                                                    @error('accept_terms')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div><!-- end col-lg-12 -->
                                        <div class="col-lg-12 {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                            <div class="btn-box">
                                                <button class="theme-btn" type="submit">@lang('site.become_a_teacher')</button>
                                            </div>
                                        </div><!-- end col-lg-12 -->
                                    </div><!-- end row -->
                                </form>
                            </div><!-- end contact-form-action -->
                        </div>
                    </div><!-- end card-box-shared -->
                </div><!-- end col-lg-10 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end register-area -->
    <!-- ================================
           START REGISTER AREA
    ================================= -->

@endsection
