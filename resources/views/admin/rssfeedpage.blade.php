
                
                <table class="table table-bordered" id="RssfeedlinksTable" width="100%" cellspacing="0">
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
                          <td><input id="toggle-status" data-id="{{$rssfeed->id}}" class="toggle-class" datacheck="status" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="DeActive" {{ $rssfeed->status ? 'checked' : '' }}></td>
                          <td><input data-id="{{$rssfeed->id}}" class="toggle-class" datacheck="is_featured" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Featured" data-off="Not featured" {{ $rssfeed->is_featured ? 'checked' : '' }}></td>
                          <td>
                          <!-- <a class="btn btn-xs btn-info" href="{{ url('/admin/rssfeeds/edit', $rssfeed->id) }}">
                          <i class="fas fa-edit"></i>
                          </a> -->
                           
                          <form action="{{ url('/admin/rssfeeds/delete', $rssfeed->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are yoy sure to delete this rss feed?') }}');" style="display: inline-block;">
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">                              
                              <button type="submit" class="btn btn-xs btn-danger">
                                <i class="fas fa-trash"></i>
                              </button>
                          </form>
                          </td>
                        </tr>
                    @endforeach
                    
                  </tbody>
                </table>
                <div class="pull-right">
                {{ $allRssfeedlinks->links() }}
                </div>
                
                
              