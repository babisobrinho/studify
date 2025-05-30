@extends('layouts.app')

@section('content')
<div class="container my-3 my-md-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">
                <i class="bi bi-pencil me-2"></i>Editar Curso
            </h1>
            <div>
                <a href="{{ route('admin.tracks.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nome do Curso</label>
                            <input type="text" class="form-control" value="Curso de Front-End" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Instrutor</label>
                            <input type="text" class="form-control" value="João Silva" required />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Categoria</label>
                            <select class="form-select" required>
                                <option>Programação</option>
                                <option>Design</option>
                                <option>DevOps</option>
                                <option selected>Data Science</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Duração (horas)</label>
                            <input type="number" class="form-control" value="32" min="1" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nível</label>
                        <div class="d-flex gap-2 flex-wrap">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="beginner" checked />
                                <label class="form-check-label" for="beginner">Iniciante</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="intermediate" />
                                <label class="form-check-label" for="intermediate">Intermediário</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="advanced" />
                                <label class="form-check-label" for="advanced">Avançado</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descrição Curta</label>
                        <textarea class="form-control" rows="2"
                            required>Aprenda a criar interfaces modernas e responsivas com HTML, CSS e JavaScript.</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sobre este curso</label>
                        <textarea class="form-control" rows="4" required>
Este curso abrange desde os fundamentos até técnicas avançadas de desenvolvimento front-end. Você aprenderá a construir sites responsivos, trabalhar com frameworks modernos e otimizar performance.</textarea>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="certificado" checked />
                        <label class="form-check-label" for="certificado">Oferece Certificado de Conclusão?</label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Imagem do Curso</label>
                        <input type="file" class="form-control" accept="image/*" />
                        <small class="form-text text-muted">Deixe em branco para manter a imagem atual.</small>
                    </div>

                    <div class="d-flex justify-content-between gap-2">
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal">
                            <i class="bi bi-trash"></i> Excluir Curso
                        </button>
                        <div class="d-flex gap-2">
                            <button type="reset" class="btn btn-outline-secondary">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Salvar Alterações
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Tem certeza que deseja excluir este curso? Esta ação não pode ser
                        desfeita.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="button" class="btn btn-danger">Excluir</button>
                </div>
            </div>
        </div>
    </div>

@endsection