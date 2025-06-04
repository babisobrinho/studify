<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index()
    {
        $tracks = Track::official()
            ->with('ratings')
            ->get()
            ->map(function ($track) {
                $track->average_rating = $track->ratings->avg('rating') ?? 0;
                return $track;
            })
            ->sortByDesc('average_rating')
            ->take(6);

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
