<div role="tabpanel" class="tab-pane fade" id="quest-and-ans">
    <div class="lecture-overview-wrap lecture-quest-wrap">
        @foreach($qas as $qa)
            <div class="replay-question-wrap-{{ $qa->id }}" style="display: none">
                <button class="theme-btn theme-btn-light back-to-question-btn" data-id="{{ $qa->id }}">
                    <i class="la la-reply mr-1"></i>
                    @lang('site.back_to_all_questions')
                </button>
                <div class="replay-question-body padding-top-30px">
                    <div class="question-list-item">
                        <ul class="comments-list">
                            <li>
                                <div class="comment">
                                    <div class="comment-avatar">
                                        <img class="avatar__img" alt="{{ $qa->student->name }}"
                                             src="{{ $qa->student->avatar }}">
                                    </div>
                                    <div class="comment-body">
                                        <div class="meta-data d-flex align-items-center justify-content-between">
                                            <div class="question-meta-content">
                                                <p class="comment__meta">
                                                    <span><a
                                                            href="javascript:void(0);">{{ $qa->student->name }}</a></span>
                                                    <span>{{ $qa->created_at->diffForHumans() }}</span>
                                                </p>
                                                <p class="comment-content">
                                                    {{ $qa->question }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end comment -->
                                <div class="section-block"></div>
                                @if($qa->answer)
                                    <div class="question-answer-wrap">
                                        <div class="comment">
                                            <div class="comment-avatar">
                                                <img class="avatar__img" alt="{{ $course->instructor->name }}"
                                                     src="{{ $course->instructor->avatar }}">
                                            </div>
                                            <div class="comment-body">
                                                <div
                                                    class="meta-data d-flex align-items-center justify-content-between">
                                                    <div class="question-meta-content">
                                                        <h3 class="comment__author">
                                                            <a href="javascript:void(0);" class="d-inline-block">
                                                                {{ $course->instructor->name }}
                                                            </a> - @lang('site.instructor')
                                                        </h3>
                                                        <p class="comment__meta">
                                                            <span>{{ $qa->updated_at->diffForHumans() }}</span>
                                                        </p>
                                                        <p class="comment-content">
                                                            {{ $qa->answer }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end comment -->
                                    </div>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- end replay-question-wrap -->
        @endforeach
        <div class="question-overview-result-wrap">
            <h3 class="widget-title font-size-20">@lang('site.ask_new_question')</h3>
            <form action="{{ route('courses.qa.ask', $course->slug) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-box">
                            <label class="label-text" for="question">
                                @lang('site.question')
                                <span class="primary-color-2 ml-1">*</span>
                            </label>
                            <div class="form-group">
                                <textarea id="question" class="message-control form-control" name="question" rows="5"
                                          placeholder="Write Question">{{ old('question') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="btn-box text-center">
                            <button class="theme-btn theme-btn-light w-100">Ask</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="lecture-overview-item mb-0">
                <div
                    class="question-overview-result-header d-flex align-items-center justify-content-between pb-3">
                    <div class="question-result-item">
                        <h3 class="widget-title font-size-17">{{ count($qas) }} @lang('site.questions_in_this_course')</h3>
                    </div>
                </div>
                <div class="section-block"></div>
            </div><!-- end lecture-overview-item -->
            <div class="lecture-overview-item mt-0">
                <div class="question-list-container">
                    <div class="question-list-item">
                        <ul class="comments-list">
                            @foreach($qas as $qa)
                                <li>
                                    <div class="comment">
                                        <div class="comment-avatar">
                                            <img class="avatar__img" alt="{{ $qa->student->name }}"
                                                 src="{{ asset($qa->student->avatar) }}">
                                        </div>
                                        <div class="comment-body">
                                            <div
                                                class="meta-data d-flex align-items-center justify-content-between">
                                                <div class="question-meta-content">
                                                    <a href="javascript:void(0)" class="question_body" data-id="{{ $qa->id }}">
                                                        <p class="comment-content">
                                                            {{ strlen($qa->question > 50) ? substr($qa->question, 0, 50) . "..." : $qa->question }}
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>
                                            <p class="comment__meta">
                                                <span><a href="javascript:void(0);">{{ $qa->student->name }}</a></span>
                                                <span>{{ $qa->created_at->diffForHumans() }}</span>
                                            </p>
                                        </div>
                                    </div><!-- end comment -->
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div><!-- end lecture-overview-item -->
        </div>
    </div>
</div><!-- end tab-pane -->
