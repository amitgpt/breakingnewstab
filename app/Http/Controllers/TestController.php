<?php

namespace BreakingNEWSTab\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use BreakingNEWSTab\Rssfeedlinks;
use BreakingNEWSTab\Newsdata;
use BreakingNEWSTab\Categories;
use BreakingNEWSTab\Channels;
use BreakingNEWSTab\YoutubeChannels;
use BreakingNEWSTab\YouTubeNewsData;
use Carbon\Carbon;
use Log;

class TestController extends Controller
{
    public function test() {
        
        //$allRssfeedlinks = Rssfeedlinks::where('rsslinks','https://rssfeeds.usatoday.com/usatoday-TechTopStories')->get();

        $allRssfeedlinks = Rssfeedlinks::get();
        //$allRssfeedlinks = Rssfeedlinks::where('categories_id',1)->get();
        //echo '<pre>'; print_r($allRssfeedlinks);die;

        if (!empty($allRssfeedlinks)) {

            $allRssfeedlinks->each(function($allRssfeedlinks) {

                $todayDate = Carbon::now()->format('Y-m-d');

                $URL = $allRssfeedlinks->rsslinks;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $URL);
                curl_setopt($ch, CURLOPT_VERBOSE, 1);
                curl_setopt($ch, CURLOPT_ENCODING , "");
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                if (curl_errno($ch)) {
                    // moving to display page to display curl errors
                    echo curl_errno($ch);
                    echo curl_error($ch);
                } else {
                    //getting response from server
                    $response = curl_exec($ch);
                    curl_close($ch);
                   
                    try { 
                        $response=preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $response);
                        $response = str_replace("media:content", "media", $response);
                        $response = str_replace("media:thumbnail", "media", $response);
                        $response = str_replace("<rss", "<xml", $response);
                        $response = str_replace("</rss>", "</xml>", $response);

                        $xmlobj = simplexml_load_string($response);
                        // echo "<pre>"; print_r($xmlobj); die;
                        $notImage = [];
                        foreach ($xmlobj->channel->item as $it) { 
                            //echo '<pre>'; print_r($it); die;
                            if (!property_exists("pubDate",$it)){ 
                                $title = str_replace("'", "", $it->title);
                                $haveNewsData = Newsdata::where('title', $title)->where('publishdate', $todayDate)->first();
                                if (empty($haveNewsData)) {
                                    $this->saveNothavePublishDate($it, $allRssfeedlinks,$URL);
                                }
                            }else{

                                $pubDate = date("Y-m-d", strtotime($it->pubDate)); 
                            
                            if ($todayDate == Carbon::createFromFormat('Y-m-d', $pubDate)->format('Y-m-d')) {
                                $title = str_replace("'", "", $it->title);
                                $haveNewsData = Newsdata::where('title', $title)->where('publishdate', $pubDate)->first();
                                
                                if (empty($haveNewsData)) {
                                    try {
                                        $defaultImage = "";
                                        if (file_exists(public_path() . '/images/News_Aggregator.png')) {
                                            $defaultImage = '/images/News_Aggregator.png';
                                        }

                                        $imageUrl = (isset($it->media['url']) && $it->media['url'] != '') ? $it->media['url'] : $defaultImage;
                                        $imageUrl = (isset($it->enclosure['url']) && $it->enclosure['url'] != '') ? $it->enclosure['url'] : $imageUrl;

                                        $parser = xml_parser_create();
                                        xml_parse_into_struct($parser, (string) $it->description, $values);
                                        foreach ($values as $key => $val) {
                                            if ($val['tag'] == 'IMG' && $imageUrl == "/images/News_Aggregator.png") {
                                                $imageUrl = $val['attributes']['SRC'];
                                            }
                                        }
                                        
                                        $imageUrl = rtrim(preg_replace ('/https|http/','https',$imageUrl,1),'/');
                                        
                                        if (isset($imageUrl) && trim($imageUrl) != '' && isset($it->title) && $it->title != '') {
                                            $newsData = new Newsdata;
                                            $newsData->title = (string) $title;
                                            $newsData->link = (string) $it->link;
                                            $newsData->is_permalink = (string) $it->guid;
                                            $newsData->description = (string) $it->description;
                                            $newsData->creator = (string) $it->title;
                                            $newsData->pubdate = date("Y-m-d H:i:s", strtotime($it->pubDate));
                                            $newsData->publishdate = date("Y-m-d", strtotime($pubDate));
                                            $newsData->imageurl = isset($imageUrl) ? $imageUrl : '';
                                            $newsData->source_url = $allRssfeedlinks->rsslinks;
                                            $newsData->rss_feed_id = $allRssfeedlinks->id;
                                            $newsData->save();
                                        } else {
                                            if (empty($notImage)) {
                                                $notImage[] = $URL;
                                                \Log::info("Url image :" . $URL . "<br />");
                                            } else if (!empty($notImage) && !in_array($URL, $notImage)) {
                                                $notImage[] = $URL;
                                                \Log::info("Url image :" . $URL . "<br />");
                                            }
                                        }
                                    } catch (\Exception $e) {
                                        dd($e->getMessage());
                                    }
                                    //Log::info( "Url :". $URL . "<br />");
                                }
                            }

                            }

                        } \Log::info("Cron is working fine! <br />  URL :" . $URL);
                    } catch (\Exception $e) {
                        \Log::info("Url :" . $URL . "<br />" . $e->getMessage());
                    }
                }

                $checkNewsData = Newsdata::where('rss_feed_id', $allRssfeedlinks->id)->whereDate('created_at', '=', Carbon::today()->toDateString())->get();
                if (!empty($checkNewsData)) {
                    Newsdata::where('rss_feed_id', $allRssfeedlinks->id)->whereDate('created_at', '<', Carbon::today()->toDateString())->delete();
                }
            });
        }
    }

    public function youtubeRssSeed() {  
        $allYouTubeChannels = YoutubeChannels::get();

        $allYouTubeChannels->each(function($allYouTubeChannels) {

            $todayDate = Carbon::now()->format('Y-m-d');

            $URL = "https://www.youtube.com/feeds/videos.xml?channel_id=" . $allYouTubeChannels->yt_channel_id;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $URL);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt($ch, CURLOPT_ENCODING , "");
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            if (curl_errno($ch)) {
                // moving to display page to display curl errors
                echo curl_errno($ch);
                echo curl_error($ch);
            } else {
                $response = curl_exec($ch);
                curl_close($ch);

                try {
                    $response = str_replace("yt:video:", "", $response);
                    $response = str_replace('media:', '', $response);

                    $xmlobj = @simplexml_load_string($response);
                    
                    //echo '<pre>'; print_r($xmlobj); die;

                    foreach ($xmlobj->entry as $entry) {                        
                        $publishDate = $entry->published;
                        $the_date = strtotime($publishDate);
                        date_default_timezone_set("UTC");
                        $pubDate = date("Y-m-d", $the_date);
                        if ($todayDate == Carbon::createFromFormat('Y-m-d', $pubDate)->format('Y-m-d')) {
                            
                            $haveYTNewsData = YouTubeNewsData::where('title', $entry->title)->where('publishdate', $pubDate)->first();
                            
                            if (empty($haveYTNewsData)) {
                                $ytNewsData = new YouTubeNewsData;
                                $ytNewsData->title = (string) $entry->title;
                                $ytNewsData->link = (string) $entry->link['href'];
                                $ytNewsData->creator = (string) $entry->author->name;
                                $ytNewsData->pubdate = $entry->published;
                                $ytNewsData->publishdate = date("Y-m-d", strtotime($pubDate));                                
                                $ytNewsData->source_url = $URL;
                                $ytNewsData->ytub_channel_id = $allYouTubeChannels->yt_channel_id;
                                $ytNewsData->yt_video_id = (string)$entry->id;
                                $ytNewsData->imageurl = (string)$entry->group->thumbnail['url'];
                                $ytNewsData->save();
                            }
                        }
                    }
                } catch (\Exception $e) {
                    \Log::info("Url :" . $URL . "<br />" . $e->getMessage());
                }
            }
            //echo $allYouTubeChannels->yt_channel_id . " ". $pubDate;
            $haveYTNewsData = YouTubeNewsData::where('ytub_channel_id', $allYouTubeChannels->yt_channel_id)->whereDate('created_at', '=', Carbon::today()->toDateString())->first();
            
            if (!empty($haveYTNewsData)) {
                YouTubeNewsData::where('ytub_channel_id', $allYouTubeChannels->yt_channel_id)->whereDate('created_at', '<', Carbon::today()->toDateString())->delete();
            }
            
        });
    }

    public function saveNothavePublishDate($it,$allRssfeedlinks,$URL){
        
        
            try {
                $title = str_replace("'", "", $it->title);
                $defaultImage = "";
                if (file_exists(public_path() . '/images/News_Aggregator.png')) {
                    $defaultImage = '/images/News_Aggregator.png';
                }

                $imageUrl = (isset($it->media['url']) && $it->media['url'] != '') ? $it->media['url'] : $defaultImage;
                $imageUrl = (isset($it->enclosure['url']) && $it->enclosure['url'] != '') ? $it->enclosure['url'] : $imageUrl;

                $parser = xml_parser_create();
                xml_parse_into_struct($parser, (string) $it->description, $values);
                foreach ($values as $key => $val) {
                    if ($val['tag'] == 'IMG' && $imageUrl == "/images/News_Aggregator.png") {
                        $imageUrl = $val['attributes']['SRC'];
                    }
                }
                
                $imageUrl = rtrim(preg_replace ('/https|http/','https',$imageUrl,1),'/');
                
                if (isset($imageUrl) && trim($imageUrl) != '' && isset($it->title) && $it->title != '') {
                    
                    $newsData = new Newsdata;
                    $newsData->title = (string) $title;
                    $newsData->link = (string) $it->link;
                    $newsData->is_permalink = (string) $it->guid;
                    $newsData->description = (string) $it->description;
                    $newsData->creator = (string) $it->title;
                    $newsData->pubdate = date("Y-m-d H:i:s");
                    $newsData->publishdate = date("Y-m-d");
                    $newsData->imageurl = isset($imageUrl) ? $imageUrl : '';
                    $newsData->source_url = $allRssfeedlinks->rsslinks;
                    $newsData->rss_feed_id = $allRssfeedlinks->id;
                    $newsData->save();
                } else {
                    if (empty($notImage)) {
                        $notImage[] = $URL;
                        \Log::info("Url image :" . $URL . "<br />");
                    } else if (!empty($notImage) && !in_array($URL, $notImage)) {
                        $notImage[] = $URL;
                        \Log::info("Url image :" . $URL . "<br />");
                    }
                }
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
            //Log::info( "Url :". $URL . "<br />");
        
         return;
    }

}
