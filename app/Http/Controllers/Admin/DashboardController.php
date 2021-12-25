<?php

namespace BreakingNEWSTab\Http\Controllers\Admin;

use Illuminate\Http\Request;
use BreakingNEWSTab\Http\Controllers\Controller;
use BreakingNEWSTab\Categories;
use BreakingNEWSTab\Channels;
Use BreakingNEWSTab\Rssfeedlinks;
Use BreakingNEWSTab\YoutubeChannels;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin')->except('logout');
    }

    public function dashboard(){

        $totalCategories = Categories::count();
        $totalChannels = Channels::count();
        $totalRssfeedlinks = Rssfeedlinks::count();  
        $totalYoutubeChannels = YoutubeChannels::count();

        return view('admin.dashboard')->with(['totalCategories'=>$totalCategories,
                                              'totalChannels' => $totalChannels,
                                              'totalRssfeedlinks'=>$totalRssfeedlinks,
                                              'totalYoutubeChannels' => $totalYoutubeChannels,
                                            ]);
    }
}
