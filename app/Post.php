<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nano\Likeable\Likeable;

class Post extends Model
{
    use Likeable;

    public function creator()
    {
        return $this->belongsTo('App\User','creator_id');
    }

    public function poster()
    {
        return $this->belongsTo('App\User','poster_id');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function videos()
    {
        return $this->hasMany('App\Video');
    }
}
