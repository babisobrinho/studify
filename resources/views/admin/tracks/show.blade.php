@extends('layouts.app')

@section('content')
<div class="container my-3 my-md-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold"><i class="bi bi-book me-2"></i>Detalhes do Curso</h1>
            <div>
                <a href="{{ route('admin.tracks.index') }}" class="btn btn-outline-secondary me-2"><i class="bi bi-arrow-left"></i> Voltar</a>
                <a href="{{ route('admin.tracks.edit', $track) }}"" class="btn btn-outline-primary"><i class="bi bi-pencil"></i> Editar</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <img src="https://cdn-icons-png.flaticon.com/512/1448/1448776.png"
                            class="img-fluid rounded mb-3" alt="Curso">
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary">Inscrever-se</button>
                            <button class="btn btn-outline-secondary">Compartilhar</button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h2>Curso de Front-End</h2>
                        <div class="mb-3">
                            <span class="text-warning"><i class="bi bi-star-fill"></i> 4.5</span>
                            <span class="text-muted ms-2">(55 avaliações)</span>
                            <span class="badge bg-primary ms-2">Iniciante</span>
                            <span class="badge bg-info ms-2">Programação</span>
                        </div>
                        <p class="lead">Aprenda a criar interfaces modernas e responsivas com HTML, CSS e JavaScript.
                        </p>
                        <hr>

                        <h5><i class="bi bi-info-circle"></i> Sobre este curso</h5>
                        <p>Este curso abrange desde os fundamentos até técnicas avançadas de desenvolvimento front-end.
                            Você aprenderá a construir sites responsivos, trabalhar com frameworks modernos e otimizar
                            performance.</p>

                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <h6><i class="bi bi-person-video2"></i> Instrutor</h6>
                                <p>João Silva</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6><i class="bi bi-clock"></i> Duração</h6>
                                <p>32 horas</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6><i class="bi bi-people"></i> Alunos</h6>
                                <p>486 inscritos</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6><i class="bi bi-award"></i> Certificado</h6>
                                <p>Sim, após conclusão</p>
                            </div>
                        </div>

                        <hr>
                        <h5><i class="bi bi-list-check"></i> Conteúdo do Curso</h5>
                        <div class="accordion" id="courseAccordion">
                            <!-- Modules would go here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection