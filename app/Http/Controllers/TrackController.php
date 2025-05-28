<?php

namespace App\Http\Controllers;

use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $username)
    {
        
        $user = User::where('username', $username)->firstOrFail();
        $tracks = Track::where('user_id', $user->id)->get();
        
        return view('users.tracks.index', compact('user', 'tracks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.tracks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, string $id)
    {
        $user = User::where('username', $username)->firstOrFail();
        $track = Track::where('id', $id)->firstOrFail();

        return view('users.tracks.show', compact('user', 'track'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('users.tracks.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
