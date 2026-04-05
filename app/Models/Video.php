<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'url',
        'channel_id',
    ];

     public function comments(){
        return $this->hasMany(Comment::class);
    }
    

    public function channel(){
        return $this->belongsTo(Channel::class);
    }
}
