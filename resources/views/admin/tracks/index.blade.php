@extends('layouts.app')

@section('content')
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Inter:wght@400;500&display=swap"
        rel="stylesheet" />
<div class="container my-3 my-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="fw-bold"><i class="bi bi-book me-2"></i>Lista de Cursos</h1>
      <div>
        <a href="{{ route('admin.tracks.create') }}" class="btn btn-outline-primary me-2"><i class="bi bi-plus-circle"></i> Adicionar Curso</a>
      </div>
    </div>

    <div class="card mb-4">
      <div class="card-body">
        <div class="row g-2 g-md-3">
          <div class="col-12 col-md-3">
            <label class="form-label">Categoria</label>
            <select class="form-select">
              <option selected>Todas</option>
              <option>Programação</option>
              <option>Design</option>
              <option>DevOps</option>
              <option>Data Science</option>
            </select>
          </div>
          <div class="col-12 col-md-3">
            <label class="form-label">Nível</label>
            <select class="form-select">
              <option selected>Todos</option>
              <option>Iniciante</option>
              <option>Intermediário</option>
              <option>Avançado</option>
            </select>
          </div>
          <div class="col-12 col-md-3">
            <label class="form-label">Avaliação</label>
            <select class="form-select">
              <option selected>Todas</option>
              <option>4+ estrelas</option>
              <option>3+ estrelas</option>
            </select>
          </div>
          <div class="col-12 col-md-3 d-flex align-items-end">
            <button class="btn btn-outline-primary w-100"><i class="bi bi-funnel"></i> Filtrar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead class="table-light">
              <tr>
                <th scope="col">Nome do Curso</th>
                <th scope="col">Alunos</th>
                <th scope="col">Categoria</th>
                <th scope="col">Avaliação</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
          <tbody>
  @foreach ($tracks as $track)
    <tr>
      <td>
        <div class="d-flex align-items-center">
          <img src="https://cdn-icons-png.flaticon.com/512/1448/1448776.png" class="me-2 rounded" alt="Curso" width="42">
          <div>
            <a href="{{ route('admin.tracks.show', $track->id) }}" class="text-decoration-none"><strong>{{ $track->name }}</strong></a><br />
            <span class="badge bg-primary me-1">{{ $track->level }}</span>
          </div>
        </div>
      </td>
      <td>212 inscritos<br /><small class="text-muted">112 completaram</small></td>
      <td><span class="badge bg-info">{{ $track->category }}</span></td>
      <td>
        <span class="text-warning"><i class="bi bi-star-fill"></i> {{ $track->rating }}</span><br />
        <small class="text-muted">{{ $track->reviews_count }} avaliações</small>
      </td>
      <td>
        <a href="{{ route('admin.tracks.show', $track->id) }}" class="action-btn"><i class="bi bi-eye"></i></a>
        <a href="{{ route('admin.tracks.edit', $track->id) }}" class="action-btn"><i class="bi bi-pencil"></i></a>
        <button class="action-btn btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bi bi-trash"></i></button>
      </td>
    </tr>
  @endforeach
</tbody>
          </table>
        </div>

        <nav aria-label="Page navigation" class="mt-4">
          <ul class="pagination justify-content-center">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1">Anterior</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Próxima</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmar Exclusão</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Tem certeza que deseja excluir este curso? Esta ação não pode ser desfeita.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger">Excluir</button>
        </div>
      </div>
    </div>
  </div>

@endsection