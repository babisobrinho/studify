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
    //public function index(string $username)
    public function index()
    {
       /** $userId = User::where('name', $username)->firstOrFail();
        $tracks = Track::where('user_id',$userId)->firstOrFail();
        return view('users.tracks.index', compact('tracks'));
        */
        return view('tracks.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tracks.create');
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
    public function show()
    {
        return view('tracks.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('tracks.edit');
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
