<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $table = 'searches';

    protected $fillable = [
        'user_id','term','results'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
