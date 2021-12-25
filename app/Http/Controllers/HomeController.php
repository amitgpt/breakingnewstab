<?php

namespace BreakingNEWSTab\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use DB;
use BreakingNEWSTab\Newsdata;
Use BreakingNEWSTab\Categories;
Use BreakingNEWSTab\Channels;
use BreakingNEWSTab\Rssfeedlinks;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request) {
        $cat = isset($_GET['cat']) ? $_GET['cat'] : '';
        $newsData = $allNewsData = $rendomNews = array();
        if (!empty($cat)) {
            $cat_name = Categories::where('slug',$cat)->first();

            if(empty($cat_name)){
                return response()->view('errors.' . '404', [], 404);
            }

            // $rendomNews = $checkExists = DB::table('newsdata')            
            // ->join('rss_feed_links', 'rss_feed_links.id', '=', 'newsdata.rss_feed_id')
            // ->join('categories', 'categories.id', '=', 'rss_feed_links.categories_id')
            // ->join('channels', 'channels.id', '=', 'rss_feed_links.channels_id')
            // ->where('categories.slug' ,'=' , $cat)->select('newsdata.*','channels.channel_name')            
            // ->orderBy("pubdate","DESC")->inRandomOrder()->take(3)
            // ->get();
            

            // $rendomNedsId = [];
            // if(!empty($checkExists)){
            //     $checkExists = $checkExists;                
            //     foreach ($checkExists as $checkExists) {                    
            //         $rendomNedsId[] = $checkExists->id;
            //     }
            // }

            $newsData = DB::table('newsdata')            
            ->join('rss_feed_links', 'rss_feed_links.id', '=', 'newsdata.rss_feed_id')
            ->join('categories', 'categories.id', '=', 'rss_feed_links.categories_id')
            ->join('channels', 'channels.id', '=', 'rss_feed_links.channels_id')
            ->where('categories.slug' ,'=' , $cat)
            //->whereNotIn('newsdata.id', $rendomNedsId)
            ->select('newsdata.*','channels.channel_name','categories.name') 
            ->where('rss_feed_links.status' ,'=' , 1)->where('rss_feed_links.is_featured', '=',0 )           
            ->orderBy("pubdate","DESC")->paginate(4);
            
            if ($request->ajax()) {
    		return view("catnewsloadmore",["allNewsData"=>$newsData]);
            }
            
            
            
            $view = view("catnews", ["rendomNews"=>$rendomNews, "allNewsData"=>$newsData, 'cat_name'=> $cat_name->name])->withTitle(' | ' . $cat);
        } else {
           
            // $rendomNews = $checkExists = DB::table('newsdata')            
            // ->join('rss_feed_links', 'rss_feed_links.id', '=', 'newsdata.rss_feed_id')
            // ->join('channels', 'channels.id', '=', 'rss_feed_links.channels_id')
            // ->select('newsdata.*','channels.channel_name')
            // ->where('rss_feed_links.status' ,'=' , 1)->where('rss_feed_links.is_featured', '=',0 )
            // ->orderBy("pubdate","DESC")->take(6)->get();

            //->orderBy(DB::raw("DATE_FORMAT(`pubdate`,'%Y%m%d %h%i%s')"), 'DESC')->take(6)->get();
            
            // $rendomNedsId = [];
            // if(!empty($checkExists)){
            //     $checkExists = $checkExists;                
            //     foreach ($checkExists as $checkExists) {                    
            //         $rendomNedsId[] = $checkExists->id;
            //     }
            // }

            $categories = Categories::get();
            if(!empty($categories)){
                foreach($categories as $cat){
                    
                    
                    $newsData = DB::table('newsdata')            
                    ->join('rss_feed_links', 'rss_feed_links.id', '=', 'newsdata.rss_feed_id')
                    ->join('categories', 'categories.id', '=', 'rss_feed_links.categories_id')
                    ->join('channels', 'channels.id', '=', 'rss_feed_links.channels_id')
                    ->where('categories.slug' ,'=' , $cat->slug)
                    //->whereNotIn('newsdata.id', $rendomNedsId)
                    ->select('newsdata.*','channels.channel_name','categories.name','categories.slug')            
                    ->where('rss_feed_links.status' ,'=' , 1)->where('rss_feed_links.is_featured', '=',0 )
                    ->orderBy("pubdate","DESC")->paginate(4);
                    
                    if(!empty($newsData) && $newsData->total() > 0){
                        $allNewsData[$cat->name] = $newsData;
                    }
                    
                }
            }
            
            $view = view("home", ["rendomNews"=>$rendomNews,"allNewsData"=>$allNewsData, 'cat_name'=>'']);
        }
        
       
        return $view; 
    }
    
    
    // Fetch More Data
    public function loadmoredata(Request $request){
        if($request->ajax()){
            
            //$skip=$request->skip;
            
            // $rendomNews = $checkExists = DB::table('newsdata')            
            // ->join('rss_feed_links', 'rss_feed_links.id', '=', 'newsdata.rss_feed_id')
            // ->join('channels', 'channels.id', '=', 'rss_feed_links.channels_id')
            // ->select('newsdata.*','channels.channel_name' )
            // ->where('rss_feed_links.status' ,'=' , 1)->where('rss_feed_links.is_featured', '=',0 )            
            // ->orderBy("pubdate","DESC")->take(6)->get();

            // $rendomNedsId = [];
            // if(!empty($checkExists)){
            //     $checkExists = $checkExists;                
            //     foreach ($checkExists as $checkExists) {                    
            //         $rendomNedsId[] = $checkExists->id;
            //     }
            // }
            
            $allNewsData = DB::table('newsdata')            
                    ->join('rss_feed_links', 'rss_feed_links.id', '=', 'newsdata.rss_feed_id')
                    ->join('categories', 'categories.id', '=', 'rss_feed_links.categories_id')
                    ->join('channels', 'channels.id', '=', 'rss_feed_links.channels_id')
                    ->where('categories.slug' ,'=' , $request->cat)
                    //->whereNotIn('newsdata.id', $rendomNedsId)
                    ->where('rss_feed_links.status' ,'=' , 1)->where('rss_feed_links.is_featured', '=',0 )
                    ->select('newsdata.*','channels.channel_name','categories.name','categories.slug')            
                    ->orderBy("pubdate","DESC")->paginate(4);
            
            $view = view('catnewsloadmore',compact('allNewsData'))->render();
            
            return response()->json(['html'=>$view]);
            
        }else{
            return response()->json('Direct Access Not Allowed!!');
        }
    }
    
    
    
    // Fetch Manage Sources
    public function managesources($channel = null){
        $rendomNews = $channelNewsData = $rendomNews = [];
       if(!empty($channel)){
           
        //    $rendomNews = $checkExists = DB::table('newsdata')            
        //     ->join('rss_feed_links', 'rss_feed_links.id', '=', 'newsdata.rss_feed_id')
        //     ->join('channels', 'channels.id', '=', 'rss_feed_links.channels_id')
        //     ->where('channels.channel_name' ,'=' , $channel)
        //     ->where('rss_feed_links.status' ,'=' , 1)->where('rss_feed_links.is_featured', '=',0 )
        //     ->select('newsdata.*','channels.channel_name' )            
        //     ->orderBy("pubdate","DESC")->inRandomOrder()->take(3)
        //     ->get();
           
        //    $rendomNedsId = [];
        //     if(!empty($checkExists)){
        //         $checkExists = $checkExists;                
        //         foreach ($checkExists as $checkExists) {                    
        //             $rendomNedsId[] = $checkExists->id;
        //         }
        //     }
            
           $channelNewsData = $checkExists = DB::table('newsdata')            
            ->join('rss_feed_links', 'rss_feed_links.id', '=', 'newsdata.rss_feed_id')
            ->join('channels', 'channels.id', '=', 'rss_feed_links.channels_id')
            ->where('channels.channel_name' ,'=' , $channel)
            //->whereNotIn('newsdata.id', $rendomNedsId)->select('newsdata.*','channels.channel_name' )            
            ->where('rss_feed_links.status' ,'=' , 1)->where('rss_feed_links.is_featured', '=',0 )
            ->orderBy("pubdate","DESC")
            ->get();
           
           
       }
       
       return $view = view("managesources", ["rendomNews"=>$rendomNews,"allNewsData"=>$channelNewsData, "channel"=>$channel]);
        
    }

    public function covid(Request $request){        
        
        $newsData = DB::table('newsdata')            
            ->join('rss_feed_links', 'rss_feed_links.id', '=', 'newsdata.rss_feed_id')
            ->join('categories', 'categories.id', '=', 'rss_feed_links.categories_id')
            ->join('channels', 'channels.id', '=', 'rss_feed_links.channels_id')
            ->where('newsdata.title', 'LIKE', "%covid%")
            ->where('newsdata.title', 'LIKE', "%coronavirus%")
            ->select('newsdata.*','channels.channel_name','categories.name') 
            ->where('rss_feed_links.status' ,'=' , 1)->where('rss_feed_links.is_featured', '=',0 )           
            ->orderBy("pubdate","DESC")->paginate(8);
            
            if ($request->ajax()) {
    		    return view("catnewsloadmore",["allNewsData"=>$newsData]);
            }

            return $view = view("tabpage", ["allNewsData"=>$newsData, 'cat_name'=> "Covid-19"])->withTitle(' | covid-19');



    }
}
