<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Series;
use App\Movie;


class AnimesController extends Controller
{
    public function index()
    {
		
    $client = new \GuzzleHttp\Client();
        $series = Series::where('type','anime')->orderBy('title','asc')->get();
        $data = [];
        foreach ($series as $s) {
            $res = $client->request('GET', 'http://www.omdbapi.com/?apikey=1150ac4&i='.$s->imdb_id);
            array_push($data, ["id" => $s->id,"link" => $s->link, "type" => "series"]);
            array_push($data, json_decode($res->getBody(), true));
        }
        $movies = Movie::where('type','anime')->orderBy('title','asc')->get();
        foreach ($movies as $movie) {
            $res = $client->request('GET', 'http://www.omdbapi.com/?apikey=1150ac4&i='.$movie->imdb_id);
            array_push($data, ["id" => $movie->id,"link" => $movie->link,"type" => "movies"]);
            array_push($data, json_decode($res->getBody(), true));
        }
        
        return view('animes.index')->with('animes', $data);
    }

    public function show($imdb_id)
    {
       $client = new \GuzzleHttp\Client();
       $series = Series::findOrFail('imdb_id',$imdb_id);
       $movie = Movie::findOrFail('imdb_id',$imdb_id);
       $link = '';
       if (!empty($series))
       {
	       	$link = $series->link;
       }
       else if (!empty($movie))
       {
       		$link = $movie->link;
       }

       $res = $client->request('GET', 'http://www.omdbapi.com/?apikey=1150ac4&i='.$imdb_id);
            array_push($data , [json_decode($res->getBody(), true),"link" => $link]);
        return view('animes.show')->with('anime', $data);   
    }
}
