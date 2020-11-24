@extends('layouts.app')

@section('content')
    <a href="./" class="btn btn-default">Naspat</a>
    <h1>{{$post->title}}</h1>
    <img style="w-100" src="../../public/storage/cover_images/{{$post->cover_image}}">

    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>vytvorene {{$post->created_at}} autor: {{$post->user->name}}</small>
    <hr>
    
    @if (!Auth::guest())  <?php  // ochrana aby uzivatel nevidel a nemohol menit prispevky ?>
        @if(Auth::user()->id == $post->user_id) <?php  // ochrana aby iba autor mohol menit prispevky ?>
            <a href="./{{$post->id}}/edit" class="btn btn-default">Upravit</a>

            <?php //mazanie prispevkov ?>
            {!!Form::open(['action'=>['PostsController@destroy', $post->id], 'method' => 'POST', 'class'=> 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif

@endsection