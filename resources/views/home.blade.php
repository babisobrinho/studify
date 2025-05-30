@extends('layouts.app')

@section('content')
    <div class="bg-primary d-flex justify-content-center align-items-center overflow-hidden" style="height: 400px;">
        <img src="imagens/1080_x_1080_px_2.png" class="img-fluid" alt="banner" />
    </div>

    <div class="container pt-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="fw-bold fs-3 lh-sm mb-0 text-white">{{ $lastTrack->title }}</h1>
                <div class="d-flex mt-4 gap-2">
                    <a href="" class="btn btn-dark rounded-pill d-flex align-items-center px-3 py-2">
                        <x-solar-play-circle-bold-duotone class="small"/> Ver Trilha
                    </a>
                    <a href="" class="btn btn-outline-dark rounded-pill d-flex align-items-center px-3 py-2">
                        <x-solar-play-circle-bold-duotone class="small"/> Biblioteca
                    </a>
                </div>
                <div class="d-flex mt-3 text-muted small">
                    <div class="me-4">
                        <i class="fa-solid fa-eye me-1"></i>10k Views
                    </div>
                    <div>
                        <i class="fa-solid fa-bookmark me-1"></i>+ 5k Salvos
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="position-relative">
                    <button class="btn btn-sm position-absolute start-0 top-50 translate-middle-y rounded-circle shadow"
                        style="width: 30px; height: 30px; transform: translateX(-15px)" onclick="scrollCards(-1)">
                        <
                    </button>

                    <div class="d-flex flex-nowrap overflow-auto pb-3 gap-3 scroll-container" style="scroll-behavior: smooth;">
                        @foreach($lastTrackSteps as $lastTrackStep)
                            <div class="col-md-4 mb-3 flex-shrink-0">
                                <div class="card h-100 rounded-2 d-flex flex-column justify-content-between" style="height: 180px; aspect-ratio: 1 / 1;">
                                    <div class="card-body position-relative p-3 d-flex flex-column">
                                        <div class="position-absolute top-0 end-0 mt-2 me-2">
                                            <i class="fa-regular fa-bookmark text-dark"></i>
                                        </div>
                                        <div class="mt-auto">
                                            <h5 class="card-title mb-0 fw-bold">{{ $lastTrackStep->title }}</h5>
                                            <p class="card-text text-muted small mb-0">{{ $lastTrackStep->content_type }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button class="btn btn-sm position-absolute end-0 top-50 translate-middle-y rounded-circle shadow"
                        style="width: 30px; height: 30px; transform: translateX(15px); background-color: transparent" onclick="scrollCards(1)">
                        >
                    </button>
                </div>
            </div>
        </div>

        <hr class="opacity-10 my-4" />

        <!-- Desenvolvimento Web Section -->
        <section class="mb-4 px-0 w-100">
            <h2 class="h4 mb-3">Desenvolvimento Web</h2>
            <div class="position-relative">
                <div id="carouselWeb" class="carousel slide" data-bs-ride="carousel">
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselWeb" data-bs-slide="prev" style="left: -50px; width: 40px">
                        <span class="carousel-control-prev-icon rounded-circle p-2"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselWeb" data-bs-slide="next" style="right: -50px; width: 40px">
                        <span class="carousel-control-next-icon rounded-circle p-2"></span>
                        <span class="visually-hidden">Próximo</span>
                    </button>

                    <div class="carousel-inner w-100">
                        <div class="carousel-item active">
                            <div class="row g-3 mx-0">
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 px-2">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-light rounded-circle p-2 me-3">
                                                    <i class="fas fa-code text-primary"></i>
                                                </div>
                                                <h5 class="card-title mb-0">Desenvolvimento Frontend</h5>
                                            </div>
                                            <p class="card-text">
                                                Aprenda HTML, CSS e JavaScript para criar interfaces modernas e responsivas.
                                            </p>
                                            <div class="progress mt-3">
                                                <div class="progress-bar" role="progressbar" style="width: 75%"></div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-2">
                                                <small>75% concluído</small>
                                                <a href="#" class="btn btn-sm btn-primary">Continuar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tech Curators Section -->
        <section class="mb-4">
            <h2 class="h4 mb-3">Tech Curators</h2>
            <div class="row">
                <div class="col-lg-2 col-md-4 col-6 mb-4 text-center">
                    <a href="https://github.com/taysoic" target="_blank" class="text-decoration-none">
                        <img src="https://avatars.githubusercontent.com/u/184450068?v=4" class="rounded-circle mb-2" width="80" height="80" alt="Thalyson Santos" />
                        <h6 class="mb-0">Thalyson Santos</h6>
                        <small class="text-muted">Data Base Architecture</small>
                    </a>
                </div>
            </div>
        </section>

        <!-- Avaliações Section -->
        <section>
            <h2 class="h4 mb-3">Avaliações</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <img src="imagens/JHON MEGGIY RAYED.jpg" alt="Pedro Almeida" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover"/>
                                <div>
                                    <h6 class="mb-1">Pedro Almeida</h6>
                                    <div class="text-warning mb-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="card-text">
                                Os cursos da Studify são excelentes! Consegui me recolocar no mercado após concluir o bootcamp de desenvolvimento web.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection