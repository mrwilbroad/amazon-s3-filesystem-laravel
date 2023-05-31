<?php

namespace App\Http\Controllers\YoutubeTutorial;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Http\Requests\Youtube\YoutubeRequest;
use Alaouy\Youtube\Facades\Youtube;

class YoutubeController extends Controller
{
    
    
    public function index()
    {
       
        return view("Youtube.index"); 
    }

    public function GetContent(YoutubeRequest $request)
    {
        $search = $request->safe()->only("youtube_Content");


        dd($search);
    }
}
