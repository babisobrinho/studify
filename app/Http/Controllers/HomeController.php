<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Step;
use App\Models\UserStep;
use App\Models\Track;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentUser = auth()->user();
        $lastCompletedUserStep = UserStep::where('user_id', $currentUser->id)
                                        ->whereNotNull('completed_at')
                                        ->orderByDesc('completed_at')
                                        ->first();
        $lastStep = Step::find($lastCompletedUserStep->step_id);
        $lastTrack = Track::find($lastStep->track_id);
        $lastTrackSteps = Step::where('track_id', $lastStep->track_id)->get();

        return view('home', compact('currentUser', 'lastStep', 'lastTrack', 'lastTrackSteps'));
    }
}
