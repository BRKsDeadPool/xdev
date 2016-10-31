<?php

namespace App\Http\Controllers\Pages\home;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Nano\Likeable\Like;

class HomeController extends Controller
{
    public function getHome()
    {
        $posts = Post::orderBy('created_at','desc')->limit(45)->with('likeCounter')->get();
        $posts->load('creator','creator.setting','poster','poster.setting','images','videos');
        return view('pages.feeds', ['posts'=>$posts]);
    }
}
