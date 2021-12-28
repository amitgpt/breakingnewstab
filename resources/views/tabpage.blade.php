@extends('layouts.mainlayout')
@section('content')



<div class="ag-right-container">
    <a id="back-to-top" href="#" class=" back-to-top" role="button" data-placement="left"><i class="fas fa-angle-up"></i></a>
    @if(!empty($cat_name))
    <div class="ag-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/')}}"><i class="fa fa-home"></i></a></li>            
            <li class="breadcrumb-item active">{{ $cat_name }} </li>            
        </ol>     
    </div>
    @endif
    
    
    <div class="ag-main-wrap">
        <div class="ag-main-wrap--body">
            <div class="row" data-masonry='{"percentPosition": true }'> 
                @if(@$allNewsData->total() == 0)
                    <p>No post at this time, Kindly check this after some time.</p>                
                @endif
               
            </div>
            
            @if(!empty($allNewsData)) 
            @foreach($allNewsData as $news)
            
            
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
                        @if(@$news->imageurl !="/images/News_Aggregator.png" )
                        <a href="javascript::void(0);" class="ag-article--img">
                            <div class="article_img-wrap">
                                <img class="article_img" src="{{ $news->imageurl }}" onerror="this.onerror=null; this.src='{{asset('/images/News_Aggregator.png')}}'" alt="">
                            </div>
                        </a>
                        @endif
                        <div class="ag-article--body">
                            <a href="{{$news->link}}" class="ag-article--title tooltip-test"  data-toggle = "tooltip" title="{{$news->title}}" target="_blank">{{$news->title}}</a>
                            <p class="article--news">{{ Str::limit(strip_tags($news->description) , 200,' ...') }}</p>
                            <div class="article-ref"><a href="{{ url('managesources/'. @$news->channel_name)  }}">{{@$news->channel_name}}</a><span class="article-update-time">{{ show_date( @$news->pubdate, 'd-m-Y H:i:s') }}</span></div>

                        </div>                                            
                    </article>
                </div>
            </div>



            
            @endforeach
            
            @endif
            
            <div id="post-data" data-totalResult="{{@$allNewsData->total()}}">
		
            </div>
            <div class="ajax-load text-center" style="display:none">
                <p><img src="{{asset('/images/loader.gif')}}" alt="">Loading More post</p>
            </div>
        </div>
        <div class="ag-main-wrap--footer">
        </div>
    </div>

</div>

@stop





