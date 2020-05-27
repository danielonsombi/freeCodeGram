<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * A profile can follow many users and one user can follow many profiles hence a many to many relationship
     * between the user and the profile. This calls for creation of a pivot table using the make:migration artisan command
     * Using the creates_profile_user_pivot_table --create profile_user. Always ensure the defined tables are in alphabetic order.
     * You can follow or unfollow a profileby using a laravel attach or detach function called toggle
     */
    public function store(User $user)
    { 
        return auth()->user()->following()->toggle($user->profile);
    }
}
