<?php

namespace App\Http\Controllers;

use App\Models\Track;
use App\Models\User;
use App\Models\Step;
use App\Models\Tag;
use App\Models\Rating;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $tracks = Track::where('user_id', $user->id)->get();

        return view('tracks.index', compact('user', 'tracks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        // Buscar todas as tags disponíveis para exibir no formulário
        $availableTags = Tag::all();

        return view('tracks.create', compact('user', 'availableTags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
            'difficulty' => 'required|string|in:beginner,intermediate,advanced',
            'category_id' => 'required|exists:category,id', // Adicionada validação para o campo category_id
            'technologies' => 'nullable|array',
            'steps' => 'nullable|array',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'plan_color' => 'nullable|string|max:7',
        ]);

        // Criar o track
        $track = new Track();
        $track->title = $validated['title'];
        $track->slug = Str::slug($validated['title']);
        $track->description = $validated['description'] ?? null;
        $track->is_public = $validated['is_public'] ?? 1;
        $track->difficulty = $validated['difficulty'];
        $track->category_id = $validated['category_id']; // Adicionada atribuição do campo category_id
        $track->user_id = $user->id;
        $track->plan_color = $request->input('plan_color', '#06d6a0');

        // Processar upload da imagem
        if ($request->hasFile('cover_image') && $request->file('cover_image')->isValid()) {
            $image = $request->file('cover_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/tracks/covers'), $imageName);
            $track->cover_image = 'tracks/covers/' . $imageName;
        }

        $track->save();
        // Salvar as tecnologias selecionadas na tabela track_tags
        if (!empty($validated['technologies'])) {
            // Verificar quais tags realmente existem no banco de dados
            $existingTagIds = Tag::whereIn('id', $validated['technologies'])->pluck('id')->toArray();

            // Associar apenas as tags que existem
            foreach ($existingTagIds as $tagId) {
                DB::table('track_tags')->insert([
                    'track_id' => $track->id,
                    'tag_id' => $tagId
                ]);
            }
        }

        // Processar os steps se existirem
        if (isset($validated['steps']) && is_array($validated['steps'])) {
            foreach ($validated['steps'] as $index => $stepData) {
                $stepData = json_decode($stepData, true);

                // Criar um novo step para este track
                $step = new Step();
                $step->track_id = $track->id;
                $step->title = $stepData['title'];
                $step->content_url = $stepData['url'];
                $step->content_type = $stepData['type'];
                $step->position = $index + 1; // Usar a posição no array como position
                $step->description = $stepData['description'] ?? 'Conteúdo do plano de estudos'; // Campo obrigatório
                $step->external_resource = $stepData['external_resource'] ?? 1; // Campo obrigatório
                $step->estimated_time = $stepData['estimated_time'] ?? 30; // Campo obrigatório (tempo em minutos)
                $step->save();
            }
        }

        // Garantir redirecionamento para a página de visualização
        return redirect()->route('tracks.show', ['username' => $username, 'id' => $track->id])
            ->with('success', 'Plano de estudos criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, string $id)
    {
        $user = User::where('username', $username)->firstOrFail();
        $track = Track::where('id', $id)->firstOrFail();

        // Carrega os relacionamentos normais
        $track->load([
            'steps' => function($query) {
                $query->orderBy('position');
            },
            'tags',
            'category'
        ]);

        // Obter os steps separadamente para usar na view
        $steps = $track->steps()->orderBy('position')->get();

        // Restante do código permanece igual...
        $ratings = $track->ratings()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $avgRating = $track->average_rating;
        $ratingsCount = $track->ratings->count();
        
        $ratingDistribution = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingDistribution[$i] = $track->ratings->where('rating', $i)->count();
        }

        $userHasRated = auth()->check() 
            ? $track->ratings->contains('user_id', auth()->id())
            : false;

        return view('tracks.show', compact(
            'user',
            'track',
            'steps', // Adicione esta linha
            'ratings',
            'avgRating',
            'ratingsCount',
            'ratingDistribution',
            'userHasRated'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $username, string $id)
    {
        $user = User::where('username', $username)->firstOrFail();
        $track = Track::where('id', $id)->firstOrFail();

        // Buscar todas as tags disponíveis para exibir no formulário
        $availableTags = Tag::all();

        // Buscar as tags associadas a este track
        $trackTags = DB::table('track_tags')
            ->where('track_id', $track->id)
            ->pluck('tag_id')
            ->toArray();

        // Buscar os steps associados a este track, ordenados por position
        $steps = Step::where('track_id', $track->id)
            ->orderBy('position')
            ->get();

        return view('tracks.edit', compact('user', 'track', 'trackTags', 'steps', 'availableTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $username, string $id)
    {
        $user = User::where('username', $username)->firstOrFail();
        $track = Track::where('id', $id)->firstOrFail();

        // Verificar se o usuário é o proprietário do track
        if ($track->user_id !== $user->id) {
            return redirect()->route('tracks.index', ['username' => $username])
                ->with('error', 'Você não tem permissão para editar este plano de estudos.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
            'difficulty' => 'required|string|in:beginner,intermediate,advanced',
            'category_id' => 'required|exists:category,id', // Adicionada validação para o campo category_id
            'technologies' => 'nullable|array',
            'steps' => 'nullable|array',
            'plan_color' => 'nullable|string|max:7',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adicionada validação para o campo cover_image
        ]);

        // Atualizar o track
        $track->title = $validated['title'];
        $track->slug = Str::slug($validated['title']); // Atualizar slug se o título mudar
        $track->description = $validated['description'] ?? null;
        $track->is_public = $validated['is_public'] ?? 1;
        $track->difficulty = $validated['difficulty'];
        $track->category_id = $validated['category_id']; // Adicionada atribuição do campo category_id
        $track->plan_color = $request->input('plan_color', $track->plan_color ?? '#06d6a0');

        // Processar upload da imagem (se houver)
        if ($request->hasFile('cover_image') && $request->file('cover_image')->isValid()) {
            $image = $request->file('cover_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/tracks/covers'), $imageName);
            $track->cover_image = 'tracks/covers/' . $imageName;
        }

        $track->save();

        // Atualizar as tecnologias selecionadas
        if (isset($validated['technologies'])) {
            // Remover todas as tags existentes
            DB::table('track_tags')->where('track_id', $track->id)->delete();

            // Verificar quais tags realmente existem no banco de dados
            $existingTagIds = Tag::whereIn('id', $validated['technologies'])->pluck('id')->toArray();

            // Adicionar as novas tags selecionadas que existem
            foreach ($existingTagIds as $tagId) {
                DB::table('track_tags')->insert([
                    'track_id' => $track->id,
                    'tag_id' => $tagId
                ]);
            }
        }

        // Processar os steps se existirem
        if (isset($validated['steps']) && is_array($validated['steps'])) {
            // Remover steps existentes
            Step::where('track_id', $track->id)->delete();

            // Adicionar novos steps
            foreach ($validated['steps'] as $index => $stepData) {
                $stepData = json_decode($stepData, true);

                $step = new Step();
                $step->track_id = $track->id;
                $step->title = $stepData['title'];
                $step->content_url = $stepData['url'];
                $step->content_type = $stepData['type'];
                $step->position = $index + 1; // Usar a posição no array como position
                $step->description = $stepData['description'] ?? 'Conteúdo do plano de estudos'; // Campo obrigatório
                $step->external_resource = $stepData['external_resource'] ?? 1; // Campo obrigatório
                $step->estimated_time = $stepData['estimated_time'] ?? 30; // Campo obrigatório (tempo em minutos)
                $step->save();
            }
        }

        // Garantir redirecionamento para a página de visualização
        return redirect()->route('tracks.show', ['username' => $username, 'id' => $track->id])
            ->with('success', 'Plano de estudos atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $username, string $id)
    {
        $user = User::where('username', $username)->firstOrFail();
        $track = Track::where('id', $id)->firstOrFail();

        // Verificar se o usuário é o proprietário do track
        if ($track->user_id !== $user->id) {
            return redirect()->route('tracks.index', ['username' => $username])
                ->with('error', 'Você não tem permissão para excluir este plano de estudos.');
        }

        // Remover as relações na tabela track_tags
        DB::table('track_tags')->where('track_id', $track->id)->delete();

        // Excluir steps relacionados
        Step::where('track_id', $track->id)->delete();

        // Excluir o track
        $track->delete();

        return redirect()->route('tracks.index', ['username' => $username])
            ->with('success', 'Plano de estudos excluído com sucesso!');
    }

    public function rate(Request $request, string $username, Track $track)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'review' => 'nullable|string|max:500',
        ]);

        // Check if user already rated this track
        if ($track->ratings()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'Você já avaliou esta trilha.');
        }

        // Create new rating
        Rating::create([
            'user_id' => auth()->id(),
            'track_id' => $track->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return back()->with('success', 'Avaliação enviada com sucesso!');
    }

    public function comment(Request $request, string $username, Track $track) {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->track_id = $track->id;
        $comment->content = $request->input('comment');
        $comment->save();

        return redirect()->back()
            ->with('success', 'Comentário adicionado com sucesso!');
    }
}
