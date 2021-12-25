<?php

namespace BreakingNEWSTab\Http\Controllers\Admin;

use Illuminate\Http\Request;
use BreakingNEWSTab\Http\Controllers\Controller;
use Response;
use DB;
use BreakingNEWSTab\Categories;
use BreakingNEWSTab\Channels;
use BreakingNEWSTab\Rssfeedlinks;
use BreakingNEWSTab\YoutubeChannels;
use BreakingNEWSTab\Newsdata;

class RssFeedsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**

     * Responds with a welcome message with instructions

     *

     * @return \Illuminate\Http\Response

     */

    public function index(){

        $allRssfeedlinks = DB::table('rss_feed_links')            
            ->join('categories', 'categories.id', '=', 'rss_feed_links.categories_id')
            ->join('channels', 'channels.id', '=', 'rss_feed_links.channels_id')
            ->select('rss_feed_links.*','categories.name','channels.channel_name')
            ->get();
        
            if (request()->ajax()) {
                return Response::json(view('admin.rssfeedpage', array('allRssfeedlinks' => $allRssfeedlinks))->render());
            }
        
        return view('admin.rssfeeds')->with(['allRssfeedlinks'=>$allRssfeedlinks]);
    }
    

    /**

     * Responds with a welcome message with instructions

     *

     * @return \Illuminate\Http\Response

     */

    public function changeStatus(Request $request)

    {        
        if(isset($request->status)){  
            Rssfeedlinks::whereId($request->rssfeedid)->update(['status' => $request->status]);
            $msg = (isset($request->status) && $request->status == 0) ? "Activet successfully." : "Deactivet successfully." ;
        }else if(isset($request->is_featured)){
            Rssfeedlinks::whereId($request->rssfeedid)->update(['is_featured'=> $request->is_featured ]);
            $msg = (isset($request->is_featured) && $request->is_featured == 1) ? "Featured successfully." : "Not featured successfully." ;
        }

        return response()->json(['success'=> $msg]);

    }

        /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()
    {
        //$allCategories = Categories::all();
        $allCategories = Categories::pluck('name', 'id');       
        $allChannels = Channels::pluck('channel_name', 'id');
        return view('admin.rssfeed.create',compact('allCategories',$allCategories), compact('allChannels',$allChannels));

    }


 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'categories_id'=> 'required',
            'channels_id'=>'required',
            'rsslinks'=>'required'
        ]);
        $status = (!empty($request->input('status'))) ? $request->input('status') : 0;
        $isfeatured = (!empty($request->input('is_featured'))) ? $request->input('is_featured') : 0;
        Rssfeedlinks::create([
            'rsslinks' => $request->input('rsslinks'),
            'categories_id' => $request->input('categories_id'),
            'channels_id' => $request->input('channels_id'),
            'status' => $status,
            'is_featured' => $isfeatured,
        ]);

        return redirect('/admin/rssfeeds/create')->with('success', 'New rssfeed created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rssfeed = Rssfeedlinks::where('id', $id)->first();
        $allCategories = Categories::pluck('name', 'id');       
        $allChannels = Channels::pluck('channel_name', 'id');
        
        return view('admin.rssfeed.edit', compact('rssfeed', 'id','allCategories','allChannels'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'categories_id'=> 'required',
            'channels_id'=>'required',
            'rsslinks'=>'required'
        ]);  
        
        $status = (!empty($request->input('status'))) ? $request->input('status') : 0;

        Rssfeedlinks::whereId($id)->update([
                                            'rsslinks' => $request->input('rsslinks'),
                                            'categories_id' => $request->input('categories_id'),
                                            'channels_id' => $request->input('channels_id'),
                                            'status' => $status
                                            ]);

        return redirect('/admin/rssfeeds')->with('success', 'RssFeed has been updated!!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {	
		 
		Newsdata::where('rss_feed_id', $id)->delete();
        $rssfeed = Rssfeedlinks::find($id);
        $rssfeed->delete();

        return redirect('/admin/rssfeeds')->with('success', 'RssFeed has been deleted!!');
    }

}
