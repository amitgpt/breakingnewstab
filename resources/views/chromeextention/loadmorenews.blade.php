<div class="row form-row justify-content-center">
    @if(!empty($allNewsData))
        @foreach($allNewsData as $key => $newsData )
        
        <div class="col-md-3 col-sm-4">
            <article class="ag-article--card">
                <a href="{{@$newsData->link}}" class="ag-article--img" target="_blank">
                    <div class="article_img-wrap">
                        <img class="article_img" width="220" height="150" src="{{ @$newsData->imageurl }}" onerror="this.onerror=null; this.src='{{asset('/images/News_Aggregator.png')}}'">
                    </div>
                </a>
                <div class="ag-article--body">
                    <a href="{{@$newsData->link}}" class="ag-article--title" target="_blank">{{ @$newsData->title }}</a>
                    <div class="article-ref"><a href="{{ url('managesources/'. @$newsData->channel_name)  }}" target="_blanck">{{get_domain(@$newsData->link)}}</a><span class="article-update-time">{{ show_date( @$newsData->pubdate, 'd-m-Y H:i:s') }}</span></div>
                </div>                                            
            </article>
        </div>
        @endforeach
    @endif
</<div>