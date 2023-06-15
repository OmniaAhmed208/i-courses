@foreach($sections as $section)
    <div class="accordion accordion-shared" id="accordionExample-{{ $section->id }}">
        <div class="card">
            <div class="card-header" id="section-{{ $section->id }}">
                <h2 class="mb-0">
                    <button
                        class="btn btn-link d-flex align-items-center justify-content-between collapsed"
                        type="button" data-toggle="collapse"
                        data-target="#collapse-{{ $section->id }}"
                        aria-expanded="false"
                        aria-controls="collapse-{{ $section->id }}">
                        <i class="fa fa-angle-up"></i>
                        <i class="fa fa-angle-down"></i>
                        {{ $section->name }}
                        <span>{{ count($section->lessons) }} @lang('site.lessons')</span>
                    </button>
                </h2>
            </div><!-- end card-header -->
            <div id="collapse-{{ $section->id }}" class="collapse"
                 aria-labelledby="section-{{ $section->id }}"
                 data-parent="#accordionExample-{{ $section->id }}">
                <div class="card-body">
                    <ul class="list-items">
                        @if(count($section->lessons) > 0 && $section->isLastLevelChild())
                            @foreach($section->lessons as $lesson)
                                @if($lesson->is_free)
                                    <li>
                                        <a href="javascript:void(0)"
                                           class="primary-color-2 d-flex align-items-center justify-content-between lesson"
                                           data-toggle="modal"
                                           data-target=".preview-modal-form"
                                           data-link="{{ $lesson->type === 'internal_link' ? asset($lesson->link) : $lesson->link }}"
                                           data-title="{{ $lesson->name }}"
                                           data-type="{{ $lesson->type }}">
                                                                            <span>
                                                                                <i class="fa fa-play-circle mr-2"></i>
                                                                                {{ $lesson->name }}
                                                                                <span
                                                                                    class="badge-label">@lang('site.preview')</span>
                                                                            </span>
                                            <span
                                                class="course-duration">{{ \Carbon\Carbon::createFromTimestamp($lesson->time)->setTimezone('UTC')->format("i:s") }}</span>
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="javascript:void(0)"
                                           class="d-flex align-items-center justify-content-between">
                                                                            <span>
                                                                                <i class="fa fa-play-circle mr-2"></i>
                                                                                {{ $lesson->name }}
                                                                                <span
                                                                                    class="badge-label badge-secondary">@lang('site.locked')</span>
                                                                            </span>
                                            <span
                                                class="course-duration">{{ \Carbon\Carbon::createFromTimestamp($lesson->time)->setTimezone('UTC')->format("i:s") }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @else
                            @include('website.courses._sub_sections', ['sections' => $section->child])
                        @endif
                    </ul>
                </div><!-- end card-body -->
            </div><!-- end collapse -->
        </div><!-- end card -->
    </div><!-- end accordion -->
@endforeach
