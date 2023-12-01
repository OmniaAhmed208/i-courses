<div class="dashboard-sidebar">
    <div class="dashboard-nav-trigger d-flex">
        <div class="dashboard-nav-trigger-btn">
            <i class="la la-bars"></i> @lang('site.dashboard_nav')
        </div>
    </div>
    <div class="dashboard-nav-container">
        <div class="humburger-menu">
            <div class="humburger-menu-lines side-menu-close"></div><!-- end humburger-menu-lines -->
        </div><!-- end humburger-menu -->
        <div class="side-menu-wrap">
            <ul class="side-menu-ul">
                <li class="sidenav__item {{ strpos(Route::currentRouteName(), 'admin.home') !== false ? 'page-active' : '' }}">
                    <a href="{{ route('admin.home') }}">
                        <i class="la la-dashboard"></i>
                        @lang('site.dashboard')
                    </a>
                </li>
                <li class="sidenav__item {{ strpos(Route::currentRouteName(), 'admin.categories.') !== false ? 'page-active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="la la-list"></i>
                        @lang('site.categories')
                    </a>
                </li>
                <li class="sidenav__item {{ strpos(Route::currentRouteName(), 'admin.courses.') !== false ? 'page-active' : '' }}">
                    <a href="{{ route('admin.courses.index') }}">
                        <i class="la la-file-video-o"></i>
                        @lang('site.courses')
                        @php
                            $pending_count = App\Models\Course::pendingCount()
                        @endphp
                        @if($pending_count)
                            <span class="badge badge-info radius-rounded p-1 ml-1">
                                {{ $pending_count }}
                            </span>
                        @endif
                    </a>
                </li>
                <li class="sidenav__item {{ strpos(Route::currentRouteName(), 'admin.recharge_requests.') !== false ? 'page-active' : '' }}">
                    <a href="{{ route('admin.recharge_requests.index') }}">
                        <i class="las la-wallet"></i>
                        @lang('site.recharge_requests')
                    </a>
                </li>
                <li class="sidenav__item {{ strpos(Route::currentRouteName(), 'admin.withdrawal_requests.') !== false ? 'page-active' : '' }}">
                    <a href="{{ route('admin.withdrawal_requests.index') }}">
                        <i class="la la-money"></i>
                        @lang('site.withdrawal_requests')
                    </a>
                </li>
                <li class="sidenav__item {{ strpos(Route::currentRouteName(), 'admin.become_teacher_requests.') !== false ? 'page-active' : '' }}">
                    <a href="{{ route('admin.become_teacher_requests.index') }}">
                        <i class="las la-chalkboard-teacher"></i>
                        @lang('site.become_teacher_requests')
                    </a>
                </li>

                <li class="sidenav__item {{ strpos(Route::currentRouteName(), 'admin.settings.') !== false ? 'page-active' : '' }}">
                    <a href="{{ route('admin.settings.index') }}">
                        <i class="la la-cog"></i>
                        @lang('site.website_settings')
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
