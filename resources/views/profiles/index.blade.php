@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
       <div class="col-3 pt-5">
        <img src="{{ $user->profile->profileImage() }}"  class = "rounded-circle w-100">
       </div> 
       <div class="col-9 pt-5">
       <!-- Just as the PHP short cut <?= $user->username ?> laravel uses the {{ $user->username }} syntaz-->
        <div class="d-flex justify-content-between align-items-baseline">
            <div class = "d-flex align-items-center pb-3">    
                <div class="h4">{{$user->username }}</div>

                <!--On Initiation must determine whether the accessed profile is being followed by the current user or not. This is done under the  profile index function-->
                <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>

            </div>

            @can('update', $user->profile)
                <a href="/p/create">Add New Post</a>
            @endcan
        </div>
        <!-- Once the Policy is in place can use the below blade directive to authorize-->
        @can('update', $user->profile)
            <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
        @endcan
        <div class="d-flex">
            <!-- Get The Count of Posts-->
            <div class="pr-5"><strong>{{ $postCount }}</strong> Posts</div>
            <div class="pr-5"><strong>{{ $followersCount }}</strong> Followers</div>
            <div class="pr-5"><strong>{{ $followingCount }}</strong> Following</div>
        </div>
        <div class="pt-4 font-weight-bold">{{$user->profile->title}}</div>
        <div>{{$user->profile->description}}</div>
        <div><a href="#">{{$user->profile->url}}</a></div>
       </div>
   </div> 
   <div class="row pt-5">
    @foreach($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="/p/{{$post->id}}">
                <img src="/storage/{{$post->image}}" class="w-100">
            </a>
        </div>
    @endforeach
   </div>
</div>
@endsection
