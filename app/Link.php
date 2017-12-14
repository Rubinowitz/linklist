<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
   protected $fillable = [
        'title',
        'url',
        'description',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}