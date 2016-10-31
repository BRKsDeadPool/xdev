<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'user_id',  'nickname', 'birthday', 'gender', 'about', 'status', 'is_admin','privacity','profilepic','wallpaper'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
