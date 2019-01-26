<?php

namespace App\Http\Controllers;

use App\Video;
use App\VideoCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->video        = new Video;
        $this->videoCategory= new VideoCategory;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pageInfo = [
                        'topHeading' => 'Dashboard - Home'
                    ];
        $videos         = $this->video->list(['limit' => 5]);
        $videoCategories= $this->videoCategory->list(['limit' => 5]);
        // dd($videos, $videoCategories);
        return view('home', ['pageInfo'=>$pageInfo, 'videoCategories'=>$videoCategories, 'videos'=>$videos]);
    }
}
