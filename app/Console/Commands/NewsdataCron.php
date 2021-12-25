<?php

namespace BreakingNEWSTab\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use BreakingNEWSTab\Rssfeedlinks;
use BreakingNEWSTab\Newsdata;
use Carbon\Carbon;
use DB;

class NewsdataCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'NewsdataCron:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {

        $allRssfeedlinks = Rssfeedlinks::all();
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
                    
                    $response=preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $response);
                    
                    try{                        
                        $response = str_replace("media:content","media", $response);
                        $response = str_replace("media:thumbnail","media", $response);
                        $response = str_replace("<rss","<xml", $response);
                        $response = str_replace("</rss>","</xml>", $response);
                        $xmlobj = simplexml_load_string($response);
                        
                    
                    $notImage = [];
                    $totalmsn = 0;
                    foreach ($xmlobj->channel->item as $it) {

                        if (!array_key_exists("pubDate",$it)){ 
                            $title = str_replace("'", "", $it->title);
                            $haveNewsData = Newsdata::where('title', $title)->where('publishdate', $todayDate)->first();
                            if (empty($haveNewsData) && $totalmsn < 20) {
                                $this->saveNothavePublishDate($it, $allRssfeedlinks, $URL);
                                $totalmsn++;
                            }
                        }else{
                        
                            $pubDate = date("Y-m-d", strtotime($it->pubDate));

                            if ($todayDate == Carbon::createFromFormat('Y-m-d', $pubDate)->format('Y-m-d')) {
                                $title = str_replace("'", "", $it->title);
                                $haveNewsData = Newsdata::where('title', $title)->where('publishdate', $pubDate)->first();

                                if (empty($haveNewsData)) {  
                                    try { 
                                        $defaultImage = "";
                                        if(file_exists(public_path().'/images/News_Aggregator.png')){
                                            $defaultImage =  '/images/News_Aggregator.png'; 
                                        }
                                        
                                        $imageIndex = ((isset($it->media)) && count($it->media) > 1) ? count($it->media) - 1: 0;
                                        $imageIndex = ((isset($it->enclosure)) && count($it->enclosure) > 1 && $imageIndex == 0) ? count($it->enclosure) - 1: $imageIndex;
                                        
                                        $imageUrl = (isset($it->media[$imageIndex]['url']) && $it->media[$imageIndex]['url'] != '') ? $it->media[$imageIndex]['url'] : $defaultImage;
                                        $imageUrl = (isset($it->enclosure[$imageIndex]['url']) && $it->enclosure[$imageIndex]['url'] != '') ? $it->enclosure[$imageIndex]['url'] : $imageUrl;
                                        
                                        $parser = xml_parser_create();
                                        xml_parse_into_struct($parser, (string)$it->description, $values);
                                        foreach ($values as $key => $val) {
                                            if ($val['tag'] == 'IMG' && $imageUrl == "/images/News_Aggregator.png") {
                                            $imageUrl = $val['attributes']['SRC'];
                                            }
                                        }
                                        //\Log::info( "started");
                                        $imageUrl = trim(preg_replace ('/https|http/','https',$imageUrl,1),'/');
                                        //\Log::info( "image url replase :". $imageUrl);
                                        
                                        if(isset($imageUrl) && trim($imageUrl) != '' && isset($it->title) && $it->title != ''){
                                            $newsData = new Newsdata;
                                            $newsData->title = (string) $title;
                                            $newsData->link = (string) $it->link;
                                            $newsData->is_permalink = (string) $it->guid;
                                            $newsData->description = (string) $it->description;
                                            $newsData->creator = (string) $title;
                                            $newsData->pubdate = date("Y-m-d H:i:s", strtotime($it->pubDate));
                                            $newsData->publishdate = date("Y-m-d", strtotime($pubDate));
                                            $newsData->imageurl = isset($imageUrl) ? $imageUrl : '';
                                            $newsData->source_url = $allRssfeedlinks->rsslinks;
                                            $newsData->rss_feed_id = $allRssfeedlinks->id;
                                            $newsData->save();
                                        }else{
                                            if(empty($notImage)){
                                                $notImage[] = $URL;
                                                \Log::info( "Url image :". $URL . "<br />");
                                            }else if(!empty($notImage) && !in_array($URL, $notImage)){
                                                $notImage[] = $URL;                                            
                                                \Log::info( "Url image :". $URL . "<br />");
                                                
                                            }
                                            
                                        }
                                    }catch (\Exception $e) {
                                        \Log::info("Cron is not working <br />  URL :".  $e->getMessage() );
                                    }
                                    
                                }
                            }
                        }
                    }  \Log::info("Cron is working fine! <br />  URL :".  $URL );
                    } catch (\Exception $e) {
                       \Log::info( "Url :". $URL . "<br />". $e->getMessage());
                        
                    }
                }
                
               $checkNewsData = Newsdata::where('rss_feed_id', $allRssfeedlinks->id)->whereDate('publishdate', '=', Carbon::today()->toDateString())->get();

                if (!empty($checkNewsData)) { 
                    Newsdata::where('rss_feed_id', $allRssfeedlinks->id)->whereDate('publishdate', '<', Carbon::today()->toDateString())->delete();
                }
                
                
            });
            
           
        }



        $this->info('Newsdata:Cron Cummand Run successfully!');
    }


    public function saveNothavePublishDate($it,$allRssfeedlinks,$URL){
        
        
        try {
            $title = str_replace("'", "", $it->title);
            $defaultImage = "";
            if (file_exists(public_path() . '/images/News_Aggregator.png')) {
                $defaultImage = '/images/News_Aggregator.png';
            }
            $imageIndex = ((isset($it->media)) && count($it->media) > 1) ? count($it->media) - 1: 0;
                $imageIndex = ((isset($it->enclosure)) && count($it->enclosure) > 1 && $imageIndex == 0) ? count($it->enclosure) - 1: $imageIndex;
                
            $imageUrl = (isset($it->media[$imageIndex]['url']) && $it->media[$imageIndex]['url'] != '') ? $it->media[$imageIndex]['url'] : $defaultImage;
                $imageUrl = (isset($it->enclosure[$imageIndex]['url']) && $it->enclosure[$imageIndex]['url'] != '') ? $it->enclosure[$imageIndex]['url'] : $imageUrl;

            $parser = xml_parser_create();
            xml_parse_into_struct($parser, (string) $it->description, $values);
            foreach ($values as $key => $val) {
                if ($val['tag'] == 'IMG' && $imageUrl == "/images/News_Aggregator.png") {
                    $imageUrl = $val['attributes']['SRC'];
                }
            }
            
            $imageUrl = rtrim(preg_replace ('/https|http/','https',$imageUrl,1),'/');
            $imageUrl = str_replace ('?h=100&w=100','?h=400&w=400',$imageUrl);
            //\Log::info( "image url replase :". $imageUrl . "<br />");
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
            \Log::info("Cron is not working <br />  URL :".  $e->getMessage() );
        }
        //Log::info( "Url :". $URL . "<br />");
    
        return;
}

}
