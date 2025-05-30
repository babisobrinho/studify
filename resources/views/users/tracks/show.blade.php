@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <!-- Playlist Header -->
        <div class="bg-white rounded shadow-sm mb-4 overflow-hidden">
            <div class="row g-0">
                <div class="col-md-3">
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        <img src="https://via.placeholder.com/300x200/e9ecef/495057?text={{ ucfirst((string)$track->difficulty->value) }}" alt="Capa do plano" class="img-fluid h-100 w-100 object-fit-cover">
                    </div>
                </div>
                <div class="col-md-9 position-relative p-4">
                    <h1 class="h3 fw-bold text-primary mb-1">{{ $track->title }}</h1>
                    <div class="text-secondary mb-1">{{ $track->description }}</div>
                    <div class="text-muted small mb-3">
                        @if(isset($likesCount))
                            <i class="fas fa-heart text-danger"></i> {{ $likesCount }} curtidas
                        @endif
                        @if(isset($avgRating) && $avgRating > 0)
                            • <i class="fas fa-star text-warning"></i> {{ number_format($avgRating, 1) }}/5
                        @endif
                    </div>

                    <div class="position-absolute top-0 end-0 m-3 d-flex gap-2">
                        <button class="btn btn-outline-secondary btn-sm">Iniciar</button>
                        <button class="btn btn-outline-secondary btn-sm rounded-circle">
                            <i class="fas fa-question"></i>
                        </button>
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

                    <button class="btn btn-primary rounded-circle position-absolute" style="width:60px; height:60px; bottom:-30px; right:30px; box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);">
                        <i class="fas fa-play fs-4"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Playlist Content -->
        <div class="bg-white rounded shadow-sm p-3 mb-4">
            @if(isset($steps) && count($steps) > 0)
                @foreach($steps as $index => $step)
                    <div class="d-flex align-items-center border-bottom py-3 position-relative">
                        <div class="text-secondary fw-bold text-center" style="width:30px;">{{ $index + 1 }}.</div>
                        <div class="me-3" style="width:60px; height:60px;">
                            @php
                                $contentType = is_object($step->content_type) ? $step->content_type->value : $step->content_type;
                                $iconText = substr($contentType, 0, 3);
                                if (strlen($iconText) < 1) {
                                    $iconText = 'DOC';
                                }
                            @endphp
                            <img src="https://via.placeholder.com/60x60/e9ecef/495057?text={{ strtoupper($iconText) }}"
                                 alt="Thumbnail do conteúdo" class="img-fluid rounded">
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold text-primary">{{ $step->title }}</div>
                            <div class="small text-secondary">
                                {{ ucfirst(is_object($step->content_type) ? $step->content_type->value : $step->content_type) }} •
                                {{ $step->estimated_time }} min •
                                {{ $step->external_resource ? 'Recurso externo' : 'Recurso interno' }}
                            </div>
                            <div class="small text-muted">{{ Str::limit($step->description, 100) }}</div>
                        </div>
                        <div class="d-flex align-items-center gap-3 me-3">
                            <button class="btn p-0 border-0 text-secondary" aria-label="Bookmark">
                                <i class="far fa-bookmark fs-5"></i>
                            </button>
                            <a href="{{ $step->content_url }}" target="_blank" class="btn p-0 border-0 text-secondary" aria-label="Play">
                                <i class="fas fa-play fs-5"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Mensagem quando não há steps -->
            @endif
        </div>

        <!-- Instructors Section -->
        <div class="bg-white rounded shadow-sm p-4 mb-4">
            <h2 class="h5 fw-bold text-primary mb-4">Linha de Frente</h2>
            <div class="d-flex gap-3 overflow-auto pb-2">
                <!-- Autor do track -->
                <div class="text-center" style="width:100px;">
                    <div class="position-relative mx-auto mb-2" style="width:80px; height:80px; border-radius: 50%; overflow: hidden; background-color:#e0e0e0;">
                        <img src="https://via.placeholder.com/80x80" alt="Autor" class="img-fluid h-100 w-100 object-fit-cover">
                        <div class="position-absolute bottom-0 end-0 rounded-circle d-flex align-items-center justify-content-center"
                             style="width:20px; height:20px; background-color: #06D6A0; color:#fff; font-size:10px;">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                    <div class="text-primary small">{{ $user->name }}</div>
                </div>
            </div>
        </div>

        <!-- Recommendations Section -->
        <div class="bg-white rounded shadow-sm p-4 mb-4 position-relative">
            <h2 class="h5 fw-bold text-primary mb-4">Recomendações para você</h2>
            <div class="d-flex gap-3 overflow-auto pb-2">
                <!-- foreach com tracks da mesma categoria e que ainda não tenham sido concluídas pelo utilizador autenticado -->
                @foreach([
                    ['img' => 'UX/UI', 'title' => 'Design UX/UI para Desenvolvedores', 'creator' => 'por Designer Pro'],
                    ['img' => 'TypeScript', 'title' => 'TypeScript para Aplicações Robustas', 'creator' => 'por Desenvolvedor TS'],
                    ['img' => 'Next.js', 'title' => 'Desenvolvimento com Next.js', 'creator' => 'por React Master'],
                ] as $rec)
                    <div class="card flex-shrink-0" style="min-width: 200px;">
                        <img src="https://via.placeholder.com/200x120/e9ecef/495057?text={{ $rec['img'] }}" class="card-img-top" alt="Thumbnail da recomendação">
                        <div class="card-body p-2">
                            <h6 class="card-title text-primary fw-semibold mb-1 text-truncate" style="-webkit-line-clamp: 2; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden;">{{ $rec['title'] }}</h6>
                            <p class="card-text small text-secondary mb-0">{{ $rec['creator'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="btn btn-white position-absolute top-50 end-0 translate-middle-y shadow rounded-circle" style="width:40px; height:40px;">
                <i class="fas fa-chevron-right text-primary"></i>
            </button>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('tracks.index', ['username' => $user->username]) }}" class="btn btn-outline-secondary">Cancelar</a>
                <a href="{{route('tracks.edit', ['username' => $user->username, 'id'=>$track->id])}}" class="btn btn-outline-secondary">Editar</a>
            </div>
        </div>
    </div>
@endsection
