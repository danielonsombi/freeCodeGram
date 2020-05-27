<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

use App\User;

class ProfilesController extends Controller
{
    public function index($user)
    {   
        //$user = User::find($user); This returns an error that is cannot be understood by the user hence the use of the findorfail

        $user = User::findOrFail($user);

        //Check if the current user is or is not following the current active profile
        $follows = (auth()->user() ? auth()->user()->following->contains($user->id) : false);

        //The pass the Info to the user by passing an array with the Returned user data.
        /*return view('profiles.index', [
            'user' => $user,
            'follows' => 'follows',
        ]);*/

        /**
         * The variables created below can be done from the blade file but to avoid the recount everytime a page is loaded we can use 
         * laravel's cache functionality therefore, better have them in the controller.
         * To use Cache first Import it as above then attach it to each calc value as below.
         * 
         * The Cache for Post count will use the key count.posts.userid, It is to be stored for 30 seconds, 
         * and if it is not there then run the function to count the number of posts.
         * 
         * 
         * Cache also has a rememberforever function that does not have a time limit and does remember forever.
         * This helps for faster running by preventing the  application from retrievingdata from the database everytime it is run.
         * Can also use the addDay, ad dMonth addYear etc.
         * 
         * 
         */

        $postCount = Cache::remember('count.posts.'.$user->id, 
            now()->addSeconds(30),
            function() use($user){
                return  $user->posts->count();
            });
        $followersCount = Cache::remember('count.followers.'.$user->id, 
            now()->addSeconds(30),
            function() use($user){
                return  $user->profile->followers->count();
            });
        
        $followingCount = Cache::remember('count.following.'.$user->id, 
            now()->addSeconds(30),
            function() use($user){
                return  $user->following->count();
            });


        return view('profiles.index', compact('user', 'follows','postCount','followersCount','followingCount'));
    }

    //The code below is the simplified version of the code above in regards to retriving the user and passing an array to the view
    public function edit(User $user) //Since App\User is Imported use User as below
    {
        /* 
        * The authorize function is called iff the policy is in place as:
        * The code below is to authorize an update on a given profile
        */
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user) //Since App\User is Imported use User as below
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        if(request('image'))
        {
            $imagePath = request('image')->store('profile', 'public');
            
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
            /**
             * Always set an image array if there be a new image created. This array is what is passed to the profile update section and if the 
             * image array is null then an empty array is passed. This will help avaid the undefinedImage error on saving the edited profile with no image
             */

             $imageArray = ['image' => $imagePath]; 
        }

        /*
        * The User being saved is for the Authenticated profile. Therefore when saving save to the user profile as:
            $user->profile->update($data)  
            Then redirect as shown below:  
            For protection and to avoid a scenario where someone alters the submitted use id, One should add an exre layer 
            of protection to ensure that only the authenticated user has access to the data.
            Therefore instead of $user->profile->update($data) use auth()->user()->profile->update($data);     
        */
        //auth()->user()->profile->update($data);

        /**
         * Having Updated the Image to imagepath then the update method above will not work.
         * This can be dealt with by either recreating the whole $data array as done in the post controller or use the method below:
         * 
         */
        
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? [] //Get the Image array or an empty array if the image is not set.
        )); 

        return redirect("/profile/{$user->id}");
    }
}
