<?php

namespace App\Http\Controllers;

use App\Events\MessageWasReceived;
use App\Message;
use App\Notifications\PostCreated;
use App\Search;
use App\User;
use App\Image;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class VueController extends Controller
{
    public function postMessages()
    {
        $messages = Message::orderBy('created_at','desc')->get();
        $messages->load('user', 'user.setting');

        return response()->json(['messages'=>$messages], 200);
    }

    public function postYou()
    {
        $user = Auth::user();
        $user->load('setting');

        return response()->json(['user'=>$user], 200);
    }

    public function postNewMessage(Request $request)
    {
        $message = new Message;
        $message->user_id = Auth::user()->id;
        $message->message = $request->message;
        $message->save();

        $user = User::find($message->user_id);
        $setting = $user->setting;

        event(new MessageWasReceived($message, $user, $setting));

        return response()->json(['success'=>'true','message'=>$message,'user'=>$user], 200);
    }

    public function postNewPost(Request $request)
    {
        $this->validate($request,[
            'post_body'  =>  'max:250|required_without_all:post_image',
            'post_image' =>  'required_without_all:post_body|image|mimes:jpeg,jpg,bmp,png,gif'
        ]);

        if ($request->post_body != '' AND $request->post_image == ''){
            $post = new Post();
            $post->poster_id = $request->user()->id;
            $post->creator_id = $request->user()->id;
            $post->body = $request->post_body;
            $post->save();
        }elseif($request->post_image != '' AND $request->post_body == ''){
            $image = new Image;
            $image->user_id = $request->user()->id;
            $image->save();
            $image->name = $image->id.'.jpg';
            $image->save();
            $request->post_image->storeAs('images', $image->name, 'public');

            $post = new Post();
            $post->poster_id = $request->user()->id;
            $post->creator_id = $request->user()->id;
            $post->save();
            $image->post_id = $post->id;
            $image->save();
        }else{
            $image = new Image;
            $image->user_id = $request->user()->id;
            $image->save();
            $image->name = $image->id.'.jpg';
            $image->save();
            $request->post_image->storeAs('images', $image->name, 'public');

            $post = new Post();
            $post->poster_id = $request->user()->id;
            $post->creator_id = $request->user()->id;
            $post->body = $request->post_body;
            $post->save();
            $image->post_id = $post->id;
            $image->save();
        }

        Notification::send(User::all(), new PostCreated($post->poster->name. ' criou uma nova publicação...' ,'/post?id='.$post->id, Auth::user()->id));

        return redirect()->back()->with(['messages'=>['Post criado com sucesso!']]);
    }

    public function newLike(Request $request)
    {
        $post = Post::find($request->postid);
        $action = $request->action;
        $user = Auth::user();

        if ($action = 'like') {
            if ($post->liked()) {
                $post->unlike();

            $likes = '0';
                if ($post->likeCounter){
                    $likes = $post->likeCounter->count;
                }
                return response()->json(['message' => 'Curtida removida com sucesso', 'likes'=> $likes], 200);
            }
            $post->like();

            $likes = '0';
            if ($post->likeCounter){
                $likes = $post->likeCounter->count;
            }
            return response()->json(['message'=>'Curtida adicionada com sucesso', 'likes'=> $likes], 200);
        }

        return response()->json(['message'=>'Não foi possivel completar essa operação'], 200);

    }
}
