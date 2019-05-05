@extends('layouts.app')
@section('content')
    <h1>Animes</h1>
    <div class="list-group">
        @if(count($animes) > 0)
            @php
            $id;
            $link;
            $type;
            @endphp
            @foreach($animes as $anime)
                @php
                if(!empty($anime['link'])&& !empty($anime['id']))
                {
                    $id = $anime['id'];
                    $link = $anime['link'];
                    $type = $anime['type'];
                    continue;
                }
                @endphp
                @if(!empty($anime['Title']))
                <div class="list-group-item">
                    <div class="row">
                        <a href="/{{$type}}/{{$id}}">{{$anime["Title"]}}</a>
                        <br>
                        {{$anime["Year"]}}
                        <br>
                        {{$anime["Rated"]}}
                        <br>
                        {{$anime["Released"]}}
                        <br>
                        {{$anime["Runtime"]}}
                        <br>
                        {{$anime["Genre"]}}
                        <br>
                        {{$anime["Director"]}}
                        <br>
                        {{$anime["Writer"]}}
                        <br>
                        {{$anime["Actors"]}}
                        <br>
                        {{$anime["Plot"]}}
                        <br>
                        {{$anime["Language"]}}
                        <br>
                        {{$anime["Country"]}}
                        <br>
                        {{$anime["Awards"]}}
                        <br>
                        <img src="{{$anime["Poster"]}}" style="width: 10%;">
                        <br>
                        {{$anime["imdbRating"]}}
                        <br>
                        {{$anime["imdbVotes"]}}
                        <br>
                        {{$anime["imdbID"]}}
                        <br>
                        {{$anime["Type"]}}
                        <br>
                        {{$anime["Metascore"]}}
                        <br>
                        <br>
                        {{$link}}
                        <br>
                    </div>
                </div>
                @endif
            @endforeach
            {{-- {{$links}} --}}
        @else
            <p>No Anime Found</p>
        @endif
    </div>
@endsection
