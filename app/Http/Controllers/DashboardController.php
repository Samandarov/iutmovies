<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Series;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->type != "admin")
            return back()->with('error', 'No Authority');
        $movies = Movie::all();
        $series = Series::all();
        return view('dashboard')->with('movies', $movies)->with('series', $series);
    }
}
