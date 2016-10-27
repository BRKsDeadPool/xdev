<?php

namespace App\Http\Controllers\Pages\profile;

use App\Image;
use App\Post;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function getProfile(Request $request)
    {
        if ($request->id != ''){
            $user = User::find($request->id);
            $user->load('setting','images','posteds','createds');
            $posts = Post::where('poster_id','=',$user->id)->orWhere('creator_id','=',$user->id)->orderBy('created_at','desc')->with('likeCounter')->get();

            return view('pages.profile',['user'=>$user,'posts'=>$posts]);
        }

        return view('errors.404');
    }

    public function getProfileImages(Request $request)
    {
        $user = $request->id;
        $images = Image::where('user_id','=',$user)->orderBy('created_at','desc')->get();


        return view('pages.profile_images',[ 'user'=>User::find($user),'images'=>$images ]);
    }
}
