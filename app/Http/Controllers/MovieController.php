<?php

namespace App\Http\Controllers;

use App\Series;
use App\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index', 'show']]);
    }
    
    public function index()
    {
        $client = new \GuzzleHttp\Client();
        $movies = Movie::orderBy('title','asc')->paginate(4,['*'], 'mlinks');
        $mdata = [];
        foreach ($movies as $movie) {
            $res = $client->request('GET', 'http://www.omdbapi.com/?apikey=1150ac4&i='.$movie->imdb_id);
            array_push($mdata, ["id" => $movie->id,"link" => $movie->link]);
            array_push($mdata, json_decode($res->getBody(), true));
        }

        $series = Series::orderBy('title','asc')->paginate(4, ['*'], 'slinks');
        $sdata = [];
        foreach ($series as $s) {
            $res = $client->request('GET', 'http://www.omdbapi.com/?apikey=1150ac4&i='.$s->imdb_id);
            array_push($sdata, ["id" => $s->id,"title" => $s->title,"link" => $s->link]);
            array_push($sdata, json_decode($res->getBody(), true));
        }
        
        $animeseries = Series::where('type','anime')->orderBy('title','asc')->get();
        $adata = [];
        foreach ($animeseries as $s) {
            $res = $client->request('GET', 'http://www.omdbapi.com/?apikey=1150ac4&i='.$s->imdb_id);
            array_push($adata, ["id" => $s->id,"link" => $s->link, "type" => "series"]);
            array_push($adata, json_decode($res->getBody(), true));
        }
        $animemovies = Movie::where('type','anime')->orderBy('title','asc')->get();
        foreach ($animemovies as $movie) {
            $res = $client->request('GET', 'http://www.omdbapi.com/?apikey=1150ac4&i='.$movie->imdb_id);
            array_push($adata, ["id" => $movie->id,"link" => $movie->link,"type" => "movies"]);
            array_push($adata, json_decode($res->getBody(), true));
        }


        // var_dump($data);
        // die;
        return view('movies.index')->with('movies', $mdata)->with('mlinks', $movies->links())->with('series', $sdata)->with('slinks', $series->links())->with('animes', $adata);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->type != "admin"){
            return redirect('/')->with('error', 'Authentification Privilage Error');
        }
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->type != "admin"){
            return redirect('/')->with('error', 'Authentification Privilage Error');
        }
        $this->validate($request, [
            'title' => ['required','max:191','string'],
            'imdb_id' => 'required',
            'type' => ['required','in:movie,anime'],
            'link' => ['required','active_url'],
        ]);
        $movie = new Movie;
        $movie->title = $request->input('title'); 
        $movie->imdb_id = $request->input('imdb_id'); 
        $movie->type = $request->input('type');
        $movie->link = $request->input('link'); 
        $movie->save();
        return redirect('/movies')->with('success','Movie Added');    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = new \GuzzleHttp\Client();
        $movie = Movie::findOrFail($id);
        $res = $client->request('GET', 'http://www.omdbapi.com/?apikey=1150ac4&i='.$movie->imdb_id);
        $data = [];
        array_push($data, ["id" => $movie->id,"link" => $movie->link]);
        array_push($data, json_decode($res->getBody(), true));
        // var_dump($data);
        // die;
        return view('movies.show')->with('movie', $data)->with('comments',$movie->comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->type != "admin"){
            return redirect('/')->with('error', 'Authentification Privilage Error');
        }
        $movie = Movie::findOrFail($id);
        return view('movies.edit')->with('movie', $movie);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->type != "admin"){
            return redirect('/')->with('error', 'Authentification Privilage Error');
        }
        $this->validate($request, [
            'title' => ['required','max:191','string'],
            'imdb_id' => 'required',
            'type' => ['required','in:movie,anime'],
            'link' => ['required','active_url'],
        ]);
        $movie = Movie::findOrFail($id);
        $movie->title = $request->input('title'); 
        $movie->imdb_id = $request->input('imdb_id'); 
        $movie->type = $request->input('type');
        $movie->link = $request->input('link'); 
        $movie->save();
        return redirect('/movies')->with('success','Movie Updated');    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->type != "admin"){
            return redirect('/')->with('error', 'Authentification Privilage Error');
        }
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect('/movies')->with('success','Movie Deleted');
    }
}
