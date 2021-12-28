<div class="ag-main-wrap--body">
            <div class="row form-row justify-content-center" id="all-news-data">
                
                @if(!empty($allNewsData))
                    @foreach($allNewsData as $key => $newsData )
                    
                    <div class="col-md-3 col-sm-4">
                        <article class="ag-article--card">
                            <a href="{{@$newsData->link}}" class="ag-article--img">
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
            </div>
            <div id="more-news-data">
		
            </div>
            
        
        <div class="ag-main-wrap--footer">
            <div class="ftrlogo"><a href="{{ url('/news') }}"><img src="{{asset('images/news-logo.png')}}" alt=""></a></div>
            <div class="ftrlinks">
                @if($allNewsData->total() > 4)
                <a href="javascript:void(0);" id="load_all_cat_button" data-cat="{{$cat_name}}">See All News <i class="fas fa-long-arrow-alt-right loadallnews"></i></a>
                <a href="javascript:void(0);" id="load_more_cat_button" data-cat="{{$cat_name}}" data-totalResult="{{$allNewsData->total()}}" page-no = '1'>More <i class="fas fa-angle-double-right"></i></a>
                @endif
            </div>
        </div>
        </div>