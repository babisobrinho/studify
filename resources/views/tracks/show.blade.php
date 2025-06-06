@extends('layouts.app')

@section('content')

    @php
        // Define difficulty variables before using them
        $difficultyClass = 'primary';
        $difficultyText = 'Iniciante';
        
        if($track->difficulty === 'beginner') {
            $difficultyClass = 'primary';
            $difficultyText = 'Iniciante';
        } elseif($track->difficulty === 'intermediate') {
            $difficultyClass = 'info';
            $difficultyText = 'Intermediário';
        } elseif($track->difficulty === 'advanced') {
            $difficultyClass = 'danger';
            $difficultyText = 'Avançado';
        }
    @endphp

    <!-- Header com gradiente igual ao dashboard -->
    <div class="container-fluid bg-{{ $track->plan_color }} bg-opacity-25" style="height: 250px;">
    </div>
    
    <section class="container p-3 p-md-5 rounded-4 bg-white shadow-sm" style="margin-top: -100px;">
        <div class="row">
            <!-- Informações da Trilha -->
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h2 class="fw-bold display-6 display-md-5">
                        {{ $track->title }}
                    </h2>
                    @if($track->user_id == auth()->user()->id)
                        <a href="{{ route('tracks.edit', ['username' => $user->username, 'id' => $track->id]) }}" class="btn border-0">
                            <iconify-icon icon="solar:document-add-bold-duotone" class="text-secondary" width="30"></iconify-icon>
                        </a>
                    @else
                        <button class="btn border-0">
                            <iconify-icon icon="{{ $track->is_official ? 'solar:bookmark-bold-duotone' : 'solar:bookmark-linear' }}" 
                                class="text-secondary" width="30"></iconify-icon>
                        </button>
                    @endif
                    
                </div>
                
                <p class="text-muted mb-4">{{ $track->description }}</p>
                
                <!-- First row - Badges on left, info on right -->
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <!-- Badges on left -->
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-{{ $track->plan_color }} text-white rounded-pill px-3 py-2 shadow-sm">
                            {{ $difficultyText }}
                        </span>
                        @if(isset($category) && is_object($category) && isset($category->name) && !empty(trim($category->name)))
                            <span class="badge bg-light text-{{ $track->plan_color }} rounded-pill px-3 py-2 shadow-sm">
                                {{ $category->name }}
                            </span>
                        @endif
                        @if(isset($tags) && count($tags) > 0)
                            @foreach($tags as $tag)
                                @if(is_object($tag) && isset($tag->name) && !empty(trim($tag->name)))
                                    <span class="badge bg-light text-{{ $track->plan_color }} rounded-pill px-3 py-2 shadow-sm">
                                        {{ $tag->name }}
                                    </span>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    
                    <!-- Info on right -->
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="d-flex align-items-center">
                            <iconify-icon icon="solar:clock-circle-bold-duotone" class="text-secondary me-1 fs-4"></iconify-icon>
                            <small class="text-muted">
                                @php
                                    $totalMinutes = 0;
                                    if(isset($steps) && count($steps) > 0) {
                                        foreach($steps as $step) {
                                            $totalMinutes += $step->estimated_time;
                                        }
                                    }
                                    
                                    $hours = floor($totalMinutes / 60);
                                    $minutes = $totalMinutes % 60;
                                    
                                    if($hours > 0) {
                                        echo $hours . 'h' . ($minutes > 0 ? $minutes . 'min' : '');
                                    } else {
                                        echo $minutes . 'min';
                                    }
                                @endphp
                            </small>
                        </div>
                        <div class="d-flex align-items-center">
                            <iconify-icon icon="solar:checklist-minimalistic-bold-duotone" class="text-secondary me-1 fs-4"></iconify-icon>
                            <small class="text-muted">{{ isset($steps) ? count($steps) : 0 }} passos</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <iconify-icon icon="solar:bookmark-bold-duotone" class="me-1 text-secondary fs-4"></iconify-icon>
                            <small class="text-muted">{{ isset($steps) == 0 ? 12 : 0 }}</small>
                        </div>
                        @if(isset($likesCount))
                            <div class="d-flex align-items-center">
                                <iconify-icon icon="solar:chat-round-bold" class="me-1 text-secondary fs-4"></iconify-icon>
                                <small class="text-muted">{{ $likesCount }}</small>
                            </div>
                        @endif
                        @if(isset($avgRating) && $avgRating > 0)
                            <div class="d-flex align-items-center">
                                <iconify-icon icon="solar:star-bold" class="me-1 text-warning fs-4"></iconify-icon>
                                <small class="text-muted">{{ number_format($avgRating, 1) }}</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contents" class="container mt-5">
        <h3 class="fw-bold mb-4">Passo a Passo</h3>
        @if(isset($steps) && count($steps) > 0)
            <div class="card bg-white border-0 shadow-sm rounded-4 p-3">
                <div class="card-body p-0">
                    <div class="accordion" id="stepsAccordion">
                        @foreach($steps as $index => $step)
                            @php
                                $contentType = is_object($step->content_type) ? $step->content_type->value : $step->content_type;
                                $icon = 'solar:document-linear';
                                $badgeClass = 'bg-secondary';
                                
                                if($contentType === 'video') {
                                    $icon = 'solar:videocamera-record-linear';
                                    $badgeClass = 'bg-danger';
                                } elseif($contentType === 'article') {
                                    $icon = 'solar:document-text-linear';
                                    $badgeClass = 'bg-primary';
                                } elseif($contentType === 'podcast') {
                                    $icon = 'solar:microphone-linear';
                                    $badgeClass = 'bg-info';
                                } elseif($contentType === 'course') {
                                    $icon = 'solar:square-academic-cap-linear';
                                    $badgeClass = 'bg-success';
                                } elseif($contentType === 'exercise') {
                                    $icon = 'solar:pen-new-square-linear';
                                    $badgeClass = 'bg-warning';
                                }
                            @endphp
                            
                            <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden">
                                <div class="accordion-header d-flex align-items-center p-3 bg-white rounded-3 shadow-sm" id="heading{{ $index }}">
                                    <div class="bg-{{ $track->plan_color }} bg-opacity-10 p-2 rounded-3 me-3 d-flex align-items-center justify-content-center">
                                        <iconify-icon icon="{{ $icon }}" width="24" height="24" class="text-{{ $track->plan_color }}"></iconify-icon>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">{{ $index + 1 }}. {{ $step->title }}</h6>
                                        <small class="text-muted">{{ Str::limit($step->description, 60) }}</small>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="badge {{ $badgeClass }} rounded-pill me-3">{{ ucfirst($contentType) }}</span>
                                        <span class="text-muted me-3">{{ $step->estimated_time }} min</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <a href="{{ $step->content_url }}" target="_blank" class="btn btn-sm btn-{{ $track->plan_color }} border-0 rounded-circle d-flex align-items-center justify-content-center me-1" style="width: 24px; height: 24px;">
                                            <iconify-icon icon="solar:play-bold" class="text-white" style="font-size: 12px;"></iconify-icon>
                                        </a>
                                        <button class="btn btn-sm border-0 d-flex align-items-center justify-content-center px-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                                            <iconify-icon icon="solar:notebook-bold-duotone" class="text-secondary" style="font-size: 24px;"></iconify-icon>
                                        </button>
                                    </div>
                                </div>
                                <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}" data-bs-parent="#stepsAccordion">
                                    <div class="accordion-body p-3 bg-white">
                                        <form class="notes-form" data-step-id="{{ $step->id }}">
                                            <div class="mb-3">
                                                <label for="notes{{ $index }}" class="form-label fw-bold">Anotações</label>
                                                <textarea class="form-control border-0" id="notes{{ $index }}" rows="3" placeholder="Escreva as suas anotações aqui..."></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-{{ $track->plan_color }} text-white fs-medium">Guardar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="card bg-white border-0 shadow-sm rounded-4 p-3">
                <div class="text-center py-5 text-muted">
                    <iconify-icon icon="solar:folder-open-linear" style="font-size: 48px;"></iconify-icon>
                    <p class="mt-2">Nenhum conteúdo disponível para esta trilha.</p>
                </div>
            </div>
        @endif
    </section>

    <!-- Unsaved Changes Modal -->
    <div class="modal fade" id="unsavedChangesModal" tabindex="-1" aria-labelledby="unsavedChangesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="unsavedChangesModalLabel">Alterações não salvas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Você tem alterações não salvas nas suas anotações. Deseja guardar antes de sair?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="discardChanges">Sair sem guardar</button>
                    <button type="button" class="btn btn-{{ $track->plan_color ?? 'primary' }}" id="saveChanges">Guardar e sair</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let unsavedChanges = false;
            const forms = document.querySelectorAll('.notes-form');
            const modal = new bootstrap.Modal(document.getElementById('unsavedChangesModal'));
            
            // Track changes in textareas
            forms.forEach(form => {
                const textarea = form.querySelector('textarea');
                textarea.addEventListener('input', () => {
                    unsavedChanges = true;
                });
                
                // Handle form submission
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    // Here you would typically save to the server
                    console.log('Saving notes for step', this.dataset.stepId);
                    unsavedChanges = false;
                    // Show success message
                    alert('Anotações guardadas com sucesso!');
                });
            });
            
            // Handle beforeunload
            window.addEventListener('beforeunload', function(e) {
                if (unsavedChanges) {
                    e.preventDefault();
                    e.returnValue = 'Tem certeza que deseja sair? Você tem alterações não salvas.';
                    return e.returnValue;
                }
            });
            
            // Handle accordion collapse with unsaved changes
            const accordionButtons = document.querySelectorAll('[data-bs-toggle="collapse"]');
            accordionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if (unsavedChanges) {
                        const collapseTarget = this.getAttribute('data-bs-target');
                        const currentlyOpen = document.querySelector('.accordion-collapse.show');
                        
                        if (currentlyOpen && currentlyOpen.id !== collapseTarget.replace('#', '')) {
                            modal.show();
                            
                            // Set up modal buttons
                            document.getElementById('discardChanges').onclick = function() {
                                unsavedChanges = false;
                                modal.hide();
                                // Proceed with original collapse action
                                const collapse = new bootstrap.Collapse(document.querySelector(collapseTarget));
                                collapse.show();
                            };
                            
                            document.getElementById('saveChanges').onclick = function() {
                                // Save all forms
                                forms.forEach(form => {
                                    if (form.querySelector('textarea').value.trim() !== '') {
                                        form.dispatchEvent(new Event('submit'));
                                    }
                                });
                                modal.hide();
                                // Proceed with original collapse action
                                const collapse = new bootstrap.Collapse(document.querySelector(collapseTarget));
                                collapse.show();
                            };
                            
                            return false;
                        }
                    }
                });
            });
        });
    </script>
    @endpush

    <!-- Seção Integrada de Avaliações -->
    <section class="container mt-5">
        <h3 class="fw-bold mb-4">Feedback da Comunidade</h3>
        <div class="card bg-white border-0 shadow-sm rounded-4 p-0">
            <div class="card-body p-3">
                <!-- Rating Summary -->
                <div class="row mb-4">
                    <div class="col-md-4 text-center border-end">
                        <h2 class="fw-bold display-4 text-{{ $track->plan_color }}">{{ number_format($avgRating, 1) }}</h2>
                        <div class="d-flex justify-content-center mb-2" aria-label="Avaliação média: {{ number_format($avgRating, 1) }} de 5 estrelas">
                            @for($i = 1; $i <= 5; $i++)
                                <iconify-icon icon="solar:star-bold" class="{{ $i <= round($avgRating) ? 'text-warning' : 'text-secondary' }}" 
                                    style="font-size: 24px; margin: 0 2px;" aria-hidden="true"></iconify-icon>
                            @endfor
                        </div>
                        <small class="text-muted">{{ $ratingsCount ?? 0 }} avaliações</small>
                    </div>
                    <div class="col-md-8">
                        @for($i = 5; $i >= 1; $i--)
                            <div class="d-flex align-items-center mb-2">
                                <small class="me-2 text-muted" style="width: 20px;">{{ $i }}</small>
                                <iconify-icon icon="solar:star-bold" class="text-warning me-2" aria-hidden="true"></iconify-icon>
                                <div class="progress flex-grow-1" style="height: 8px;" aria-label="{{ ($ratingDistribution[$i] ?? 0) }} avaliações com {{ $i }} estrelas">
                                    <div class="progress-bar bg-{{ $track->plan_color }}" 
                                        role="progressbar" 
                                        style="width: {{ ($ratingDistribution[$i] ?? 0) / max($ratingsCount, 1) * 100 }}%" 
                                        aria-valuenow="{{ ($ratingDistribution[$i] ?? 0) }}" 
                                        aria-valuemin="0" 
                                        aria-valuemax="{{ $ratingsCount }}"></div>
                                </div>
                                <small class="text-muted ms-2" style="width: 40px;">{{ $ratingDistribution[$i] ?? 0 }}</small>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Rating Form (only for users who haven't rated) -->
                @auth
                    @if(!$userHasRated)
                        <div class="border-top pt-4">
                            <h5 class="fw-bold mb-3">Avalie esta trilha</h5>
                            <form action="{{ route('tracks.rate', ['username' => $user->username, 'track' => $track->id]) }}" method="POST" id="ratingForm">
                                @csrf
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rating-input" role="radiogroup" aria-label="Selecione uma avaliação de 1 a 5 estrelas">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" class="btn p-0 border-0 bg-transparent" onclick="rate({{ $i }})" aria-label="Avaliar com {{ $i }} estrelas">
                                                <iconify-icon icon="solar:star-bold" 
                                                            class="rating-icon fs-4 {{ $i <= old('rating', 0) ? 'text-warning' : 'text-secondary' }}" 
                                                            data-rating="{{ $i }}"
                                                            aria-hidden="true"></iconify-icon>
                                            </button>
                                        @endfor
                                        <input type="hidden" name="rating" id="ratingValue" value="{{ old('rating', 0) }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="review" class="form-label fw-bold">Comentário (opcional)</label>
                                    <textarea class="form-control border-0" id="review" name="review" rows="3" 
                                        placeholder="O que achou desta trilha?">{{ old('review') }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-{{ $track->plan_color }} text-white fw-semibold">
                                    Enviar Avaliação
                                </button>
                            </form>
                        </div>
                    @endif
                @else
                    <div class="border-top pt-4 text-center">
                        <p class="text-muted">
                            <iconify-icon icon="solar:lock-keyhole-bold-duotone" class="me-1" aria-hidden="true"></iconify-icon>
                            Faça <a href="{{ route('login') }}" class="text-{{ $track->plan_color }}">login</a> para avaliar esta trilha.
                        </p>
                    </div>
                @endauth

                <!-- Ratings List -->
                <div class="border-top pt-4 mt-4">
                    @forelse($ratings as $rating)
                        <div class="rounded-4 bg-light mb-2 p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center me-3" 
                                        style="width: 40px; height: 40px;" aria-hidden="true">
                                        <iconify-icon icon="solar:user-rounded-bold-duotone" class="text-secondary"></iconify-icon>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $rating->user->name }}</h6>
                                        <small class="text-muted">{{ $rating->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                <div class="d-flex" aria-label="Avaliação: {{ $rating->rating }} de 5 estrelas">
                                    @for($i = 1; $i <= 5; $i++)
                                        <iconify-icon icon="solar:star-bold" 
                                            class="{{ $i <= $rating->rating ? 'text-warning' : 'text-secondary' }}"
                                            style="font-size: 18px; margin: 0 1px;"
                                            aria-hidden="true"></iconify-icon>
                                    @endfor
                                </div>
                            </div>
                            @if($rating->review)
                                <div class="ps-5 ms-3 mt-2">
                                    <p class="mb-0">{{ $rating->review }}</p>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-4 text-muted">
                            <iconify-icon icon="solar:stars-line-duotone" style="font-size: 48px;" aria-hidden="true"></iconify-icon>
                            <p class="mt-2">Nenhuma avaliação disponível.</p>
                            <p class="small">Seja o primeiro a avaliar esta trilha!</p>
                        </div>
                    @endforelse
                    
                    <!-- Paginação -->
                    @if($ratings->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            <nav aria-label="Navegação de páginas de avaliações">
                                <ul class="pagination">
                                    {{-- Link Anterior --}}
                                    @if($ratings->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-hidden="true">&laquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $ratings->previousPageUrl() }}" aria-label="Anterior">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Links das Páginas --}}
                                    @foreach($ratings->getUrlRange(1, $ratings->lastPage()) as $page => $url)
                                        <li class="page-item {{ $ratings->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    {{-- Próximo Link --}}
                                    @if($ratings->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $ratings->nextPageUrl() }}" aria-label="Próximo">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-hidden="true">&raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <script>
        function rate(rating) {
            // Atualiza todas as estrelas
            const stars = document.querySelectorAll('.rating-icon');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('text-warning');
                    star.classList.remove('text-secondary');
                } else {
                    star.classList.remove('text-warning');
                    star.classList.add('text-secondary');
                }
            });
            
            // Atualiza o valor escondido que será enviado no formulário
            document.getElementById('ratingValue').value = rating;
        }

        // Inicializa as estrelas com o valor antigo (se existir)
        document.addEventListener('DOMContentLoaded', function() {
            const oldRating = parseInt(document.getElementById('ratingValue').value) || 0;
            if (oldRating > 0) {
                rate(oldRating);
            }

            // Animação para feedback de envio
            const form = document.querySelector('#ratingForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const submitButton = this.querySelector('button[type="submit"]');
                    const originalText = submitButton.innerHTML;
                    
                    submitButton.disabled = true;
                    submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Enviando...';
                    
                    // Simulação de envio (remover em produção)
                    setTimeout(() => {
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalText;
                    }, 1000);
                    
                    // Comentar esta linha em produção
                    // e.preventDefault();
                });
            }
        });
    </script>

    <section class="container mt-5 mb-5">
        <h3 class="fw-bold mb-4">Autor & Contribuidores</h3>
        <div class="card p-3" style="background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%)">
            <div class="card-body text-center text-white fw-medium">
                <div class="row d-flex align-items-center justify-content-start">
                    <div class="col-lg-2 col-md-3 col-6 mb-4 mb-md-0">
                        <div class="rounded-circle bg-light mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; position: relative;">
                            <iconify-icon icon="solar:user-rounded-bold-duotone" class="text-secondary" style="font-size: 80px;"></iconify-icon>
                            @if($track->user_id != auth()->user()->id)
                                <span class="position-absolute bottom-0 end-0 d-flex align-items-center justify-content-center">
                                    <iconify-icon icon="solar:add-circle-bold" class="text-primary bg-white rounded-circle" style="font-size: 24px;"></iconify-icon>
                                </span>
                            @endif
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="small me-1">
                                {{ $track->user->name }}
                            </span>
                            @if($track->user_id == auth()->user()->id)
                                <iconify-icon icon="solar:verified-check-bold-duotone" class="text-primary"></iconify-icon>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recomendações -->
    <section class="container pb-5 my-5">
        <h3 class="fw-bold mb-4">Recomendações</h3>
        <div class="row">
            @foreach([
                ['title' => 'Design UX/UI para Desenvolvedores', 'creator' => 'por Designer Pro', 'badge' => 'UX/UI', 'color' => 'primary'],
                ['title' => 'TypeScript para Aplicações Robustas', 'creator' => 'por Desenvolvedor TS', 'badge' => 'TypeScript', 'color' => 'info'],
                ['title' => 'Desenvolvimento com Next.js', 'creator' => 'por React Master', 'badge' => 'Next.js', 'color' => 'success'],
                ['title' => 'Arquitetura de Software', 'creator' => 'por Arquiteto Master', 'badge' => 'Design', 'color' => 'danger']
            ] as $rec)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="bg-{{ $rec['color'] }} bg-opacity-25 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-white text-{{ $rec['color'] }} rounded-pill px-3 py-2 shadow-sm">{{ $rec['badge'] }}</span>
                                <button class="btn border-0">
                                    <iconify-icon icon="solar:bookmark-linear" class="text-secondary" width="24"></iconify-icon>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $rec['title'] }}</h5>
                            <p class="card-text text-muted small">{{ $rec['creator'] }}</p>
                            <div class="d-flex align-items-center mt-3 justify-content-between">
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="badge rounded-pill bg-{{ $rec['color'] }} me-1">Iniciante</span>
                                    <span class="badge rounded-pill bg-secondary me-2 d-flex align-items-center justify-content-center">
                                        <iconify-icon icon="solar:star-bold" class="me-1"></iconify-icon> 4.8
                                    </span>
                                </div>
                                <small class="fw-semibold text-muted">8h</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

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