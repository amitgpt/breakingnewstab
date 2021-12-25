<?php

use Illuminate\Database\Seeder;
use App\Channels;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$channelsArray = ['ABC News','BBC','Buzzfeed','CNBC','Daily Mail','Huffpost','NY Times','Telegraph','The Wall Street Journal','news18'];
        $channelsArray = ['ABC News','BBC','Buzzfeed','CNBC','Daily Mail','Huffpost','NY Times','Telegraph','The Wall Street Journal','news18','MSN','CBSNEws','feeds Reuters','TheGuardian','ChicagoTribune','TheStar','NYPost','USNews','Time','Forbes','USAToday','Sports Yahoo','CBSSports','ApNews','FoxNews','CBC','NewsWeek','ESPN','NYDailyNews','ScienceDaily','NPR','LATimes','DetriotTimes','SeattleTimes','CNN','WashingtonPost'];
        for ($i=0; $i < count($channelsArray); $i++) { 

	    	Channels::create([
	            'channel_name' => trim($channelsArray[$i])
	        ]);

    	}
    }
}
