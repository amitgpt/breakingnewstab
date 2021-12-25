
<div class="col-lg-8 col-md-7">
    <div class="video-view-wrap">
        <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{$youTubeNews->yt_video_id}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>
<div class="col-lg-4 col-md-5">
    <div class="related-videos">
        @if(!empty($moreRelatedNews))
        <h5 class="related-videos-title">
            More Related Videos
        </h5>
        <div class="related-videos-side">
            @foreach($moreRelatedNews as $relatedNews)
            <a href="JavaScript:void(0);" class="videos-article {{ $youTubeNews->id === $relatedNews->id ? "active-video" : '' }}" video_id = "{{$relatedNews->yt_video_id}}">
                <div class="activevideo"></div>
                <div class="video-article-img"><img src="{{$relatedNews->imageurl}}" alt=""></div>
                <div class="video-article-title">
                    <div class="video-article">{{$relatedNews->title}}</div>
                    <div class="video-channel">{{$relatedNews->creator}}</div>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</div>
