<section class="header-menu-area course-dashboard-header {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
    <div class="header-menu-fluid">
        <div class="header-menu-content course-dashboard-menu-content">
            <div class="container-fluid">
                <div class="main-menu-content d-flex align-items-center">
                    <div class="logo-box">
                        <a href="{{ route('home') }}" class="logo" title="MAX">
                            <img src="{{ asset('images/logo2.png') }}" alt="logo" style="max-height: 40px">
                        </a>
                    </div>
                    <div class="course-dashboard-title d-flex justify-content-between">
                        <span>{{ $title }}</span>
                        <a href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            @lang('site.auth.logout')
                        </a>
                    </div>
                </div><!-- end row -->
            </div><!-- end container-fluid -->
        </div><!-- end header-menu-content -->
    </div><!-- end header-menu-fluid -->
</section><!-- end header-menu-area -->
