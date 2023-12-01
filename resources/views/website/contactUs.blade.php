@extends('layouts.app')
@section('title', setting('website_name') . ' Contact Us')
@section('content')
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <div class="section-heading">
                            <h2 class="section__title">@lang('site.contact_us')</h2>
                        </div>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{ route('home') }}">@lang('site.home')</a></li>
                            <li>@lang('site.contact_us')</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <section class="contact-area padding-bottom-100px padding-top-50px">
        <div class="container">
            <div class="row">
            <div class="col-lg-4 column-td-half">
                    <div class="info-box info-box-color-4 text-center">
                        <div class="hover-overlay"></div>
                        <div class="icon-element mx-auto">
{{--                            <i class="la la-whatsapp"></i>--}}
                            <img src="{{ asset('images/vodafone_icon.svg') }}" alt="vodafone cash" style="max-width: 50px;margin-bottom: 11px;">
                        </div>
                        <h3 class="info__title">@lang('site.method_vodafone')</h3>
                        <p class="info__text mb-0" style="direction: ltr;font-size: 24px; color: black;">
                            <span class="d-block">+201005615033</span>
                        </p>
                    </div><!-- end info-box -->
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 column-td-half">
                    <div class="info-box info-box-color-2 text-center">
                        <div class="hover-overlay"></div>
                        <div class="icon-element mx-auto">
                            <i class="la la-envelope"></i>
                        </div>
                        <h3 class="info__title">@lang('site.email_us')</h3>
                        <p class="info__text mb-0" style="color: black;">
                            <span class="d-block">mohamedelgallad1982@gmail.com</span>
                        </p>
                    </div><!-- end info-box -->
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 column-td-half">
                    <div class="info-box info-box-color-3 text-center">
                        <div class="hover-overlay"></div>
                        <div class="icon-element mx-auto">
                            <i class="la la-phone"></i>
                        </div>
                        <h3 class="info__title">@lang('site.call_us')</h3>
                        <p class="info__text mb-0" style="direction: ltr;font-size: 24px; color: black;">
                            <span class="d-block">+201272555871</span>
                            <span class="d-block">+201005615033</span>
                            <span class="d-block">+2035874750</span>
                        </p>
                    </div><!-- end info-box -->
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
            <div class="contact-form-wrap pt-5">
                <div class="row">
                    <div class="col-lg-5 {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                        <div class="section-heading">
                            <p class="section__meta">@lang('site.get_in_touch')</p>
                            <h2 class="section__title">@lang('site.contact_with_us')</h2>
                            <span class="section-divider"></span>
                            <p class="section__desc">
                                @lang('site.contact_us_des')
                            </p>
                            <p class="section__desc">
                                @if(app()->getLocale() == 'ar')
                                    عزيزي العميل اذا واجهتك مشكله في الدفع يرجي التواصل معنا هاتفيا او عن طريق ارسال
                                    رساله واتس اب واعتبر مشكلتك محلوله لان مصلحه العميل وراحته وحقه اولويه عند i_courses
                                @elseif(app()->getLocale() == 'en')
                                    Dear customer, if you encounter a problem with payment, please contact us by phone
                                    or by sending a WhatsApp message and consider your problem solved because the
                                    customer's interest, comfort and right is a priority at i_courses
                                @endif
                            </p>

                            <ul class="social-profile">
                                <li>
                                    <a href="{{ setting('facebook') ?? "#" }}" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ setting('instagram') ?? "#" }}" target="_blank">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ setting('whatsapp') ? "https://api.whatsapp.com/send?phone=+2" . setting('whatsapp') : "#" }}"
                                       target="_blank">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ setting('youtube') ?? "#" }}" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                            </ul>
                        </div><!-- end section-heading -->
                    </div><!-- end col-lg-5 -->
                    <div class="col-lg-7">
                        <div class="contact-form-action {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                            <form method="POST" action="{{ route('contact.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-box">
                                            <label class="label-text" for="name">@lang('site.name')<span
                                                    class="primary-color-2 ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control @error('name') error @enderror" id="name"
                                                       type="text" name="name"
                                                       placeholder="@lang('site.name')">
                                                <span class="la la-user input-icon"></span>
                                                @error('name')
                                                <span class="text-danger font-size-12">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="input-box">
                                            <label class="label-text" for="email">@lang('site.auth.email')<span
                                                    class="primary-color-2 ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control @error('email') error @enderror" id="email"
                                                       type="email" name="email"
                                                       placeholder="@lang('site.auth.email')">
                                                <span class="la la-envelope input-icon"></span>
                                                @error('email')
                                                <span class="text-danger font-size-12">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-12">
                                        <div class="input-box">
                                            <label class="label-text" for="mobile">@lang('site.mobile')<span
                                                    class="primary-color-2 ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control @error('phone') error @enderror" id="mobile"
                                                       type="text" name="phone"
                                                       placeholder="@lang('site.mobile')">
                                                <span class="la la-phone input-icon"></span>
                                                @error('phone')
                                                <span class="text-danger font-size-12">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-12">
                                        <div class="input-box">
                                            <label class="label-text" for="message">
                                                @lang('site.message')
                                                <span class="primary-color-2 ml-1">*</span>
                                            </label>
                                            <div class="form-group">
                                                <textarea
                                                    class="message-control form-control @error('message') error @enderror"
                                                    id="message"
                                                    name="message"
                                                    placeholder="@lang('site.message')"></textarea>
                                                <span class="la la-pencil input-icon"></span>
                                                @error('message')
                                                <span class="text-danger font-size-12">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-12 -->
                                    <div class="col-lg-12">
                                        <button class="theme-btn" type="submit">@lang('site.send_message')</button>
                                    </div><!-- end col-md-12 -->
                                </div><!-- end row -->
                            </form>
                        </div><!-- end contact-form-action -->
                    </div><!-- end col-md-7 -->
                </div><!-- end row -->
            </div>
        </div><!-- end container -->
    </section><!-- end contact-area -->
@endsection
