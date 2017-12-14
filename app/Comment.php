<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Link;

class Comment extends Model
{
    //
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}
