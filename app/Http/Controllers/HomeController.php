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
        if($lastCompletedUserStep){
            $lastStep = Step::find($lastCompletedUserStep->step_id);
            $lastTrack = Track::find($lastStep->track_id);
            $lastTrackSteps = Step::where('track_id', $lastStep->track_id)->get();
        } else {
            $lastTrack = Track::where('is_official', true)->orderByDesc('created_at')->first();
            $lastTrackSteps = Step::where('track_id', $lastTrack->id)->get();
            $lastStep = Step::where('track_id', $lastTrack->id)->orderByDesc('position')->first();
            
        }

        $webDevelopmentTracks = Track::where('is_public', true)
                                    ->orderByDesc('created_at')
                                    ->take(8)
                                    ->get();
        
        // Mapear as trilhas para o formato necessário para exibição
        $webDevelopmentCourses = [];
        
       // Cores e ícones para diferentes níveis de dificuldade
        $difficultyStyles = [
            'beginner' => [
                'icon' => 'fas fa-code',
                'color' => 'primary'
            ],
            'intermediate' => [
                'icon' => 'fas fa-laptop-code',
                'color' => 'success'
            ],
            'advanced' => [
                'icon' => 'fas fa-server',
                'color' => 'warning'
            ]
        ];
        
        foreach ($webDevelopmentTracks as $track) {
            // Calcular um progresso fictício baseado no ID da trilha (apenas para demonstração)
            $progress = ($track->id * 10) % 100;
            if ($progress < 10) $progress = 10;
            
            // Garantir que a dificuldade seja uma string válida para evitar o erro "Illegal offset type"
            $difficulty = '';
            if (isset($track->difficulty) && is_string($track->difficulty)) {
                $difficulty = $track->difficulty;
            } else {
                $difficulty = 'lol'; // Valor padrão caso a dificuldade não seja uma string válida
            }
            
            // Definir estilo baseado na dificuldade
            $style = isset($difficultyStyles[$difficulty]) ? $difficultyStyles[$difficulty] : $difficultyStyles['beginner'];
            
            $webDevelopmentCourses[] = [
                'id' => $track->id,
                'title' => $track->title,
                'description' => $track->description ?? 'Aprenda habilidades essenciais para desenvolvimento web.',
                'icon' => $style['icon'],
                'progress' => $progress,
                'color' => $style['color'],
                'cover_image' => $track->cover_image,
                'difficulty' => $difficulty
            ];
        }

        // Buscar trilhas de engenharia de software do banco de dados
        // Usando a mesma tabela tracks, mas com offset para simular trilhas diferentes
        $softwareEngineeringTracks = Track::where('is_public', true)
                                        ->orderByDesc('updated_at') // Usando updated_at para ter uma ordem diferente
                                        ->offset(3) // Offset para pegar trilhas diferentes das de web
                                        ->take(8)
                                        ->get();
        
        // Mapear as trilhas para o formato necessário para exibição
        $softwareEngineeringCourses = [];
        
        foreach ($softwareEngineeringTracks as $track) {
            // Calcular um progresso fictício baseado no ID da trilha (apenas para demonstração)
            $progress = ($track->id * 15) % 100; // Fórmula ligeiramente diferente para variar os progressos
            if ($progress < 10) $progress = 10;
            
            // Garantir que a dificuldade seja uma string válida para evitar o erro "Illegal offset type"
            $difficulty = '';
            if (isset($track->difficulty) && is_string($track->difficulty)) {
                $difficulty = $track->difficulty;
            } else {
                $difficulty = 'beginner'; // Valor padrão caso a dificuldade não seja uma string válida
            }
            
            // Definir estilo baseado na dificuldade
            $style = isset($difficultyStyles[$difficulty]) ? $difficultyStyles[$difficulty] : $difficultyStyles['beginner'];
            
            $softwareEngineeringCourses[] = [
                'id' => $track->id,
                'title' => $track->title,
                'description' => $track->description ?? 'Aprenda conceitos avançados de engenharia de software.',
                'icon' => $style['icon'],
                'progress' => $progress,
                'color' => $style['color'],
                'cover_image' => $track->cover_image,
                'difficulty' => $difficulty
            ];
        }
        
        $techCurators = [
            [
                'id' => 1,
                'name' => 'Thalyson Santos',
                'specialty' => 'Data Base Architecture',
                'avatar' => 'https://avatars.githubusercontent.com/u/184450068?v=4',
                'github' => 'https://github.com/taysoic'
            ],
            [
                'id' => 2,
                'name' => 'Ana Oliveira',
                'specialty' => 'Full-Stack Development',
                'avatar' => 'https://github.com/babisobrinho.png',
                'github' => 'https://github.com/babisobrinho'
            ],
            [
                'id' => 3,
                'name' => 'Lenice Pereira',
                'specialty' => 'Full-Stack Development',
                'avatar' => 'https://github.com/lenicesoaares.png',
                'github' => 'https://github.com/lenicesoaares'
            ],
            [
                'id' => 4,
                'name' => 'Juliana Alves',
                'specialty' => 'FrontEnd Development',
                'avatar' => 'https://github.com/JulyDuds.png',
                'github' => 'https://github.com/JulyDuds'
            ],
            [
                'id' => 5,
                'name' => 'Rebeca Santos',
                'specialty' => 'UI/UX Design',
                'avatar' => 'https://github.com/RebecaSantosb.png',
                'github' => 'https://github.com/RebecaSantosb'
            ],
            [
                'id' => 6,
                'name' => 'Aline Armando',
                'specialty' => 'Data Science',
                'avatar' => 'https://github.com/kiamy6.png',
                'github' => 'https://github.com/kiamy6'
            ]
        ];

        return view('home', compact(
            'currentUser', 
            'lastStep', 
            'lastTrack', 
            'lastTrackSteps',
            'webDevelopmentCourses',
            'softwareEngineeringCourses',
            'techCurators'
        ));
    }
}
