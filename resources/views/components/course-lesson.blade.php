<div class="lecture-viewer-container">
    <div class="lecture-video-item">
        @if($lesson)
            @if($lesson->type == 'link' || $lesson->type == 'internal_link')
                <video controls crossorigin playsinline id="player">
                    <source src="{{ $lesson->type == 'internal_link' ? asset($lesson->link) : $lesson->link  }}"
                            type="video/mp4" size="1080"/>
                </video>
            @elseif($lesson->type == 'vimeo')
                <iframe
                        src="https://player.vimeo.com/video/{{ explode("/", $lesson->link)[count(explode("/", $lesson->link))-1] }}"
                        width="1500"
                        height="500"
                        id="vimeoIframe"
                        frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            @elseif($lesson->type == 'youtube')
                <div id="player" data-plyr-provider="youtube" data-plyr-embed-id="{{ $lesson->link }}"></div>
            @endif
        @endif
    </div>
</div><!-- end lecture-viewer-container -->
