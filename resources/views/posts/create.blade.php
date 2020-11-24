@extends('layouts.app')

@section('content')
    <a href="./" class="btn btn-default">Naspat</a>
    <h1>create</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' =>'multipart/form-data'] ) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div>
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control' , 
                    'placeholder' => 'Sem napis text...'])}}
        </div>
        <div>
            <div class="form-group">
                {{Form::file('cover_image')}}
            </div>
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}
@endsection