<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * This is the default index file upon login
     * Since as per to the create posts function, all the posts are attached to the users and not the profiles, then first we have to get all the users.
     * And since there are several user ids, you have to specify the user id to be selected when plucking to avoid ambiguity.
     * Using the result, you can get the posts from the Post table using  the whereIn function.
     * Then reorder the list in descending order using orderby('created_at', 'DESC') or latest()
     * if want the whole result chage the paginate function to get();
     * When pagination is used the method links is automatically added and this can be called in the blade files to access the next files in the list.
     * 
     * The with('user') function (using the relationship) is used to eliminate the limit 1 problem by only executing one query to return all users at once instead of executing
     * the same query for each user separately.
     * 
     */
    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');//can use the . or /
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => 'required|image',//Can also use ['required','image']
        ]);

        /* 
        *  By default the image is stored in some temporary path that is not related to our project.
        *  Laravel has a provision for storing images. This is by the use of the store method which take the path to which the image is to be stored,as well as the driver.
        *  The upload is done to amazon and then laravel brings back the file name to php in the case of S3 
        *  For pur uplication we use the local public dirrectory.
        *  They are different storage driver eg the Amazon S3 
        *  dd(request('image')->store('uploads', 'public'));
        *  On upload the file will end up in the applications storage directory in the apps/public/uploads folder 
        *  But laravel has no access to the files in the storage directory and there is a need to explicitly tell laravel to link to the files in the storage directory.
        *  Laravel does this by creating a symbolic link in the public folder.
        *  This is a one time command that can be done using a php artisan
        *  The initial auth()->user()->posts()->create($data); to save our data what work thus we will go to the manual version as 
        *  auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
          ]); 
        */
        
        $imagePath = request('image')->store('uploads', 'public');
        
        /* To manipulate our image we can use the public_path helper then into it pass the path to our image
         * The make wraps our Image around the Intevention Class to manipulate it. To resize use the fit function from the Intevention class
         * Resize changes the physical but the fit cuts the image to fit it in.
        */
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();
        
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]); 

        //To store can use
        /*$post = new \App\Post();

        $post->caption = $data['caption'];
        $post->save(); */

        //\App\Post::create($data);//The array is as defined in the validation. If there is a field that is not in the validation then it won't be saved to the database. To pass it to db then include it in the validation but with no rules
        
        //dd(request()->all());

        return redirect('/profile/' . auth()->user()->id);
    }

    /* Instead of using show($post) function, Laravel provides Route Model Bind which helps prevent one from manually passing 
    *in parameters and returns a 404 if the record does not exist just as when the findOrFail() method to return a 404 if page not found. Thus the use of  show(\App\Post $post)
    * for this to work, the parameter passed in the route must named similar to the variable in the show() method
    * The return can be done by passing a variable as - return view('posts.show',['post' => $post,]); This is similar to the
    * simplied version using the compact method as return view('posts.show',compact('post'));
    */

    public function show(\App\Post $post)  
    {
        
        return view('posts.show',compact('post'));
    }
}
