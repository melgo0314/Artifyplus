<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'image',
        'is_active'
    ];

    public function users(){
        return $this->belongsToMany(\App\Models\User::class, 'subscriptions');
    }

    public function videos(){
        return $this->hasMany(Video::class,);
    }
}
