
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>                
 <!--load all styles -->	
 <script defer src="{{asset('js/all.js')}}"></script>
<script defer src="{{asset('js/watch.js')}}"></script>

 
<script>
   

   // Hide/show animation hamburger function
   $('.navbar-toggler').on('click', function () {
     // Take this line to first hamburger animations
     $('.animated-icon1').toggleClass('open');
   });

    var main_site="{{ url('/') }}";

     

     $(document).ready(function () {


        $(".g-search").submit(function(e) {
            e.preventDefault();
            //get the action-url of the form
            var actionurl = e.currentTarget.action;
            ("actionurl: "+actionurl+'?'+$(this).serialize());
            window.parent.location.href= actionurl+'?'+$(this).serialize();
        });

        $("#load_all_button").on('click', function(e){
            $.ajax({
             type: 'GET',
             dataType:'json',
             url: '{{url("/news/loadalldata")}}',              
             beforeSend: function(){
                 $('.ajax-load').show();
             },
             success: function (data) {                 
                 if(data.html == " "){                    
                     $('.ajax-load').html("No more records found");
                     return;
                 }
                 $('.ajax-load').hide();
                 $("#all-news-data").html(data.html);
                 $("#load_all_button").hide();
                 $("#load_more_button").hide();
             }
             });
        });

        $("#load_more_button").on('click',function(e){   
                     
            var page = $(this).attr('page-no');
            var _totalResult = $(this).attr("data-totalResult");
            var _totalCurrentResult = 4 * page;
            
            if( _totalCurrentResult >= _totalResult){ 
                $("#load_more_button").hide();
            }
            page++;
            $(this).attr('page-no',page);              
            $.ajax({
            type: 'GET',
            dataType:'json',
            url: '{{url("/news/loadmoredata")}}'+'?page=' + page,              
            beforeSend: function(){
                $('.ajax-load').show();
            },
            success: function (data) {                 
                if(data.html == " "){                    
                    $('.ajax-load').html("No more records found");
                    return;
                }
                $('.ajax-load').hide();
                $("#more-news-data").append(data.html);
                $("#load_more_button").hide();
            }
            });
        });
 
        $(".cat-click").on('click', function(e){
            var caturl = $(this).attr('data-link');
            $(".cat-click").removeClass("active-cat");
            $(".cat-click").each(function(){
                if($(this).attr('data-link') == caturl){
                    $(this).addClass("active-cat");
                }
            });
            
            $.ajax({
             type: 'GET',
             dataType:'json',
             url: caturl,              
             beforeSend: function(){
                 $('.ajax-load').show();
             },
             success: function (data) {                 
                 if(data.html == " "){                    
                     $('.ajax-load').html("No more records found");
                     return;
                 }
                 
                 $('.ajax-load').hide();
                 $(".cat-all-news").html(data.html);
                 
             }
             });
        });

        $('body').delegate('#load_all_cat_button', 'click', function (e) { 
            var cat = $(this).attr('data-cat');
            $.ajax({
                type: 'GET',
                dataType:'json',
                url: '{{url("/news/loadallcatdata/")}}'+'?cat='+cat,             
                beforeSend: function(){
                    $('.ajax-load').show();
                },
                success: function (data) {                 
                    if(data.html == " "){                    
                        $('.ajax-load').html("No more records found");
                        return;
                    }
                    $('.ajax-load').hide();
                    $("#all-news-data").html(data.html);
                    $("#load_all_cat_button").hide();
                    $("#load_more_cat_button").hide();
                }
             });

        });
        $('body').delegate('#load_more_cat_button', 'click', function (e) { 
                    
            var page = $(this).attr('page-no');
            var cat = $(this).attr('data-cat');
            var _totalResult = $(this).attr("data-totalResult");
            var _totalCurrentResult = 4 * page;
            
            if( _totalCurrentResult >= _totalResult){ 
                $("#load_more_cat_button").hide();
            }
            page++;
            $(this).attr('page-no',page);              
            $.ajax({
            type: 'GET',
            //dataType:'json',
            url: '{{url("/news/")}}'+'?cat='+cat+'&page=' + page,              
            beforeSend: function(){
                $('.ajax-load').show();
            },
            success: function (data) {                   
                if(data == " "){                    
                    $('.ajax-load').html("No more records found");
                    return;
                }
                $('.ajax-load').hide();
                $("#more-news-data").append(data.html);
            }
            });
        });
 
     });
</script>

