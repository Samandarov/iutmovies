@extends('layouts.app')
@section('content')
    <a href="/series" class="btn btn-secondary">Go Back</a>
    <div class="row">
        @php
            $id;
            $link;
            @endphp
            @foreach($series as $movie)
                @php
                if(!empty($movie['link']))
                {
                    $id = $movie['id'];
                    $link = $movie['link'];
                    continue;
                }
                @endphp
                @if(!empty($ser['Title']))
                <div class="list-group-item">
                    <div class="row">
                        {{$movie["Title"]}}
                        <br>
                        {{$movie["Year"]}}
                        <br>
                        {{$movie["Rated"]}}
                        <br>
                        {{$movie["Released"]}}
                        <br>
                        {{$movie["Runtime"]}}
                        <br>
                        {{$movie["Genre"]}}
                        <br>
                        {{$movie["Director"]}}
                        <br>
                        {{$movie["Writer"]}}
                        <br>
                        {{$movie["Actors"]}}
                        <br>
                        {{$movie["Plot"]}}
                        <br>
                        {{$movie["Language"]}}
                        <br>
                        {{$movie["Country"]}}
                        <br>
                        {{$movie["Awards"]}}
                        <br>
                        <img src="{{$movie["Poster"]}}" style="width: 10%;">
                        <br>
                        {{$movie["imdbRating"]}}
                        <br>
                        {{$movie["imdbVotes"]}}
                        <br>
                        {{$movie["imdbID"]}}
                        <br>
                        {{$movie["Type"]}}
                        <br>
                        {{$movie["Metascore"]}}
                        <br>
                        <br>
                        <video src="{{$link}}" controls></video>
                        <br>
                    </div>
                </div>
                @endif
            @endforeach
    </div>
    @auth
        @if(Auth::user()->type == "admin")
            <hr>
            <div class="row">
            <a href="/series/{{$id}}/edit" class="btn btn btn-primary">Edit</a>
            <form method='POST' action="/series/{{$id}}">
                 @csrf
                 @method('DELETE')
                <input type="submit" class=" pull-right btn btn-danger" value="Delete">
            </form>
            </div>
        @endif
    @endif
    <div class="row">
        <div class="col-md-12">
            @auth
            <a name="forms">
            <a name="csrf-field">
            <form method='POST' action="/comments" enctype="multipart/form-data">
                 @csrf
                 {{-- @method('POST') --}}
                <div class="form-group">
                    <label>Title</label>
                    <textarea name="body" placeholder="Comment:" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                </div>
                <div class="form-group">
                    <input type="hidden" name="movie_id" value="">
                </div>
                <div class="form-group">
                    <input type="hidden" name="series_id" value="{{$id}}">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>
            </a>
            </a>
            @endif
            <br>
            <hr>
            <br>
            <h4>Comments: </h4><hr>
            @if(count($comments)>0)
                @foreach($comments as $comment)
                    <div class="commentText">
                        <h4><span>{{ $comment->user->name }}</span> <span>| {{ $comment->created_at }}</span></h4>
                        <h5>{{ $comment->body }}</h5>
                        @if(auth()->user()->id == $comment->user->id)
                            {{-- <a href="/comments/{{ $comment->id }}/delete" class="btn btn-danger">Delete</a> --}}
                            <a name="forms">
                            <a name="csrf-field">
                            <form method='POST' action="/comments/{{$comment->id}}" enctype="multipart/form-data">
                                 @csrf
                                 @method('DELETE')
                                <div class="form-group">
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </div>
                            </form>
                            </a>
                            </a>
                        @endif
                    </div>
                    <hr>
                @endforeach
            @else
                <h4>There is No Comments</h4>
            @endif
        </div>
    </div>
@endsection
