@extends('layouts.app')

@section('content')
<div class="container my-3 my-md-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">
                <i class="bi bi-plus-circle me-2"></i>Criar Novo Curso
            </h1>
            <div>
                <a href="{{route('admin.tracks.index')}}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nome do Curso</label>
                            <input type="text" class="form-control" placeholder="Ex: Curso de Front-End" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Instrutor</label>
                            <input type="text" class="form-control" placeholder="Nome do instrutor" required />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Categoria</label>
                            <select class="form-select" required>
                                <option value="" disabled selected>
                                    Selecione uma categoria
                                </option>
                                <option>Programação</option>
                                <option>Design</option>
                                <option>DevOps</option>
                                <option>Data Science</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Duração (horas)</label>
                            <input type="number" class="form-control" placeholder="Ex: 32" min="1" />
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
                        <textarea class="form-control" rows="2" placeholder="Uma breve descrição do curso..."
                            required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sobre este curso</label>
                        <textarea class="form-control" rows="4"
                            placeholder="Detalhes sobre o que será abordado no curso..." required></textarea>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="certificado" />
                        <label class="form-check-label" for="certificado">Oferece Certificado de Conclusão?</label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Imagem do Curso</label>
                        <input type="file" class="form-control" accept="image/*" />
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-outline-secondary">
                            Limpar
                        </button>
                        <button type="submit" class="btn btn-primary">Criar Curso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection