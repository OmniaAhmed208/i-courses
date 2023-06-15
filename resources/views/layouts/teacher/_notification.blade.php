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
                                    @if($notification->type == "App\Notifications\BecomeTeacherRequestApproved")
                                    {{ __('site.notifications_messages.teacher_request_approved') }}
                                    @elseif($notification->type == "App\Notifications\WithdrawRequestApproved")
                                    {{ __('site.notifications_messages.withdraw_request_approved') }}
                                    @elseif($notification->type == "App\Notifications\WithdrawRequestRejected")
                                    {{ __('site.notifications_messages.withdraw_request_rejected') }}
                                    @elseif($notification->type == "App\Notifications\CourseApproved")
                                    {{ __('site.notifications_messages.course_approved', ['course_name' => $notification->data['course_name']]) }}
                                    @elseif($notification->type == "App\Notifications\CourseRejected")
                                    {{ __('site.notifications_messages.course_rejected', ['course_name' => $notification->data['course_name']]) }}
                                    @elseif($notification->type == "App\Notifications\CourseDestroyed")
                                    {{ __('site.notifications_messages.course_destroyed', ['course_name' => $notification->data['course_name']]) }}
                                    @elseif($notification->type == "App\Notifications\StudentAddQuestionToCourse")
                                    {{ __('site.notifications_messages.student_add_question', ['student_name' => $notification->data['student_name'], 'course_name' => $notification->data['course_name']]) }}
                                    @elseif($notification->type == "App\Notifications\StudentAnswerAllAssignmentQuestions")
                                    {{ __('site.notifications_messages.student_answered_assignment', ['student_name' => $notification->data['student_name'], 'assignment_name' => $notification->data['assignment_name']]) }}
                                    @elseif($notification->type == "App\Notifications\StudentSubmittedQuiz")
                                    {{ __('site.notifications_messages.student_answered_quiz', ['student_name' => $notification->data['student_name'], 'quiz_name' => $notification->data['quiz_name']]) }}
                                    @endif
                                        ">
                                        @if($notification->type == "App\Notifications\BecomeTeacherRequestApproved")
                                            {{ __('site.notifications_messages.teacher_request_approved') }}
                                        @elseif($notification->type == "App\Notifications\WithdrawRequestApproved")
                                            {{ __('site.notifications_messages.withdraw_request_approved') }}
                                        @elseif($notification->type == "App\Notifications\WithdrawRequestRejected")
                                            {{ __('site.notifications_messages.withdraw_request_rejected') }}
                                        @elseif($notification->type == "App\Notifications\CourseApproved")
                                            {{ __('site.notifications_messages.course_approved', ['course_name' => $notification->data['course_name']]) }}
                                        @elseif($notification->type == "App\Notifications\CourseRejected")
                                            {{ __('site.notifications_messages.course_rejected', ['course_name' => $notification->data['course_name']]) }}
                                        @elseif($notification->type == "App\Notifications\CourseDestroyed")
                                            {{ __('site.notifications_messages.course_destroyed', ['course_name' => $notification->data['course_name']]) }}
                                        @elseif($notification->type == "App\Notifications\StudentAddQuestionToCourse")
                                            {{ __('site.notifications_messages.student_add_question', ['student_name' => $notification->data['student_name'], 'course_name' => $notification->data['course_name']]) }}
                                        @elseif($notification->type == "App\Notifications\StudentAnswerAllAssignmentQuestions")
                                            {{ __('site.notifications_messages.student_answered_assignment', ['student_name' => $notification->data['student_name'], 'assignment_name' => $notification->data['assignment_name']]) }}
                                        @elseif($notification->type == "App\Notifications\StudentSubmittedQuiz")
                                            {{ __('site.notifications_messages.student_answered_quiz', ['student_name' => $notification->data['student_name'], 'quiz_name' => $notification->data['quiz_name']]) }}
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
                    <a href="{{ route('teacher.notifications.index') }}">@lang('site.show_all_notifications')</a>
                </div><!-- end btn-box -->
            </div><!-- end mess-dropdown -->
        </div><!-- end dropdown-menu -->
    </div><!-- end dropdown -->
</div>
