<div class="lecture-viewer-container">
    <div class="lecture-video-item">
        @if($lesson)
            @if($lesson->type == 'link' || $lesson->type == 'internal_link')
                <video controls crossorigin playsinline id="player">
                    <source src="{{ $lesson->type == 'internal_link' ? asset($lesson->link) : $lesson->link  }}"
                            type="video/mp4" size="1080"/>
                </video>
            @elseif($lesson->type == 'vimeo')
                <div id="player" data-plyr-provider="vimeo" data-plyr-embed-id="{{ $lesson->link }}"></div>
            @elseif($lesson->type == 'youtube')
                <div id="player" data-plyr-provider="youtube" data-plyr-embed-id="{{ $lesson->link }}"></div>
            @endif
        @endif
    </div>
</div><!-- end lecture-viewer-container -->
