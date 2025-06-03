@extends('layouts.app')

@section('content')
    <div class="bg-primary d-flex justify-content-center align-items-center overflow-hidden" style="height: 400px;">
        <img src="{{ asset('1080_x_1080_px_2.png') }}" class="img-fluid" alt="banner" />
    </div>

    <div class="container pt-4">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h1 class="fw-bold fs-3 lh-sm mb-0">{{ $lastTrack->title }}</h1>
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
                        @foreach(array_chunk($webDevelopmentCourses, 4) as $key => $courseGroup)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="row g-3 mx-0">
                                @foreach($courseGroup as $course)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 px-2">
                                    <div class="card h-100 course-card d-flex flex-column" data-course-id="{{ $course['id'] }}">
                                        <div class="card-body d-flex flex-column h-100">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-light rounded-circle p-2 me-3">
                                                    <i class="{{ $course['icon'] }} text-{{ $course['color'] }}"></i>
                                                </div>
                                                <h5 class="card-title mb-0">{{ $course['title'] }}</h5>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-{{ $course['color'] }} me-2">{{ ucfirst($course['difficulty']) }}</span>
                                                @if(isset($course['popularity']) && $course['popularity'] > 5)
                                                <span class="badge bg-danger"><i class="fas fa-fire me-1"></i> Popular</span>
                                                @endif
                                            </div>
                                            <p class="card-text text-truncate-3 mb-3">
                                                {{ $course['description'] }}
                                            </p>
                                            <div class="mt-auto">
                                                <div class="progress">
                                                    <div class="progress-bar bg-{{ $course['color'] }}" role="progressbar" style="width: {{ $course['progress'] }}%"></div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mt-2">
                                                    <small>{{ $course['progress'] }}% concluído</small>
                                                    <a href="#" class="btn btn-sm btn-{{ $course['color'] }} course-continue-btn">Continuar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Engenharia de Software Section -->
        <section class="mb-4 px-0 w-100">
            <h2 class="h4 mb-3">Engenharia de Software</h2>
            <div class="position-relative">
                <div id="carouselSoftwareEng" class="carousel slide" data-bs-ride="carousel">
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselSoftwareEng" data-bs-slide="prev" style="left: -50px; width: 40px">
                        <span class="carousel-control-prev-icon rounded-circle p-2"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselSoftwareEng" data-bs-slide="next" style="right: -50px; width: 40px">
                        <span class="carousel-control-next-icon rounded-circle p-2"></span>
                        <span class="visually-hidden">Próximo</span>
                    </button>

                    <div class="carousel-inner w-100">
                        @foreach(array_chunk($softwareEngineeringCourses, 4) as $key => $courseGroup)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="row g-3 mx-0">
                                @foreach($courseGroup as $course)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 px-2">
                                    <div class="card h-100 course-card software-eng-card d-flex flex-column" data-course-id="{{ $course['id'] }}">
                                        <div class="card-body d-flex flex-column h-100">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-light rounded-circle p-2 me-3">
                                                    <i class="{{ $course['icon'] }} text-{{ $course['color'] }}"></i>
                                                </div>
                                                <h5 class="card-title mb-0">{{ $course['title'] }}</h5>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-{{ $course['color'] }} me-2">{{ ucfirst($course['difficulty']) }}</span>
                                                @if(isset($course['popularity']) && $course['popularity'] > 5)
                                                <span class="badge bg-danger"><i class="fas fa-fire me-1"></i> Popular</span>
                                                @endif
                                            </div>
                                            <p class="card-text text-truncate-3 mb-3">
                                                {{ $course['description'] }}
                                            </p>
                                            <div class="mt-auto">
                                                <div class="progress">
                                                    <div class="progress-bar bg-{{ $course['color'] }}" role="progressbar" style="width: {{ $course['progress'] }}%"></div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mt-2">
                                                    <small>{{ $course['progress'] }}% concluído</small>
                                                    <a href="#" class="btn btn-sm btn-{{ $course['color'] }} course-continue-btn">Continuar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

       <!-- Tech Curators Section -->
        <section class="mb-4">
            <h2 class="h4 mb-3">Tech Curators</h2>
            <div class="row">
                @foreach($techCurators as $curator)
                <div class="col-lg-2 col-md-4 col-6 mb-4 text-center curator-card" data-curator-id="{{ $curator['id'] }}">
                    <a href="{{ $curator['github'] }}" target="_blank" class="text-decoration-none curator-link">
                        <img src="{{ $curator['avatar'] }}" class="rounded-circle mb-2 curator-avatar" width="80" height="80" alt="{{ $curator['name'] }}" />
                        <h6 class="mb-0 curator-name">{{ $curator['name'] }}</h6>
                        <small class="text-muted curator-specialty">{{ $curator['specialty'] }}</small>
                    </a>
                </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection