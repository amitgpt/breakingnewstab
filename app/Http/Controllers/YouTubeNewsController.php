<?php

namespace BreakingNEWSTab\Http\Controllers;

use Illuminate\Http\Request;
use BreakingNEWSTab\YoutubeChannels;
use BreakingNEWSTab\YouTubeNewsData;
use Illuminate\Database\Eloquent\Builder;
use DB;

class YouTubeNewsController extends Controller
{
    public function index() {
        $moreRelatedNews = $moreRelatedNewsId = [];

        $youTubeNews = YouTubeNewsData::orderBy("pubdate", "DESC")->first();
        if (!empty($youTubeNews)) {
            $title = str_replace("'", "", $youTubeNews->title);
            $moreRelatedNews = $checkExists = DB::table('youtubenews')
                    ->whereRaw("MATCH (title) AGAINST ('$title' IN NATURAL LANGUAGE MODE)")
                    ->orderBy("pubdate", "DESC")
                    ->get();
            if (!empty($moreRelatedNews)) {
                foreach ($moreRelatedNews as $relatedNews) {
                    $moreRelatedNewsId[] = $relatedNews->id;
                }
            }
        }

        $allYouTubeNews = YouTubeNewsData::whereNotIn('id', $moreRelatedNewsId)->orderBy("pubdate", "DESC")->get();

        return $view = view('wtachnews', ['youTubeNews' => $youTubeNews, 'moreRelatedNews' => $moreRelatedNews, 'allYouTubeNews' => $allYouTubeNews])->render();
        
        
    }

    public function ajaxRequestPost(Request $request) {
        $input = $request->all();
        if (isset($input['id']) && $input['id'] != '') {
            $id = $input['id'];
            $moreRelatedNews =  [];

            $youTubeNews = YouTubeNewsData::where('id',$id)->first();
            if (!empty($youTubeNews)) {
                $title = str_replace("'", "", $youTubeNews->title);
                $moreRelatedNews = $checkExists = DB::table('youtubenews')
                        ->whereRaw("MATCH (title) AGAINST ('$title' IN NATURAL LANGUAGE MODE)")
                        ->orderBy("pubdate", "DESC")
                        ->get();
                
            }
        }
        
        return view('videowindow', ['youTubeNews' => $youTubeNews, 'moreRelatedNews' => $moreRelatedNews]);
        
        
    }
}
