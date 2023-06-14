@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Notifications')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="card-box-shared-title d-flex flex-column justify-content-center {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
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
                                        <p class="text text-break" title="
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
                                            <p class="d-block text-break time">{{ $notification->data['rejected_by'] }}
                                                : {{ $notification->data['note'] }}</p>
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
