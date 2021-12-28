@extends('layouts.mainlayout')
@section('content')



<div class="ag-right-container">
    <a id="back-to-top" href="#" class="back-to-top" role="button" data-placement="left" title="Go to top"><i class="fas fa-angle-up"></i></a>
    @if(!empty($cat_name))
    <div class="ag-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>            
            <li class="breadcrumb-item active">{{ $cat_name }} </li>            
        </ol>     
    </div>
    @endif
    <div class="ag-main-wrap">
        <div class="ag-main-wrap--body">

            <div class="row" data-masonry='{"percentPosition": true }'>
                @if(count($rendomNews) == 0 && count($allNewsData) == 0)
                    <p>No post at this time, Kindly check this after some time.</p>                
                @endif
                @if(!empty($rendomNews))
                @foreach($rendomNews as $news)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <article class="ag-article--card">
                        <div class="read-related-wrap" style="display: block;">                            
                            <div class="share-icon">
                                <div class="sharebtn_wrap">
                                    <div class="sharebtn sharefbicon fa-wrap" data-share-url="https://www.facebook.com/sharer.php?u=" article_link="{{@$news->link}}" data-layout="button" data-size="small">
                                        <i class="fab fa-facebook-f"></i>                                      
                                    </div>
                                    <div class="shareemailbtn shareemailticon fa-wrap">
                                        <a href="mailto:?subject=I wanted you to see this news&amp;body=Check out this site {{@$news->link}}  title="Share by Email">
                                           <i class="far fa-envelope"></i>
                                        </a>
                                    </div>

                                </div>
                                <span class="fa-wrap share-s">
                                    <i class="fa-gray fa fa-share-alt"></i>
                                </span>
                            </div>
                        </div>
                        
                        @if(@$news->imageurl !="/images/News_Aggregator.png" && does_url_exists(@$news->imageurl))
                        <a href="{{@$news->link}}" class="ag-article--img" target="_blank">
                            <div class="article_img-wrap">
                                <img class="article_img" src="{{ @$news->imageurl }}" onerror="this.onerror=null; this.src='{{asset('/images/News_Aggregator.png')}}'">
                            </div>
                        </a>
                        @endif
                        <div class="ag-article--body">
                            <a href="{{@$news->link}}" class="ag-article--title tooltip-test"  data-toggle = "tooltip" title="{{@$news->title}}" target="_blank">{{@$news->title}}</a>
                            <div class="article-ref"><a href="{{ url('managesources/'. @$news->channel_name)  }}">{{@$news->channel_name}}</a><span class="article-update-time">{{ show_date( @$news->pubdate, 'd-m-Y H:i:s') }}</span></div>
                        </div>                                            
                        </article>
                    </div>
                   
                @endforeach
                @endif
            </div>

            

            @if(!empty($allNewsData))
                @foreach($allNewsData as $cat=> $newsData )
                @if(!empty($newsData))
               
                <div class="row">
                <div class="col-sm-12">
                    <div class="news-row-heading">{{ $cat }}</div>
                </div>
                </div>
                @endif
                @php $i = 0; $checknews = 0;@endphp
                @foreach($newsData as $newsdata )
                @php $i++; $checknews = 1; @endphp
                <div class="row">
                <div class="col-lg-12">
                    <article class="ag-article--card article--card_landscape ">
                        <div class="read-related-wrap" style="display: block;">                            
                            <div class="share-icon">
                                <div class="sharebtn_wrap">
                                    <div class="sharebtn sharefbicon fa-wrap" data-share-url="https://www.facebook.com/sharer.php?u=" article_link="{{@$news->link}}" data-layout="button" data-size="small">
                                        <i class="fab fa-facebook-f"></i>                                      
                                    </div>
                                    <div class="shareemailbtn shareemailticon fa-wrap">
                                        <a href="mailto:?subject=I wanted you to see this news&amp;body=Check out this site {{@$news->link}}  title="Share by Email">
                                           <i class="far fa-envelope"></i>
                                        </a>
                                    </div>
                                </div>
                                <span class="fa-wrap share-s">
                                    <i class="fa-gray fa fa-share-alt"></i>
                                </span>
                            </div>
                        </div>
                        @if(@$newsdata->imageurl !="/images/News_Aggregator.png" )
                        <a href="{{@$newsdata->link}}" class="ag-article--img" target="_blank">
                            <div class="article_img-wrap">
                                <img class="article_img" src="{{ @$newsdata->imageurl }}" onerror="this.onerror=null; this.src='{{asset('/images/News_Aggregator.png')}}'">
                            </div>
                        </a>
                        @endif
                        <div class="ag-article--body">
                            <a href="{{@$newsdata->link}}" class="ag-article--title tooltip-test"  data-toggle = "tooltip" title="{{@$newsdata->title}}" target="_blank">{{@$newsdata->title}}</a>
                            <p class="article--news">{{ Str::limit( strip_tags(@$newsdata->description) , 200, ' ...') }}</p>
                            <div class="article-ref"><a href="{{ url('managesources/'. @$newsdata->channel_name)  }}">{{@$news->channel_name}}</a><span class="article-update-time">{{ show_date( @$newsdata->pubdate, 'd-m-Y H:i:s') }}</span></div>

                        </div> 
                    </article>
                </div>
            </div>
               
               
                @if(@$newsdata->slug && $i == 4) 
                <div id="news-data_{{@$newsdata->slug}}">
		
                </div>                
                
                <div id="load_more">
                    <button type="button" name="load_more_button" class="btn load_more_button load_more_button_{{@$newsdata->slug}}" data-cat="{{@$newsdata->slug}}"  data-totalResult="{{$newsData->total()}}" id="load_more_button" page-no = '1' >MORE {{ \Str::upper($cat) }} ARTICALS <i class="fas fa-chevron-down"></i></button>
                </div>
                @endif
                @endforeach 
                @endforeach
                
            @endif
           
        </div>
        <div class="ag-main-wrap--footer">
        </div>
    </div>

</div>
 
@stop





