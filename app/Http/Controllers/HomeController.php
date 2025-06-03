<?php

namespace App\Http\Controllers;

use App\Models\Track;
use App\Models\Rating;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }
    public function sobre()
    {

        return view('sobre');
    }
    public function welcome()
    {
        $tracks = Track::official()
            ->with(['ratings'])
            ->withAvg('ratings as average_rating', 'rating')
            ->having('average_rating', '=', 5)
            ->get();
        return view('welcome', compact('tracks'));
    }
}
