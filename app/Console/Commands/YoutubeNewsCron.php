<?php

namespace BreakingNEWSTab\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use BreakingNEWSTab\YoutubeChannels;
use BreakingNEWSTab\YouTubeNewsData;
use Carbon\Carbon;

class YoutubeNewsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'YoutubeNews:cron';

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
    public function handle()
    {
        
        $allYouTubeChannels = YoutubeChannels::get();

        $allYouTubeChannels->each(function($allYouTubeChannels) {

            $todayDate = Carbon::now()->format('Y-m-d');

            $URL = "https://www.youtube.com/feeds/videos.xml?channel_id=" . $allYouTubeChannels->yt_channel_id;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $URL);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
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
            
            $haveYTNewsData = YouTubeNewsData::where('ytub_channel_id', $allYouTubeChannels->yt_channel_id)->whereDate('created_at', '=', Carbon::today()->toDateString())->first();
            if (!empty($haveYTNewsData)) {
                YouTubeNewsData::where('ytub_channel_id', $allYouTubeChannels->yt_channel_id)->whereDate('created_at', '<', Carbon::today()->toDateString())->delete();
            }
            
        });
        
        $this->info('YoutubeNews:Cron Cummand Run successfully!');
        
    }
}
