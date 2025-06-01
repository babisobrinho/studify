@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<div class="container my-3 my-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold"><i class="bi bi-book me-2"></i>Detalhes do Curso</h1>
        <div>
            <a href="{{ route('admin.tracks.index') }}" class="btn btn-outline-secondary me-2">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
            <a href="{{ route('admin.tracks.edit', $track->id) }}" class="btn btn-outline-primary">
                <i class="bi bi-pencil"></i> Editar
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    @if($track->cover_image)
                        <img src="{{ asset('storage/' . $track->cover_image) }}" 
                             class="img-fluid rounded mb-3" alt="Capa do curso {{ $track->title }}">
                    @else
                        <img src="https://cdn-icons-png.flaticon.com/512/1448/1448776.png"
                             class="img-fluid rounded mb-3" alt="Curso sem imagem">
                    @endif
                    
                    <div class="d-grid gap-2">
                        <span class="badge bg-{{ $track->is_official ? 'success' : 'secondary' }} mb-2">
                            {{ $track->is_official ? 'Oficial' : 'Comunitário' }}
                        </span>
                        <span class="badge bg-{{ $track->is_public ? 'primary' : 'warning' }} mb-2">
                            {{ $track->is_public ? 'Público' : 'Privado' }}
                        </span>
                    </div>
                </div>
                <div class="col-md-8">
                    <h2 class="text-dark">{{ $track->title }}</h2>
                    <div class="mb-3">
                        @if($track->ratings->count() > 0)
                            @php $avgRating = $track->ratings->avg('rating'); @endphp
                            <span class="text-warning">
                                <i class="bi bi-star-fill"></i> {{ number_format($avgRating, 1) }}
                            </span>
                            <span class="text-muted ms-2">({{ $track->ratings->count() }} avaliações)</span>
                        @else
                            <span class="text-muted">Sem avaliações ainda</span>
                        @endif
                        
                        <span class="badge bg-{{ 
                            $track->difficulty == 'beginner' ? 'success' : 
                            ($track->difficulty == 'intermediate' ? 'warning' : 'danger') 
                        }} ms-2">
                            {{ 
                                $track->difficulty == 'beginner' ? 'Iniciante' : 
                                ($track->difficulty == 'intermediate' ? 'Intermediário' : 'Avançado') 
                            }}
                        </span>
                        
                        @foreach($track->tags as $tag)
                            <span class="badge bg-info ms-2">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    
                    <p class="lead text-secondary">{{ $track->description }}</p>
                    <hr class="border-secondary">

                    <h5 class="text-dark"><i class="bi bi-info-circle"></i> Sobre este curso</h5>
                    <p class="text-secondary">{{ $track->about ?? 'Nenhuma descrição detalhada disponível.' }}</p>

                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <h6 class="text-dark"><i class="bi bi-person-video2"></i> Instrutor</h6>
                            <p class="text-secondary">{{ $track->user->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="text-dark"><i class="bi bi-clock"></i> Duração estimada</h6>
                            <p class="text-secondary">
                                {{ $track->steps->sum('estimated_time') }} minutos
                                ({{ round($track->steps->sum('estimated_time')/60) }} horas)
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="text-dark"><i class="bi bi-people"></i> Alunos</h6>
                            <p class="text-secondary">{{ $track->userTracks->count() }} inscritos</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="text-dark"><i class="bi bi-award"></i> Certificado</h6>
                            <p class="text-secondary">
                                {{ $track->certificates->count() > 0 ? 'Disponível' : 'Não disponível' }}
                                ({{ $track->certificates->count() }} emitidos)
                            </p>
                        </div>
                    </div>

                    <hr class="border-secondary">
                    <h5 class="text-dark"><i class="bi bi-list-check"></i> Conteúdo do Curso</h5>
                    <div class="accordion" id="courseAccordion">
                        @foreach($track->steps->sortBy('position') as $step)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $step->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{ $step->id }}" aria-expanded="false" 
                                    aria-controls="collapse{{ $step->id }}">
                                    <i class="bi bi-{{ 
                                        $step->content_type == 'video' ? 'play-circle' : 
                                        ($step->content_type == 'article' ? 'file-text' : 
                                        ($step->content_type == 'exercise' ? 'clipboard-check' : 'collection')) 
                                    }} me-2"></i>
                                    {{ $step->title }}
                                    <span class="badge bg-secondary ms-2">{{ $step->estimated_time }} min</span>
                                </button>
                            </h2>
                            <div id="collapse{{ $step->id }}" class="accordion-collapse collapse" 
                                aria-labelledby="heading{{ $step->id }}" data-bs-parent="#courseAccordion">
                                <div class="accordion-body">
                                    <p>{{ $step->description }}</p>
                                    <a href="{{ $step->content_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        Acessar conteúdo
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection