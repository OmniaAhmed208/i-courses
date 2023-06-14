@foreach($sections as $index => $section)
    <div class="accordion course-item-list-accordion" id="mobileCourseMenu-{{ $section->id }}">
        <div class="card">
            <div class="card-header" id="mobileCollapseMenu-{{ $section->id }}">
                <h2 class="mb-0">
                    <button class="btn btn-link {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}"
                            type="button" data-toggle="collapse"
                            data-target="#mobileCollapse-{{ $section->id }}"
                            aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                            aria-controls="mobileCollapse-{{ $index }}">
                                        <span
                                            class="widget-title font-size-15 font-weight-semi-bold">@lang('site.section') {{ $index + 1 }}: {{ $section->name }}</span>
                    </button>
                </h2>
            </div>
            <div id="mobileCollapse-{{ $section->id }}" class="collapse {{ $index == 0 ? 'show' : '' }}"
                 aria-labelledby="mobileCollapseMenu-{{ $section->id }}"
                 data-parent="#mobileCourseMenu-{{ $section->id }}">
                <div class="card-body">
                    <div class="course-content-list">
                        <ul class="course-list">
                            @if(count($section->lessons) > 0 && $section->isLastLevelChild())
                                @foreach($section->lessons as $key => $lesson)
                                    <li class="course-item-link {{ $key == 0 && $index == 0 ? 'active' : '' }} course-lesson  {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}"
                                        data-link="{{ $lesson->type === 'internal_link' ? asset($lesson->link) : $lesson->link }}"
                                        data-type="{{ $lesson->type }}"
                                        data-id="{{ $lesson->id }}"
                                    >
                                        <div class="course-item-content-wrap">
                                            <div class="course-item-content">
                                                <h4 class="widget-title font-size-15 font-weight-medium">
                                                    {{ $key + 1 }}. {{ $lesson->name }}
                                                </h4>
                                                <div class="courser-item-meta-wrap">
                                                    <p class="course-item-meta">
                                                        <i class="la la-play-circle"></i>
                                                        {{ \Carbon\Carbon::createFromTimestamp($lesson->time)->setTimezone('UTC')->format("H:i:s") }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                @include('website.courses.details._sub_sections_mobile', ['sections' => $section->child])
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
