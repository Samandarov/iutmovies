@extends('layouts.app')
@section('content')

<style type="text/css">
    .card{
        height: 450px;
    }
    .card img{
        height: 170px;
        width: 100%;
        object-fit: cover;
    }
</style>
  <div class="container-fluid mainMovies">
    <div class="row" id="movies">
      <div class="col-md-12">
        <h3>Movies</h3>
        <div class="row">
            @if(count($movies) > 0)
            @php
            $id;
            $link;
            @endphp
                <div class="row">

            @foreach($movies as $movie)
                @php
                if(!empty($movie['link'])&& !empty($movie['id']))
                {
                    $id = $movie['id'];
                    continue;
                }
                @endphp
                @if(!empty($movie['Title']))
                    <div class="col-md-3">
                        <a href="/movies/{{$id}}">
                        <div class="card"> 
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
                            <div class="card-body">
                              <h6 class="card-title">{{$movie["Title"]}} <br> {{$movie["Country"]}} ({{$movie["Year"]}})</h6>
                              <p class="movies-info">{{$movie["Runtime"]}} min   -   {{$movie["Genre"]}}</p>
                              <p class="movies-director"><strong>Director:</strong> {{$movie["Director"]}}</p>
                              <p class="actors"><strong>Actors:</strong>{{$movie["Actors"]}}</p>
                              <p class="card-text">
                                {{$movie["Plot"]}}</p>
                            </div>
                          </a>
                      </div>
                      </div>
                    @endif
            @endforeach
            </div>
            <div class="row" style="position: relative; margin:  0 auto;">
                {{$mlinks}}
            </div>
        @else
            <p>No Movie Found</p>
        @endif
        </div>
      </div>
    </div>

    <div class="row" id="series">
      <div class="col-md-12">
        <h3>Series</h3>
        <div class="row">
          @if(count($series) > 0)
            @php
            $id;
            $link;
            @endphp
            @foreach($series as $ser)
                @php
                if(!empty($ser['link'])&& !empty($ser['id']))
                {
                    $id = $ser['id'];
                    $title = $ser['title'];
                    continue;
                }
                @endphp
                @if(!empty($ser['Title']))

                  <div class="col-md-3">
                      <a href="/series/{{$id}}">
                        <div class="card">
                          @php
                            $img = $ser["Poster"];
                            $url = $img;
                            $header_response = get_headers($url, 1);
                            if ( strpos( $header_response[0], "403" ) !== false)
                            {
                             // FILE DOES NOT EXIST
                              $img = '/storage/images/noimage.png';
                            } 
                          @endphp
                          <img class="card-img-top" src="{{$img}}" alt="Card image">
                          <div class="card-body">
                            <h6 class="card-title">{{$title}}<br> {{$ser["Country"]}}({{$ser["Year"]}})</h6>
                            <p class="movies-info">{{$ser["Runtime"]}} min   -   {{$ser["Genre"]}}</p>
                            <p class="movies-director"><strong>Director:</strong> {{$ser["Director"]}}</p>
                            <p class="actors"><strong>Actors:</strong>  {{$ser["Actors"]}}</p>
                            <p class="card-text">{{$ser["Plot"]}}</p>
                          </div>
                        </div>
                      </a>
                  </div>

                @endif
            @endforeach
            {{$slinks}}
          @else
            <p>No Series Found</p>
          @endif
      </div>
    </div>
  </div>
  </div>

<script src="data/js/owl.carousel.min.js"></script>
@endsection
