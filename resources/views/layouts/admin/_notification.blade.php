<div class="notification-item mr-3">
    <div class="dropdown">
        <button class="notification-btn dropdown-toggle" type="button"
                id="notificationDropdownMenu" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            <i class="la la-bell"></i>
            @if(count($unread_notifications) > 0)
                <span class="quantity">{{ count($unread_notifications) }}</span>
            @endif
        </button>
        <div class="dropdown-menu" aria-labelledby="notificationDropdownMenu"
             x-placement="bottom-start"
             style="position: absolute; will-change: transform; top: 0; left: 0; transform: translate3d(0px, 40px, 0px);">
            <div class="mess-dropdown">
                <div class="mess__title">
                    <h4 class="widget-title">@lang('site.notifications')</h4>
                </div><!-- end mess__title -->
                <div class="mess__body">
                    @forelse($unread_notifications as $notification)
                        <a href="{{ $notification->data['redirect_url'] }}" class="d-block notification-link">
                            <div class="mess__item">
                                <div class="icon-element {{ $notification->data['color'] }} text-white">
                                    <i class="{{ $notification->data['icon'] }}"></i>
                                </div>
                                <div class="content text-left">
                                    <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                    <p class="text" title="
                                        @if($notification->type == "App\Notifications\CourseAdded")
                                    {{ __('site.notifications_messages.course_added', ['name' => $notification->data['teacher_name']]) }}
                                    @elseif($notification->type == "App\Notifications\RechargeRequestCreated")
                                    {{ __('site.notifications_messages.recharge_request', ['name' => $notification->data['student_name']]) }}
                                    @elseif($notification->type == "App\Notifications\TeacherRequestCreated")
                                    {{ __('site.notifications_messages.become_teacher', ['name' => $notification->data['student_name']]) }}
                                    @elseif($notification->type == "App\Notifications\TeacherWithdrawRequestNotification")
                                    {{ __('site.notifications_messages.teacher_withdraw', ['name' => $notification->data['teacher_name'], 'amount' => $notification->data['amount']]) }}
                                    @endif
                                        ">
                                        @if($notification->type == "App\Notifications\CourseAdded")
                                            {{ __('site.notifications_messages.course_added', ['name' => $notification->data['teacher_name']]) }}
                                        @elseif($notification->type == "App\Notifications\RechargeRequestCreated")
                                            {{ __('site.notifications_messages.recharge_request', ['name' => $notification->data['student_name']]) }}
                                        @elseif($notification->type == "App\Notifications\TeacherRequestCreated")
                                            {{ __('site.notifications_messages.become_teacher', ['name' => $notification->data['student_name']]) }}
                                        @elseif($notification->type == "App\Notifications\TeacherWithdrawRequestNotification")
                                            {{ __('site.notifications_messages.teacher_withdraw', ['name' => $notification->data['teacher_name'], 'amount' => $notification->data['amount']]) }}
                                        @endif
                                    </p>
                                </div>
                            </div><!-- end mess__item -->
                        </a>
                    @empty
                        <a href="#" class="d-block">
                            <div class="mess__item">
                                <div class="content">
                                    <p class="text">@lang('site.no_new_notifications')</p>
                                </div>
                            </div><!-- end mess__item -->
                        </a>
                    @endforelse
                    {{--                    <a href="#" class="d-block">--}}
                    {{--                        <div class="mess__item">--}}
                    {{--                            <div class="icon-element bg-color-2 text-white">--}}
                    {{--                                <i class="la la-lock"></i>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="content">--}}
                    {{--                                <span class="time">November 12, 2019</span>--}}
                    {{--                                <p class="text">You changed password</p>--}}
                    {{--                            </div>--}}
                    {{--                        </div><!-- end mess__item -->--}}
                    {{--                    </a>--}}
                    {{--                    <a href="#" class="d-block">--}}
                    {{--                        <div class="mess__item">--}}
                    {{--                            <div class="icon-element bg-color-3 text-white">--}}
                    {{--                                <i class="la la-check-circle"></i>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="content">--}}
                    {{--                                <span class="time">October 6, 2019</span>--}}
                    {{--                                <p class="text">You applied for a job <span--}}
                    {{--                                        class="color-text">Front-end Developer</span>--}}
                    {{--                                </p>--}}
                    {{--                            </div>--}}
                    {{--                        </div><!-- end mess__item -->--}}
                    {{--                    </a>--}}
                    {{--                    <a href="#" class="d-block">--}}
                    {{--                        <div class="mess__item">--}}
                    {{--                            <div class="icon-element bg-color-4 text-white">--}}
                    {{--                                <i class="la la-user"></i>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="content">--}}
                    {{--                                <span class="time">Jun 12, 2019</span>--}}
                    {{--                                <p class="text">Your account has been created--}}
                    {{--                                    successfully</p>--}}
                    {{--                            </div>--}}
                    {{--                        </div><!-- end mess__item -->--}}
                    {{--                    </a>--}}
                    {{--                    <a href="#" class="d-block">--}}
                    {{--                        <div class="mess__item">--}}
                    {{--                            <div class="icon-element bg-color-5 text-white">--}}
                    {{--                                <i class="la la-download"></i>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="content">--}}
                    {{--                                <span class="time">May 12, 2019</span>--}}
                    {{--                                <p class="text">Someone downloaded resume</p>--}}
                    {{--                            </div>--}}
                    {{--                        </div><!-- end mess__item -->--}}
                    {{--                    </a>--}}
                </div><!-- end mess__body -->
                <div class="btn-box p-2 text-center">
                    <a href="{{ route('admin.notifications.index') }}">@lang('site.show_all_notifications')</a>
                </div><!-- end btn-box -->
            </div><!-- end mess-dropdown -->
        </div><!-- end dropdown-menu -->
    </div><!-- end dropdown -->
</div>
