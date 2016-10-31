<?php

namespace App\Http\Controllers\Pages\setting;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function getSetting()
    {
        return view('pages.settings');
    }

    public function editSetting(Request $request)
    {
        $user = $request->user();
        $setting_name = $request->setting_name;
        $setting_value = $request->setting_value;
        if ($setting_name == 'name' OR $setting_name == 'last_name'){
            $user->$setting_name = $setting_value;
            $user->save();
            return response()->json(['newValue'=> $setting_value], 200);
        }
        $setting = $user->setting;
        $setting->$setting_name = $setting_value;
        $setting->save();

        return response()->json(['newValue'=> $setting_value], 200);
    }

    public function editProfilepic(Request $request)
    {
        $this->validate($request,[
           'profilepic'=>'required'
        ]);
        $user = Auth::user();
        $setting = $user->setting;

        $image = new Image;
        $image->user_id = $user->id;
        $image->save();
        $image->name = $image->id.'.jpg';
        $image->save();

        $request->profilepic->storeAs('images', $image->name,'public');

        $setting->profilepic = $image->name;
        $setting->save();

        return redirect()->back();
    }

    public function editWallpaper(Request $request)
    {
        $this->validate($request,[
           'wallpaper'=>'required'
        ]);
        $user = Auth::user();
        $setting = $user->setting;

        $image = new Image;
        $image->user_id = $user->id;
        $image->save();
        $image->name = $image->id.'.jpg';
        $image->save();

        $request->wallpaper->storeAs('images', $image->name,'public');

        $setting->wallpaper = $image->name;
        $setting->save();

        return redirect()->back();
    }
}
