<?php

namespace App\Http\Controllers\Pages\post;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function getPost(Request $request)
    {
        $id = $request->id;
        if ($id != '') {
            $post = Post::find($id);
            if($post != '') {
                $post->load('images','videos','poster','creator');
                return view('pages.post', ['post'=> $post]);
            }
            return view('pages.post');
        }
        return view('pages.post');
    }
}
