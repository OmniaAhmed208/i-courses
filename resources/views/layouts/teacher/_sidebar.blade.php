<div class="dashboard-sidebar">
    <div class="dashboard-nav-trigger">
        <div class="dashboard-nav-trigger-btn">
            <i class="la la-bars"></i> Dashboard Nav
        </div>
    </div>
    <div class="dashboard-nav-container">
        <div class="humburger-menu">
            <div class="humburger-menu-lines side-menu-close"></div><!-- end humburger-menu-lines -->
        </div><!-- end humburger-menu -->
        <div class="side-menu-wrap">
            <ul class="side-menu-ul">
                <li class="sidenav__item {{ strpos(Route::currentRouteName(), 'teacher.home') !== false ? 'page-active' : '' }}">
                    <a href="{{ route('teacher.home') }}">
                        <i class="la la-dashboard"></i>
                        @lang('site.dashboard')
                    </a>
                </li>
                <li class="sidenav__item {{ strpos(Route::currentRouteName(), 'teacher.courses.') !== false ? 'page-active' : '' }}">
                    <a href="{{ route('teacher.courses.index') }}">
                        <i class="la la-file-video-o"></i>
                        @lang('site.my_courses')
                    </a>
                </li>
                {{--                <li class="sidenav__item {{ strpos(Route::currentRouteName(), 'teacher.questions_bank.groups.') !== false ? 'page-active' : '' }}">--}}
                {{--                    <a href="{{ route('teacher.questions_bank.groups.index') }}">--}}
                {{--                        <i class="las la-object-ungroup"></i>--}}
                {{--                        @lang('site.questions_bank_groups')--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                <li class="sidenav__item {{ strpos(Route::currentRouteName(), 'teacher.questions_bank.') !== false ? 'page-active' : '' }}">
                    <a href="{{ route('teacher.questions_bank.groups.index') }}">
                        <i class="las la-question-circle"></i>
                        @lang('site.questions_bank')
                    </a>
                </li>
                <li class="sidenav__item {{ strpos(Route::currentRouteName(), 'teacher.wallet.') !== false ? 'page-active' : '' }}">
                    <a href="{{ route('teacher.wallet.index') }}">
                        <i class="la la-wallet"></i>
                        @lang('site.wallet')
                    </a>
                </li>
                <li class="sidenav__item">
                    <a href="#"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="la la-power-off"></i> @lang('site.auth.logout')</a>
                </li>
            </ul>
        </div><!-- end side-menu-wrap -->
    </div>
</div><!-- end dashboard-sidebar -->
