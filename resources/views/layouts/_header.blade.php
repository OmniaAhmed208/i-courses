<header class="header-menu-area">
    @guest
        <div class="header-top d-block d-lg-none">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="header-widget d-flex align-items-center justify-content-end">
                            <div class="header-right-info">
                                <ul class="header-action-list">
                                    <li><a href="{{ route('login') }}">@lang('site.auth.login')</a></li>
                                    <li>@lang('site.or')</li>
                                    <li><a href="{{ route('register') }}">@lang('site.auth.register')</a></li>
                                </ul>
                            </div><!-- end header-right-info -->
                        </div><!-- end header-widget -->
                    </div><!-- end col-lg-6 -->
                </div><!-- end row -->
            </div><!-- end container-fluid -->
        </div>
    @endguest
    <div class="header-menu-content dashboard-menu-content my-course-menu-content">
        <div class="container-fluid">
            <div class="main-menu-content">
                <div class="row align-items-center">
                    @auth
                        <div class="col-lg-2">
                            <div class="logo-box">
                                <a href="{{ route('home') }}" class="logo">
                                    <img
                                        src="{{ setting('website_logo') ? asset(setting('website_logo')) : asset('images/logo.png') }}"
                                        alt="logo" style="max-height: 70px;">
                                </a>
                                <div class="side-menu-open">
                                    <i class="la la-user"></i>
                                </div>
                                <div class="menu-toggler">
                                    <i class="la la-bars"></i>
                                    <i class="la la-times"></i>
                                </div>
                            </div>
                        </div><!-- end col-lg-2 -->
                    @endauth
                    @guest
                        <div class="col-lg-2">
                            <div class="logo-box">
                                <a href="{{ route('home') }}" class="logo">
                                    <img
                                        src="{{ setting('website_logo') ? asset(setting('website_logo')) : asset('images/logo.png') }}"
                                        alt="logo" style="max-height: 70px;">
                                </a>
                                <div class="menu-toggler">
                                    <i class="la la-bars"></i>
                                    <i class="la la-times"></i>
                                </div>
                            </div>
                        </div><!-- end col-lg-2 -->
                    @endguest
                    <div class="col-lg-10">
                        <div class="menu-wrapper justify-content-between">
                            <div class="menu-category d-md-block d-lg-flex align-items-center">
                                <ul>
                                    <li>
                                        <a href="#"><i class="la la-th-large mr-1"></i>@lang('site.categories')</a>
                                        <ul class="cat-dropdown-menu">
                                            @forelse(\App\Models\Category::headerCategories() as $category)
                                                <li>
                                                    <a href="{{ route('courses.index') }}?category_id[{{$category->id}}]={{$category->id}}">
                                                        {{ $category->name }}
                                                        @if(count($category->childrens) > 0)
                                                            @if(app()->getLocale() == 'en')
                                                                <i class="la la-angle-right d-none d-lg-block d-xl-block"></i>
                                                            @else
                                                                <i class="la la-angle-left d-none d-lg-block d-xl-block"></i>
                                                            @endif
                                                        @endif
                                                    </a>
                                                    @if(count($category->childrens) > 0)
                                                        @include('layouts._sub_categories', ['categories' => $category->childrens])
                                                    @endif
                                                </li>
                                            @empty
                                                <li>@lang('site.no_categories')</li>
                                            @endforelse
                                        </ul>
                                    </li>
                                </ul>
                            </div><!-- end menu-category -->
                            <nav class="main-menu">
                                <ul>
                                    <li>
                                        <a href="{{ route('home') }}">@lang('site.home')</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('courses.index') }}">@lang('site.teacher_courses')</a>
                                    </li>
                                    <li><a href="{{ route('contact.index') }}">@lang('site.contact_us')</a></li>
                                    <li><a href="{{ route('about.index') }}">@lang('site.about_us')</a></li>
                                    <li><a href="{{ route('about.teacher') }}">@lang('site.about_teacher')</a></li>
                                </ul><!-- end ul -->
                            </nav><!-- end main-menu -->
                            <div class="logo-right-button d-flex align-items-center">
                                @auth
                                    @if(auth()->user()->hasRole('student'))
                                        <div class="shop-cart h-auto">
                                            <ul>
                                                @php
                                                    $header_cart_items = \App\Models\CartItem::headerItems()
                                                @endphp
                                                <li>
                                                    <p class="shop-cart-btn d-flex align-items-center">
                                                        <i class="la la-shopping-cart"></i>
                                                        @if(count($header_cart_items) > 0)
                                                            <span
                                                                class="product-count ml-1">{{ count($header_cart_items) }}</span>
                                                        @endif
                                                    </p>
                                                    <ul class="cart-dropdown-menu">
                                                        @forelse($header_cart_items as $item)
                                                            <li>
                                                                <a href="{{ route('cart.index') }}" class="cart-link">
                                                                    <img src="{{ asset($item->course->small_image) }}"
                                                                         alt="{{ $item->course->title }}">
                                                                </a>
                                                                <p class="cart-info">
                                                                    <a href="{{ route('cart.index') }}">
                                                                        {{ $item->course->title }}
                                                                    </a>
                                                                    <span
                                                                        class="cart__author">{{ $item->course->instructor->name }}</span>
                                                                    <span
                                                                        class="cart__price">{{ $item->price }} @lang('site.le')
                                                                        {{--                                                                    <span class="before-price">$55.99</span>--}}
                                                                </span>
                                                                </p>
                                                            </li>
                                                        @empty
                                                            <li>@lang('site.your_cart_empty')</li>
                                                        @endforelse
                                                        @if(count($header_cart_items) > 0)
                                                            <li>
                                                                <p class="cart-total">
                                                                    @lang('site.total')
                                                                    : {{ \App\Models\CartItem::headerTotal() }} @lang('site.le')
                                                                    {{--                                                            <span class="before-price">$110.99</span>--}}
                                                                </p>
                                                            </li>
                                                        @endif
                                                        <li>
                                                            <a class="theme-btn w-100 text-center"
                                                               href="{{ route('cart.index') }}">@lang('site.go_to_cart')</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div><!-- end shop-cart -->
                                    @endif
                                    <div class="header-action-button d-flex align-items-center">
                                        <div class="notification-wrap d-flex align-items-center">
                                            @if(auth()->user()->hasRole('student'))
                                                @include('layouts._notification', ['unread_notifications' => auth()->user()->unreadNotifications ])
                                            @endif
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
                                                            <div class="mess-dropdown">
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
                                                                        @if(auth()->user()->hasRole('teacher'))
                                                                            <li class="mb-0">
                                                                                <a href="{{ route('teacher.home') }}"
                                                                                   class="d-block">
                                                                                    <i class="la la-dashboard"></i>
                                                                                    @lang('site.dashboard')
                                                                                </a>
                                                                            </li>
                                                                            <li class="mb-0">
                                                                                <a href="{{ route('teacher.notifications.index') }}"
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
                                                                        @endif
                                                                        @if(auth()->user()->hasRole('student'))
                                                                            <li class="mb-0">
                                                                                <a href="{{ route('courses.my_courses') }}"
                                                                                   class="d-block">
                                                                                    <i class="la la-file-video-o"></i> @lang('site.my_courses')
                                                                                </a>
                                                                            </li>
                                                                            <li class="mb-0">
                                                                                <a href="{{ route('notifications.index') }}"
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
                                                                                <a href="{{ route('cart.index') }}"
                                                                                   class="d-block">
                                                                                    <i class="la la-shopping-cart"></i> @lang('site.my_cart')
                                                                                </a>
                                                                            </li>
                                                                            {{--                                                                        <li class="mb-0">--}}
                                                                            {{--                                                                            <a href="#" class="d-block">--}}
                                                                            {{--                                                                                <i class="la la-heart-o"></i> My--}}
                                                                            {{--                                                                                wishlist--}}
                                                                            {{--                                                                            </a>--}}
                                                                            {{--                                                                        </li>--}}
                                                                        @endif
                                                                        <li class="mb-0">
                                                                            <div class="section-block mt-2 mb-2"></div>
                                                                        </li>
                                                                        {{--                                                                    <li class="mb-0">--}}
                                                                        {{--                                                                        <a href="#" class="d-block">--}}
                                                                        {{--                                                                        <span><i--}}
                                                                        {{--                                                                                class="la la-envelope"></i> Messages</span>--}}
                                                                        {{--                                                                            <span--}}
                                                                        {{--                                                                                class="badge bg-info text-white ml-2 p-1">12+</span>--}}
                                                                        {{--                                                                        </a>--}}
                                                                        {{--                                                                    </li>--}}
                                                                        @if(auth()->user()->hasRole('student'))
                                                                            <li class="mb-0">
                                                                                <a href="{{ route('wallet.index') }}"
                                                                                   class="d-block">
                                                                                    <i class="la la-wallet"></i> @lang('site.wallet')
                                                                                </a>
                                                                            </li>
                                                                            {{--                                                                        <li class="mb-0">--}}
                                                                            {{--                                                                            <a href="#"--}}
                                                                            {{--                                                                               class="d-block">--}}
                                                                            {{--                                                                                <i class="la la-cart-plus"></i> Purchase--}}
                                                                            {{--                                                                                history--}}
                                                                            {{--                                                                            </a>--}}
                                                                            {{--                                                                        </li>--}}
                                                                            {{--                                                                        <li class="mb-0">--}}
                                                                            {{--                                                                            <div class="section-block mt-2 mb-2"></div>--}}
                                                                            {{--                                                                        </li>--}}
                                                                            <li class="mb-0">
                                                                                <a href="{{ route('profile') }}"
                                                                                   class="d-block">
                                                                                    <i class="la la-edit"></i>
                                                                                    @lang('site.edit_profile')
                                                                                </a>
                                                                            </li>
                                                                            {{--                                                                        <li class="mb-0">--}}
                                                                            {{--                                                                            <div class="section-block mt-2 mb-2"></div>--}}
                                                                            {{--                                                                        </li>--}}
                                                                        @endif
                                                                        {{--                                                                    <li class="mb-0">--}}
                                                                        {{--                                                                        <a href="#" class="d-block">--}}
                                                                        {{--                                                                            <i class="la la-question"></i> Help--}}
                                                                        {{--                                                                        </a>--}}
                                                                        {{--                                                                    </li>--}}
                                                                        <li class="mb-0">
                                                                            <a href="#" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();"
                                                                               class="d-block">
                                                                                <i class="la la-power-off"></i> @lang('site.auth.logout')
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
                                @endauth
                                @guest
                                    <div class="logo-right-button logo-right-button-2">
                                        <ul class="user-action">
                                            <li><a href="{{ route('login') }}">@lang('site.auth.login')</a></li>
                                            <li><span>@lang('site.or')</span></li>
                                            <li><a href="{{ route('register') }}"
                                                   class="theme-btn">@lang('site.auth.register')</a></li>
                                        </ul>
                                    </div><!-- end logo-right-button -->
                                @endguest
                            </div><!-- end menu-wrapper -->
                            @auth
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
                                            @if(auth()->user()->hasRole('student'))
                                                <li role="presentation">
                                                    <a href="#notification-home" role="tab" data-toggle="tab"
                                                       aria-selected="false">
                                                        @lang('site.notifications')
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="user-panel-content">
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="account-home"
                                                 role="tabpanel">
                                                <div class="user-sidebar-item user-action-item">
                                                    <div class="mess-dropdown">
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
                                                                @if(auth()->user()->hasRole('teacher'))
                                                                    <li class="mb-0">
                                                                        <a href="{{ route('teacher.home') }}"
                                                                           class="d-block">
                                                                            <i class="la la-dashboard"></i>
                                                                            @lang('site.dashboard')
                                                                        </a>
                                                                    </li>
                                                                    <li class="mb-0">
                                                                        <a href="{{ route('teacher.notifications.index') }}"
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
                                                                @endif
                                                                @if(auth()->user()->hasRole('student'))
                                                                    <li class="mb-0">
                                                                        <a href="{{ route('courses.my_courses') }}"
                                                                           class="d-block">
                                                                            <i class="la la-file-video-o"></i> @lang('site.my_courses')
                                                                        </a>
                                                                    </li>
                                                                    <li class="mb-0">
                                                                        <a href="{{ route('cart.index') }}"
                                                                           class="d-block">
                                                                            <i class="la la-shopping-cart"></i> @lang('site.my_cart')
                                                                        </a>
                                                                    </li>

                                                                @endif
                                                                <li class="mb-0">
                                                                    <div class="section-block mt-2 mb-2"></div>
                                                                </li>
                                                                @if(auth()->user()->hasRole('student'))
                                                                    <li class="mb-0">
                                                                        <a href="{{ route('wallet.index') }}"
                                                                           class="d-block">
                                                                            <i class="la la-wallet"></i> @lang('site.wallet')
                                                                        </a>
                                                                    </li>

                                                                    <li class="mb-0">
                                                                        <a href="{{ route('profile') }}"
                                                                           class="d-block">
                                                                            <i class="la la-edit"></i>
                                                                            @lang('site.edit_profile')
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                                <li class="mb-0">
                                                                    <a href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="d-block">
                                                                        <i class="la la-power-off"></i> @lang('site.auth.logout')
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div><!-- end mess__body -->
                                                    </div><!-- end mess-dropdown -->
                                                </div>
                                            </div>
                                            @if(auth()->user()->hasRole('student'))

                                                <div class="tab-pane fade" id="notification-home"
                                                     role="tabpanel">
                                                    @if(auth()->user()->hasRole(['student', 'limited_student']))
                                                        @include('layouts._sidebar_notifications', ['unread_notifications' => auth()->user()->unreadNotifications ])
                                                    @elseif(auth()->user()->hasRole('teacher'))
                                                        @include('layouts.teacher._sidebar_notifications', ['unread_notifications' => auth()->user()->unreadNotifications ])
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endauth
                        </div><!-- end col-lg-10 -->
                    </div><!-- end row -->
                </div>
            </div><!-- end container-fluid -->
        </div><!-- end header-menu-content -->
</header><!-- end header-menu-area -->
