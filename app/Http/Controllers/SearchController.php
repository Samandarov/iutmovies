<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Series;

class SearchController extends Controller
{
    public function search(Request $request)
    {
    	$client = new \GuzzleHttp\Client();
        $movies = Movie::where('title','like','%'.$request->input('query').'%')->orderBy('title','asc')->paginate(10);
        $mdata = [];
        foreach ($movies as $movie) {
            $res = $client->request('GET', 'http://www.omdbapi.com/?apikey=1150ac4&i='.$movie->imdb_id);
            array_push($mdata, ["id" => $movie->id,"link" => $movie->link]);
            array_push($mdata, json_decode($res->getBody(), true));
        }
 
    	$client = new \GuzzleHttp\Client();
        $series = Series::where('title','like','%'.$request->input('query').'%')->orderBy('title','asc')->paginate(10);
        $sdata = [];
        foreach ($series as $s) {
            $res = $client->request('GET', 'http://www.omdbapi.com/?apikey=1150ac4&i='.$s->imdb_id);
            array_push($sdata, ["id" => $s->id,"title" => $s->title,"link" => $s->link]);
            array_push($sdata, json_decode($res->getBody(), true));
        }

    	return view('search')->with("series", $sdata)->with("movies", $mdata)->with("slinks", $series->links())->with("mlinks", $movies->links());
    }
}
