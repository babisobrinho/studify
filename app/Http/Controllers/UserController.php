<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Track;
use App\Models\Badge;
use App\Models\UserBadge;
use App\Models\UserTrack;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function profile(string $username)
    {
        // Buscar o usuário pelo username
        $user = User::where('username', $username)->firstOrFail();

        // Buscar os cursos/tracks concluídos pelo usuário
        $completedTracks = UserTrack::with(['track' => function($query) {
                $query->withCount('steps');
            }])
            ->where('user_id', $user->id)
            ->whereNotNull('completed_at')
            ->orderBy('completed_at', 'desc')
            ->get();

        // Formatar os cursos para exibição
        $formattedCourses = $completedTracks->map(function($userTrack) {
            return [
                'title' => $userTrack->track->title,
                'hours' => round($userTrack->track->steps->sum('estimated_time') / 60, 1),
                'teacher' => 'Professor do Curso', // Você pode adicionar um campo de professor na tabela tracks se necessário
                'completed_at' => $userTrack->completed_at->format('d/m/Y'),
                'certificate_url' => route('certificate.show', ['track' => $userTrack->track->id]),
                'linkedin_url' => '#'
            ];
        });

        // Buscar as badges/conquistas do usuário
        $badges = UserBadge::with('badge')
            ->where('user_id', $user->id)
            ->orderBy('earned_at', 'desc')
            ->get()
            ->pluck('badge');

        // Calcular XP total (você pode ter uma tabela separada para XP ou calcular com base em cursos concluídos)
        $totalXP = $completedTracks->count() * 100; // Exemplo: 100 XP por curso concluído

        // Gerar dados de atividade (você pode ter uma tabela de atividades ou usar os acessos aos cursos)
        $activityData = $this->generateActivityData($user);

        return view('users.profile', [
            'user' => $user,
            'courses' => $formattedCourses,
            'badges' => $badges,
            'totalXP' => $totalXP,
            'coursesCount' => $completedTracks->count(),
            'badgesCount' => $badges->count(),
            'activityData' => $activityData,
            'currentYear' => Carbon::now()->year
        ]);
    }

    /**
     * Gera dados de atividade para o gráfico de contribuições
     */
    private function generateActivityData(User $user)
    {
        $data = [];
        $totalDays = 52 * 7; // 52 semanas * 7 dias
        
        // Primeiro preencha com zeros
        for ($i = 0; $i < $totalDays; $i++) {
            $data[$i] = 0;
        }
        
        // Aqui você deve substituir por sua lógica real de atividade
        // Por enquanto, vamos manter a versão simulada
        
        // Distribuição de níveis de contribuição
        // 0: sem contribuição, 1: baixa, 2: média, 3: alta
        $levelDistribution = [0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 2, 2, 3];
        
        // Gerar padrões de atividade mais realistas
        for ($i = 0; $i < $totalDays; $i++) {
            $dayOfWeek = $i % 7;
            
            // Fins de semana têm menor probabilidade de contribuição
            if ($dayOfWeek === 0 || $dayOfWeek === 6) {
                $data[$i] = rand(0, 100) < 85 ? 0 : $levelDistribution[array_rand($levelDistribution)];
            } else {
                // Dias de semana têm maior probabilidade de contribuição
                $data[$i] = $levelDistribution[array_rand($levelDistribution)];
            }
        }
        
        // Adicionar alguns períodos de alta atividade
        $highActivityStart = rand(0, $totalDays - 14);
        for ($i = 0; $i < 14; $i++) {
            if ($data[$highActivityStart + $i] > 0) {
                $data[$highActivityStart + $i] = min(3, $data[$highActivityStart + $i] + 1);
            } else {
                $data[$highActivityStart + $i] = rand(1, 2);
            }
        }
        
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
