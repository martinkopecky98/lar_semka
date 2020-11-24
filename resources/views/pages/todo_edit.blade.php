@extends('layouts.app')

@section('content')
    <a href="./" class="btn btn-default">Naspat</a>
    <h1>Editovanie</h1>
    <br>
    {!! Form::open(['action' => ['PostsController@update',$post->id] ,'method' => 'POST', 'enctype' =>'multipart/form-data'] ) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div>
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control' , 
                    'placeholder' => 'Sem napis text...'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection