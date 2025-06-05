@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="height: 250px; background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%)">
    </div>
    <section class="container p-3 p-md-5 rounded-4 bg-white shadow-sm" style="margin-top: -100px;">
        <div class="row align-items-center">
            <!-- Conteúdo do Hero -->
            <div class="col-12 col-lg-5 mb-4 mb-lg-0">
                <h2 class="fw-bold display-6 display-md-5">
                    Aprenda Angular do Zero: Primeiros Passos
                </h2>
                <div class="d-flex flex-wrap gap-1 mb-3">
                    <button class="btn btn-secondary px-3">Ver detalhes</button>
                    <button class="btn btn-outline-secondary px-3">Começar</button>
                </div>
                <div class="d-flex flex-wrap align-items-center mt-3">
                    <span class="badge bg-primary text-white rounded-pill px-2 px-md-3 py-1 py-md-2 shadow-sm me-2 mb-2 mb-md-0">HTML</span>
                    <span class="badge bg-danger text-white rounded-pill px-2 px-md-3 py-1 py-md-2 shadow-sm me-2 mb-2 mb-md-0">Angular</span>
                    <div class="d-flex align-items-center me-3 mb-2 mb-md-0">
                        <iconify-icon icon="solar:clock-circle-bold-duotone" class="me-1"></iconify-icon>
                        <small class="text-muted">2h40</small>
                    </div>
                    <div class="d-flex align-items-center mb-2 mb-md-0">
                        <iconify-icon icon="solar:notebook-bold-duotone" class="me-1"></iconify-icon>
                        <small class="text-muted">8 aulas</small>
                    </div>
                </div>
            </div>
        
            <!-- Carrossel de Aulas -->
            <div class="col-12 col-lg-7">
                <div class="position-relative">
                    <div id="carouselCursoDestaque" class="carousel slide" data-bs-ride="false">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row g-2">
                                    @for ($i = 1; $i < 5; $i++)
                                        <div class="col-12 col-lg-3 mb-2 mb-sm-0">
                                            <div class="card h-100 border-0 bg-light rounded-4">
                                                <div class="card-body d-flex flex-column p-2 p-sm-3">
                                                    <div class="d-flex justify-content-end mb-2">
                                                        <iconify-icon icon="solar:bookmark-linear" class="fs-5"></iconify-icon>
                                                    </div>
                                                    <h5 class="card-title flex-grow-1 fs-6">Aula {{ $i }}</h5>
                                                    <div class="progress mb-2 bg-white" style="height: 4px;">
                                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <p class="card-text text-muted small mb-0">20 min</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row g-2">
                                    @for ($i = 5; $i < 9; $i++)
                                        <div class="col-12 col-md-4 col-lg-3 mb-2 mb-sm-0">
                                            <div class="card h-100 border-0 bg-light rounded-4">
                                                <div class="card-body d-flex flex-column p-2 p-sm-3">
                                                    <div class="d-flex justify-content-end mb-2">
                                                        <iconify-icon icon="solar:bookmark-linear" class="fs-5"></iconify-icon>
                                                    </div>
                                                    <h5 class="card-title flex-grow-1 fs-6">Aula {{ $i }}</h5>
                                                    <div class="progress mb-2 bg-white" style="height: 4px;">
                                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <p class="card-text text-muted small mb-0">20 min</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <button class="btn btn-sm btn-light rounded-circle shadow-sm me-1" type="button" data-bs-target="#carouselCursoDestaque" data-bs-slide="prev">
                            <iconify-icon icon="solar:arrow-left-linear"></iconify-icon>
                        </button>
                        <button class="btn btn-sm btn-light rounded-circle shadow-sm" type="button" data-bs-target="#carouselCursoDestaque" data-bs-slide="next">
                            <iconify-icon icon="solar:arrow-right-linear"></iconify-icon>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container pt-5 pb-2">
        <div class="row mb-3">
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="bg-primary bg-opacity-25 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-white text-primary rounded-pill px-3 py-2 shadow-sm">HTML</span>
                            <button class="btn border-0">
                                <iconify-icon icon="solar:bookmark-linear" class="text-secondary" width="24"></iconify-icon>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Frontend</h5>
                        <p class="card-text text-muted small">Aprenda HTML, CSS e JavaScript para criar interfaces web interativas</p>
                        <div class="d-flex align-items-center mt-3 justify-content-between">
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="badge rounded-pill bg-primary me-1">Iniciante</span>
                                <span class="badge rounded-pill bg-secondary me-2 d-flex align-items-center justify-content-center">
                                    <iconify-icon icon="solar:star-bold" class="me-1"></iconify-icon> 4.9
                                </span>
                            </div>
                            <small class="fw-semibold text-muted">8h</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="bg-info bg-opacity-25 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-white text-info rounded-pill px-3 py-2 shadow-sm">React</span>
                            <button class="btn border-0">
                                <iconify-icon icon="solar:bookmark-linear" class="text-secondary" width="24"></iconify-icon>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">React JS</h5>
                        <p class="card-text text-muted small">Desenvolva aplicações web modernas com a biblioteca React</p>
                        <div class="d-flex align-items-center mt-3 justify-content-between">
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="badge rounded-pill bg-info me-1">Iniciante</span>
                                <span class="badge rounded-pill bg-secondary me-2 d-flex align-items-center justify-content-center">
                                    <iconify-icon icon="solar:star-bold" class="me-1"></iconify-icon> 4.4
                                </span>
                            </div>
                            <small class="fw-semibold text-muted">10h</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="bg-success bg-opacity-25 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-white text-success rounded-pill px-3 py-2 shadow-sm">Node.js</span>
                            <button class="btn border-0">
                                <iconify-icon icon="solar:bookmark-linear" class="text-secondary" width="24"></iconify-icon>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Node.js</h5>
                        <p class="card-text text-muted small">Crie APIs e servidores web com JavaScript no backend</p>
                        <div class="d-flex align-items-center mt-3 justify-content-between">
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="badge rounded-pill bg-success me-1">Avançado</span>
                                <span class="badge rounded-pill bg-secondary me-2 d-flex align-items-center justify-content-center">
                                    <iconify-icon icon="solar:star-bold" class="me-1"></iconify-icon> 4.8
                                </span>
                            </div>
                            <small class="fw-semibold text-muted">12h</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="bg-danger bg-opacity-25 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-white text-danger rounded-pill px-3 py-2 shadow-sm">Angular</span>
                            <button class="btn border-0">
                                <iconify-icon icon="solar:bookmark-bold-duotone" class="text-secondary" width="24"></iconify-icon>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold d-flex align-items-center justify-content-start">
                            Angular <iconify-icon icon="solar:verified-check-bold" class="text-primary ms-1"></iconify-icon>
                        </h5>
                        <p class="card-text text-muted small">Desenvolva aplicações web robustas com o framework Angular</p>
                        <div class="d-flex align-items-center mt-3 mb-1 justify-content-between">
                            
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="badge rounded-pill bg-danger me-1">Avançado</span>
                                <span class="badge rounded-pill bg-secondary me-2 d-flex align-items-center justify-content-center">
                                    <iconify-icon icon="solar:star-bold" class="me-1"></iconify-icon> 4.6
                                </span>
                            </div>
                            <small class="fw-semibold text-muted">14h</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="bg-warning bg-opacity-25 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-white text-warning rounded-pill px-3 py-2 shadow-sm">Agile</span>
                            <button class="btn border-0">
                                <iconify-icon icon="solar:bookmark-bold-duotone" class="text-secondary" width="24"></iconify-icon>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Metodologias Ágeis</h5>
                        <p class="card-text text-muted small">Aprenda Scrum, Kanban e outras metodologias ágeis para gestão de projetos</p>
                        <div class="d-flex align-items-center mt-3 justify-content-between">
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="badge rounded-pill bg-warning me-1">Avançado</span>
                                <span class="badge rounded-pill bg-secondary me-2 d-flex align-items-center justify-content-center">
                                    <iconify-icon icon="solar:star-bold" class="me-1"></iconify-icon> 5.0
                                </span>
                            </div>
                            <small class="fw-semibold text-muted">6h</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="bg-primary bg-opacity-25 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-white text-primary rounded-pill px-3 py-2 shadow-sm">DevOps</span>
                            <button class="btn border-0">
                                <iconify-icon icon="solar:bookmark-linear" class="text-secondary" width="24"></iconify-icon>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">DevOps</h5>
                        <p class="card-text text-muted small">Integração e entrega contínua com Docker, Jenkins e Kubernetes</p>
                        <div class="d-flex align-items-center mt-3 justify-content-between">
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="badge rounded-pill bg-primary me-1">Avançado</span>
                                <span class="badge rounded-pill bg-secondary me-2 d-flex align-items-center justify-content-center">
                                    <iconify-icon icon="solar:star-bold" class="me-1"></iconify-icon> 4.6
                                </span>
                            </div>
                            <small class="fw-semibold text-muted">15h</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="bg-info bg-opacity-25 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-white text-info rounded-pill px-3 py-2 shadow-sm">TDD</span>
                            <button class="btn border-0">
                                <iconify-icon icon="solar:bookmark-linear" class="text-secondary" width="24"></iconify-icon>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Testes de Software</h5>
                        <p class="card-text text-muted small">Aprenda TDD, BDD e automação de testes para garantir qualidade</p>
                        <div class="d-flex align-items-center mt-3 justify-content-between">
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="badge rounded-pill bg-info me-1">Intermediário</span>
                                <span class="badge rounded-pill bg-secondary me-2 d-flex align-items-center justify-content-center">
                                    <iconify-icon icon="solar:star-bold" class="me-1"></iconify-icon> 4.7
                                </span>
                            </div>
                            <small class="fw-semibold text-muted">8h</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="bg-success bg-opacity-25 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-white text-success rounded-pill px-3 py-2 shadow-sm">Design</span>
                            <button class="btn border-0">
                                <iconify-icon icon="solar:bookmark-linear" class="text-secondary" width="24"></iconify-icon>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Arquitetura de Software</h5>
                        <p class="card-text text-muted small">Padrões de projeto, SOLID e arquiteturas modernas</p>
                        <div class="d-flex align-items-center mt-3 justify-content-between">
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="badge rounded-pill bg-success me-1">Iniciante</span>
                                <span class="badge rounded-pill bg-secondary me-2 d-flex align-items-center justify-content-center">
                                    <iconify-icon icon="solar:star-bold" class="me-1"></iconify-icon> 4.8
                                </span>
                            </div>
                            <small class="fw-semibold text-muted">10h</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container pb-5 mb-4">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-3 px-4">
                <div class="row d-flex align-items-end justify-content-center">
                    <div class="col-md-2 mb-3 mb-md-0">
                        <label class="form-label small fw-bold">Nível</label>
                        <select class="form-select rounded-3 border-0 bg-light">
                            <option selected>Todos os níveis</option>
                            <option>Iniciante</option>
                            <option>Intermediário</option>
                            <option>Avançado</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3 mb-md-0">
                        <label class="form-label small fw-bold">Duração</label>
                        <select class="form-select rounded-3 border-0 bg-light">
                            <option selected>Qualquer duração</option>
                            <option>Menos de 3 horas</option>
                            <option>3-10 horas</option>
                            <option>Mais de 10 horas</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3 mb-md-0">
                        <label class="form-label small fw-bold">Categoria</label>
                        <select class="form-select rounded-3 border-0 bg-light">
                            <option selected>Todas as categorias</option>
                            <option>Desenvolvimento Web</option>
                            <option>Engenharia de Software</option>
                            <option>Data Science</option>
                            <option>Mobile</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3 mb-md-0">
                        <label class="form-label small fw-bold">Avaliação</label>
                        <select class="form-select rounded-3 border-0 bg-light">
                            <option selected>Qualquer avaliação</option>
                            <option>4.5 ou mais</option>
                            <option>4.0 ou mais</option>
                            <option>3.5 ou mais</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3 mb-md-0">
                        <label class="form-label small fw-bold">Tipo</label>
                        <select class="form-select rounded-3 border-0 bg-light">
                            <option selected>Todos</option>
                            <option>Oficial</option>
                            <option>Comunidade</option>
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary w-100 py-2 rounded-3">
                            Pesquisar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5" style="background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%)">
        <div class="container text-white">
            <h3 class="fw-bold mb-4 text-white">Tech Creators</h3>
            <div class="row">
                <div class="col-lg-2 col-md-3 col-12 text-center mb-4">
                    <div class="rounded-circle bg-light mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; position: relative;">
                        <iconify-icon icon="solar:user-rounded-bold-duotone" class="text-secondary" style="font-size: 80px;"></iconify-icon>
                        <span class="position-absolute bottom-0 end-0 d-flex align-items-center justify-content-center">
                            <iconify-icon icon="solar:add-circle-bold" class="text-primary bg-white rounded-circle" style="font-size: 24px;"></iconify-icon>
                        </span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="small me-1">
                            Nome Apelido
                        </span>
                        <iconify-icon icon="solar:verified-check-bold-duotone" class="text-primary"></iconify-icon>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12 text-center mb-4">
                    <div class="rounded-circle bg-light mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; position: relative;">
                        <iconify-icon icon="solar:user-rounded-bold-duotone" class="text-secondary" style="font-size: 80px;"></iconify-icon>
                        <span class="position-absolute bottom-0 end-0 d-flex align-items-center justify-content-center">
                            <iconify-icon icon="solar:check-circle-bold" class="text-success bg-white rounded-circle" style="font-size: 24px;"></iconify-icon>
                        </span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="small me-1">
                            Nome Apelido
                        </span>
                        <iconify-icon icon="solar:verified-check-bold-duotone" class="text-primary"></iconify-icon>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12 text-center mb-4">
                    <div class="rounded-circle bg-light mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; position: relative;">
                        <iconify-icon icon="solar:user-rounded-bold-duotone" class="text-secondary" style="font-size: 80px;"></iconify-icon>
                        <span class="position-absolute bottom-0 end-0 d-flex align-items-center justify-content-center">
                            <iconify-icon icon="solar:check-circle-bold" class="text-success bg-white rounded-circle" style="font-size: 24px;"></iconify-icon>
                        </span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="small me-1">
                            Nome Apelido
                        </span>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12 text-center mb-4">
                    <div class="rounded-circle bg-light mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; position: relative;">
                        <iconify-icon icon="solar:user-rounded-bold-duotone" class="text-secondary" style="font-size: 80px;"></iconify-icon>
                        <span class="position-absolute bottom-0 end-0 d-flex align-items-center justify-content-center">
                            <iconify-icon icon="solar:add-circle-bold" class="text-primary bg-white rounded-circle" style="font-size: 24px;"></iconify-icon>
                        </span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="small me-1">
                            Nome Apelido
                        </span>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12 text-center mb-4">
                    <div class="rounded-circle bg-light mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; position: relative;">
                        <iconify-icon icon="solar:user-rounded-bold-duotone" class="text-secondary" style="font-size: 80px;"></iconify-icon>
                        <span class="position-absolute bottom-0 end-0 d-flex align-items-center justify-content-center">
                            <iconify-icon icon="solar:add-circle-bold" class="text-primary bg-white rounded-circle" style="font-size: 24px;"></iconify-icon>
                        </span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="small me-1">
                            Nome Apelido
                        </span>
                        <iconify-icon icon="solar:verified-check-bold-duotone" class="text-primary"></iconify-icon>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12 text-center mb-4">
                    <div class="rounded-circle bg-light mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; position: relative;">
                        <iconify-icon icon="solar:user-rounded-bold-duotone" class="text-secondary" style="font-size: 80px;"></iconify-icon>
                        <span class="position-absolute bottom-0 end-0 d-flex align-items-center justify-content-center">
                            <iconify-icon icon="solar:add-circle-bold" class="text-primary bg-white rounded-circle" style="font-size: 24px;"></iconify-icon>
                        </span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="small me-1">
                            Nome Apelido
                        </span>
                        <iconify-icon icon="solar:verified-check-bold-duotone" class="text-primary"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container mt-5">
        <h3 class="fw-bold mb-4">Cursos Guardados</h3>
        <div class="card bg-white border-0 shadow-sm rounded-4 p-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0" style="background-color: #fff !important;">
                        <thead>
                            <tr>
                                <th class="ps-4">Curso</th>
                                <th class="">Categoria</th>
                                <th class="">Progresso</th>
                                <th class="">Duração</th>
                                <th class="text-end pe-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3 d-flex align-items-center justify-content-center">
                                            <iconify-icon icon="solar:code-square-linear" width="24" height="24" class="text-primary"></iconify-icon>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">JavaScript Avançado</h6>
                                            <small class="text-muted">por Maria Aparecida</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Desenvolvimento Web</td>
                                <td>
                                    <div class="progress" style="height: 6px; width: 120px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="text-muted">75%</small>
                                </td>
                                <td>8h</td>
                                <td class="d-flex align-items-center align-content-center justify-content-end">
                                    <button class="btn btn-sm btn-primary border-0 rounded-circle d-flex align-items-center justify-content-center me-1" style="width: 24px; height: 24px;">
                                        <iconify-icon icon="solar:play-bold" class="text-white" style="font-size: 12px;" ></iconify-icon>
                                    </button>
                                    <button class="btn btn-sm d-flex align-items-center justify-content-center me-1" style="width: 24px; height: 24px;">
                                        <iconify-icon icon="solar:document-add-bold-duotone" class="text-secondary" style="font-size: 24px;"></iconify-icon>
                                    </button>
                                    <button class="btn btn-sm d-flex align-items-center justify-content-center me-1" style="width: 24px; height: 24px;">
                                        <iconify-icon icon="solar:chat-round-bold" class="text-secondary" style="font-size: 24px;"></iconify-icon>
                                    </button>
                                    <button class="btn btn-sm d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;">
                                        <iconify-icon icon="solar:archive-bold-duotone" class="text-secondary" style="font-size: 24px;"></iconify-icon>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3 d-flex align-items-center justify-content-center">
                                            <iconify-icon icon="solar:database-linear" width="24" height="24" class="text-success"></iconify-icon>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">SQL para Iniciantes</h6>
                                            <small class="text-muted">por Pedro Aparecido</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Banco de Dados</td>
                                <td>
                                    <div class="progress" style="height: 6px; width: 120px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="text-muted">30%</small>
                                </td>
                                <td>5h</td>
                                <td class="d-flex align-items-center align-content-center justify-content-end">
                                    <button class="btn btn-sm btn-primary border-0 rounded-4 d-flex align-items-center justify-content-center me-1" style="width: 24px; height: 24px;">
                                        <iconify-icon icon="solar:play-bold" class="text-white" style="font-size: 12px;" ></iconify-icon>
                                    </button>
                                    <button class="btn btn-sm d-flex align-items-center justify-content-center me-1" style="width: 24px; height: 24px;">
                                        <iconify-icon icon="solar:document-add-bold-duotone" class="text-secondary" style="font-size: 24px;"></iconify-icon>
                                    </button>
                                    <button class="btn btn-sm d-flex align-items-center justify-content-center me-1" style="width: 24px; height: 24px;">
                                        <iconify-icon icon="solar:chat-round-bold" class="text-secondary" style="font-size: 24px;"></iconify-icon>
                                    </button>
                                    <button class="btn btn-sm d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;">
                                        <iconify-icon icon="solar:archive-bold-duotone" class="text-secondary" style="font-size: 24px;"></iconify-icon>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info bg-opacity-10 p-2 rounded-3 me-3 d-flex align-items-center justify-content-center">
                                            <iconify-icon icon="solar:cloud-linear" width="24" height="24" class="text-info"></iconify-icon>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">AWS Fundamentals</h6>
                                            <small class="text-muted">por Bruno Agostinho</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Cloud Computing</td>
                                <td>
                                    <div class="progress" style="height: 6px; width: 120px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="text-muted">0%</small>
                                </td>
                                <td>12h</td>
                                <td class="d-flex align-items-center align-content-center justify-content-end">
                                    <button class="btn btn-sm btn-primary border-0 rounded-4 d-flex align-items-center justify-content-center me-1" style="width: 24px; height: 24px;"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top">
                                        <iconify-icon icon="solar:play-bold" class="text-white" style="font-size: 12px;" ></iconify-icon>
                                    </button>
                                    <button class="btn btn-sm d-flex align-items-center justify-content-center me-1" style="width: 24px; height: 24px;">
                                        <iconify-icon icon="solar:document-add-bold-duotone" class="text-secondary" style="font-size: 24px;"></iconify-icon>
                                    </button>
                                    <button class="btn btn-sm d-flex align-items-center justify-content-center me-1" style="width: 24px; height: 24px;">
                                        <iconify-icon icon="solar:chat-round-bold" class="text-secondary" style="font-size: 24px;"></iconify-icon>
                                    </button>
                                    <button class="btn btn-sm d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;">
                                        <iconify-icon icon="solar:archive-bold-duotone" class="text-secondary" style="font-size: 24px;"></iconify-icon>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-5">
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

    <!-- Comunidade -->
    <section class="container pb-5 my-5">
        <h3 class="fw-bold mb-4">Comunidade</h3>
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-4 row g-3 d-flex align-items-center justify-content-center">
                    <div class="col-6 col-md-3">
                        <a href="#" class="text-decoration-none">
                            <div class="bg-white rounded-4 p-3 d-flex flex-column align-items-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle mb-2 d-flex flex-column align-items-center">
                                    <iconify-icon icon="solar:chat-round-dots-linear" width="24" height="24" class="text-primary"></iconify-icon>
                                </div>
                                <span class="small fw-bold">Fórum</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#" class="text-decoration-none">
                            <div class="bg-white rounded-4 p-3 d-flex flex-column align-items-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle mb-2 d-flex flex-column align-items-center">
                                    <iconify-icon icon="solar:calendar-mark-linear" width="24" height="24" class="text-primary"></iconify-icon>
                                </div>
                                <span class="small fw-bold">Eventos</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#" class="text-decoration-none">
                            <div class="bg-white rounded-4 p-3 d-flex flex-column align-items-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle mb-2 d-flex flex-column align-items-center">
                                    <iconify-icon icon="solar:users-group-two-rounded-linear" width="24" height="24" class="text-primary"></iconify-icon>
                                </div>
                                <span class="small fw-bold">Grupos</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#" class="text-decoration-none">
                            <div class="bg-white rounded-4 p-3 d-flex flex-column align-items-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle mb-2 d-flex flex-column align-items-center">
                                    <iconify-icon icon="solar:document-text-linear" width="24" height="24" class="text-primary"></iconify-icon>
                                </div>
                                <span class="small fw-bold">Recursos</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <div class="rounded-circle bg-light me-3" style="width: 50px; height: 50px; overflow: hidden;">
                                <div class="bg-primary bg-opacity-10 w-100 h-100 d-flex align-items-center justify-content-center">
                                    <iconify-icon icon="solar:user-rounded-linear" width="30" height="30"></iconify-icon>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold d-flex align-items-center">
                                    Maria Aparecida <iconify-icon icon="solar:verified-check-bold" class="text-primary ms-1"></iconify-icon>
                                </h6>
                                <small class="text-muted">Mentora • 2 horas atrás</small>
                            </div>
                        </div>
                        <p>Acabei de lançar um novo curso sobre TypeScript! Venham conferir e aprender como adicionar tipagem estática ao JavaScript para criar aplicações mais robustas e escaláveis.</p>
                        <div class="bg-light rounded-3 p-3 mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-start">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3 d-flex align-items-center">
                                        <iconify-icon icon="solar:code-square-linear" width="24" height="24" class="text-primary"></iconify-icon>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">TypeScript: Do Zero ao Avançado</h6>
                                        <small class="text-muted">Novo curso disponível</small>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-primary border-0 rounded-circle d-flex align-items-center justify-content-center me-1" style="width: 35px; height: 35px;">
                                    <iconify-icon icon="solar:play-bold" class="text-white" style="font-size: 18px;" ></iconify-icon>
                                </button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-sm btn-light rounded-pill me-2 d-flex align-items-center justify-content-center">
                                <iconify-icon icon="solar:heart-bold" class="text-danger me-1"></iconify-icon> 24
                            </button>
                            <button class="btn btn-sm btn-light rounded-pill me-2 d-flex align-items-center justify-content-center">
                                <iconify-icon icon="solar:chat-round-dots-linear" class="me-1"></iconify-icon> 8
                            </button>
                            <button class="btn btn-sm btn-light rounded-pill d-flex align-items-center justify-content-center">
                                <iconify-icon icon="solar:share-linear" class="me-1"></iconify-icon> Partilhar
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <div class="rounded-circle bg-light me-3" style="width: 50px; height: 50px; overflow: hidden;">
                                <div class="bg-info bg-opacity-10 w-100 h-100 d-flex align-items-center justify-content-center">
                                    <iconify-icon icon="solar:user-rounded-linear" width="30" height="30"></iconify-icon>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold d-flex align-items-center">
                                    Thalyson Santos <iconify-icon icon="solar:verified-check-bold" class="text-primary ms-1"></iconify-icon>
                                </h6>
                                <small class="text-muted">Equipa Studify • 1 dia atrás</small>
                            </div>
                        </div>
                        <p>Estamos organizando um evento online gratuito sobre Desenvolvimento Web! Teremos palestras sobre as últimas tendências e tecnologias. Não percam!</p>
                        <div class="bg-light rounded-3 p-3 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-start">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3 d-flex align-items-center">
                                        <iconify-icon icon="solar:calendar-mark-linear" width="24" height="24" class="text-info"></iconify-icon>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Web Dev Summit 2025</h6>
                                        <small class="text-muted">15 de Junho • 19:00</small>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-info text-white rounded-pill ms-auto">Participar</button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-sm btn-light rounded-pill me-2 d-flex align-items-center justify-content-center">
                                <iconify-icon icon="solar:heart-linear" class="me-1"></iconify-icon> 42
                            </button>
                            <button class="btn btn-sm btn-light rounded-pill me-2 d-flex align-items-center justify-content-center">
                                <iconify-icon icon="solar:chat-round-dots-linear" class="me-1"></iconify-icon> 15
                            </button>
                            <button class="btn btn-sm btn-light rounded-pill d-flex align-items-center justify-content-center">
                                <iconify-icon icon="solar:share-linear" class="me-1"></iconify-icon> Partilhar
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-2 d-flex align-items-center justify-content-center">
                    <a href="#" class="btn btn-primary text-dark rounded-pill mt-4 px-4">Ver toda a comunidade</a>
                </div>
            </div>

            <div class="col-lg-4 d-none d-lg-block">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">Eventos Próximos</h5>
                        </div>
                        <div class="d-flex align-items-center mb-3 event-item" data-bs-toggle="modal" data-bs-target="#eventModal1" style="cursor: pointer;">
                            <div class="bg-info bg-opacity-10 p-2 rounded-3 me-3 text-center" style="width: 50px;">
                                <span class="fw-bold">15</span><br>
                                <small>Jun</small>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Web Dev Summit 2025</h6>
                                <small class="text-muted">Online • 19:00</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3 event-item" data-bs-toggle="modal" data-bs-target="#eventModal2" style="cursor: pointer;">
                            <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3 text-center" style="width: 50px;">
                                <span class="fw-bold">22</span><br>
                                <small>Jun</small>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Workshop React</h6>
                                <small class="text-muted">Online • 14:00</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center event-item" data-bs-toggle="modal" data-bs-target="#eventModal3" style="cursor: pointer;">
                            <div class="bg-warning bg-opacity-10 p-2 rounded-3 me-3 text-center" style="width: 50px;">
                                <span class="fw-bold">30</span><br>
                                <small>Jun</small>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Hackathon</h6>
                                <small class="text-muted">Online • 09:00</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal modal-lg fade border-0" id="eventModal1" tabindex="-1" aria-labelledby="eventModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title fw-bold" id="eventModalLabel1">Web Dev Summit 2025</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body pt-0 mb-0">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-info bg-opacity-10 p-2 rounded-3 me-3 text-center" style="width: 50px;">
                                        <span class="fw-bold">15</span><br>
                                        <small>Jun</small>
                                    </div>
                                    <div>
                                        <p class="mb-1 fw-bold">19:00 - 22:00</p>
                                        <p class="mb-0 text-muted">Evento Online</p>
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-start mb-3 bg-light rounded-3">
                                    <h6 class="mb-0 fw-bold">Participantes Confirmados</h6>
                                    <p class="mb-0 text-muted">
                                        <span class="fw-bold text-dark">247 pessoas</span> já confirmaram presença
                                    </p>
                                </div>
                                
                                <p>O maior evento de desenvolvimento web do ano! Palestras com os principais especialistas do mercado sobre as últimas tendências em frontend, backend e novas tecnologias.</p>
                                <div class="alert alert-info m-0">
                                    <iconify-icon icon="solar:info-circle-outline" class="me-2"></iconify-icon>
                                    Link de acesso será enviado por e-mail 1 hora antes do evento.
                                </div>
                            </div>
                            <div class="modal-footer border-0 pt-0 mt-0">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Talvez depois</button>
                                <button type="button" class="btn btn-info text-white">Participar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal modal-lg fade border-0" id="eventModal2" tabindex="-1" aria-labelledby="eventModalLabel2" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title fw-bold" id="eventModalLabel2">Workshop React</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body pt-0 mb-0">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3 text-center" style="width: 50px;">
                                        <span class="fw-bold">22</span><br>
                                        <small>Jun</small>
                                    </div>
                                    <div>
                                        <p class="mb-1 fw-bold">14:00 - 17:00</p>
                                        <p class="mb-0 text-muted">Evento Online</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex flex-column align-items-start mb-3 bg-light rounded-3">
                                    <h6 class="mb-0 fw-bold">Participantes Confirmados</h6>
                                    <p class="mb-0 text-muted">
                                        <span class="fw-bold text-dark">183 pessoas</span> já confirmaram presença
                                    </p>
                                </div>
                                
                                <p>Workshop prático de React.js com construção de projeto real. Traga seu notebook e codifique junto com nosso instrutor. Nível intermediário.</p>
                                <div class="alert alert-success m-0">
                                    <iconify-icon icon="solar:clock-circle-outline" class="me-2"></iconify-icon>
                                    Inscrições limitadas! Garanta sua participação.
                                </div>
                            </div>
                            <div class="modal-footer border-0 pt-0 mt-0">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Talvez depois</button>
                                <button type="button" class="btn btn-success text-white">Inscrever-se</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal modal-lg fade border-0" id="eventModal3" tabindex="-1" aria-labelledby="eventModalLabel3" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title fw-bold" id="eventModalLabel3">Hackathon</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body pt-0 mb-0">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-warning bg-opacity-10 p-2 rounded-3 me-3 text-center" style="width: 50px;">
                                        <span class="fw-bold">30</span><br>
                                        <small>Jun</small>
                                    </div>
                                    <div>
                                        <p class="mb-1 fw-bold">09:00 - 18:00</p>
                                        <p class="mb-0 text-muted">Evento Online</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex flex-column align-items-start mb-3 bg-light rounded-3 p-3">
                                    <h6 class="mb-0 fw-bold">Participantes Confirmados</h6>
                                    <p class="mb-0 text-muted">
                                        <span class="fw-bold text-dark">312 pessoas</span> já confirmaram presença
                                    </p>
                                </div>
                                
                                <p>Maratona de desenvolvimento com prêmios para os melhores projetos! Forme a sua equipa ou participe individualmente. Tema será revelado no dia.</p>
                                <div class="alert alert-warning m-0">
                                    <iconify-icon icon="solar:prize-outline" class="me-2"></iconify-icon>
                                    Prémio: 5000€ para o primeiro lugar! Máximo de membros por equipa: 3.
                                </div>
                            </div>
                            <div class="modal-footer border-0 pt-0 mt-0">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Talvez depois</button>
                                <button type="button" class="btn btn-warning text-white">Inscrever-se</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Grupos Populares</h5>
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-danger bg-opacity-10 p-2 rounded-3 me-3 d-flex align-items-center justify-content-center">
                                <iconify-icon icon="solar:users-group-rounded-linear" width="24" height="24" class="text-danger"></iconify-icon>
                            </div>
                            <div>
                                <h6 class="mb-0">Frontend Developers</h6>
                                <small class="text-muted">1.2k membros</small>
                            </div>
                            <button class="btn btn-sm text-white btn-secondary rounded-pill ms-auto">Entrar</button>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3 d-flex align-items-center justify-content-center">
                                <iconify-icon icon="solar:users-group-rounded-linear" width="24" height="24" class="text-success"></iconify-icon>
                            </div>
                            <div>
                                <h6 class="mb-0">DevOps Masters</h6>
                                <small class="text-muted">850 membros</small>
                            </div>
                            <button class="btn btn-sm text-white btn-secondary rounded-pill ms-auto">Entrar</button>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 p-2 rounded-3 me-3 d-flex align-items-center justify-content-center">
                                <iconify-icon icon="solar:users-group-rounded-linear" width="24" height="24" class="text-warning"></iconify-icon>
                            </div>
                            <div>
                                <h6 class="mb-0">Data Science</h6>
                                <small class="text-muted">1.5k membros</small>
                            </div>
                            <button class="btn btn-sm text-white btn-secondary rounded-pill ms-auto">Entrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- JavaScript personalizado -->
    <script>
        // Inicialização do carrossel
        document.addEventListener('DOMContentLoaded', function() {
            var myCarousel = document.getElementById('carouselCursoDestaque');
            var carousel = new bootstrap.Carousel(myCarousel, {
                interval: 5000,
                wrap: true
            });
        });
    </script>
</script>

@endsection