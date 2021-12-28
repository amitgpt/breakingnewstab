@if(@$youTubeNews->yt_video_id)
<div class="row video-window">
    <div class="col-lg-8 col-md-7">
        <div class="video-view-wrap">
            
            <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{@$youTubeNews->yt_video_id}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            
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
</div>
@endif
@if(!empty($allYouTubeNews))
<div class="row">
    <div class="col-lg-12">
        <div class="watch-news-recommended">

            <div class="news-recommended-title">Watch News</div>

            <!-- Swiper -->
            <div class="swiper-container watch-news-slider">
                <div class="swiper-wrapper">
                    @foreach($allYouTubeNews as $allytnews)
                    <div>
                        <a href="JavaScript:void(0);" class="news-recommended-article" videonewsid = "{{$allytnews->id}}">                                        
                            <span class="video-playingnow">Playing Now</span>
                            <div class="recommended-video">
                                <img src="{{$allytnews->imageurl}}" alt="">
                                <i class="fab fa-youtube"></i>
                            </div>                                        
                            <div class="recommended-video-title">
                                <div class="video-article">{{$allytnews->title}}</div>
                                <div class="video-channel">{{$allytnews->creator}}  <span> {{ show_date( @$allytnews->pubdate, 'd-m-Y H:i:s') }} </span></div>
                                
                            </div>
                        </a>
                    </div>
                    @endforeach


                </div>
                
            </div>
        </div>
    </div>
</div>
@endif

