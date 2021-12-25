<?php

use Illuminate\Database\Seeder;
use App\YoutubeChannels;

class YoutubeChannelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $youtubeRssfeedlinks = array(
                "ABC News" => "UCBi2mrWuNuyYy4gbM6fU18Q",
                "Access"   => "UCiKGMZZmZXK-RpbKJGXgH3Q",
                "AFP News Agency" =>"UC86dbj-lbDks_hZ5gRKL49Q",
                "Associated Press" => "UC52X5wxOL_s5yw0dQk7NtgA",
                "CBS Miami" => "UCXJryYh6xcW5iEeJGzK191A",                
                "CBS News"  => "UC8p1vwvWtl6T73JiExfWs1g",
                "CBS Sports" => "UCja8sZ2T4ylIqjggA1Zuukg",
                "CNN" => "UCupvZG-5ko_eiXAupbDfxWw",
                "Clevver News" => "UCQjh-JVPNWfY-KsZS3RgRHw",
                "DW News" =>    "UCknLrEdhRCp1aegoMqRaCZg",
                "Entertainment Tonight" =>"UCdtXPiqI2cLorKaPrfpKc4g",
                "eNCA" => "UCI3RT5PGmdi1KVp9FG_CneA",
                "E! News" => "UCjDsbbzHgTrGc4Ff26TJtsA",                
                "Fox News" => "UCXIJgqnII2ZOINSWNOGFThA",
                "Fort Worth Star-Telegram" => "UCs4TGanvFtdeg4E4Muggm9g",
                "GamingBolt" => "UCXa_bzvv7Oo1glaW9FldDhQ",
                "HollywoodLife" => "UC2rJLq19N0dGrxfib80M_fg",
                "HuffPost" => "UCZfsrIV68Oegr5bJgAMLBDA",
                "IGN" => "UCKy1dAqELo0zrOtPkf0eTMw",
                "INQUIRER.net" => "UCvRAX-ujvZ0eTMLGG2vki9w",
                "KMBC 9" => "UCWTkpYvniGIUe1jeCncFzKw",
                "KPIX CBS SF Bay Area" => "UCF4LEacx9sDvAbEJnlaJfKQ",
                "Newsy" => "UCTln5ss6h6L_xNfMeujfPbg",
                "PennLive.com" =>"UC5yvng1eSgffmybUM-51fTw",
                "RT America" => "UCczrL-2b-gYK3l4yDld4XlQ",
                "SABC Digital News" => "UC8yH-uI81UUtEMDsowQyx1g",
                "The Oklahoman" => "UC3yh5vp9HPyUPzDWy46K0sA",
                "The Star Online" => "UCpWvshQVx1d7BqCsPnVuNIw",
                "The Telegraph" => "UCPgLNge0xqQHWM5B5EFH9Cg",
                "VOA News" => "UCVSNOxehfALut52NbkfRBaA",
                "WPRI" => "UCnwI-VN5jXWIGQKOI9PMDMw",
                "WWLP-22News" => "UCGbEXjkmPTCQfJ4FiD3lOQg",
                "Wochit Business" =>"UCAj4AIMZcqxjVbV-zWD9jtA",
        );
        
        if (!empty($youtubeRssfeedlinks)) {
            foreach ($youtubeRssfeedlinks as $channelName => $channel_id) {
                YoutubeChannels::create([                                
                                'yt_channel_name' => $channelName,
                                'yt_channel_id' => $channel_id
                            ]);
            }
        }
    }
}
