<?php

namespace App\Http\Controllers;

use App\Notifications\FriendRequestWasSent;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    public function handleFriendship(Request $request)
    {
        $user = User::find($request->target);
        $action = $request->action;

        if ($user->id == Auth::user()->id){
            return response()->json(['status'=>'error','message'=>'Você não pode enviar uma solicitação para si mesmo!'],200);
        }

        switch ($action){
            case 'send':
                    Auth::user()->befriend($user);
                    Notification::send($user, new FriendRequestWasSent('/profile?id='.Auth::user()->id,Auth::user()->name.' '.Auth::user()->last_name.' te enviou uma nova solicitação de amizade...',Auth::user()->id));
                return response()->json(['user'=>$user,'result'=>'sent','status'=>'success','message'=>'Sua solicitação foi enviada com sucesso!','action'=>'remove'],200);
                break;
            case 'accept':
                Auth::user()->acceptFriendRequest($user);
                return response()->json(['user'=>$user,'result'=>'accepted','status'=>'success','message'=>'Solicitação aceita com sucesso','action'=>'remove'],200);
                break;
            case 'remove':
                Auth::user()->unfriend($user);
                return response()->json(['user'=>$user,'result'=>'removed','status'=>'success','message'=>'Solicitação removida com sucesso!','action'=>'send'],200);
                break;
            case 'deny':
                Auth::user()->denyFriendRequest($user);
                return response()->json(['user'=>$user,'result'=>'denied','status'=>'success','message'=>'Solicitação negada com sucesso!','action'=>'send'],200);
                break;
            default:

                return response()->json(['status'=>'error','message'=>'Ocorreu um erro ao processar sua solicitação!'],200);
                break;
        }
    }

    public function getFriendships()
    {

    }

}
