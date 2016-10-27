<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    public function handleFriendship(Request $request)
    {

    }

    public function getFriendships()
    {
        $pending = Auth::user()->getPendingFriendships();
        $pendingids = array();
        $suggested = array();
        foreach ($pending as $pend) {
            $pendingids[] = $pend->id;
        }

        $suggested = User::where('id','!=',Auth::user()->id)->whereNotIn('id',$pendingids)->limit(10)->get();


        return response()->json(['pending'=>$pending, 'suggested' => $suggested],200);
    }

}
