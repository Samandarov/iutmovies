@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('data/css/style.css')}}">
<div class="container-fluid movie-item">
    @php
        $id;
        $link;
        $movies = $movie
    @endphp

            @foreach($movies as $movie)
                @php
                if(!empty($movie['link']))
                {
                    $id = $movie['id'];
                    $link = $movie['link'];
                    continue;
                }
                @endphp
                @if(!empty($movie['Title']))
                <h3 class="my-4">{{$movie["Title"]}}</h3>
      <div class="row">
        <div class="col-md-3 col-sm-3">
          <div>
            @php
                $img = $movie["Poster"];
                $url = $img;
                $header_response = get_headers($url, 1);
                if ( strpos( $header_response[0], "403" ) !== false || strpos( $header_response[0], "404" ) !== false)
                {
                 // FILE DOES NOT EXIST
                  $img = '/storage/images/noimage.png';
                } 
              @endphp
              <img class="card-img-top" src="{{$img}}" alt="Card image">
              
          </div>
        </div>
        <div class="col-md-9 col-sm-9">
            <video class="video" src="{{$link}}" controls></video>
        </div>
      </div>
      <div class="row my-4">
        <div class="col-md-3">
          <!-- A vertical navbar -->
          <nav class="navbar bg-light sidenav">

            <!-- Links -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <strong>Year: </strong> {{$movie["Year"]}}
              </li>
              <li class="nav-item">
                <strong>Released: </strong> {{$movie["Released"]}}
              </li>
              <li class="nav-item">
                <strong>Duration: </strong> {{$movie["Runtime"]}} min
              </li>
              <li class="nav-item">
                <strong>Director: </strong> {{$movie["Director"]}}
              </li>
              <li class="nav-item">
                <strong>Imdb rating: </strong> {{$movie["imdbRating"]}}
              </li>
              <li class="nav-item">
                <strong>Language: </strong> {{$movie["Language"]}} 
              </li>
              <li class="nav-item">
                <strong>Imdb rating: </strong> <p class="btn btn-success btn-sm"> {{$movie["imdbRating"]}}</p>
              </li>
            </ul>
          </nav>
        </div>
        <div class="col-md-9">
          <p><strong>Country: {{$movie["Language"]}} </strong> | <strong> Genre: {{$movie["Genre"]}} </strong></p>
          <p><strong>Writers: </strong> {{$movie["Writer"]}} </p>
          <p><strong>Actors: </strong> {{$movie["Actors"]}} </p>
          <p class="my-5">{{$movie["Plot"]}} </p>
          
        @auth
            @if(Auth::user()->type == "admin")
                <hr>
                <div class="row">
                <a href="/movies/{{$id}}/edit" class="btn m-3 btn-primary">Edit</a>
                <form method='POST' action="/movies/{{$id}}">
                     @csrf
                     @method('DELETE')
                    <input type="submit" class=" pull-right m-3 btn btn-danger" value="Delete">
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
                    <input type="hidden" name="movie_id" value="{{$id}}">
                </div>
                <div class="form-group">
                    <input type="hidden" name="series_id" value="">
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
                        <p><span>{{ $comment->user->name }}</span> <span>| {{ $comment->created_at }}</span></h4>
                        <h5 class="m-3">{{ $comment->body }}</h5>
                        @if(auth()->user()->id == $comment->user->id)
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
        </div>
      </div>
                       
                @endif
            @endforeach
      
    </div>
    

 
@endsection
