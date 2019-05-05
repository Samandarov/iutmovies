@extends('layouts.app')
@section('content')
    <h1>Series</h1>
    <div class="list-group">
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
                    $link = $ser['link'];
                    $title = $ser['title'];
                    continue;
                }
                @endphp
                @if(!empty($ser['Title']))
                <div class="list-group-item">
                    <div class="row">
                        <a href="/series/{{$id}}">
                            <h3>
                                {{$title}} -
                                Season: {{$ser["Season"]}}
                                Episode: {{$ser["Episode"]}}
                            </h3>
                    </a>
                        {{$ser["Title"]}}
                        <br>
                        Season: {{$ser["Season"]}}
                        <br>
                        Episode: {{$ser["Episode"]}}
                        <br>
                        {{$ser["Year"]}}
                        <br>
                        {{$ser["Rated"]}}
                        <br>
                        {{$ser["Released"]}}
                        <br>
                        {{$ser["Runtime"]}}
                        <br>
                        {{$ser["Genre"]}}
                        <br>
                        {{$ser["Director"]}}
                        <br>
                        {{$ser["Writer"]}}
                        <br>
                        {{$ser["Actors"]}}
                        <br>
                        {{$ser["Plot"]}}
                        <br>
                        {{$ser["Language"]}}
                        <br>
                        {{$ser["Country"]}}
                        <br>
                        {{$ser["Awards"]}}
                        <br>
                        <img src="{{$ser["Poster"]}}" style="width: 10%;">
                        <br>
                        {{$ser["imdbRating"]}}
                        <br>
                        {{$ser["imdbVotes"]}}
                        <br>
                        {{$ser["imdbID"]}}
                        <br>
                        {{$ser["Type"]}}
                        <br>
                        {{$ser["Metascore"]}}
                        <br>
                        <br>
                        {{$link}}
                        <br>
                    </div>
                </div>
                @endif
            @endforeach
            {{$links}}
        @else
            <p>No Series Found</p>
        @endif
    </div>
@endsection
