<div role="tabpanel" class="tab-pane fade" id="quizzes">
    <div class="lecture-overview-wrap lecture-quest-wrap">
        <div class="">
            <div class="lecture-overview-item mt-0">
                <div class="question-list-container">
                    <div class="question-list-item">
                        <ul class="comments-list">
                            @forelse($quizzes as $quiz)
                                <li>
                                    <div class="comment">
                                        <div class="comment-body">
                                            <div
                                                class="meta-data d-flex align-items-center justify-content-between">
                                                <div
                                                    class="question-meta-content d-flex justify-content-between align-items-center w-100">
                                                    <h3 class="comment__author">
                                                        {{ $quiz->name }}
                                                    </h3>
                                                    @if(\Carbon\Carbon::now() >= $quiz->start_time && \Carbon\Carbon::now() <= $quiz->end_time && !auth()->user()->studentTakeQuiz($quiz))
                                                        <a href="{{ route('courses.quizzes.show', ['course' => $course->slug, 'quiz' => $quiz->id]) }}">
                                                            <button class="theme-btn">
                                                                <i class="las la-pencil-ruler"></i>
                                                                @lang('site.go_to_quiz')
                                                            </button>
                                                        </a>
                                                    @endif
                                                    @if(\Carbon\Carbon::now() >= $quiz->end_time && auth()->user()->studentTakeQuiz($quiz))
                                                        @php
                                                            $quiz_attempt_id = \App\Models\QuizAttempt::where('student_id', auth()->user()->id)->where('quiz_id', $quiz->id)->first()->id;
                                                        @endphp
                                                        <a href="{{ route('courses.quizzes.showResults', ['course' => $course->slug, 'quiz' => $quiz->id, 'quiz_attempt' => $quiz_attempt_id]) }}">
                                                            <button class="theme-warning-btn">
                                                                <i class="las la-pencil-ruler"></i>
                                                                @lang('site.show_result')
                                                            </button>
                                                        </a>
                                                    @elseif(\Carbon\Carbon::now() >= $quiz->start_time && \Carbon\Carbon::now() < $quiz->end_time && auth()->user()->studentTakeQuiz($quiz))
                                                        <h6>@lang('site.submitted')</h6>
                                                    @elseif(\Carbon\Carbon::now() >= $quiz->end_time && !auth()->user()->studentTakeQuiz($quiz))
                                                        <h6 class="text-danger">@lang('site.you_didt_attend_to_this_quiz')</h6>
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="comment__meta">
                                                @if(\Carbon\Carbon::now() < $quiz->start_time)
                                                    <span>@lang('site.quiz_start_after') {{ $quiz->start_time->setTimezone('Africa/Cairo')->diffForHumans() }}</span>
                                                @elseif(\Carbon\Carbon::now() >= $quiz->end_time)
                                                    <span>@lang('site.quiz_finished_from') {{ $quiz->end_time->setTimezone('Africa/Cairo')->diffForHumans() }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div><!-- end comment -->
                                </li>
                            @empty
                                <li>@lang('site.no_quizzes')</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div><!-- end lecture-overview-item -->
        </div>
    </div>
</div><!-- end tab-pane -->
