<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="{{asset('js/masonry.pkgd.min.js')}}"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<div id="fb-root"></div>


<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<script defer src="{{ asset('js/all.js') }}"></script> <!--load all styles -->	
<!-- Swiper JS -->

<script src="{{ asset('js/swiper.min.js') }}"></script>	
<script src="{{ asset('js/slideout.min.js') }}"></script>
<script>
    var slideout = new Slideout({
        'panel': document.getElementById('panel'),
        'menu': document.getElementById('mbl-menu'),
        'padding': 0,
        'tolerance': 0
    });



    // Toggle button
    document.querySelector('.toggle-button').addEventListener('click', function () {
        slideout.toggle();
    });


    $(document).ready(function () {
        // $(window).scroll(function(){
        //     if ($(this).scrollTop() > 50) {
        //        $('.ag-body-bg').addClass('fixedfilter');
        //     } else {
        //        $('.ag-body-bg').removeClass('fixedfilter');
        //     }
        // });
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });

    });

    //share news on facecook
    $(document).on('click', '.sharebtn', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var shareUrl = $(this).attr('data-share-url');
        var article_link = $(this).attr('article_link');
        var extensionUrl = encodeURIComponent(article_link);
        var finalUrl = shareUrl + extensionUrl;
        var height = 456;
        var width = 626;
        var sTop = window.innerHeight / 2 - (height / 2);
        var sLeft = window.screen.width / 2 - (width / 2);
        window.open(finalUrl, '_blank', 'toolbar=0,status=0,width=' + width + ',height=' + height + ',top=' + sTop + ',left=' + sLeft);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    //watch youtube news. 
    $(document).on('click', '.watchytnews', function (e) {
        
        e.preventDefault();

        $.ajax({
            type: 'GET',
            url: '/ajaxRequest',
            beforeSend: function()
            {
                $('.news-loader').show();
            },
            success: function (data) {                
                if(data == ""){
                    alert("No more records found");
                    $('.news-loader').hide(); 
                    return;
                }
                $('.news-loader').hide(); 
                
                $('.watch-news-modal-body').html(data);
                $('#watchNewsModal').modal({backdrop: 'static', keyboard: false})
                //$('#watchNewsModal').modal('show');
                $('#watchNewsModal').on('shown.bs.modal', function (e) {
                    $('.swiper-wrapper').slick({                        
                        dots: false,
                        arrows: true,
                        infinite: true,
                        speed: 300,
                        slidesToShow: 5,
                        slidesToScroll: 4,
                        
                        responsive: [
                            {
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 4,
                                    slidesToScroll: 3,
                                    infinite: true,
                                }
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 3,
                                    slidesToScroll: 2,
                                }
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 1,
                                }
                            },
                            {
                                breakpoint: 375,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                }
                            },
                        ],
                    });

                });
            }
        });
    });

    $(document).on('click', '.videos-article', function (e) {
        $(".videos-article").removeClass('active-video');
        $(this).addClass('active-video');
        if ($(this).attr('video_id') != '')
            $('.video-view-wrap').html('<iframe width="100%" height="400" src="https://www.youtube.com/embed/' + $(this).attr("video_id") + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
    });

    $(document).on('click', '.news-recommended-article', function (e) {
        let videonewsid = $(this).attr('videonewsid');
        $(".news-recommended-article").removeClass('playing');
        $(this).addClass("playing");
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/ajaxRequest',
            data: {id: videonewsid},
            beforeSend: function()
            {
                $('.news-loader').show();
            },
            success: function (data) {
                $('.news-loader').hide();
                $('.video-window').html(data);

            }
        });



    });



    if (window.location.href.indexOf('?') > 0 || window.location.pathname =="/covid-19") {
        var url = '@php echo url()->full(); @endphp';
        
	let page = 1;
	$(window).scroll(function() {
	    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
	        page++;
	        loadMoreData(page);
	    }
	});


	function loadMoreData(page){
            var _totalResult = $("#post-data").attr("data-totalResult");
            var _totalCurrentResult = 4 * page;
            if( _totalCurrentResult >= _totalResult){ 
                return false;
            }
	  $.ajax(
	        {
	            url: (window.location.pathname =="/covid-19") ? url+'?page=' + page : url+'&page=' + page,
	            type: "get",
	            beforeSend: function()
	            {
	                $('.ajax-load').show();
	            }
	        })
	        .done(function(data)
	        {
	            if(data == " "){
	                $('.ajax-load').html("No more records found");
	                return;
	            }
	            $('.ajax-load').hide();                    
	            $("#post-data").append(data);
	        })
	        .fail(function(jqXHR, ajaxOptions, thrownError)
	        {
	              alert('server not responding...');
	        });
	}
    }
     var main_site="{{ url('/') }}";
     
    $(document).ready(function () {
        $(".load_more_button").on('click',function(e){
            var cat = $(this).attr('data-cat');
            var page = $(this).attr('page-no');
            var _totalResult = $(this).attr("data-totalResult");
            var _totalCurrentResult = 4 * page;
            
            if( _totalCurrentResult >= _totalResult){ 
                $(".load_more_button_"+cat).hide();
            }
            page++;
            $(this).attr('page-no',page);
            $.ajax({
            type: 'POST',
            dataType:'json',
            url: '{{url("loadmoredata")}}'+'?page=' + page,
            data: {cat: cat},            
            beforeSend: function(){
                $('.ajax-load').show();
            },
            success: function (data) {
                
                if(data.html == " "){                    
                    $('.ajax-load').html("No more records found");
                    return;
                }
	        $('.ajax-load').hide(); 
                $('#news-data_'+cat).append(data.html);
            }
            });
        });
    });
    
    $(document).ready(function() {
    
        $("form").submit(function(e){        
            if($.trim($(".google-search").val()) == "") {           
                e.preventDefault(e);
                return false;
            }
        });
    });

    $(document).on('click', '.clickmore', function (e) {
        if($('.ag-top-nav').hasClass('more-categories')){
            $('.ag-top-nav').removeClass('more-categories');
            $('.clickmore').text("More");
        }else{
            $('.clickmore').text("Close");
            $('.ag-top-nav').addClass('more-categories');
        }
    });

</script>



