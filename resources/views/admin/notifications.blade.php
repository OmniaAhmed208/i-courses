@extends('layouts.admin.app')
@section('title', setting('website_name') . ' Notifications')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="card-box-shared-title d-flex flex-column justify-content-center">
                <h3 class="widget-title">@lang('site.notifications')</h3>
            </div>

            @forelse($notifications as $notification)
                <div class="col-12 mt-3">
                    <div class="card-box-shared notification-border">
                        <div class="card-box-shared-title d-flex flex-column justify-content-center p-0"
                             style="border-bottom: none">
                            <a href="{{ $notification->data['redirect_url'] }}" class="d-block notification-link">
                                <div class="mess__item" style="border-bottom: none">
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
                        </div>
                    </div>
                </div>
            @empty
                <a href="#" class="d-block">
                    <div class="mess__item">
                        <div class="content">
                            <p class="text">@lang('site.no_new_notifications')</p>
                        </div>
                    </div><!-- end mess__item -->
                </a>
            @endforelse


            @include('layouts.admin._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection
