@extends('layouts.app')

@section('content')
    <div class="container py-4 mx-auto" style="max-width: 900px; overflow-x: hidden;">
        <!-- Plano Header -->
        <div class="card mb-4 shadow-sm">
            <div class="row g-0">
                <div class="col-md-3">
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        <img src="https://via.placeholder.com/300x200/e9ecef/495057?text={{ ucfirst((string)$track->difficulty->value) }}" alt="Capa do plano" class="img-fluid h-100 w-100 object-fit-cover rounded">
                    </div>
                </div>
                <div class="col-md-9 position-relative p-4">
                    <h1 class="h3 fw-bold text-primary mb-1">{{ $track->title }}</h1>
                    <div class="text-secondary mb-3">{{ $track->description }}</div>
                    <div class="text-muted small mb-3">
                        @if(isset($likesCount))
                            <i class="fas fa-heart text-danger me-2"></i> {{ $likesCount }} curtidas
                        @endif
                        @if(isset($avgRating) && $avgRating > 0)
                            • <i class="fas fa-star text-warning mx-2"></i> {{ number_format($avgRating, 1) }}/5
                        @endif
                    </div>

                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @if(isset($tags) && count($tags) > 0)
                            @foreach($tags as $tag)
                                <span class="badge bg-light text-primary rounded-pill px-3 py-1">{{ $tag->name }}</span>
                            @endforeach
                        @else
                            <span class="badge bg-light text-secondary rounded-pill px-3 py-1">Sem tags</span>
                        @endif
                    </div>

                    <!-- Botão de play verde circular com ícone play -->
                    <button
                        class="btn btn-primary rounded-circle position-absolute"
                        style="width:60px; height:60px; bottom:15px; right:30px; box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3); display: flex; align-items: center; justify-content: center;"
                        title="Play"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Conteúdos do Plano -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h2 class="card-title h5 mb-4">
                    <i class="fas fa-file-alt me-2 text-warning"></i> Conteúdos do Plano
                </h2>
                @if(isset($steps) && count($steps) > 0)
                    @foreach($steps as $index => $step)
                        <div class="d-flex align-items-center border-bottom py-3 position-relative">
                            <div class="text-secondary fw-bold text-center" style="width:30px;">{{ $index + 1 }}.</div>
                            <div class="me-3" style="width:60px; height:60px;">
                                @php
                                    $contentType = is_object($step->content_type) ? $step->content_type->value : $step->content_type;
                                    $iconText = strtoupper(substr($contentType, 0, 3)) ?: 'DOC';
                                @endphp
                                <img src="https://via.placeholder.com/60x60/e9ecef/495057?text={{ $iconText }}" alt="Thumbnail do conteúdo" class="img-fluid rounded">
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold text-primary">{{ $step->title }}</div>
                                <div class="small text-secondary mb-1">
                                    {{ ucfirst($contentType) }} &bull;
                                    {{ $step->estimated_time }} min &bull;
                                    {{ $step->external_resource ? 'Recurso externo' : 'Recurso interno' }}
                                </div>
                                <div class="small text-muted">{{ Str::limit($step->description, 100) }}</div>
                            </div>
                            <div class="d-flex align-items-center gap-3 me-3">
                                <button class="btn p-0 border-0 text-secondary" aria-label="Bookmark" title="Marcar">
                                    <i class="far fa-bookmark fs-5"></i>
                                </button>
                                <a href="{{ $step->content_url }}" target="_blank" class="btn p-0 border-0 text-secondary" aria-label="Play" title="Assistir">
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
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h2 class="card-title h5 mb-4 text-primary fw-bold">Linha de Frente</h2>
                <div class="d-flex gap-3 overflow-auto pb-2">
                    <div class="text-center" style="width:100px;">
                        <div class="position-relative mx-auto mb-2" style="width:80px; height:80px; border-radius: 50%; overflow: hidden; background-color:#e0e0e0;">
                            <img src="https://via.placeholder.com/80x80" alt="Autor" class="img-fluid h-100 w-100 object-fit-cover rounded-circle">
                            <div class="position-absolute bottom-0 end-0 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:20px; height:20px; background-color: #06D6A0; color:#fff; font-size:10px;">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <div class="text-primary small">{{ $user->name }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recomendações -->
        <div class="card mb-4 shadow-sm position-relative">
            <div class="card-body">
                <h2 class="card-title h5 mb-4 fw-bold text-primary">Recomendações para você</h2>
                <div class="d-flex gap-3 overflow-auto pb-2">

                    @foreach([
                        ['img' => 'UX/UI', 'title' => 'Design UX/UI para Desenvolvedores', 'creator' => 'por Designer Pro'],
                        ['img' => 'TypeScript', 'title' => 'TypeScript para Aplicações Robustas', 'creator' => 'por Desenvolvedor TS'],
                        ['img' => 'Next.js', 'title' => 'Desenvolvimento com Next.js', 'creator' => 'por React Master'],
                    ] as $rec)
                        <div class="card flex-shrink-0" style="min-width: 200px; max-width: 200px; height: 320px; display: flex; flex-direction: column;">
                            <img
                                src="https://via.placeholder.com/200x120/e9ecef/495057?text={{ $rec['img'] }}"
                                class="card-img-top rounded"
                                alt="Thumbnail da recomendação"
                                style="height: 140px; object-fit: cover;"
                            >
                            <div class="card-body p-3 flex-grow-1 d-flex flex-column justify-content-between">
                                <h6 class="card-title text-primary fw-semibold mb-2" style="min-height: 3.6em; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $rec['title'] }}
                                </h6>
                                <p class="card-text small text-secondary mb-0">{{ $rec['creator'] }}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            {{-- Botão de próxima página removido para simplificação --}}
        </div>

        <!-- Botões Cancelar e Editar -->
        <div class="d-flex justify-content-between mb-5">
            <a href="{{ route('tracks.index', ['username' => $user->username]) }}" class="btn btn-outline-secondary px-4 py-2">
                <i class="fas fa-arrow-left me-2"></i> Cancelar
            </a>
            <a href="{{ route('tracks.edit', ['username' => $user->username, 'id' => $track->id]) }}" class="btn btn-success">
                <i class="fas fa-edit me-2"></i> Editar
            </a>
        </div>
    </div>
@endsection
