@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
       <div class="col-3 p-3">
        <img alt="freecodecamp's profile picture" height = "100" width = "100" src="https://instagram.fnbo2-1.fna.fbcdn.net/v/t51.2885-19/s320x320/83213956_3360255157381124_5752385570823208960_n.jpg?_nc_ht=instagram.fnbo2-1.fna.fbcdn.net&amp;_nc_ohc=1g9woUWsBWsAX_68zC5&amp;oh=52d296325d0e68097615c716da9379d5&amp;oe=5EE9C93E" class = "rounded-circle">
       </div>
       <div class="col-9 p-3">
       <!-- Just as the PHP short cut <?= $user->username ?> laravel uses the {{ $user->username }} syntaz-->
        <div class="d-flex justify-content-between align-items-baseline">
            <h1>{{$user->username }}</h1 >
            <a href="#">Add New Post</a>
        </div>
        <div class="d-flex">
            <div class="pr-5"><strong>299</strong> Posts</div>
            <div class="pr-5"><strong>47.8k</strong> Followers</div>
            <div class="pr-5"><strong>299</strong> Following</div>
        </div>
        <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
        <div>{{$user->profile->description}}</div>
        <div><a href="#">{{$user->profile->url}}</a></div>
       </div>
   </div>
   <div class="row pt-5">
    <div class="col-4">
        <img src="https://instagram.fnbo2-1.fna.fbcdn.net/v/t51.2885-15/e35/c95.0.559.559a/96936602_574334026620306_7948073701358189323_n.jpg?_nc_ht=instagram.fnbo2-1.fna.fbcdn.net&amp;_nc_cat=106&amp;_nc_ohc=rCyzyyhzlVkAX8D-Ha6&amp;oh=43866b0c4fec50062a7f4286a55dfb59&amp;oe=5EEAD222" class="w-100">
    </div>
    <div class="col-4">
        <img src="https://instagram.fnbo2-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c0.23.730.730a/s640x640/96823965_1408350016016174_6558000491988366869_n.jpg?_nc_ht=instagram.fnbo2-1.fna.fbcdn.net&amp;_nc_cat=102&amp;_nc_ohc=A5nb-UREq4cAX8Z1Vlh&amp;oh=7134a84a0e1155fc58f91d2c5dfe6f43&amp;oe=5EEAD0EC" class="w-100">
    </div>
    <div class="col-4">
        <img src="https://instagram.fnbo2-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c0.56.849.849a/s640x640/96936602_865468200615953_5556357876951389968_n.jpg?_nc_ht=instagram.fnbo2-1.fna.fbcdn.net&amp;_nc_cat=105&amp;_nc_ohc=xACgkOnATbwAX8iez2q&amp;oh=bdd8d4a87d7d8c7abaff22d48e880162&amp;oe=5EE96706" class="w-100">
    </div>
   </div>
</div>
@endsection
