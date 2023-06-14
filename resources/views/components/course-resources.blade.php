<div role="tabpanel" class="tab-pane fade" id="resources">
    <div class="lecture-overview-wrap lecture-quest-wrap">
        <div class="">
            <div class="lecture-overview-item mb-0">
                <div
                    class="question-overview-result-header d-flex align-items-center justify-content-between pb-3">
                    <div class="question-result-item">
                        <h3 class="widget-title font-size-17">{{ count($resources) }} @lang('site.resources_to_be_downloaded')</h3>
                    </div>
                </div>
                <div class="section-block"></div>
            </div><!-- end lecture-overview-item -->
            <div class="lecture-overview-item mt-0">
                <div class="question-list-container">
                    <div class="question-list-item">
                        <ul class="comments-list {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                            @forelse($resources as $resource)
                                <li>
                                    <div class="comment">
                                        <div class="comment-body">
                                            <div
                                                class="meta-data d-flex align-items-center justify-content-between">
                                                <div
                                                    class="question-meta-content d-flex justify-content-between align-items-center w-100">
                                                    <h3 class="comment__author">
                                                        <span>
                                                            @if($resource->extension == 'docx' || $resource->extension == 'doc')
                                                                <i class="far fa-file-word fa-2x"></i>
                                                            @elseif($resource->extension == 'xls' || $resource->extension == 'xlsx' || $resource->extension == 'csv')
                                                                <i class="far fa-file-excel fa-2x"></i>
                                                            @elseif($resource->extension == 'csv')
                                                                <i class="fas fa-file-csv fa-2x"></i>
                                                            @elseif($resource->extension == 'ppt' || $resource->extension == 'pptx')
                                                                <i class="far fa-file-powerpoint fa-2x"></i>
                                                            @elseif($resource->extension == 'jpeg' || $resource->extension == 'jpg' || $resource->extension == 'png')
                                                                <i class="far fa-file-image fa-2x"></i>
                                                            @elseif($resource->extension == 'pdf')
                                                                <i class="far fa-file-pdf fa-2x"></i>
                                                            @endif
                                                        </span>
                                                        {{ $resource->name }}
                                                        <span class="font-size-12">({{ $resource->size }})</span>
                                                    </h3>
                                                    <a href="{{ route('courses.resources.download', ['course' => $slug, 'resource' => $resource->id]) }}">
                                                        <button class="theme-btn theme-btn-light">
                                                            <i class="la la-download"></i>
                                                            @lang('site.download')
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                            <p class="comment__meta">
                                                <span>{{ $resource->created_at->diffForHumans() }}</span>
                                            </p>
                                        </div>
                                    </div><!-- end comment -->
                                </li>
                            @empty
                                <li>@lang('site.no_resources')</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div><!-- end lecture-overview-item -->
        </div>
    </div>
</div><!-- end tab-pane -->
