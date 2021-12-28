<div class="news-loader d-none">
        <div class="indeterminate"></div>
    </div> 
    

    <header id="agHeader" class="ag-header extension-header toolbarlooklike_header">
        <nav class="navbar navbar-expand-lg">              
          <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button> -->

          <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="animated-icon1"><span></span><span></span><span></span></div>
          </button>

            <div class="headersearch">
                <form class="g-search" action="https://google.com/search" method="GET">
                    <div class="input-group"><!-- <i class="fa fa-search"></i> -->
                        <!-- <i class="fas fa-search"></i>  -->          
                        <input type="text" class="google-search form-control" placeholder="Search the web" name="q">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i> </button>
                      </div>
                    </div>
                </form>
            </div>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php $allCategories = navigation_cat(); ?>
            <div class="dropdown topGeners_nav">
                <ul class="navbar-nav">
                  @if(!empty($allCategories))
                        @foreach($allCategories as $cat)
                            <li class="nav-item " data-link = "{{ url('/?cat=') }}{{$cat->slug}}">
                                <a class="nav-link" href="{{ url('/?cat=') }}{{$cat->slug}}" target="_parent">{{$cat->name}}</a>
                            </li>
                        @endforeach
                  @endif
                </ul>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- <i class="fal fa-ellipsis-v"></i> -->
                    <i class="far fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    @if(!empty($allCategories))
                        @foreach($allCategories as $cat)
                            <a href="{{ url('/?cat=') }}{{$cat->slug}}" class="dropdown-item cat-click" target="_parent">
                            @if($cat->slug == 'topnews')
                                <i class="fas fa-newspaper"></i>
                            @elseif($cat->slug == 'worldnews')
                                <i class="fas fa-globe-americas"></i>                    
                            @elseif($cat->slug == 'business')
                                <i class="fas fa-chart-bar"></i>                    
                            @elseif($cat->slug == 'technology')
                                <i class="fas fa-desktop"></i>
                            @elseif($cat->slug == 'sports')
                                <i class="fas fa-futbol"></i>
                            @elseif($cat->slug == 'health')
                                <i class="fas fa-heartbeat"></i>
                            @elseif($cat->slug == 'science')
                                <i class="fas fa-flask"></i>
                            @elseif($cat->slug == 'usnews')
                                <i class="fas fa-newspaper"></i>
                            @elseif($cat->slug == 'entertainment')
                                <i class="fas fa-film"></i>
                            @elseif($cat->slug == 'politics')
                                <i class="fas fa-box-ballot"></i>
                            @elseif($cat->slug == 'travel')
                                <i class="fas fa-suitcase"></i>
                            @endif    
                            {{$cat->name}}
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- /.topGeners_nav -->
          </div>
          <div class="extension-logo"><a href="{{ url('/news') }}"><img src="{{asset('images/news-logo.png')}}" alt=""></a></div>
        </nav>
	</header>
