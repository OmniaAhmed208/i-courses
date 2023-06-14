@extends('layouts.app')
@section('title', setting('website_name') . ' Notifications')
@section('content')
    <div class="container">
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
    </div><!-- end container-fluid -->
@endsection
