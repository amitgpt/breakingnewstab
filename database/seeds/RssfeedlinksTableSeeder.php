<?php

use Illuminate\Database\Seeder;
use App\Rssfeedlinks;
use App\Categories;
use App\Channels;

class RssfeedlinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rssfeedlinks = array(
            "Top News" => array(
                "CNBC" => "https://www.cnbc.com/id/100003114/device/rss/rss.html",
                "Daily Mail" => "https://www.dailymail.co.uk/news/index.rss",
                "Telegraph" => "https://www.telegraph.co.uk/rss.xml",
                "BBC" => "https://feeds.bbci.co.uk/news/rss.xml",
                "CBSNEws" => "https://www.cbsnews.com/latest/rss/main",
                "feeds Reuters" => "http://feeds.reuters.com/reuters/topNews",
                "TheStar" => 'https://thestar.com/feeds.topstories.rss',
                "Time" => "https://feeds.feedburner.com/time/topstories?format=xml",
                "CBC"   => "https://rss.cbc.ca/lineup/topstories.xml",
                "NYDailyNews" => "https://www.nydailynews.com/cmlink/NYDN.News.rss",
                "ScienceDaily" => "https://www.sciencedaily.com/rss/top.xml",
                "CNN"   => "http://rss.cnn.com/rss/cnn_topstories.rss",
                "NYPost"    => "https://nypost.com/news/feed",
                "MSN"   =>  "https://rss.msn.com/",
            ),
            "World News" => array(
                "The Wall Street Journal" => "https://feeds.a.dj.com/rss/RSSWorldNews.xml",
                "CNBC" => "https://www.cnbc.com/id/100727362/device/rss/rss.html",
                "Daily Mail" => "https://www.dailymail.co.uk/news/worldnews/index.rss",
                "Telegraph" => "https://www.telegraph.co.uk/news/rss.xml",
                "Huffpost" => "https://www.huffpost.com/section/world-news/feed",
                "NY Times" => "https://rss.nytimes.com/services/xml/rss/nyt/World.xml",
                "CBSNEws"   => "https://www.cbsnews.com/latest/rss/world",
                "feeds Reuters"=> "http://feeds.reuters.com/Reuters/worldNews",
                "TheGuardian" => "https://theguardian.com/world/rss",
                "ChicagoTribune" => "https://www.chicagotribune.com/arcio/rss/category/nation-world",
                "TheStar"   => "https://thestar.com/feeds.articles.news.world.rss",
                "USNews"    => "https://www.usnews.com/rss/news",
                "Time"  =>  "https://feeds.feedburner.com/time/world?format=xml",
                "CBC"   => "https://rss.cbc.ca/lineup/world.xml",
                "NYDailyNews" => "https://www.nydailynews.com/cmlink/NYDN.News.World.rss",
                "ScienceDaily" => "https://www.sciencedaily.com/rss/strange_offbeat/weird_world.xml",
                "LATimes"   => "https://www.latimes.com/world/rss2.0.xml",
                "SeattleTimes" => "https://www.seattletimes.com/world/feed/",
                "WashingtonPost.com" => "http://feeds.washingtonpost.com/rss/world",
            ),
            "Business" => array(
                "The Wall Street Journal" => "https://feeds.a.dj.com/rss/WSJcomUSBusiness.xml",
                "CNBC" => "https://www.cnbc.com/id/10001147/device/rss/rss.html",
                "Telegraph" => "https://www.telegraph.co.uk/business/rss.xml",
                "Huffpost" => "https://www.huffpost.com/section/business/feed",
                "BBC" => "https://feeds.bbci.co.uk/news/business/rss.xml",
                "NY Times" => "https://rss.nytimes.com/services/xml/rss/nyt/Business.xml",
                "feeds Reuters" => "http://feeds.reuters.com/reuters/businessNews",
                "TheGuardian" => "https://feeds.theguardian.com/theguardian/uk/business/rss",
                "ChicagoTribune" => "https://www.chicagotribune.com/arcio/rss/category/business",
                "TheStar" => "https://thestar.com/feeds.articles.business.rss",
                "Time" => "https://feeds.feedburner.com/time/business?format=xml",
                "CBC" => "https://rss.cbc.ca/lineup/business.xml",
                "ScienceDaily" => "https://www.sciencedaily.com/rss/strange_offbeat/business_industry.xml",
                "LATimes" => "https://www.latimes.com/business/rss2.0.xml",
                "SeattleTimes" => "https://www.seattletimes.com/business/feed/",
                "CNN" => "http://rss.cnn.com/rss/edition_business.rss",
                "WashingtonPost" => "http://feeds.washingtonpost.com/rss/business",
                "NYPost"    =>   "https://nypost.com/business/feed/",
            ),
            "Technology" => array(
                "CNBC" => "https://www.cnbc.com/id/19854910/device/rss/rss.html",
                "Telegraph" => "https://www.telegraph.co.uk/technology/rss.xml",
                "Huffpost" => "https://www.huffpost.com/section/technology/feed",
                "NY Times" => "https://rss.nytimes.com/services/xml/rss/nyt/Technology.xml",
                "BBC" => "https://feeds.bbci.co.uk/news/technology/rss.xml",
                "CBSNEws" => "https://www.cbsnews.com/latest/rss/technology",
                "feeds Reuters" => "http://feeds.reuters.com/reuters/technologyNews?format=xml",
                "TheGuardian.com" => "https://feeds.theguardian.com/theguardian/technology/rss",
                "TheStar" => "https://www.thestar.com/feeds.articles.life.technology.rss",
                "Forbes"    =>  "https://www.forbes.com/technology/feed/",
                "USAToday" => "https://rssfeeds.usatoday.com/usatoday-TechTopStories",
                "FoxNews"=> "http://feeds.foxnews.com/foxnews/tech",
                "CBC"   =>  "https://www.cbc.ca/cmlink/rss-technology",
                "TechCrunch"    =>  "https://techcrunch.com/europe/feed/",
                "ScienceDaily"  =>  "https://www.sciencedaily.com/rss/top/technology.xml",
                "NPR"   =>  "https://www.npr.org/rss/rss.php?id=1019",
                "LATimes"   =>  "https://www.latimes.com/business/technology/rss2.0.xml",
                "CNN"   =>  "http://rss.cnn.com/rss/cnn_tech.rss",
                "WashingtonPost"    =>  "http://feeds.washingtonpost.com/rss/business/technology",
                "NYPost"  =>  "https://nypost.com/tech/feed/",
            ),
            "Sports" => array(
                "Daily Mail" => "https://www.dailymail.co.uk/sport/index.rss",
                "Telegraph" => "https://www.telegraph.co.uk/sport/rss.xml",
                "Huffpost" => "https://www.huffpost.com/section/sports/feed",
                "NY Times" => "https://rss.nytimes.com/services/xml/rss/nyt/Sports.xml",
                "feeds Reuters"	=>	"http://feeds.reuters.com/reuters/worldOfSport",
                "TheGuardian"	=>"https://www.theguardian.com/sport/us-sport/rss",
                "ChicagoTribune"	=>	"https://www.chicagotribune.com/arcio/rss/category/sports",
                "TheStar"=> "https://www.thestar.com/feeds.articles.sports.rss",
                "USAToday"	=>	"https://content.usatoday.com/marketing/rss/rsstrans.aspx?feedId=sports1",
                "Sports Yahoo"	=>	"https://sports.yahoo.com/top/rss.xml",
                "CBSSports"	=>	"https://www.cbssports.com/partners/feeds/rss/home_news",
                "FoxNews"	=>	"http://feeds.foxnews.com/foxnews/sports",
                "CBC"	=>	"https://www.cbc.ca/cmlink/rss-sports",
                "ScienceDaily"	=>	"https://www.sciencedaily.com/rss/science_society/sports.xml",
                "LATimes"	=>	"https://www.latimes.com/sports/rss2.0.xml",                
                "WashingtonPost"	=>	"http://feeds.washingtonpost.com/rss/sports",
                "NYPost"    =>  "https://nypost.com/sports/feed/",
            ),
            "Health" => array(
                "CNBC" => "https://www.cnbc.com/id/10000108/device/rss/rss.html",
                "Daily Mail" => "https://www.dailymail.co.uk/health/index.rss",
                "Huffpost" => "https://www.huffpost.com/section/health/feed",
                "BBC" => "https://feeds.bbci.co.uk/news/health/rss.xml",
                "NY Times" => "https://rss.nytimes.com/services/xml/rss/nyt/Health.xml",
                "CBSNEws"   =>  "https://www.cbsnews.com/latest/rss/health",
                "feeds Reuters" =>  "http://feeds.reuters.com/reuters/healthNews",
                "TheGuardian"   =>	"https://www.theguardian.com/society/health/rss",
                "ChicagoTribune"    =>  "https://www.chicagotribune.com/lifestyles/health/rss2.0.xml",
                "TheStar"   =>  "https://www.thestar.com/feeds.articles.life.health_wellness.rss",
                "USNews"    =>  "https://www.usnews.com/rss/health",
                "Time"  =>  "https://feeds.feedburner.com/time/scienceandhealth?format=xml",
                "Forbes"    =>  "https://www.forbes.com/health/feed2/",
                "CBC"   =>  "https://rss.cbc.ca/lineup/health.xml",
                "ScienceDaily"  =>  "https://www.sciencedaily.com/rss/top/health.xml",
                "NPR"   =>  "https://www.npr.org/rss/rss.php?id=1128",
                "LATimes"   =>  "https://www.latimes.com/health/rss2.0.xml",
                "SeattleTimes"  =>  "https://www.seattletimes.com/life/feed/",
                "CNN"   =>  "http://rss.cnn.com/rss/cnn_health.rss",
                "WashingtonPost"    =>  "http://feeds.washingtonpost.com/rss/lifestyle",
                "NYPost"    =>  "https://nypost.com/living/feed/",

            ),
            "Science" => array(
                "Daily Mail" => "https://www.dailymail.co.uk/sciencetech/index.rss",
                "Telegraph" => "https://www.telegraph.co.uk/science/rss.xml",
                "Huffpost" => "https://www.huffpost.com/section/science/feed",
                "BBC" => "https://feeds.bbci.co.uk/news/science_and_environment/rss.xml",
                "Ny Times" => "https://rss.nytimes.com/services/xml/rss/nyt/Science.xml",
                "CBSNEws"   =>  "https://www.cbsnews.com/latest/rss/science",
                "feeds Reuters" =>  "http://feeds.reuters.com/reuters/scienceNews",
                "TheGuardian"   =>  "https://feeds.theguardian.com/theguardian/science/rss",
                "TheStar"   =>  "https://www.thestar.com/feeds.articles.life.technology.rss",
                "USNews"    =>  "https://www.usnews.com/topics/subjects/science/rss",
                "FoxNews"   =>  "http://feeds.foxnews.com/foxnews/science",
                "CBC"   =>  "https://www.cbc.ca/cmlink/1.392",
                "ScienceDaily"  =>  "https://www.sciencedaily.com/rss/top/science.xml",
                "LATimes"   =>  "https://www.latimes.com/science/rss2.0.xml",
                "WashingtonPost"    =>  "http://feeds.washingtonpost.com/rss/rss_speaking-of-science",
            ),
            "US News" => array(
                "CNBC" => "https://www.cnbc.com/id/100003114/device/rss/rss.html",
                "Daily Mail" => "https://www.dailymail.co.uk/ushome/index.rss",
                "ABC News" => "https://abcnews.go.com/abcnews/usheadlines",
                "CBSNEws"   =>  "https://www.cbsnews.com/latest/rss/us",
                "TheGuardian" => "https://www.theguardian.com/world/usa/rss",
                "USNews"    =>  "https://www.usnews.com/rss/news",
                "NYDailyNews"   =>  "https://www.nydailynews.com/cmlink/NYDN.News.National.rss",
            ),
            "Entertainment" => array(
                "BBC" => "https://feeds.bbci.co.uk/news/entertainment_and_arts/rss.xml",
                "NY Times" => "https://rss.nytimes.com/services/xml/rss/nyt/Arts.xml",
                "Daily Mail" => "https://www.dailymail.co.uk/tvshowbiz/index.rss",
                "ABC News" => "http://feeds.abcnews.com/abcnews/entertainmentheadlines",
                "Buzzfeed" => "https://www.buzzfeed.com/tvandmovies.xml",
                "CBSNEws"   =>  "https://www.cbsnews.com/latest/rss/entertainment",
                "feeds Reuters" =>  "http://feeds.reuters.com/reuters/entertainment",
                "TheGuardian"   =>  "https://www.theguardian.com/tv-and-radio/entertainment/rss",
                "ChicagoTribune"    =>  "https://www.chicagotribune.com/arcio/rss/category/entertainment",
                "TheStar"   =>  "https://www.thestar.com/feeds.articles.entertainment.rss",
                "USAToday"  =>  "https://rssfeeds.usatoday.com/usatoday-LifeTopStories",
                "CBC"   =>  "https://rss.cbc.ca/lineup/arts.xml",
                "ScienceDaily"  =>  "https://www.sciencedaily.com/rss/science_society/media_and_entertainment.xml",
                "LATimes"   =>  "https://www.latimes.com/entertainment-arts/rss2.0.xml",
                "SeattleTimes"  =>  "https://www.seattletimes.com/entertainment/feed/",
                "CNN"   =>  "http://rss.cnn.com/rss/cnn_showbiz.rss",
                "WashingtonPost"    =>  "http://feeds.washingtonpost.com/rss/entertainment",
                "NYPost"    =>  "https://nypost.com/entertainment/feed/",

            ),
            "Politics" => array(
                "Daily Mail" => "https://www.dailymail.co.uk/news/us-politics/index.rss",
                "Telegraph" => "https://www.telegraph.co.uk/politics/rss.xml",
                "Buzzfeed" => "https://www.buzzfeed.com/politics.xml",
                "news18" => "https://www.news18.com/rss/politics.xml",
                "CBSNEws"   =>  "https://www.cbsnews.com/latest/rss/politics",
                "feeds Reuters" =>  "http://feeds.reuters.com/Reuters/PoliticsNews",
                "TheGuardian"   =>  "https://feeds.theguardian.com/theguardian/politics/rss",
                "ChicagoTribune"    =>  "https://www.chicagotribune.com/arcio/rss/category/politics",
                "TheStar"   =>  "https://www.thestar.com/feeds.blogs.news.politics_blog.rss",
                "USNews"    =>  "https://www.usnews.com/rss/the-report",
                "Politico"  =>  "https://www.politico.com/rss/magazine.xml", 
                "FoxNews"   =>  "http://feeds.foxnews.com/foxnews/politics",
                "CBC"   =>  "https://rss.cbc.ca/lineup/politics.xml",
                "NYDailyNews"   =>  "https://www.nydailynews.com/cmlink/NYDN.News.Politics.rss",
                "ScienceDaily"  =>  "https://www.sciencedaily.com/rss/top.xml",
                "NPR"   =>  "https://www.npr.org/rss/rss.php?id=1014",
                "LATimes"   =>  "https://www.latimes.com/politics/rss2.0.xml",
                "CNN"   =>  "http://rss.cnn.com/rss/cnn_allpolitics.rss",
                "WashingtonPost"    =>  "http://feeds.washingtonpost.com/rss/politics",

            ),
            "Travel" => array(
                "Daily Mail" => "https://www.dailymail.co.uk/travel/index.rss",
                "Telegraph" => "https://www.telegraph.co.uk/travel/rss.xml",
                "ABC News" => "http://feeds.abcnews.com/abcnews/travelheadlines",
                "TheGuardian"   =>  "https://www.theguardian.com/travel/rss",
                "USNews"    =>  "https://www.usnews.com/rss/travel-editorial",
                "ScienceDaily"  =>  "https://www.sciencedaily.com/rss/science_society/travel_and_recreation.xml",
                "LATimes"   =>  "https://www.latimes.com/travel/rss2.0.xml",
            )
        );

        if (!empty($rssfeedlinks)) {
            foreach ($rssfeedlinks as $cat => $rsslinks) {
                $categories = Categories::where('name', $cat)->first();
                if (!empty($categories)) {
                    $cat_id = $categories->id;

                    foreach ($rsslinks as $channel => $link) {

                        $channel = Channels::where('channel_name', $channel)->first();
                        if (!empty($channel)) {
                            $channel_id = $channel->id;

                            Rssfeedlinks::create([
                                'rsslinks' => $link,
                                'categories_id' => $cat_id,
                                'channels_id' => $channel_id,
                                'status'    => 1,
                                'is_featured'=> 0
                            ]);
                        }
                    }
                }
            }
        }
    }
}
