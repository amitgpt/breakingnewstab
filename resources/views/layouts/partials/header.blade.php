<button class="toggle-button humburger hamburger--arrow">
    <div class="hamburger-box">
        <div class="hamburger-inner"></div>
    </div>
</button>
<div class="ag-overlay"></div>


<header id="agHeader" class="ag-header">
    <nav class="ag-top-nav navbar d-flex navbar-expand-lg fixed-top navbar-dark">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-auto hdr-dvd-lft">
                  <a class="navbar-brand mr-auto mr-lg-0" href="/"><img src="{{asset('images/news-logo.png')}}"></a>
              </div>
              <div class="col hdr-dvd-rgt">
                  <div class="headersearch">
                      <form action="https://google.com/search" method="GET">
      
                          <div class="input-group mb-3">
                                      
                            <input type="text" class="google-search form-control" placeholder="Search the web" name='q'>
                            <div class="input-group-append">
                              <button class="btn btn-outline-secondary" type="submit"><img src="{{asset('images/search-icon.svg')}}"> </button>
                            </div>
                          </div>
      
                      </form>
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-12">
                
              <div class="menu-listing">
                  <div class="menu-listing--body" id="mbl-menu">
                        <div class="nav-more-btn"><a href="javascript:void(0);" class="btn clickmore">More</a></div>
                      <?php $allCategories = navigation_cat(); ?>
                      <div class="menu-listing--loop">
                          <a href="{{ url('/covid-19') }}" class="menu-listing--link {{{ (Request::segment(1) == 'covid-19') ? 'active-cat' : '' }}}"><img src="{{ (Request::segment(1) == 'covid-19') ? asset('images/virus-white.png') : asset('images/virus-grey.png') }}"> <span>Covid-19</span></a>
                          @if(!empty($allCategories))
                          @foreach($allCategories as $cat)
                          <a href="{{ url('/?cat=') }}{{$cat->slug}}" class="menu-listing--link {{{ (isset($_GET['cat']) && $_GET['cat'] == $cat->slug) ? 'active-cat' : '' }}} ">
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
                              <span>{{$cat->name}}</span>
                          </a>
                          @endforeach
                          @endif
                          <a href="javascript::void(0);" class="menu-listing--link watchytnews"><i class="fas fa-video"></i> <span>Watch News</span></a>
                      </div>
                  </div>
              </div>  

            </div>
          </div>
      </div>
    </nav>
</header>
<div class="news-loader" style="display:none">
    <div class="indeterminate"></div>
</div>
<!-- Watch News Modal -->
            <div class="modal fade video-popup" id="watchNewsModal" tabindex="-1" role="dialog" aria-labelledby="watchNewsModal" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="video-popup-container"> 
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="watch-news-modal-body">

                        </div>
                    </div>  
                  </div>
                </div>
              </div>
            </div>

