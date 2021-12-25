
@extends('layouts.mainadminlayout')
@section('content')
        <!-- Begin Page Content -->
        

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Rss Feeds</h1>
          </div>

          

            
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div> -->
            <div class="card-body">
                @if(\Session::has('success'))
                    <div class="alert alert-success">
                        {{\Session::get('success')}}
                    </div>
                @endif
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Categorie</th>
                      <th>Channel</th>
                      <th>Rsslink</th>
                      <th>Status</th>
                      <th>Is Featured</th>
                      <th>Action</th>                      
                    </tr>
                  </thead>
                  
                  <tbody>
                  
                    @foreach ($allRssfeedlinks as $rssfeed)
                        <tr>
                          <td>{{$rssfeed->name}}</td>
                          <td>{{$rssfeed->channel_name}}</td>
                          <td>{{$rssfeed->rsslinks}}</td> 
                          <td>{{ $rssfeed->status ? 'Active' : 'In Active' }}</td>                          
                          <td>
                          <label class="switch">
                            <input class="toggle-class" data-id="{{$rssfeed->id}}" datacheck="is_featured" type="checkbox" {{ $rssfeed->is_featured ? "checked" : "" }}>
                            <span class="slider round"></span>
                          </label>
                          
                          
                          <!-- <input data-id="{{$rssfeed->id}}" class="toggle-class" datacheck="is_featured" type="checkbox" data-toggle="toggle" data-style="ios" data-onstyle="info" {{ $rssfeed->is_featured ? "checked" : "" }} ></td>                        -->
                          <!-- <td><input id="toggle-status" data-id="{{$rssfeed->id}}" class="toggle-class" datacheck="status" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="DeActive" {{ $rssfeed->status ? 'checked' : '' }}></td>
                          <td><input data-id="{{$rssfeed->id}}" class="toggle-class" datacheck="is_featured" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Featured" data-off="Not featured" {{ $rssfeed->is_featured ? 'checked' : '' }}></td> -->
                          <td>
                          <a class="btn-edit" href="{{ url('/admin/rssfeeds/edit', $rssfeed->id) }}">
                          <i class="fas fa-edit"></i>
                          </a> 
                           
                          <form action="{{ url('/admin/rssfeeds/delete', $rssfeed->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are yoy sure to delete this rss feed?') }}');" style="display: inline-block;">
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">                              
                              <button type="submit" class="btn btn-xs btn-remove">
                                <i class="fas fa-trash"></i>
                              </button>
                          </form>
                          </td>
                        </tr>
                    @endforeach
                    
                  </tbody>
                </table>
                </div>
                
            </div>
         

          
        </div>
        <!-- /.container-fluid -->
        <!-- <style>
          .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
          .toggle.ios .toggle-handle { border-radius: 20px; }
        </style> -->
        <script>

  $(function() {
    
    // $(window).on('hashchange', function() {

    //   if (window.location.hash) {

    //       var page = window.location.hash.replace('#', '');

    //       if (page == Number.NaN || page <= 0) {

    //           return false;

    //       }else{

    //           getData(page);

    //       }

    //   }
    // });

    // $(document).on('click', '.pagination a',function(event)

    // {
    //     event.preventDefault();
        
    //     $('li').removeClass('active');

    //     $(this).parent('li').addClass('active');

    //     var myurl = $(this).attr('href');

    //     var page=$(this).attr('href').split('page=')[1];

    //     getData(page);

    // });




    // function getData(page){

    //   $.ajax(
    //   {

    //       url: '/admin/rssfeeds/ajax-pagination?page=' + page,

    //       type: "get",

    //       dataType: 'json',

    //   }).done(function(data){

    //       $(".table-responsive").empty().html(data);

    //       //location.hash = page;

    //   }).fail(function(jqXHR, ajaxOptions, thrownError){

    //         alert('No response from server');

    //   });

    // }

    $('.toggle-class').change(function() {

        var checkvalue = $(this).prop('checked') == true ? 1 : 0; 

        var rssfeedid = $(this).data('id'); 
        var dataAttr = $(this).attr("datacheck");
        if(dataAttr == 'is_featured'){
          var paramiter = { 'is_featured' : checkvalue, 'rssfeedid': rssfeedid};
        }        
        else{
          var paramiter = { 'status' : checkvalue, 'rssfeedid': rssfeedid};
        }

        $.ajax({

            type: "GET",

            dataType: "json",

            url: '/admin/changeRssFeedStatus',

            data: paramiter,

            success: function(data){

              alert(data.success)

            }

        });

    })

  })

</script>
@stop