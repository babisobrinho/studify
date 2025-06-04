<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index()
    {
        $tracks = Track::official()
            ->with(['ratings'])
            ->withAvg('ratings as average_rating', 'rating')
            ->having('average_rating', '=', 5)
            ->get();

        return view('landing.index', compact('tracks'));
    }

    /**
     * Display the about page.
     */
    public function about()
    {
        return view('landing.about');
    }
}
