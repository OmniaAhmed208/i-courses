<header class="header-menu-area dashboard-header">
    <div class="header-menu-content dashboard-menu-content">
        <div class="container-fluid">
            <div class="main-menu-content">
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo-box">
                            <a href="{{ route('admin.home') }}" class="logo">
                                <img
                                    src="{{ setting('website_logo') ? asset(setting('website_logo')) : asset('images/logo.png') }}"
                                    alt="logo"
                                    style="max-height: 70px;">
                            </a>
                            <div class="side-menu-open">
                                <i class="la la-user"></i>
                            </div>
                        </div>
                    </div><!-- end col-lg-2 -->
                    <div class="col-lg-10">
                        <div class="menu-wrapper">
                            <div class="logo-right-button d-flex align-items-center">
                                <div class="header-action-button d-flex align-items-center">
                                    <div class="notification-wrap d-flex align-items-center">
                                        <div class="notification-item mr-3">
                                            <div class="dropdown">
                                                <button class="notification-btn dropdown-toggle" type="button"
                                                        id="languageDropdownMenu" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    <i class="la la-flag"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="languageDropdownMenu">
                                                    <div class="mess-dropdown">
                                                        <div class="mess__title">
                                                            <h4 class="widget-title">@lang('site.language')</h4>
                                                        </div><!-- end mess__title -->
                                                        <div class="mess__body">
                                                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                                                   class="d-block">
                                                                    <div class="mess__item">
                                                                        <div class="content">
                                                                            <p class="text {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">{{ $properties['native'] }}</p>
                                                                        </div>
                                                                    </div><!-- end mess__item -->
                                                                </a>
                                                            @endforeach

                                                        </div><!-- end mess__body -->
                                                    </div><!-- end mess-dropdown -->
                                                </div><!-- end dropdown-menu -->
                                            </div><!-- end dropdown -->
                                        </div>
                                        @include('layouts.admin._notification', ['unread_notifications' => auth()->user()->unreadNotifications ])
                                    </div>
                                    <div class="user-action-wrap">
                                        <div class="notification-item user-action-item">
                                            <div class="dropdown">
                                                <button
                                                    class="notification-btn dropdown-toggle"
                                                    type="button" id="userDropdownMenu" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <img src="{{ auth()->user()->avatar }}"
                                                         alt="{{ auth()->user()->name }}" class="profile_pic">
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="userDropdownMenu">
                                                    <div
                                                        class="mess-dropdown">
                                                        <div class="mess__title d-flex align-items-center">
                                                            <div class="image">
                                                                <a href="#">
                                                                    <img
                                                                        src="{{ strpos(auth()->user()->avatar, 'avatar.png') !== false ? asset('images/avatar_white.png') : auth()->user()->avatar }}"
                                                                        alt="{{ auth()->user()->name }}"
                                                                        class="profile_pic">
                                                                </a>
                                                            </div>
                                                            <div class="content">
                                                                <h4 class="widget-title font-size-16">
                                                                    <a href="#" class="text-white">
                                                                        {{ auth()->user()->name }}
                                                                    </a>
                                                                </h4>
                                                                <span
                                                                    class="email">{{ auth()->user()->email }}</span>
                                                            </div>
                                                        </div><!-- end mess__title -->
                                                        <div class="mess__body">
                                                            <ul class="list-items">
                                                                <li class="mb-0">
                                                                    <a href="{{ route('admin.notifications.index') }}"
                                                                       class="d-block">
                                                                            <span>
                                                                                <i class="la la-bell"></i>
                                                                                @lang('site.notifications')
                                                                            </span>
                                                                        @if(count(auth()->user()->unreadNotifications) > 0)
                                                                            <span
                                                                                class="badge bg-info text-white ml-2 p-1">{{ count(auth()->user()->unreadNotifications) }}</span>
                                                                        @endif
                                                                    </a>
                                                                </li>

                                                                <li class="mb-0">
                                                                    <div class="section-block mt-2 mb-2"></div>
                                                                </li>

                                                                <li class="mb-0">
                                                                    <a href="{{ route('admin.profile') }}"
                                                                       class="d-block">
                                                                        <i class="la la-edit"></i>
                                                                        @lang('site.edit_profile')
                                                                    </a>
                                                                </li>
                                                                {{--                                                                    <li class="mb-0">--}}
                                                                {{--                                                                        <div class="section-block mt-2 mb-2"></div>--}}
                                                                {{--                                                                    </li>--}}
                                                                <li class="mb-0">
                                                                    <a href="#"
                                                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                                                       class="d-block">
                                                                        <i class="la la-power-off"></i>
                                                                        @lang('site.auth.logout')
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div><!-- end mess__body -->
                                                    </div><!-- end mess-dropdown -->
                                                </div><!-- end dropdown-menu -->
                                            </div><!-- end dropdown -->
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end logo-right-button -->
                        </div><!-- end menu-wrapper -->
                        <div class="user-nav-container">
                            <div class="humburger-menu">
                                <div class="humburger-menu-lines side-menu-close"></div>
                                <!-- end humburger-menu-lines -->
                            </div><!-- end humburger-menu -->
                            <div class="section-tab section-tab-2">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation">
                                        <a href="#account-home" role="tab" data-toggle="tab" class="active"
                                           aria-selected="true">
                                            @lang('site.account')
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#notification-home" role="tab" data-toggle="tab"
                                           aria-selected="false">
                                            @lang('site.notifications')
                                        </a>
                                    </li>
                                    {{--                                                                                <li role="presentation">--}}
                                    {{--                                                                                    <a href="#message-home" role="tab" data-toggle="tab"--}}
                                    {{--                                                                                       aria-selected="false">--}}
                                    {{--                                                                                        Messages--}}
                                    {{--                                                                                    </a>--}}
                                    {{--                                                                                </li>--}}

                                </ul>
                            </div>
                            <div class="user-panel-content">
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="account-home" role="tabpanel">
                                        <div class="user-sidebar-item user-action-item">
                                            <div class="mess-dropdown">
                                                <div class="mess__title d-flex align-items-center">
                                                    <div class="image">
                                                        <a href="#">
                                                            <img
                                                                src="{{ strpos(auth()->user()->avatar, 'avatar.png') !== false ? asset('images/avatar_white.png') : auth()->user()->avatar }}"
                                                                alt="{{ auth()->user()->name }}" class="profile_pic">
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <h4 class="widget-title font-size-16">
                                                            <a href="#" class="text-white">
                                                                {{ auth()->user()->name }}
                                                            </a>
                                                        </h4>
                                                        <span class="email">{{ auth()->user()->email }}</span>
                                                    </div>
                                                </div><!-- end mess__title -->
                                                <div class="mess__body">
                                                    <ul class="list-items">
                                                        <li class="mb-0">
                                                            <a href="{{ route('admin.notifications.index') }}"
                                                               class="d-block">
                                                                <span><i
                                                                        class="la la-bell"></i> @lang('site.notifications')</span>
                                                                @if(count(auth()->user()->unreadNotifications) > 0)
                                                                    <span
                                                                        class="badge bg-info text-white ml-2 p-1">{{ count(auth()->user()->unreadNotifications) }}</span>
                                                                @endif
                                                            </a>
                                                        </li>
                                                        {{--                                                            <li class="mb-0">--}}
                                                        {{--                                                                <a href="#" class="d-block">--}}
                                                        {{--                                                                    <span>--}}
                                                        {{--                                                                        <i class="la la-envelope"></i>--}}
                                                        {{--                                                                        Messages--}}
                                                        {{--                                                                    </span>--}}
                                                        {{--                                                                    <span--}}
                                                        {{--                                                                        class="badge bg-info text-white ml-2 p-1">12+</span>--}}
                                                        {{--                                                                </a>--}}
                                                        {{--                                                            </li>--}}
                                                        {{--                                                            <li class="mb-0">--}}
                                                        {{--                                                                <a href="#"--}}
                                                        {{--                                                                   class="d-block">--}}
                                                        {{--                                                                    <i class="las la-exchange-alt"></i>--}}
                                                        {{--                                                                    Transactions history--}}
                                                        {{--                                                                </a>--}}
                                                        {{--                                                            </li>--}}
                                                        {{--                                                            <li class="mb-0">--}}
                                                        {{--                                                                <div class="section-block mt-2 mb-2"></div>--}}
                                                        {{--                                                            </li>--}}

                                                        <li class="mb-0">
                                                            <a href="{{ route('admin.profile') }}" class="d-block">
                                                                <i class="la la-edit"></i>
                                                                @lang('site.edit_profile')
                                                            </a>
                                                        </li>
                                                        {{--                                                            <li class="mb-0">--}}
                                                        {{--                                                                <div class="section-block mt-2 mb-2"></div>--}}
                                                        {{--                                                            </li>--}}
                                                        {{--                                                            <li class="mb-0">--}}
                                                        {{--                                                                <a href="#" class="d-block">--}}
                                                        {{--                                                                    <i class="la la-question"></i> Help--}}
                                                        {{--                                                                </a>--}}
                                                        {{--                                                            </li>--}}
                                                        <li class="mb-0">
                                                            <a href="#"
                                                               onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                                               class="d-block">
                                                                <i class="la la-power-off"></i> @lang('site.auth.logout')
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div><!-- end mess__body -->
                                            </div><!-- end mess-dropdown -->
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="notification-home"
                                         role="tabpanel">
                                        @include('layouts.admin._sidebar_notifications', ['unread_notifications' => auth()->user()->unreadNotifications ])
                                    </div>
                                    {{--                                        <div class="tab-pane fade" id="message-home" role="tabpanel">--}}
                                    {{--                                            <div class="user-sidebar-item">--}}
                                    {{--                                                <div class="mess-dropdown">--}}
                                    {{--                                                    <div class="mess__body">--}}
                                    {{--                                                        <a href="dashboard-message.html" class="d-block">--}}
                                    {{--                                                            <div class="mess__item">--}}
                                    {{--                                                                <div class="avatar dot-status">--}}
                                    {{--                                                                    <img src="{{ asset('images/team7.jpg') }}"--}}
                                    {{--                                                                         alt="Team img">--}}
                                    {{--                                                                </div>--}}
                                    {{--                                                                <div class="content">--}}
                                    {{--                                                                    <h4 class="widget-title">Michelle Moreno</h4>--}}
                                    {{--                                                                    <p class="text">Thanks for reaching out. I'm--}}
                                    {{--                                                                        quite--}}
                                    {{--                                                                        busy right now on many</p>--}}
                                    {{--                                                                    <span class="time">5 min ago</span>--}}
                                    {{--                                                                </div>--}}
                                    {{--                                                            </div><!-- end mess__item -->--}}
                                    {{--                                                        </a>--}}
                                    {{--                                                        <a href="dashboard-message.html" class="d-block">--}}
                                    {{--                                                            <div class="mess__item">--}}
                                    {{--                                                                <div class="avatar dot-status online-status">--}}
                                    {{--                                                                    <img src="{{ asset('images/team8.jpg') }}"--}}
                                    {{--                                                                         alt="Team img">--}}
                                    {{--                                                                </div>--}}
                                    {{--                                                                <div class="content">--}}
                                    {{--                                                                    <h4 class="widget-title">Alex Smith</h4>--}}
                                    {{--                                                                    <p class="text">Thanks for reaching out. I'm--}}
                                    {{--                                                                        quite--}}
                                    {{--                                                                        busy right now on many</p>--}}
                                    {{--                                                                    <span class="time">2 days ago</span>--}}
                                    {{--                                                                </div>--}}
                                    {{--                                                            </div><!-- end mess__item -->--}}
                                    {{--                                                        </a>--}}
                                    {{--                                                        <a href="dashboard-message.html" class="d-block">--}}
                                    {{--                                                            <div class="mess__item">--}}
                                    {{--                                                                <div class="avatar dot-status">--}}
                                    {{--                                                                    <img src="{{ asset('images/team9.jpg') }}"--}}
                                    {{--                                                                         alt="Team img">--}}
                                    {{--                                                                </div>--}}
                                    {{--                                                                <div class="content">--}}
                                    {{--                                                                    <h4 class="widget-title">Michelle Moreno</h4>--}}
                                    {{--                                                                    <p class="text">Thanks for reaching out. I'm--}}
                                    {{--                                                                        quite--}}
                                    {{--                                                                        busy right now on many</p>--}}
                                    {{--                                                                    <span class="time">5 min ago</span>--}}
                                    {{--                                                                </div>--}}
                                    {{--                                                            </div><!-- end mess__item -->--}}
                                    {{--                                                        </a>--}}
                                    {{--                                                        <a href="dashboard-message.html" class="d-block">--}}
                                    {{--                                                            <div class="mess__item">--}}
                                    {{--                                                                <div class="avatar dot-status online-status">--}}
                                    {{--                                                                    <img src="{{ asset('images/team7.jpg') }}"--}}
                                    {{--                                                                         alt="Team img">--}}
                                    {{--                                                                </div>--}}
                                    {{--                                                                <div class="content">--}}
                                    {{--                                                                    <h4 class="widget-title">Alex Smith</h4>--}}
                                    {{--                                                                    <p class="text">Thanks for reaching out. I'm--}}
                                    {{--                                                                        quite--}}
                                    {{--                                                                        busy right now on many</p>--}}
                                    {{--                                                                    <span class="time">2 days ago</span>--}}
                                    {{--                                                                </div>--}}
                                    {{--                                                            </div><!-- end mess__item -->--}}
                                    {{--                                                        </a>--}}
                                    {{--                                                        <a href="dashboard-message.html" class="d-block">--}}
                                    {{--                                                            <div class="mess__item">--}}
                                    {{--                                                                <div class="avatar dot-status">--}}
                                    {{--                                                                    <img src="{{ asset('images/team8.jpg') }}"--}}
                                    {{--                                                                         alt="Team img">--}}
                                    {{--                                                                </div>--}}
                                    {{--                                                                <div class="content">--}}
                                    {{--                                                                    <h4 class="widget-title">Alex Smith</h4>--}}
                                    {{--                                                                    <p class="text">Thanks for reaching out. I'm--}}
                                    {{--                                                                        quite--}}
                                    {{--                                                                        busy right now on many</p>--}}
                                    {{--                                                                    <span class="time">2 days ago</span>--}}
                                    {{--                                                                </div>--}}
                                    {{--                                                            </div><!-- end mess__item -->--}}
                                    {{--                                                        </a>--}}
                                    {{--                                                    </div><!-- end mess__body -->--}}
                                    {{--                                                    <div class="btn-box p-2 text-center">--}}
                                    {{--                                                        <a href="dashboard-message.html">Show All Message</a>--}}
                                    {{--                                                    </div><!-- end btn-box -->--}}
                                    {{--                                                </div><!-- end mess-dropdown -->--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                </div>
                            </div>
                        </div>
                    </div><!-- end col-lg-10 -->
                </div><!-- end row -->
            </div>
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-content -->
</header><!-- end header-menu-area -->
