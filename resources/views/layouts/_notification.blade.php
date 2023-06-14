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
                                    <p class="text"
                                       title="@if($notification->type == "App\Notifications\AnnouncementNotification")
                                       {{ __('site.notifications_messages.new_announcement', ['teacher_name' => $notification->data['teacher_name']]) }}
                                       @elseif($notification->type == "App\Notifications\AssignmentAddedToCourse")
                                       {{ __('site.notifications_messages.new_assignment', ['assignment_name' => $notification->data['assignment_name']]) }}
                                       @elseif($notification->type == "App\Notifications\QuizAddedToCourse")
                                       {{ __('site.notifications_messages.new_quiz', ['quiz_name' => $notification->data['quiz_name']]) }}
                                       @elseif($notification->type == "App\Notifications\AssignmentAnswerHasBeenReviewed")
                                       {{ __('site.notifications_messages.assignment_answers_reviewed', ['assignment_name' => $notification->data['assignment_name']]) }}
                                       @elseif($notification->type == "App\Notifications\QuizAnswerHasBeenReviewed")
                                       {{ __('site.notifications_messages.quiz_answers_reviewed', ['quiz_name' => $notification->data['quiz_name']]) }}
                                       @elseif($notification->type == "App\Notifications\InstructorAnswerQuestion")
                                       {{ __('site.notifications_messages.teacher_answers_questions', ['instructor_name' => $notification->data['instructor_name']]) }}
                                       @elseif($notification->type == "App\Notifications\InstructorEditAnswer")
                                       {{ __('site.notifications_messages.teacher_edited_answers', ['instructor_name' => $notification->data['instructor_name']]) }}
                                       @elseif($notification->type == "App\Notifications\NewLessonAdded")
                                       {{ __('site.notifications_messages.new_lesson_added', ['course_name' => $notification->data['course_name']]) }}
                                       @elseif($notification->type == "App\Notifications\NewResourceAdded")
                                       {{ __('site.notifications_messages.new_resource_added', ['course_name' => $notification->data['course_name']]) }}
                                       @elseif($notification->type == "App\Notifications\RechargeRequestApproved")
                                       {{ __('site.notifications_messages.recharge_request_approved') }}
                                       @endif">
                                        @if($notification->type == "App\Notifications\AnnouncementNotification")
                                            {{ __('site.notifications_messages.new_announcement', ['teacher_name' => $notification->data['teacher_name']]) }}
                                        @elseif($notification->type == "App\Notifications\AssignmentAddedToCourse")
                                            {{ __('site.notifications_messages.new_assignment', ['assignment_name' => $notification->data['assignment_name']]) }}
                                        @elseif($notification->type == "App\Notifications\QuizAddedToCourse")
                                            {{ __('site.notifications_messages.new_quiz', ['quiz_name' => $notification->data['quiz_name']]) }}
                                        @elseif($notification->type == "App\Notifications\AssignmentAnswerHasBeenReviewed")
                                            {{ __('site.notifications_messages.assignment_answers_reviewed', ['assignment_name' => $notification->data['assignment_name']]) }}
                                        @elseif($notification->type == "App\Notifications\QuizAnswerHasBeenReviewed")
                                            {{ __('site.notifications_messages.quiz_answers_reviewed', ['quiz_name' => $notification->data['quiz_name']]) }}
                                        @elseif($notification->type == "App\Notifications\InstructorAnswerQuestion")
                                            {{ __('site.notifications_messages.teacher_answers_questions', ['instructor_name' => $notification->data['instructor_name']]) }}
                                        @elseif($notification->type == "App\Notifications\InstructorEditAnswer")
                                            {{ __('site.notifications_messages.teacher_edited_answers', ['instructor_name' => $notification->data['instructor_name']]) }}
                                        @elseif($notification->type == "App\Notifications\NewLessonAdded")
                                            {{ __('site.notifications_messages.new_lesson_added', ['course_name' => $notification->data['course_name']]) }}
                                        @elseif($notification->type == "App\Notifications\NewResourceAdded")
                                            {{ __('site.notifications_messages.new_resource_added', ['course_name' => $notification->data['course_name']]) }}
                                        @elseif($notification->type == "App\Notifications\RechargeRequestApproved")
                                            {{ __('site.notifications_messages.recharge_request_approved') }}
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
                    <a href="{{ route('notifications.index') }}">@lang('site.show_all_notifications')</a>
                </div><!-- end btn-box -->
            </div><!-- end mess-dropdown -->
        </div><!-- end dropdown-menu -->
    </div><!-- end dropdown -->
</div>
