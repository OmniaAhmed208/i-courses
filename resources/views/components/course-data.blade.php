<div class="lecture-video-detail">
    <div class="lecture-tab-body">
        <div class="section-tab section-tab-2">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="mobile-course-tab">
                    <a href="#course-content" role="tab" data-toggle="tab" aria-selected="true">
                        @lang('site.course_content')
                    </a>
                </li>
                <li role="presentation">
                    <a href="#overview" role="tab" data-toggle="tab" class="active" aria-selected="true">
                        @lang('site.overview')
                    </a>
                </li>
                <li role="presentation">
                    <a href="#resources" role="tab" data-toggle="tab" aria-selected="false">
                        @lang('site.resources')
                    </a>
                </li>
                <li role="presentation">
                    <a href="#quizzes" role="tab" data-toggle="tab" aria-selected="false">
                        @lang('site.quizzes')
                    </a>
                </li>
                <li role="presentation">
                    <a href="#assignments" role="tab" data-toggle="tab" aria-selected="false">
                        @lang('site.assignments')
                    </a>
                </li>
                <li role="presentation">
                    <a href="#announcements" role="tab" data-toggle="tab" aria-selected="false">
                        @lang('site.announcements')
                    </a>
                </li>
                <li role="presentation">
                    <a href="#quest-and-ans" role="tab" data-toggle="tab" aria-selected="false">
                        @lang('site.question_n_answers')
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="lecture-video-detail-body">
        <div class="tab-content">
            <x-course-mobile-sidebar :sections="$course->sections"/>
            <x-course-overview :course="$course"/>
            {{--            <x-course-qa/>--}}
            <x-course-resources :resources="$course->resources" :slug="$course->slug"/>
            <x-course-quizzes :quizzes="$course->quizzes" :course="$course"/>
            <x-course-assignments :assignments="$course->assignments" :course="$course"/>
            <x-course-announcements :announcements="$course->announcements" :course="$course"/>
            <x-course-qa :qas="$course->qas" :course="$course"/>

        </div>
    </div><!-- end lecture-video-detail-body -->
</div><!-- end lecture-video-detail -->
