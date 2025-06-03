<?php

namespace App\Http\Controllers;

use App\Models\Track;
use App\Models\User;
use App\Models\Step;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        return view('users.tracks.index', compact('user', 'tracks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        // Buscar todas as tags disponíveis para exibir no formulário
        $availableTags = Tag::all();

        return view('users.tracks.create', compact('user', 'availableTags'));
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
            'category_id' => 'required|exists:categories,id', // Adicionada validação para o campo category_id
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
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('tracks/covers', 'public');
            $track->cover_image = $path;
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

        // Carregar os steps associados a este track, ordenados por position
        $steps = Step::where('track_id', $track->id)
            ->orderBy('position')
            ->get();

        // Carregar as tags associadas a este track (com filtro rigoroso)
        $tagsQuery = DB::table('track_tags')
            ->join('tags', 'track_tags.tag_id', '=', 'tags.id')
            ->where('track_tags.track_id', $track->id)
            ->select('tags.*');

// Obter os resultados como array para manipulação
        $tagsArray = $tagsQuery->get()->toArray();

// Filtrar manualmente para remover qualquer tag com nome vazio ou nulo
        $filteredTags = [];
        foreach ($tagsArray as $tag) {
            if (isset($tag->name) && !empty($tag->name) && trim($tag->name) !== '') {
                $filteredTags[] = $tag;
            }
        }

// Converter de volta para collection
        $tags = collect($filteredTags);



        // Carregar a categoria do track
        $category = null;
        if ($track->category_id) {
            $category = DB::table('categories')->where('id', $track->category_id)->first();
        }

        // Carregar estatísticas do track (likes, visualizações)
        $likesCount = DB::table('likes')
            ->where('track_id', $track->id)
            ->count();

        // Carregar avaliações do track
        $ratings = DB::table('ratings')
            ->where('track_id', $track->id)
            ->get();

        $avgRating = $ratings->avg('rating') ?? 0;

        return view('users.tracks.show', compact('user', 'track', 'steps', 'tags', 'category', 'likesCount', 'avgRating'));
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

        return view('users.tracks.edit', compact('user', 'track', 'trackTags', 'steps', 'availableTags'));
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
            'category_id' => 'required|exists:categories,id', // Adicionada validação para o campo category_id
            'technologies' => 'nullable|array',
            'steps' => 'nullable|array',
            'plan_color' => 'nullable|string|max:7',
        ]);

        // Atualizar o track
        $track->title = $validated['title'];
        $track->slug = Str::slug($validated['title']); // Atualizar slug se o título mudar
        $track->description = $validated['description'] ?? null;
        $track->is_public = $validated['is_public'] ?? 1;
        $track->difficulty = $validated['difficulty'];
        $track->category_id = $validated['category_id']; // Adicionada atribuição do campo category_id
        $track->plan_color = $request->input('plan_color', $track->plan_color ?? '#06d6a0');
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
}
