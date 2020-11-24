@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nastenka</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="panel-body">
                <a href="./posts/create" class="btn btn-primary">Vytvor prispevok </a>
                <h3>Tvoje prispevky</h3>
                <table class="table table-striped">

                    @foreach ($posts as $item)
                    <br>
                    <tr>
                        
                        <td>{{$item->title}}</td>
                        <td><a href="./{{$item->id}}/edit" class="btn btn-info"> Uprav prispevok</a></td>
                        <td>
                            {!!Form::open(['action'=>['PostsController@destroy', $item->id], 'method' => 'POST', 'class'=> 'pull-right'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                            {!!Form::close()!!}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
