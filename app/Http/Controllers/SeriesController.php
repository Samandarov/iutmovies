<?php

namespace App\Http\Controllers;

use App\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['show']]);
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
        return view('series.create');
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
            'title' => ['required', 'string', 'max:191'],
            'imdb_id' => 'required',
            'type' => ['required', 'in:series,anime'],
            'season' => ['required','min:1','numeric'],
            'episode' => ['required','min:1','numeric'],
            'link' => ['required','active_url'],
        ]);
        $series = new Series;
        $series->title = $request->input('title'); 
        $series->imdb_id = $request->input('imdb_id'); 
        $series->type = $request->input('type');
        $series->season = $request->input('season');
        $series->episode = $request->input('episode');
        $series->link = $request->input('link'); 
        $series->save();
        return redirect('/series')->with('success','Series Added');    
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = new \GuzzleHttp\Client();
        $series = Series::findOrFail($id);
        $res = $client->request('GET', 'http://www.omdbapi.com/?apikey=1150ac4&i='.$series->imdb_id);
        $data = [];
        array_push($data, ["id" => $series->id,"link" => $series->link]);
        array_push($data, json_decode($res->getBody(), true));
        // var_dump($data);
        // die;
        return view('series.show')->with('series', $data)->with('comments', $series->comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->type != "admin"){
            return redirect('/')->with('error', 'Authentification Privilage Error');
        }
        $series = Series::findOrFail($id);
        return view('series.edit')->with('series', $series);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->type != "admin"){
            return redirect('/')->with('error', 'Authentification Privilage Error');
        }
        $this->validate($request, [
            'title' => ['required', 'string', 'max:191'],
            'imdb_id' => 'required',
            'type' => ['required', 'in:series,anime'],
            'season' => ['required','min:1','numeric'],
            'episode' => ['required','min:1','numeric'],
            'link' => ['required','active_url'],
        ]);
        $series = Series::findOrFail($id);
        $series->title = $request->input('title'); 
        $series->imdb_id = $request->input('imdb_id'); 
        $series->type = $request->input('type');
        $series->season = $request->input('season');
        $series->episode = $request->input('episode');
        $series->link = $request->input('link'); 
        $series->save();
        return redirect('/series')->with('success','Series Updated');    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->type != "admin"){
            return redirect('/')->with('error', 'Authentification Privilage Error');
        }
        $series = Series::findOrFail($id);
        $series->delete();
        return redirect('/series')->with('success','Series Deleted');
    
    }
}
