<?php

namespace App\Http\Controllers\Pages\generalchat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GeneralChatController extends Controller
{
    public function getHome()
    {
        return view('pages.generalchat');
    }
}
