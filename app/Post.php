<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = []; // Used to prevent the check of whether the database fields are declared explicity in the model
    
    
    public function user()
    {
        return $this->belongsto(User::class);
    }
}
