<div role="tabpanel" class="tab-pane fade" id="assignments">
    <div class="lecture-overview-wrap lecture-quest-wrap">
        <div class="">
            <div class="lecture-overview-item mt-0">
                <div class="question-list-container">
                    <div class="question-list-item">
                        <ul class="comments-list">
                            @forelse($assignments as $assignment)
                                <li>
                                    <div class="comment">
                                        <div class="comment-body">
                                            <div
                                                class="meta-data d-flex align-items-center justify-content-between">
                                                <div
                                                    class="question-meta-content d-flex justify-content-between align-items-center w-100">
                                                    <h3 class="comment__author">
                                                        {{ $assignment->name }}
                                                    </h3>
                                                    @if(now()->gte($assignment->start_time) && now()->lt($assignment->end_time) && !auth()->user()->studentTakeAssignment($assignment))
                                                        <a href="{{ route('courses.assignments.show', ['course' => $course->slug, 'assignment' => $assignment->id]) }}">
                                                            <button class="theme-btn">
                                                                <i class="las la-pencil-ruler"></i>
                                                                @lang('site.go_to_assignment')
                                                            </button>
                                                        </a>
                                                    @endif
                                                    @if(now()->gte($assignment->end_time) && auth()->user()->studentTakeAssignment($assignment))
                                                        @php
                                                            $assignment_attempt_id = \App\Models\AssignmentAttempt::where('student_id', auth()->user()->id)->where('assignment_id', $assignment->id)->first()->id;
                                                        @endphp
                                                        <a href="{{ route('courses.assignments.showResults', ['course' => $course->slug, 'assignment' => $assignment->id, 'assignment_attempt' => $assignment_attempt_id]) }}">
                                                            <button class="theme-warning-btn">
                                                                <i class="las la-pencil-ruler"></i>
                                                                @lang('site.show_result')
                                                            </button>
                                                        </a>
                                                    @elseif(now()->gte($assignment->end_time) && !auth()->user()->studentTakeAssignment($assignment))
                                                        <h6 class="text-danger">@lang('site.you_didt_attend_to_this_assignment')</h6>
                                                    @elseif(now()->gte($assignment->start_time) &&now()->lt($assignment->end_time) && auth()->user()->studentTakeAssignment($assignment) && \App\Models\AssignmentAttempt::where('student_id', auth()->user()->id)->where('assignment_id', $assignment->id)->first()->student_answers_all_questions)
                                                        <h6>@lang('site.you_finished_assignment_wait_for_results')</h6>
                                                    @endif
                                                </div>
                                            </div>
                                            @if(now()->lt($assignment->start_time))
                                                <p class="comment__meta">
                                                    <span>@lang('site.assignment_start_after') {{ $assignment->start_time->setTimezone('Africa/Cairo')->diffForHumans() }}</span>
                                                </p>
                                            @endif
                                        </div>
                                    </div><!-- end comment -->
                                </li>
                            @empty
                                <li>@lang('site.no_assignments')</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div><!-- end lecture-overview-item -->
        </div>
    </div>
</div><!-- end tab-pane -->
