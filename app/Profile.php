<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];
    
    public function profileImage()
    {
        //This is to be the default controller. This is to help return a no available image for newly created profiles
        $imagePath = ($this->image) ? $this->image : 'profile/CsozCkZRDN8rMUJ977Y1vbWA9zf9EOU1gopxwxxi.jpeg';
        return '/storage/'.$imagePath;
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }


    public function user()
    {
        return $this->belongsto(User::class);
    }
}
