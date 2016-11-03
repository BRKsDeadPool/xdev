<?php

namespace App\Http\Controllers\Pages\search;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Search;
use Illuminate\Support\Facades\Auth;
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
                ->orwhere('name','LIKE',$term)
		->orwhere('name','LIKE',$term.'%')
                ->orwhere('name','LIKE','%'.$term.'%')
                ->orwhere('name','LIKE','%'.$term)
                ->orwhere('id','like',$term)
                ->get();

            if (count(Search::orderBy('created_at','desc')->where('user_id','=',$request->user()->id)->where('term','=', $term)->get()) < 1) {
                Search::create([
                    'term'    =>  $term,
                    'user_id' => $request->user()->id,
                    'results' => count($users)
                ]);
            }else {
               $searches =  Search::orderBy('created_at','desc')->where('user_id','=',$request->user()->id)->where('term','=', $term)->get();
                foreach ($searches as $search) {
                    $search->updated_at = Carbon::now();
                    $search->save();
                }
            }

            $last_searches = Search::orderBy('updated_at','desc')->where('user_id','=',$request->user()->id)->get();

            return view('pages.search',['users'=>$users,'term'=>$term, 'last_searches'=>$last_searches]);
        }
        $last_searches = Search::orderBy('updated_at','desc')->where('user_id','=',$request->user()->id)->limit(4)->get();


        return view('pages.search', ['last_searches'=>$last_searches]);
    }
}
