@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($posts as $post)
        <div class="row">
            <div class="col-6 offset-3">
                <!--
                Using telescope you'll notice  {{ $post->user->id }} returns several queries for each of the users this is referred to as the limit one problem
                and can be dealt with in the controller using the with function. Check the PostControllers index function. 
                <a href="/profile/{{ $post->user->id}}"><img src="/storage/{{ $post->image }}" alt="" class="w-100"></a>  
                -->
                <a href="/profile/{{ $post->user->id}}"><img src="/storage/{{ $post->image }}" alt="" class="w-100"></a>
            </div>
        </div>
        <!-- py-3  Give a padding of three at the top and bottom-->
        <div class="row pt-2 pb-4">
            <div class="col-6 offset-3">
                <p>
                    <span class="font-weight-bold">
                        <a href="/profile/{{$post->user_id}}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </span> {{ $post->caption }}
                </p>
            </div>
        </div>
    @endforeach
    <!--- Using the paginate added links method add the Next button below.-->
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
