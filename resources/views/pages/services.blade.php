@extends('layouts.app')

@section('content')
<h1>{{$title}}</h1>

<form id='formular' >
    <input type="text" name="textarea" id="textarea" placeholder="sem napis co chces robit" class="textarea">
    @csrf
    <input type="submit" value="submit" class="btn btn-submit">
</form>

<ul id='vypis'>
    <p>vypisovanie tvojich todo veci</p>
    @foreach ($data as $todo)
        <li> 
            <p> {{$todo->text}} </p>
            <a class='btn' href='{{ url('todo_delete/'.$todo->id) }}'>Vymazat</a>
            <a class='btn' href='{{ url('todo_edit/'.$todo->id) }}'>Upravit</a>
        </li>
    @endforeach
</ul>

@endsection
 