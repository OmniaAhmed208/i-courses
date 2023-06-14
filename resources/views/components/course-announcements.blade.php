<div role="tabpanel" class="tab-pane fade" id="announcements">
    <div class="lecture-overview-wrap lecture-quest-wrap" style="width: 80%">
        <div class="">
            <div class="lecture-overview-item mt-0">
                <div class="question-list-container">
                    <div class="question-list-item">
                        <ul class="comments-list">
                            @forelse($announcements as $announcement)
                                <li>
                                    <div class="comment">
                                        <div class="comment-body">
                                            <div
                                                class="meta-data d-flex align-items-center justify-content-between">
                                                <div
                                                    class="question-meta-content w-100">
                                                    <h3 class="comment__author">
                                                        {{ $announcement->body }}
                                                    </h3>
                                                    <h6 class="mt-2">{{ $announcement->created_at->format('d/m/Y h:i A') }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end comment -->
                                </li>
                            @empty
                                <li>@lang('site.no_announcements')</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div><!-- end lecture-overview-item -->
        </div>
    </div>
</div><!-- end tab-pane -->
