@extends('layouts.app')

@section('content')
    <div class="container py-4 mx-auto" style="max-width: 900px; overflow-x: hidden;">
        <!-- Plano Header -->
        <div class="card mb-4 shadow-sm" style="border-radius: 8px; transition: transform 0.3s ease, box-shadow 0.3s ease; border-left: 4px solid {{ $track->plan_color ?? '#06D6A0' }};">
            <div class="row g-0">
                <div class="col-md-3">
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        @if(isset($track->cover_image) && $track->cover_image)
                            <img src="{{ asset('storage/' . $track->cover_image) }}" alt="Capa do plano" class="img-fluid h-100 w-100 object-fit-cover rounded">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; background-color: {{ $track->plan_color ?? '#06D6A0' }}; box-shadow: 0 4px 10px rgba(6, 214, 160, 0.3);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-9 position-relative p-4">
                    <h1 class="h3 fw-bold mb-1" style="color: {{ $track->plan_color ?? '#06D6A0' }}; font-family: 'Poppins', sans-serif;">{{ $track->title }}</h1>
                    <div class="text-secondary mb-3" style="font-family: 'Inter', sans-serif;">{{ $track->description }}</div>
                    <div class="text-muted small mb-3">
                        @if(isset($likesCount))
                            <i class="fas fa-heart text-danger me-2"></i> {{ $likesCount }} curtidas
                        @endif
                        @if(isset($avgRating) && $avgRating > 0)
                            • <i class="fas fa-star text-warning mx-2"></i> {{ number_format($avgRating, 1) }}/5
                        @endif
                    </div>

                    <!-- Início da seção de badges - Removido div wrapper para eliminar possíveis elementos vazios -->
                    @php
                        // Inicializa array para armazenar todos os badges válidos
                        $allBadges = [];

                        // Adiciona badge de categoria se válido
                        if(isset($category) && is_object($category) && isset($category->name) && !empty(trim($category->name))) {
                            $allBadges[] = [
                                'type' => 'category',
                                'text' => $category->name,
                                'icon' => 'fa-folder',
                                'bg_color' => $track->plan_color ?? '#06D6A0',
                                'text_color' => 'white'
                            ];
                        }

                        // Adiciona badge de dificuldade
                        $difficultyText = '';
                        $difficultyIcon = '';

                        if($track->difficulty === 'beginner') {
                            $difficultyText = 'Iniciante';
                            $difficultyIcon = 'fa-signal-1';
                        } elseif($track->difficulty === 'intermediate') {
                            $difficultyText = 'Intermediário';
                            $difficultyIcon = 'fa-signal-2';
                        } elseif($track->difficulty === 'advanced') {
                            $difficultyText = 'Avançado';
                            $difficultyIcon = 'fa-signal-3';
                        }

                        if(!empty($difficultyText)) {
                            $allBadges[] = [
                                'type' => 'difficulty',
                                'text' => $difficultyText,
                                'icon' => $difficultyIcon,
                                'bg_color' => '#EDF2F4',
                                'text_color' => $track->plan_color ?? '#2C5364'
                            ];
                        }

                        // Adiciona badges de tags válidas
                        if(isset($tags) && count($tags) > 0) {
                            foreach($tags as $tag) {
                                if (is_object($tag) && isset($tag->name) && !empty(trim($tag->name))) {
                                    $allBadges[] = [
                                        'type' => 'tag',
                                        'text' => $tag->name,
                                        'icon' => '',
                                        'bg_color' => '#EDF2F4',
                                        'text_color' => $track->plan_color ?? '#2C5364'
                                    ];
                                }
                            }
                        }
                    @endphp

                        <!-- Renderiza todos os badges válidos de uma vez -->
                    @if(count($allBadges) > 0)
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            @foreach($allBadges as $badge)
                                <span class="badge rounded-pill px-3 py-1" style="background-color: {{ $badge['bg_color'] }}; color: {{ $badge['text_color'] }}; transition: all 0.3s ease;">
                                @if(!empty($badge['icon']))
                                        <i class="fas {{ $badge['icon'] }} me-1"></i>
                                    @endif
                                    {{ $badge['text'] }}
                            </span>
                            @endforeach
                        </div>
                    @endif
                    <!-- Fim da seção de badges -->

                    <!-- Botão de play verde circular com ícone play -->
                    <button
                        class="btn rounded-circle position-absolute"
                        style="width:60px; height:60px; bottom:15px; right:30px; background-color: {{ $track->plan_color ?? '#06D6A0' }}; color: white; box-shadow: 0 4px 10px rgba(6, 214, 160, 0.3); display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;"
                        title="Play"
                        onmouseover="this.style.transform='scale(1.1)'"
                        onmouseout="this.style.transform='scale(1)'"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Conteúdos do Plano -->
        <div class="card mb-4 shadow-sm" style="border-radius: 8px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="card-body">
                <h2 class="card-title h5 mb-4">
                    <i class="fas fa-file-alt me-2" style="color: {{ $track->plan_color ?? '#06D6A0' }};"></i> Conteúdos do Plano
                </h2>
                @if(isset($steps) && count($steps) > 0)
                    @foreach($steps as $index => $step)
                        <div class="d-flex align-items-center border-bottom py-3 position-relative" style="transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='rgba({{ hexToRgb($track->plan_color ?? '#06D6A0') }}, 0.05)'" onmouseout="this.style.backgroundColor=''">
                            <div class="text-secondary fw-bold text-center" style="width:30px;">{{ $index + 1 }}.</div>
                            <div class="me-3" style="width:60px; height:60px;">
                                <div class="d-flex align-items-center justify-content-center bg-light rounded" style="width:60px; height:60px;">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle" style="width:40px; height:40px; background-color: {{ $track->plan_color ?? '#06D6A0' }}; box-shadow: 0 4px 10px rgba(6, 214, 160, 0.3);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold" style="color: {{ $track->plan_color ?? '#06D6A0' }};">{{ $step->title }}</div>
                                <div class="small text-secondary mb-1">
                                    @php
                                        $contentType = is_object($step->content_type) ? $step->content_type->value : $step->content_type;
                                    @endphp
                                    {{ ucfirst($contentType) }} &bull;
                                    {{ $step->estimated_time }} min &bull;
                                    {{ $step->external_resource ? 'Recurso externo' : 'Recurso interno' }}
                                </div>
                                <div class="small text-muted">{{ Str::limit($step->description, 100) }}</div>
                            </div>
                            <div class="d-flex align-items-center gap-3 me-3">
                                <button class="btn p-0 border-0 text-secondary" aria-label="Bookmark" title="Marcar" style="transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    <i class="far fa-bookmark fs-5"></i>
                                </button>
                                <a href="{{ $step->content_url }}" target="_blank" class="btn p-0 border-0" aria-label="Play" title="Assistir" style="color: {{ $track->plan_color ?? '#06D6A0' }}; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    <i class="fas fa-play fs-5"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-folder-open fa-3x mb-3"></i>
                        <p class="mb-0">Nenhum conteúdo disponível para este plano.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Linha de Frente -->
        <div class="card mb-4 shadow-sm" style="border-radius: 8px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="card-body">
                <h2 class="card-title h5 mb-4 fw-bold" style="color: {{ $track->plan_color ?? '#06D6A0' }};">Linha de Frente</h2>
                <div class="d-flex gap-3 overflow-auto pb-2">
                    <div class="text-center" style="width:100px;">
                        <div class="position-relative mx-auto mb-2" style="width:80px; height:80px; border-radius: 50%; overflow: hidden; background-color:#e0e0e0;">
                            <img src="https://via.placeholder.com/80x80" alt="Autor" class="img-fluid h-100 w-100 object-fit-cover rounded-circle">
                            <div class="position-absolute bottom-0 end-0 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:20px; height:20px; background-color: {{ $track->plan_color ?? '#06D6A0' }}; color:#fff; font-size:10px;">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <div class="small" style="color: {{ $track->plan_color ?? '#06D6A0' }}; font-weight: 500;">{{ $user->name }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recomendações -->
        <div class="card mb-4 shadow-sm position-relative" style="border-radius: 8px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="card-body">
                <h2 class="card-title h5 mb-4 fw-bold" style="color: {{ $track->plan_color ?? '#06D6A0' }};">Recomendações para você</h2>
                <div class="d-flex gap-3 overflow-auto pb-2" style="scrollbar-width: thin; scrollbar-color: {{ $track->plan_color ?? '#06D6A0' }} #EDF2F4;">
                    @foreach([
                        ['img' => 'UX/UI', 'title' => 'Design UX/UI para Desenvolvedores', 'creator' => 'por Designer Pro'],
                        ['img' => 'TypeScript', 'title' => 'TypeScript para Aplicações Robustas', 'creator' => 'por Desenvolvedor TS'],
                        ['img' => 'Next.js', 'title' => 'Desenvolvimento com Next.js', 'creator' => 'por React Master'],
                    ] as $rec)
                        <div class="card flex-shrink-0" style="min-width: 200px; max-width: 200px; height: 320px; display: flex; flex-direction: column; border-radius: 8px; transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)';" onmouseout="this.style.transform=''; this.style.boxShadow='';">
                            <div class="d-flex align-items-center justify-content-center bg-light" style="height: 140px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                                <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background-color: {{ $track->plan_color ?? '#06D6A0' }}; box-shadow: 0 4px 10px rgba(6, 214, 160, 0.3);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="card-body p-3 flex-grow-1 d-flex flex-column justify-content-between">
                                <h6 class="card-title fw-semibold mb-2" style="min-height: 3.6em; overflow: hidden; text-overflow: ellipsis; color: {{ $track->plan_color ?? '#06D6A0' }};">
                                    {{ $rec['title'] }}
                                </h6>
                                <p class="card-text small text-secondary mb-0">{{ $rec['creator'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Botões Cancelar e Editar -->
        <div class="d-flex justify-content-between mb-5">
            <a href="{{ route('tracks.index', ['username' => $user->username]) }}" class="btn btn-outline-secondary px-4 py-2">
                <i class="fas fa-arrow-left me-2"></i> Cancelar
            </a>
            <a href="{{ route('tracks.edit', ['username' => $user->username, 'id' => $track->id]) }}" class="btn" style="background-color: {{ $track->plan_color ?? '#06D6A0' }}; color: white;">
                <i class="fas fa-edit me-2"></i> Editar
            </a>
        </div>
    </div>

    @php
        /**
         * Função auxiliar para converter cor hexadecimal em RGB
         */
        function hexToRgb($hex) {
            $hex = ltrim($hex, '#');
            if(strlen($hex) == 3) {
                $r = hexdec(substr($hex,0,1).substr($hex,0,1));
                $g = hexdec(substr($hex,1,1).substr($hex,1,1));
                $b = hexdec(substr($hex,2,1).substr($hex,2,1));
            } else {
                $r = hexdec(substr($hex,0,2));
                $g = hexdec(substr($hex,2,2));
                $b = hexdec(substr($hex,4,2));
            }
            return "$r, $g, $b";
        }
    @endphp
@endsection
