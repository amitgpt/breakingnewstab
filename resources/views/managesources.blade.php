@extends('layouts.mainlayout')
@section('content')



<div class="ag-right-container">
    <a id="back-to-top" href="#" class=" back-to-top" role="button" data-placement="left"><i class="fas fa-angle-up"></i></a>
    @if(!empty($cat_name))
    <div class="ag-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"> managesources </li> 
            <li class="breadcrumb-item active">{{ $channel }} </li>            
        </ol>     
    </div>
    @endif
    <div class="ag-main-wrap">
        <div class="ag-main-wrap--body">
            <div class="row" data-masonry='{"percentPosition": true }'>
                @if(!empty($rendomNews))
                @foreach($rendomNews as $news)



                <div class="col-lg-4 col-md-6 col-sm-6">
                    <article class="ag-article--card">

                        <div class="read-related-wrap" style="display: block;">                            
                            <div class="share-icon">
                                <div class="sharebtn_wrap">
                                    <div class="sharebtn sharefbicon fa-wrap" data-share-url="http://www.facebook.com/sharer.php?u=" article_link="{{@$news->link}}" data-layout="button" data-size="small">
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
                                <img class="article_img" src="{{ @$news->imageurl }}" onerror="this.onerror=null; this.src='{{asset('/images/News_Aggregator.png')}}'">
                            </div>
                        </a>
                        @endif
                        <div class="ag-article--body">
                            <a href="{{@$news->link}}" class="ag-article--title tooltip-test"  data-toggle = "tooltip" title="{{@$news->title}}" target="_blank">{{@$news->title}}</a>
                            <div class="article-ref"><a href="javascript::void(0);">{{@$news->channel_name}}</a><span class="article-update-time">{{ show_date( @$news->pubdate, 'd-m-Y H:i:s') }}</span></div>
                        </div>                                            
                    </article>
                </div>

                @endforeach
                @endif

            </div>

            @if(!empty($allNewsData))
            
            @foreach($allNewsData as $channelnews)

            <div class="row">
                <div class="col-lg-12">
                    <article class="ag-article--card article--card_landscape ">
                        <div class="read-related-wrap" style="display: block;">                            
                            <div class="share-icon">
                                <span class="fa-wrap share-s">
                                    <i class="fa-gray fa fa-share-alt"></i>
                                </span><div class="sharebtn_wrap">
                                    <div class="sharebtn sharefbicon fa-wrap" data-share-url="http://www.facebook.com/sharer.php?u=" article_link="{{@$news->link}}" data-layout="button" data-size="small">
                                        <i class="fab fa-facebook-f"></i>                                      
                                    </div>
                                    <div class="shareemailbtn shareemailticon fa-wrap">
                                        <a href="mailto:?subject=I wanted you to see this news&amp;body=Check out this site {{@$news->link}}  title="Share by Email">
                                           <i class="far fa-envelope"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="javascript::void(0);" class="ag-article--img">
                            <div class="article_img-wrap">
                                <img class="article_img" src="{{ $channelnews->imageurl }}" onerror="this.onerror=null; this.src='{{asset('/images/News_Aggregator.png')}}'">
                            </div>
                        </a>
                        <div class="ag-article--body">
                            <a href="{{$channelnews->link}}" class="ag-article--title tooltip-test"  data-toggle = "tooltip" title="{{$channelnews->title}}" target="_blank">{{$channelnews->title}}</a>
                            <p class="article--news">{{ Str::limit(strip_tags($channelnews->description) ,'200',' ...') }}</p>
                            <div class="article-ref"><a href="#">{{@$news->channel_name}}</a><span class="article-update-time">{{ show_date( $channelnews->pubdate, 'd-m-Y H:i:s') }}</span></div>

                        </div>                                            
                    </article>
                </div>
            </div>
            @endforeach
            @endif

        </div>
        <div class="ag-main-wrap--footer">
        </div>
    </div>

</div>

@stop





