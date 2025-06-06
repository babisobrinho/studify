@extends('layouts.app')

@section('content')
    <!-- Header com gradiente igual ao dashboard -->
    <div class="container-fluid" style="height: 250px; background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%)">
    </div>
    
    <!-- Conteúdo principal com margem negativa para sobrepor ao gradiente -->
    <section class="container p-3 p-md-5 rounded-4 bg-white shadow-sm" style="margin-top: -100px;">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
            <div>
                <h1 class="fw-bold display-6 display-md-5">As Minhas Trilhas</h1>
                <p class="text-muted">Organize o seu aprendizado com trilhas estruturadas</p>
            </div>
            <a href="{{ route('tracks.create', ['username' => $user->username]) }}" class="btn btn-primary fw-semibold text-white px-3 py-2 rounded-3 shadow-sm">
                Nova Trilha
            </a>
        </div>
        
        <!-- Filtros -->
        <div class="border-0">
            <div class="row d-flex align-items-end justify-content-center">
                <div class="col-md-3 mb-3 mb-md-0">
                    <label class="form-label small fw-bold">Nível</label>
                    <select class="form-select rounded-3 border-0 bg-light">
                        <option selected>Todos os níveis</option>
                        <option>Iniciante</option>
                        <option>Intermediário</option>
                        <option>Avançado</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <label class="form-label small fw-bold">Categoria</label>
                    <select class="form-select rounded-3 border-0 bg-light">
                        <option selected>Todas as categorias</option>
                        <option>Desenvolvimento Web</option>
                        <option>Engenharia de Software</option>
                        <option>Data Science</option>
                        <option>Mobile</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <label class="form-label small fw-bold">Visibilidade</label>
                    <select class="form-select rounded-3 border-0 bg-light">
                        <option selected>Todas</option>
                        <option>Públicas</option>
                        <option>Privadas</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary w-100 py-2 rounded-3 text-white fs-semibold">
                        Filtrar
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Trilhas Grid -->
    <section class="container mt-5">
        <div class="row">
            @if(count($tracks) > 0)
                @foreach($tracks as $track)
                    @php
                        $colorClass = 'primary';
                        $trackDifficulty = 'Iniciante';

                        if($track->difficulty === 'beginner') {
                            $colorClass = 'primary';
                            $trackDifficulty = 'Iniciante';
                        } elseif($track->difficulty === 'intermediate') {
                            $colorClass = 'info';
                            $trackDifficulty = 'Intermediário';
                        } elseif($track->difficulty === 'advanced') {
                            $colorClass = 'danger';
                            $trackDifficulty = 'Avançado';
                        }
                    @endphp
                    
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="bg-{{ $colorClass }} bg-opacity-25 p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-white text-{{ $colorClass }} rounded-pill px-3 py-2 shadow-sm">
                                        {{ $trackDifficulty }}
                                    </span>
                                    <a href="{{ route('tracks.edit', ['username' => $user->username, 'id' => $track->id]) }}" class="btn border-0">
                                        <iconify-icon icon="solar:document-add-bold-duotone" class="text-secondary" width="24"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-bold">
                                    <a href="{{ route('tracks.show', ['username' => $user->username, 'id' => $track->id]) }}" class="text-decoration-none text-{{ $track->plan_color }}">
                                        {{ $track->title }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted small">{{ Str::limit($track->description, 60) }}</p>
                                <div class="d-flex align-items-center mt-3 justify-content-between">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="badge rounded-pill bg-{{ $colorClass }} me-1">
                                            {{ $track->is_public ? 'Público' : 'Privado' }}
                                        </span>
                                        <span class="badge rounded-pill bg-secondary me-2">
                                            @php
                                                $stepsCount = DB::table('steps')->where('track_id', $track->id)->count();
                                            @endphp
                                            {{ $stepsCount }} passos
                                        </span>
                                    </div>
                                    <a href="{{ route('tracks.show', ['username' => $user->username, 'id' => $track->id]) }}" class="btn btn-sm rounded-circle" style="background-color: {{ $track->plan_color ?? '#06D6A0' }}; color: white; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
                                        <iconify-icon icon="solar:play-bold" style="font-size: 12px;"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <div class="text-muted">
                        <iconify-icon icon="solar:playlist-minimalistic-bold-duotone" style="font-size: 64px;"></iconify-icon>
                        <h5 class="mt-3">Nenhuma trilha de estudos encontrada</h5>
                        <p>Crie sua primeira trilha de estudos clicando no botão "Nova Trilha".</p>
                        <a href="{{ route('tracks.create', ['username' => $user->username]) }}" class="btn btn-primary mt-2">
                            <iconify-icon icon="solar:add-circle-bold-duotone" class="me-1"></iconify-icon> Criar Trilha
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
    
    <!-- Roadmaps Sugeridos -->
    @if(count($tracks) > 0)
        <section class="container mt-3 mb-5 pb-4">
            <h3 class="fw-bold mb-4">Roadmaps</h3>
            <div class="accordion" id="roadmapAccordion">
                <div class="card shadow-sm rounded-4 mb-3">
                    <div class="card-header bg-white border-0 p-0">
                        <button class="btn w-100 text-start p-0" type="button" data-bs-toggle="collapse" data-bs-target="#frontendMaster">
                            <div class="card-body">
                                <div class="d-flex flex-column flex-md-row align-items-md-center align-items-start">
                                    <div class="bg-danger bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center me-3 mb-3 mb-md-0" style="width: 60px; height: 60px;">
                                        <iconify-icon icon="solar:window-frame-linear" width="32" height="32" class="text-danger"></iconify-icon>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-0">Frontend Master</h5>
                                        <p class="text-muted mb-3 mb-md-0">Domine o desenvolvimento frontend para ganhar esta badge</p>
                                    </div>
                                    <div class="ms-md-auto">
                                        <span class="badge bg-danger rounded-pill px-3 py-2">2/5 Completos</span>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div id="frontendMaster" class="collapse" data-bs-parent="#roadmapAccordion">
                        <div class="card-body pt-0">
                            <div class="progress mb-4" style="height: 8px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-success rounded-circle p-0 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                    <iconify-icon icon="solar:check-circle-bold" class="text-white fs-4"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">HTML & CSS Fundamentals</h6>
                                                    <small class="text-muted">Completo</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-success rounded-circle p-0 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                    <iconify-icon icon="solar:check-circle-bold" class="text-white fs-4"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">JavaScript Essentials</h6>
                                                    <small class="text-muted">Completo</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-white rounded-circle p-0 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                    <iconify-icon icon="solar:lock-keyhole-unlocked-bold-duotone" class="text-danger fs-5"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">React Fundamentals</h6>
                                                    <small class="text-muted">15/20 Passos</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-secondary rounded-circle p-0 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                    <iconify-icon icon="solar:lock-keyhole-bold-duotone" class="text-white fs-5"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Responsive Web Design</h6>
                                                    <small class="text-muted">Não iniciado</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-secondary rounded-circle p-0 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                    <iconify-icon icon="solar:lock-keyhole-bold-duotone" class="text-white fs-5"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Frontend Performance</h6>
                                                    <small class="text-muted">Não iniciado</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header bg-white border-0 p-0">
                        <button class="btn w-100 text-start p-0" type="button" data-bs-toggle="collapse" data-bs-target="#backendExpert">
                            <div class="card-body">
                                <div class="d-flex flex-column flex-md-row align-items-md-center align-items-start">
                                    <div class="bg-warning bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center mb-3 mb-md-0 me-3" style="width: 60px; height: 60px;">
                                        <iconify-icon icon="solar:server-linear" width="32" height="32" class="text-warning"></iconify-icon>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-0">Backend Expert</h5>
                                        <p class="text-muted mb-3 mb-md-0">Domine o desenvolvimento backend para ganhar esta badge</p>
                                    </div>
                                    <div class="ms-md-auto">
                                        <span class="badge bg-warning rounded-pill px-3 py-2">1/4 Completos</span>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div id="backendExpert" class="collapse" data-bs-parent="#roadmapAccordion">
                        <div class="card-body pt-0">
                            <div class="progress mb-4" style="height: 8px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-success rounded-circle p-0 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                    <iconify-icon icon="solar:check-circle-bold" class="text-white fs-4"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Node.js Basics</h6>
                                                    <small class="text-muted">Completo</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-white rounded-circle p-0 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                    <iconify-icon icon="solar:lock-keyhole-unlocked-bold-duotone" class="text-warning fs-5"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">API Design</h6>
                                                    <small class="text-muted">3/12 Passos</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-secondary rounded-circle p-0 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                    <iconify-icon icon="solar:lock-keyhole-bold-duotone" class="text-white fs-5"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Database Management</h6>
                                                    <small class="text-muted">Não iniciado</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-secondary rounded-circle p-0 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                    <iconify-icon icon="solar:lock-keyhole-bold-duotone" class="text-white fs-5"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Authentication & Security</h6>
                                                    <small class="text-muted">Não iniciado</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header bg-white border-0 p-0">
                        <button class="btn w-100 text-start p-0" type="button" data-bs-toggle="collapse" data-bs-target="#fullstackDev">
                            <div class="card-body">
                                <div class="d-flex flex-column flex-md-row align-items-md-center align-items-start">
                                    <div class="bg-success bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center me-3 mb-3 mb-md-0" style="width: 60px; height: 60px;">
                                        <iconify-icon icon="solar:code-square-linear" width="32" height="32" class="text-success"></iconify-icon>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-0">Fullstack Developer</h5>
                                        <p class="text-muted mb-3 mb-md-0">Domine frontend e backend para ganhar esta badge</p>
                                    </div>
                                    <div class="ms-md-auto">
                                        <span class="badge bg-success rounded-pill px-3 py-2">0/3 Completos</span>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div id="fullstackDev" class="collapse" data-bs-parent="#roadmapAccordion">
                        <div class="card-body pt-0">
                            <div class="progress mb-4" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-secondary rounded-circle p-0 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                    <iconify-icon icon="solar:lock-keyhole-bold-duotone" class="text-white fs-5"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Fullstack Architecture</h6>
                                                    <small class="text-muted">Não iniciado</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-secondary rounded-circle p-0 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                    <iconify-icon icon="solar:lock-keyhole-bold-duotone" class="text-white fs-5"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Deployment Strategies</h6>
                                                    <small class="text-muted">Não iniciado</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-secondary rounded-circle p-0 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                    <iconify-icon icon="solar:lock-keyhole-bold-duotone" class="text-white fs-5"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Project Integration</h6>
                                                    <small class="text-muted">Não iniciado</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-0 bg-white m-0"></div>
                </div>
            </div>
        </section>
    @endif
@endsection