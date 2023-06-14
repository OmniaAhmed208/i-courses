@role('student')
<div
    class="subscriber-area call-to-action padding-top-40px padding-bottom-40px {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="call-to-action-heading d-flex align-items-center">
                    <div class="call-to-action-icon">
                        <svg viewBox="0 -48 496 496" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m472 0h-448c-13.230469 0-24 10.769531-24 24v352c0 13.230469 10.769531 24 24 24h448c13.230469 0 24-10.769531 24-24v-352c0-13.230469-10.769531-24-24-24zm8 376c0 4.414062-3.59375 8-8 8h-448c-4.40625 0-8-3.585938-8-8v-352c0-4.40625 3.59375-8 8-8h448c4.40625 0 8 3.59375 8 8zm0 0"/>
                            <path d="m448 32h-400v240h400zm-16 224h-368v-208h368zm0 0"/>
                            <path
                                d="m328 200.136719c0-17.761719-11.929688-33.578125-29.007812-38.464844l-26.992188-7.703125v-2.128906c9.96875-7.511719 16-19.328125 16-31.832032v-14.335937c0-21.503906-16.007812-39.726563-36.449219-41.503906-11.183593-.96875-22.34375 2.800781-30.574219 10.351562-8.25 7.550781-12.976562 18.304688-12.976562 29.480469v16c0 12.503906 6.03125 24.328125 16 31.832031v2.128907l-26.992188 7.710937c-17.078124 4.886719-29.007812 20.703125-29.007812 38.464844v39.863281h160zm-16 23.863281h-128v-23.863281c0-10.664063 7.160156-20.152344 17.40625-23.082031l38.59375-11.023438v-23.070312l-3.976562-2.3125c-7.527344-4.382813-12.023438-12.105469-12.023438-20.648438v-16c0-6.703125 2.839844-13.160156 7.792969-17.695312 5.007812-4.601563 11.496093-6.832032 18.382812-6.207032 12.230469 1.0625 21.824219 12.285156 21.824219 25.566406v14.335938c0 8.542969-4.496094 16.265625-12.023438 20.648438l-3.976562 2.3125v23.070312l38.59375 11.023438c10.246094 2.9375 17.40625 12.425781 17.40625 23.082031zm0 0"/>
                            <path
                                d="m32 364.945312 73.886719-36.945312-73.886719-36.945312zm16-48 22.113281 11.054688-22.113281 11.054688zm0 0"/>
                            <path d="m152 288h16v80h-16zm0 0"/>
                            <path d="m120 288h16v80h-16zm0 0"/>
                            <path d="m336 288h-48v32h-104v16h104v32h48v-32h128v-16h-128zm-16 64h-16v-48h16zm0 0"/>
                        </svg>
                    </div>
                    <div class="section-heading">
                        <h2 class="section__title font-size-20 pb-1">@lang('site.become_techer_header')</h2>
                        <p class="section__desc mb-0">@lang('site.become_techer_text')</p>
                    </div><!-- end section-heading -->
                </div>
            </div><!-- end col-lg-8 -->
            <div class="col-lg-4">
                <div class="btn-box text-right">
                    <a href="{{ route('become-teacher.index') }}" class="theme-btn">@lang('site.teach_on_max')</a>
                </div><!-- end btn-box-->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end subscriber-area -->
@endrole
<section
    class="footer-area section-bg-2 padding-top-100px padding-bottom-40px {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 column-td-half">
                <div class="footer-widget">
                    <h3 class="widget-title font-size-17">@lang('site.follow_on')</h3>
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
                </div><!-- end footer-widget -->
            </div><!-- end col-lg-4 -->
            <div class="col-lg-4 column-td-half">
                <div class="footer-widget">
                    <h3 class="widget-title">@lang('site.pages')</h3>
                    <span class="section-divider"></span>
                    <ul class="list-items">
                        <li><a href="{{ route('home') }}">@lang('site.home')</a></li>
                        <li><a href="{{ route('courses.index') }}">@lang('site.teacher_courses')</a></li>
                        <li><a href="{{ route('contact.index') }}">@lang('site.contact_us')</a></li>
                        <li><a href="{{ route('about.index') }}">@lang('site.about_us')</a></li>
                        <li><a href="{{ route('about.teacher') }}">@lang('site.about_teacher')</a></li>
                    </ul>
                </div><!-- end footer-widget -->
            </div><!-- end col-lg-4 -->
            <div class="col-lg-4 column-td-half">
                <div class="footer-widget">
                    <h3 class="widget-title">@lang('site.download_app')</h3>
                    <span class="section-divider"></span>
                    <ul class="btn-box">
                        <li>
                            <a href="{{ setting('app_store_link') ?? "#" }}"
                               class="theme-btn">
                                <i class="la la-apple icon-element"></i>
                                <span class="app-titles">
                                    <span class="app__subtitle">@lang('site.download_on_the')</span>
                                    <span class="app__title">@lang('site.app_store')</span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ setting('google_play_link') ?? "#" }}"
                               class="theme-btn">
                                <i class="la la-android icon-element"></i>
                                <span class="app-titles">
                                    <span class="app__subtitle">@lang('site.get_in_on')</span>
                                    <span class="app__title">@lang('site.google_play')</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div><!-- end footer-widget -->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
        <div class="copyright-content">
            <div class="row align-items-center">
                <div class="col-lg-10">
                    <p class="copy__desc">
                        &copy; {{ \Carbon\Carbon::now()->format('Y') }} @lang('site.all_right_reserved')
                        {{ setting('website_name') }}</p>
                </div><!-- end col-lg-9 -->
                <div class="col-lg-2">
                    <div class="sort-ordering">
                        <select class="sort-ordering-select" onchange="location = this.value;">

                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                                <option
                                    value="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                    {{ $localeCode  == app()->getLocale() ? 'selected' : '' }}>
                                    {{ $properties['native'] }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                </div>
            </div><!-- end row -->
        </div><!-- end copyright-content -->
    </div><!-- end container -->
</section><!-- end footer-area -->
