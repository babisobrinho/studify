@extends('layouts.app')

@section('content')
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<div class="container-fluid px-4 px-lg-5 py-4">
    <!-- Header Section -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center">
            <i class="bi bi-book fs-1 text-primary me-3"></i>
            <div>
                <h1 class="h3 mb-0 text-gray-800 fw-bold">Detalhes do Curso</h1>
                <p class="mb-0 text-muted">Visualização completa das informações do curso</p>
            </div>
        </div>
        <div>
            <a href="{{ route('admin.tracks.index') }}" class="btn btn-outline-secondary me-2">
                <i class="bi bi-arrow-left me-1"></i> Voltar
            </a>
            <a href="{{ route('admin.tracks.edit', $track->id) }}" class="btn btn-outline-primary">
                <i class="bi bi-pencil me-1"></i> Editar
            </a>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card shadow border-0">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="bi bi-info-circle me-2"></i>Informações do Curso
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Left Column - Image and Basic Info -->
                <div class="col-md-4 mb-4 mb-md-0">
                    @if($track->cover_image)
                        @php
                            $isExternal = str_starts_with($track->cover_image, 'http://') || str_starts_with($track->cover_image, 'https://');
                            $imageUrl = $isExternal ? $track->cover_image : asset('storage/' . $track->cover_image);
                        @endphp
                        <img src="{{ $imageUrl }}" alt="Capa do curso" style="max-height: 270px; max-width: 300px; margin-bottom: 50px; margin-left: 130px; margin-top: 30px">
                    @else
                        <span>Sem imagem</span>
                    @endif
                    
                    <div class="d-grid gap-2">
                        <span class="badge bg-{{ $track->is_official ? 'success' : 'secondary' }} mb-2">
                            {{ $track->is_official ? 'Oficial' : 'Comunitário' }}
                        </span>
                        <span class="badge bg-{{ $track->is_public ? 'primary' : 'warning' }} mb-2">
                            {{ $track->is_public ? 'Público' : 'Privado' }}
                        </span>
                        <span class="badge bg-{{ 
                            $track->difficulty == 'beginner' ? 'success' : 
                            ($track->difficulty == 'intermediate' ? 'warning' : 'danger') 
                        }}">
                            {{ 
                                $track->difficulty == 'beginner' ? 'Iniciante' : 
                                ($track->difficulty == 'intermediate' ? 'Intermediário' : 'Avançado') 
                            }}
                        </span>
                        
                        @if($track->tags->count() > 0)
                            <div class="mt-3">
                                <h6 class="fw-semibold"><i class="bi bi-tags me-1"></i> Tags</h6>
                                @foreach($track->tags as $tag)
                                    <span class="badge bg-info me-1 mb-1">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right Column - Detailed Info -->
                <div class="col-md-8">
                    <h2 class="fw-bold mb-3">{{ $track->title }}</h2>
                    
                    <div class="mb-4">
                        @if($track->ratings->count() > 0)
                            @php $avgRating = $track->ratings->avg('rating'); @endphp
                            <span class="text-warning">
                                <i class="bi bi-star-fill"></i> {{ number_format($avgRating, 1) }}
                            </span>
                            <span class="text-muted ms-2">({{ $track->ratings->count() }} avaliações)</span>
                        @else
                            <span class="text-muted">Sem avaliações ainda</span>
                        @endif
                    </div>
                    
                    <p class="lead text-secondary mb-4">{{ $track->description }}</p>
                    
                    <div class="border-top border-bottom py-3 my-3">
                        <h5 class="fw-semibold"><i class="bi bi-info-circle me-2"></i>Sobre este curso</h5>
                        <p class="text-secondary">{{ $track->about ?? 'Nenhuma descrição detalhada disponível.' }}</p>
                    </div>

                    <!-- Course Stats -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-semibold"><i class="bi bi-person-video2 me-2"></i>Instrutor</h6>
                            <p class="text-secondary">{{ $track->user->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-semibold"><i class="bi bi-clock me-2"></i>Duração estimada</h6>
                            <p class="text-secondary">
                                {{ $track->steps->sum('estimated_time') }} minutos
                                ({{ round($track->steps->sum('estimated_time')/60) }} horas)
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-semibold"><i class="bi bi-people me-2"></i>Alunos</h6>
                            <p class="text-secondary">{{ $track->userTracks->count() }} inscritos</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-semibold"><i class="bi bi-award me-2"></i>Certificado</h6>
                            <p class="text-secondary">
                                {{ $track->certificates->count() > 0 ? 'Disponível' : 'Não disponível' }}
                                ({{ $track->certificates->count() }} emitidos)
                            </p>
                        </div>
                    </div>

                    <!-- Course Content -->
                    <div class="border-top pt-4">
                        <h5 class="fw-semibold mb-4"><i class="bi bi-list-check me-2"></i>Conteúdo do Curso</h5>
                        <div class="accordion" id="courseAccordion">
                            @foreach($track->steps->sortBy('position') as $step)
                            <div class="accordion-item mb-2 border-0">
                                <h2 class="accordion-header" id="heading{{ $step->id }}">
                                    <button class="accordion-button collapsed shadow-none rounded" type="button" data-bs-toggle="collapse" 
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
                                    <div class="accordion-body bg-light rounded-bottom">
                                        <p class="mb-3">{{ $step->description }}</p>
                                        <a href="{{ $step->content_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-box-arrow-up-right me-1"></i> Acessar conteúdo
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
</div>

@push('styles')
    <style>
        .card {
            border-radius: 0.75rem;
            overflow: hidden;
        }
        .card-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(0,0,0,.05);
        }
        .accordion-item {
            margin-bottom: 0.5rem;
        }
        .accordion-button {
            font-weight: 500;
            padding: 1rem 1.25rem;
            background-color: #f8f9fa;
        }
        .accordion-button:not(.collapsed) {
            background-color: rgba(13, 110, 253, 0.05);
            color: #0d6efd;
        }
        .accordion-body {
            padding: 1rem 1.25rem;
        }
        .badge {
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.35em 0.65em;
        }
        .img-fluid {
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            max-height: 300px;
            width: 100%;
            object-fit: cover;
        }
        .bg-light {
            background-color: #f8f9fa!important;
        }
    </style>
@endpush

@endsection