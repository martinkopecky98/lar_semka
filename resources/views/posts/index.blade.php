@extends('layouts.app')

@section('content')
    <h1>Prispevky</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
        <br><br>
            <div class = "well">
                <div class="row">
                    <div class ="col-md-4 col-sm-4">
                        <img style="w-100%" src="./storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class= "col-md-8 col-sm-8">
                        <h3><a href="posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>vytvorene {{$post->created_at}} autor: {{$post->user->name}} </small>
                        <a href="posts/{{$post->id}}/edit">Upravit</a>
                    </div>                
                </div>                
            </div>                
        @endforeach
    @else
        <p>No post found</p>
    @endif
@endsection