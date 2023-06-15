<div role="tabpanel" class="tab-pane fade active show {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}"
     id="overview">
    <div class="lecture-overview-wrap">
        <div class="lecture-overview-item">
            <div class="lecture-heading">
                <h3 class="widget-title pb-2">@lang('site.about_this_course')</h3>
            </div>
        </div><!-- end lecture-overview-item -->
        <div class="lecture-overview-item">
            <div class="lecture-overview-stats-wrap d-flex ">
                <div class="lecture-overview-stats-item">
                    <ul class="list-items">
                        <li><span>@lang('site.level'):</span>@lang('site.' . $course->level)</li>
                        <li><span>@lang('site.students'):</span>{{ $course->students()->count() }}</li>
                        <li><span>@lang('site.language'):</span>@lang('site.lang_' .$course->language)</li>
                    </ul>
                </div>
                <div class="lecture-overview-stats-item">
                    <ul class="list-items">
                        <li><span>@lang('site.lessons'):</span>{{ $course->lessons()->count() }}</li>
                        <li>
                            <span>@lang('site.course_duration'):</span>{{ \Carbon\Carbon::createFromTimestamp($course->total_duration)->setTimezone('UTC')->format("H:i:s") }}
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- end lecture-overview-item -->

        @if(auth()->user()->hasRole('student'))
            <div class="section-block"></div>
            <div class="lecture-overview-item">
                <div class="lecture-overview-stats-wrap d-flex">
                    <div class="lecture-overview-stats-item">
                        <h3 class="widget-title font-size-16">@lang('site.course_features')</h3>
                    </div>
                    <div class="lecture-overview-stats-item">
                        <ul class="list-items">
                            <li>@lang('site.available_on')
                                <a href="#" class="primary-color-2">IOS</a> @lang('site.and') <a href="#"
                                                                                                 class="primary-color-2">Android</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- end lecture-overview-item -->
        @endif
        <div class="section-block"></div>
        <div class="lecture-overview-item">
            <div class="lecture-overview-stats-wrap d-flex">
                <div class="lecture-overview-stats-item">
                    <h3 class="widget-title font-size-16">@lang('site.description')</h3>
                </div>
                <div class="lecture-overview-stats-item lecture-overview-stats-wide-item">
                    <div class="lecture-description show-more-content">
                        {!! $course->description !!}
                    </div>
                </div>
            </div>
        </div><!-- end lecture-overview-item -->
        <div class="section-block"></div>
        <div class="lecture-overview-item">
            <div class="lecture-overview-stats-wrap d-flex ">
                <div class="lecture-overview-stats-item">
                    <h3 class="widget-title font-size-16">@lang('site.instructor')</h3>
                </div>
                <div class="lecture-overview-stats-item lecture-overview-stats-wide-item">
                    <div class="lecture-owner-wrap d-flex align-items-center">
                        <div class="lecture-owner-avatar">
                            <img src="{{ $course->instructor->avatar }}" alt="{{ $course->instructor->name }}">
                        </div>
                        <div class="lecture-owner-title-wrap">
                            <h3 class="widget-title pb-1 font-size-18">
                                <a
                                    href="{{ asset('teacher-detail.html') }}"
                                    class="primary-color">
                                    {{ $course->instructor->name }}
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div class="lecture-owner-profile pt-4">
                        <ul class="social-profile">
                            <li>
                                <a href="{{ $course->instructor->teacher->facebook ?? "#" }}" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $course->instructor->teacher->twitter ?? "#" }}" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $course->instructor->teacher->linkedin ?? "#" }}" target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- end lecture-overview-item -->
    </div><!-- end lecture-overview-wrap -->
</div><!-- end tab-pane -->
