@extends('extentionlayouts.mainlayout')
@section('content')
       
<div class="ag-right-container">
    <div class="extension-section-header">
        <div class="hdr-top">
            
            <div class="time" >
                <div class="clock">
                    <div class="wrap">
                        <span class="hour"></span>
                        <span class="minute"></span>
                        <span class="second"></span>
                        <span class="dot"></span>
                    </div>
                </div>
                <div id="dig-watch">
                </div>
            </div>

            
        </div>
        <div class="hdr-search headersearch">
            <form class="g-search" action="https://google.com/search" method="GET">
                <div class="input-group"><!-- <i class="fa fa-search"></i> -->
                    <i class="fas fa-search"></i>           
                    <input type="text" class="google-search form-control" placeholder="Search the web" name="q">
                    <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="extension-category-nav-wrap">
        <ul class="extension-category-nav">
            <?php $allCategories = navigation_cat(); ?>
            
            @if(!empty($allCategories))
                @foreach($allCategories as $cat)
                    <li class="cat-click" data-link = "{{ url('/news?cat=') }}{{$cat->slug}}" ><a href="javascript:void(0);" class="menu-listing--link">
                            <span>{{$cat->name}}</span>
                        </a>
                    </li>
                @endforeach
            @endif

        </ul>
    </div>
    <div class="ag-main-wrap cat-all-news">
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
            
        </div>
        <div class="ag-main-wrap--footer">
            <div class="ftrlogo"><a href="{{ url('/news') }}"><img src="{{asset('images/news-logo.png')}}" alt=""></a></div>
            <div class="ftrlinks">
                <a href="javascript:void(0);" id="load_all_button" >See All News <i class="fas fa-long-arrow-alt-right loadallnews"></i></a>
                <a href="javascript:void(0);" id="load_more_button" data-totalResult="{{$allNewsData->total()}}" page-no = '1'>More <i class="fas fa-angle-double-right"></i></a>
            </div>
        </div>
    </div>
</div>
@stop
                
        
	
      
     
      

	
