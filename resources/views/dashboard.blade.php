@extends('layouts.app')

@section('content')
<div class="container jumbotron">
    <a href="/movies/create">Add Movie</a><br>
    <a href="/series/create">Add Series</a>
    <h1>Movies</h1>
    @foreach($movies as $movie)
    <div class="row m-2">
        <div class="col-md-2 col-sm-2">
            {{$movie->title}}
        </div>
        <div class="col-md-2 col-sm-2">
            {{$movie->imdb_id}}
        </div>

        <div class="col-md-2 col-sm-2">
            {{$movie->type}}
        </div>
        <div class="col-md-2 col-sm-2">
            {{$movie->created_at}}
        </div>
        <div class="col-md-2 col-sm-2">
            <a href="/movies/{{$movie->id}}/edit" class="btn btn btn-primary">Edit</a>
        </div>
        <div class="col-md-2 col-sm-2">
            <form method='POST' action="/movies/{{$movie->id}}">
                 @csrf
                 @method('DELETE')
                <input type="submit" class=" pull-right btn btn-danger" value="Delete">
            </form>
        </div>
    </div>
    <hr>
    @endforeach

    <h1>Series</h1>
    @foreach($series as $movie)
    <div class="row m-2">
        <div class="col-md-2 col-sm-2">
            {{$movie->title}}
        </div>
        <div class="col-md-2 col-sm-2">
            {{$movie->imdb_id}}
        </div>

        <div class="col-md-2 col-sm-2">
            {{$movie->type}}
        </div>
        <div class="col-md-2 col-sm-2">
            {{$movie->created_at}}
        </div>
        <div class="col-md-2 col-sm-2">
            <a href="/movies/{{$movie->id}}/edit" class="btn btn btn-primary">Edit</a>
        </div>
        <div class="col-md-2 col-sm-2">
            <form method='POST' action="/movies/{{$movie->id}}">
                 @csrf
                 @method('DELETE')
                <input type="submit" class=" pull-right btn btn-danger" value="Delete">
            </form>
        </div>
    </div>
    <hr>
    @endforeach



</div>
@endsection
