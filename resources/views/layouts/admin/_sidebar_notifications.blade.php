<div class="user-sidebar-item">
    <div class="mess-dropdown">
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
        </div><!-- end mess__body -->
        <div class="btn-box p-2 text-center">
            <a href="{{ route('admin.notifications.index') }}">@lang('site.show_all_notifications')</a>
        </div><!-- end btn-box -->
    </div><!-- end mess-dropdown -->
</div>
