<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Image;
use App\Setting;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user =  new User();
        $user->name = $data['name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();

        $img = new Image();
        $img->user_id = $user->id;
        $img->save();
        $img->name = $img->id.'.jpg';
        $img->save();

        $wallpaper = new Image();
        $wallpaper->user_id = $user->id;
        $wallpaper->save();
        $wallpaper->name = $wallpaper->id.'.jpg';
        $wallpaper->save();

        $setting = new Setting;
        $setting->user_id = $user->id;
        $setting->profilepic = $img->name;
        $setting->wallpaper = $wallpaper->name;
        $setting->birthday = $data['bd_year'].'/'.$data['bd_month'].'/'.$data['bd_day'];
        $setting->gender = $data['gender'];
        $setting->about = 'Escreva uma breve descrição sobre você para que seus amigos possam te reconhecer';
        $setting->status = 'Eu comecei a usar o XFind!';
        $setting->save();

        switch ($data['gender']){
            case '1':
                Storage::disk('public')->copy('/default_images/male_profile.jpg','images/'.$img->name);
                break;
            case '2':
                Storage::disk('public')->copy('/default_images/female_profile.jpg','images/'.$img->name);
                break;
            case '3':
                Storage::disk('public')->copy('/default_images/another_profile.jpg','images/'.$img->name);
                break;
        }

        Storage::disk('public')->copy('/default_images/wallpaper.jpg', 'images/'.$wallpaper->name);

        return $user;
    }
}
