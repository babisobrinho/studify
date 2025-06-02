<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Track;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
public function index()
{
    $perPage = request('perPage', 10);
    
    $query = Track::with(['user', 'tags'])
        ->orderBy('created_at', 'desc');

    // Filtro por dificuldade (com tratamento para Enum)
    if (request()->has('difficulty') && request('difficulty') != '') {
        $query->where('difficulty', request('difficulty'));
    }

    // Restante dos filtros permanecem iguais
    if (request()->has('is_public') && request('is_public') !== '') {
        $query->where('is_public', request('is_public'));
    }

    if (request()->has('is_official') && request('is_official') !== '') {
        $query->where('is_official', request('is_official'));
    }

    $tracks = $query->paginate($perPage)
                  ->appends(request()->query());

    return view('admin.tracks.index', compact('tracks'));
}

    /**
     * Show the form for creating a new track.
     */
    public function create()
{
    $instructors = User::whereHas('roles', function($query) {
        $query->whereIn('name', ['admin', 'curator']);
    })->get();

    $tags = Tag::all();
    $difficultyLevels = [
        'beginner' => 'Iniciante',
        'intermediate' => 'Intermediário', 
        'advanced' => 'Avançado'
    ];

    return view('admin.tracks.create', compact('instructors', 'tags', 'difficultyLevels'));
}

    /**
     * Store a newly created track in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'slug' => 'required|string|max:120|unique:tracks,slug',
            'user_id' => 'required|exists:users,id',
            'description' => 'required|string',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'is_official' => 'sometimes|boolean',
            'is_public' => 'sometimes|boolean',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $validated['is_official'] = $request->has('is_official');
        $validated['is_public'] = $request->has('is_public');

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('tracks/covers', 'public');
            $validated['cover_image'] = $path;
        }

        $track = Track::create($validated);

        if ($request->has('tags')) {
            $track->tags()->sync($request->tags);
        }

        return redirect()->route('admin.tracks.index')
            ->with('success', 'Curso criado com sucesso!');
    }

    /**
     * Show the form for editing the specified track.
     */
    public function edit(Track $track)
{
    $instructors = User::whereHas('roles', function($query) {
        $query->whereIn('name', ['admin', 'curator']);
    })->get();

    $tags = Tag::all();
    
    return view('admin.tracks.edit', [
        'track' => $track,
        'instructors' => $instructors,
        'tags' => $tags,
        'difficultyLevels' => [
            'beginner' => 'Iniciante',
            'intermediate' => 'Intermediário',
            'advanced' => 'Avançado'
        ]
    ]);
}

    /**
     * Update the specified track in storage.
     */
    public function update(Request $request, Track $track)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'slug' => 'required|string|max:120|unique:tracks,slug,'.$track->id,
            'user_id' => 'required|exists:users,id',
            'description' => 'required|string',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'is_official' => 'sometimes|boolean',
            'is_public' => 'sometimes|boolean',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $validated['is_official'] = $request->has('is_official');
        $validated['is_public'] = $request->has('is_public');

        if ($request->hasFile('cover_image')) {
            if ($track->cover_image) {
                Storage::disk('public')->delete($track->cover_image);
            }
            
            $path = $request->file('cover_image')->store('tracks/covers', 'public');
            $validated['cover_image'] = $path;
        }

        $track->update($validated);
        $track->tags()->sync($request->tags ?? []);

        return redirect()->route('admin.tracks.index')
            ->with('success', 'Curso atualizado com sucesso!');
    }

    /**
     * Remove the specified track from storage.
     */
    public function destroy(Track $track)
    {
        if ($track->cover_image) {
            Storage::disk('public')->delete($track->cover_image);
        }

        $track->delete();

        return redirect()->route('admin.tracks.index')
            ->with('success', 'Curso removido com sucesso!');
    }
    
    public function show(Track $track)
    {
        // Carrega todos os relacionamentos necessários
        $track->load([
            'user', 
            'tags', 
            'steps' => function($query) {
                $query->orderBy('position');
            }, 
            'userTracks',
            'certificates',
            'ratings'
        ]);

        return view('admin.tracks.show', compact('track'));
    }
}