<?php

namespace App\Http\Controllers\Pages\search;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Search;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function getSearch(Request $request)
    {
        $term = $request->term;

        if ($term != ''){
            $users = User::
            where('name','LIKE',$term)
                ->orwhere('name','LIKE',$term.'%')
                ->orwhere('name','LIKE','%'.$term.'%')
                ->orwhere('name','LIKE','%'.$term)
                ->orwhere('id','like',$term)
                ->get();
            if (count(Search::where('term','=',$term)->where('user_id','=',$request->user()->id)) <= 0) {
                Search::create([
                    'term'    =>  $term,
                    'user_id' => $request->user()->id,
                    'results' => count($users)
                ]);
            }

            $last_searches = Search::orderBy('created_at','desc')->where('user_id','=',$request->user()->id)->limit(10)->get();

            return view('pages.search',['users'=>$users,'term'=>$term, 'last_searches'=>$last_searches]);
        }
        $last_searches = Search::orderBy('created_at','desc')->where('user_id','=',$request->user()->id)->limit(4)->get();


        return view('pages.search', ['last_searches'=>$last_searches]);
    }
}
