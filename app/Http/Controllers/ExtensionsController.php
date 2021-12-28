<?php

namespace BreakingNEWSTab\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use DB;
use BreakingNEWSTab\Newsdata;
Use BreakingNEWSTab\Categories;
Use BreakingNEWSTab\Channels;
use BreakingNEWSTab\Rssfeedlinks;
use Carbon\Carbon;

class ExtensionsController extends Controller
{
    public function index(Request $request) {
        $cat = isset($_GET['cat']) ? $_GET['cat'] : '';
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        $newsData = $allNewsData = array();
        if (!empty($cat)) { 
            $cat_name = Categories::where('slug',$cat)->first();

            if(empty($cat_name)){
                return response()->view('errors.' . '404', [], 404);
            }

            $newsData = DB::table('newsdata')            
            ->join('rss_feed_links', 'rss_feed_links.id', '=', 'newsdata.rss_feed_id')
            ->join('categories', 'categories.id', '=', 'rss_feed_links.categories_id')
            ->join('channels', 'channels.id', '=', 'rss_feed_links.channels_id')
            ->where('categories.slug' ,'=' , $cat)
            ->select('newsdata.*','channels.channel_name','categories.name')            
            ->orderBy("pubdate","DESC")->paginate(4);
            
            if ($request->ajax()) {
                if(!empty($page))
                $view = view("chromeextention/loadmorenews",["allNewsData"=>$newsData, 'cat_name'=> $cat_name->slug])->render();
                else
    		     $view = view("chromeextention/catnews",["allNewsData"=>$newsData, 'cat_name'=> $cat_name->slug])->render();
        
            }else{
               return $view = view("chromeextention/loadmorenews", ["allNewsData"=>$newsData, 'cat_name'=> $cat_name->name])->withTitle(' | ' . $cat)->render();
            }
            return response()->json(['html'=>$view]);
            
            
        } else {
           
            $allNewsData = $checkExists = DB::table('newsdata')            
            ->join('rss_feed_links', 'rss_feed_links.id', '=', 'newsdata.rss_feed_id')
            ->join('channels', 'channels.id', '=', 'rss_feed_links.channels_id')
            ->select('newsdata.*','channels.channel_name')
            ->orderBy("pubdate","DESC")->paginate(4);

            $view = view("chromeextention/index", ["allNewsData"=>$allNewsData]);
        }
        return $view;
        
    }

    // Fetch All Data By category
    public function loadallcatdata(Request $request){
        if($request->ajax()){
            $cat = isset($_GET['cat']) ? $_GET['cat'] : '';

            $cat_name = Categories::where('slug',$cat)->first();

            $newsData = DB::table('newsdata')            
            ->join('rss_feed_links', 'rss_feed_links.id', '=', 'newsdata.rss_feed_id')
            ->join('categories', 'categories.id', '=', 'rss_feed_links.categories_id')
            ->join('channels', 'channels.id', '=', 'rss_feed_links.channels_id')
            ->where('categories.slug' ,'=' , $cat)
            ->select('newsdata.*','channels.channel_name','categories.name')            
            ->orderBy("pubdate","DESC")->get();
            
            $view = view("chromeextention/loadmorenews", ["allNewsData"=>$newsData, 'cat_name'=> $cat_name->name])->withTitle(' | ' . $cat)->render();
            
            return response()->json(['html'=>$view]);
            
        }else{
            return response()->json('Direct Access Not Allowed!!');
        }
    }

    // Fetch All Data
    public function loadalldata(Request $request){
        if($request->ajax()){
            $allNewsData = $checkExists = DB::table('newsdata')            
            ->join('rss_feed_links', 'rss_feed_links.id', '=', 'newsdata.rss_feed_id')
            ->join('channels', 'channels.id', '=', 'rss_feed_links.channels_id')
            ->select('newsdata.*','channels.channel_name')
            ->orderBy("pubdate","DESC")->get();

            $view = view('chromeextention/loadmorenews',compact('allNewsData'))->render();
            
            return response()->json(['html'=>$view]);
            
        }else{
            return response()->json('Direct Access Not Allowed!!');
        }
    }

    // Fetch More Data
    public function loadmoredata(Request $request){
        if($request->ajax()){
            $allNewsData = $checkExists = DB::table('newsdata')            
            ->join('rss_feed_links', 'rss_feed_links.id', '=', 'newsdata.rss_feed_id')
            ->join('channels', 'channels.id', '=', 'rss_feed_links.channels_id')
            ->select('newsdata.*','channels.channel_name')
            ->orderBy("pubdate","DESC")->paginate(4);

            $view = view('chromeextention/loadmorenews',compact('allNewsData'))->render();
            
            return response()->json(['html'=>$view]);
            
        }else{
            return response()->json('Direct Access Not Allowed!!');
        }
    }
}
