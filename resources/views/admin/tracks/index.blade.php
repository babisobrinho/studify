@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Inter:wght@400;500&display=swap" rel="stylesheet" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
  
  <div class="container-fluid px-4 px-lg-5 py-4">
    <!-- Header Section -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <div class="d-flex align-items-center">
        <i class="bi bi-book-half fs-1 text-primary me-3"></i>
        <div>
          <h1 class="h3 mb-0 text-gray-800 fw-bold">Gestão de Cursos</h1>
          <p class="mb-0 text-muted">Gerencie todos os cursos da plataforma</p>
        </div>
      </div>
      <div class="d-flex gap-2">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-circle" data-bs-toggle="tooltip" title="Voltar">
          <i class="bi bi-house"></i>
        </a>
        <a href="{{ route('admin.tracks.create') }}" class="btn btn-primary">
          <i class="bi bi-plus-circle me-2"></i> Novo Curso
        </a>
      </div>
    </div>

    <!-- Filters Card -->
    <div class="card shadow border-0 mb-4">
      <div class="card-header bg-white py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          <i class="bi bi-funnel me-2"></i>Filtros
        </h6>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.tracks.index') }}" method="GET">
          <div class="row g-3">
            <div class="col-md-3">
              <label class="form-label small text-uppercase fw-bold text-muted">Dificuldade</label>
              <select name="difficulty" class="form-select form-select-sm">
                <option value="">Todas</option>
                @foreach(\App\Enums\DifficultyEnum::cases() as $case)
                  <option value="{{ $case->value }}" {{ request('difficulty') == $case->value ? 'selected' : '' }}>
                    {{ $case->label() }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label small text-uppercase fw-bold text-muted">Visibilidade</label>
              <select name="is_public" class="form-select form-select-sm">
                <option value="">Todas</option>
                <option value="1" {{ request('is_public') === '1' ? 'selected' : '' }}>Público</option>
                <option value="0" {{ request('is_public') === '0' ? 'selected' : '' }}>Privado</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label small text-uppercase fw-bold text-muted">Tipo</label>
              <select name="is_official" class="form-select form-select-sm">
                <option value="">Todos</option>
                <option value="1" {{ request('is_official') === '1' ? 'selected' : '' }}>Oficial</option>
                <option value="0" {{ request('is_official') === '0' ? 'selected' : '' }}>Comunitário</option>
              </select>
            </div>
            <div class="col-md-3 d-flex align-items-end gap-2">
              <button type="submit" class="btn btn-sm btn-primary flex-grow-1">
                <i class="bi bi-funnel me-1"></i> Aplicar
              </button>
              <a href="{{ route('admin.tracks.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-counterclockwise"></i>
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Courses Table -->
    <div class="card shadow border-0">
      <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">
            <i class="bi bi-list-ul me-2"></i>Lista de Cursos
          </h6>
          <span class="badge bg-primary rounded-pill">
            {{ $tracks->total() }} cursos
          </span>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
              <tr>
                <th class="ps-4">Curso</th>
                <th>Dificuldade</th>
                <th>Status</th>
                <th>Tipo</th>
                <th class="text-end pe-4">Ações</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($tracks as $track)
                <tr>
                  <td class="ps-4">
                    <div class="d-flex align-items-center">
                      <div class="position-relative">
                        @if($track->cover_image)
                          <img src="{{ asset('storage/' . $track->cover_image) }}" class="rounded me-3" alt="{{ $track->title }}" width="60" height="60" style="object-fit: cover;">
                        @else
                          <div class="bg-light rounded d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-book text-muted fs-4"></i>
                          </div>
                        @endif
                        @if($track->is_featured)
                          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                            <i class="bi bi-star-fill"></i>
                          </span>
                        @endif
                      </div>
                      <div>
                        <a href="{{ route('admin.tracks.show', $track->id) }}" class="fw-semibold text-decoration-none text-dark d-block">
                          {{ $track->title }}
                        </a>
                        <small class="text-muted d-block">{{ Str::limit($track->description, 60) }}</small>
                        <small class="text-muted">
                          <code>{{ $track->slug }}</code>
                        </small>
                      </div>
                    </div>
                  </td>
                  <td>
                    @php
                      $difficultyClasses = [
                        'beginner' => 'bg-success',
                        'intermediate' => 'bg-warning text-dark',
                        'advanced' => 'bg-danger'
                      ];
                      $difficultyValue = $track->difficulty instanceof \App\Enums\DifficultyEnum 
                        ? $track->difficulty->value 
                        : strtolower($track->difficulty);
                      $badgeClass = $difficultyClasses[$difficultyValue] ?? 'bg-secondary';
                    @endphp
                    <span class="badge {{ $badgeClass }}">
                      {{ $track->difficulty instanceof \App\Enums\DifficultyEnum ? $track->difficulty->label() : ucfirst($difficultyValue) }}
                    </span>
                  </td>
                  <td>
                    <span class="badge {{ $track->is_public ? 'bg-primary' : 'bg-secondary' }}">
                      <i class="bi {{ $track->is_public ? 'bi-eye' : 'bi-eye-slash' }} me-1"></i>
                      {{ $track->is_public ? 'Público' : 'Privado' }}
                    </span>
                  </td>
                  <td>
                    <span class="badge {{ $track->is_official ? 'bg-info text-dark' : 'bg-light text-dark border' }}">
                      <i class="bi {{ $track->is_official ? 'bi-check-circle' : 'bi-people' }} me-1"></i>
                      {{ $track->is_official ? 'Oficial' : 'Comunitário' }}
                    </span>
                  </td>
                  <td class="pe-4">
                    <div class="d-flex justify-content-end gap-2">
                      <a href="{{ route('admin.tracks.show', $track->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" data-bs-toggle="tooltip" title="Visualizar">
                        <i class="bi bi-eye"></i>
                      </a>
                      <a href="{{ route('admin.tracks.edit', $track->id) }}" class="btn btn-sm btn-outline-success rounded-circle" data-bs-toggle="tooltip" title="Editar">
                        <i class="bi bi-pencil"></i>
                      </a>
                      <button class="btn btn-sm btn-outline-danger rounded-circle delete-btn" 
                              data-bs-toggle="modal" 
                              data-bs-target="#deleteModal" 
                              data-id="{{ $track->id }}" 
                              data-title="{{ $track->title }}"
                              data-bs-toggle="tooltip" 
                              title="Excluir">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center py-5">
                    <div class="py-5">
                      <i class="bi bi-book text-muted fs-1"></i>
                      <h5 class="text-muted mt-3">Nenhum curso encontrado</h5>
                      <p class="text-muted">Tente ajustar seus filtros ou adicionar um novo curso</p>
                      <a href="{{ route('admin.tracks.create') }}" class="btn btn-primary mt-2">
                        <i class="bi bi-plus-circle me-2"></i>Criar Curso
                      </a>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        @if($tracks->hasPages())
          <div class="card-footer bg-white border-top-0">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
              <div class="mb-2 mb-md-0">
                <p class="small text-muted mb-0">
                  Mostrando <span class="fw-semibold">{{ $tracks->firstItem() }}</span> a 
                  <span class="fw-semibold">{{ $tracks->lastItem() }}</span> de 
                  <span class="fw-semibold">{{ $tracks->total() }}</span> resultados
                </p>
              </div>
              
              <div class="d-flex align-items-center gap-3">
                <!-- Items per page selector -->
                <form action="{{ route('admin.tracks.index') }}" method="GET" class="d-flex align-items-center">
                  <input type="hidden" name="page" value="1">
                  @foreach(request()->except('perPage', 'page') as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                  @endforeach
                  
                  <label for="perPage" class="small text-muted me-2 mb-0">Itens por página:</label>
                  <select name="perPage" id="perPage" class="form-select form-select-sm" style="width: 80px;" onchange="this.form.submit()">
                    <option value="10" {{ request('perPage', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('perPage', 10) == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('perPage', 10) == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('perPage', 10) == 100 ? 'selected' : '' }}>100</option>
                  </select>
                </form>
                
                <!-- Pagination links -->
                <nav aria-label="Page navigation">
                  <ul class="pagination pagination-sm mb-0">
                    {{-- Previous Page Link --}}
                    @if($tracks->onFirstPage())
                      <li class="page-item disabled">
                        <span class="page-link"><i class="bi bi-chevron-left"></i></span>
                      </li>
                    @else
                      <li class="page-item">
                        <a class="page-link" href="{{ $tracks->previousPageUrl() }}" aria-label="Previous">
                          <i class="bi bi-chevron-left"></i>
                        </a>
                      </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach($tracks->getUrlRange(1, $tracks->lastPage()) as $page => $url)
                      @if($page == $tracks->currentPage())
                        <li class="page-item active" aria-current="page">
                          <span class="page-link">{{ $page }}</span>
                        </li>
                      @else
                        <li class="page-item">
                          <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                      @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if($tracks->hasMorePages())
                      <li class="page-item">
                        <a class="page-link" href="{{ $tracks->nextPageUrl() }}" aria-label="Next">
                          <i class="bi bi-chevron-right"></i>
                        </a>
                      </li>
                    @else
                      <li class="page-item disabled">
                        <span class="page-link"><i class="bi bi-chevron-right"></i></span>
                      </li>
                    @endif
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title text-danger" id="deleteModalLabel">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>Confirmar Exclusão
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="deleteForm" method="POST">
          @csrf
          @method('DELETE')
          <div class="modal-body py-4">
            <p>Tem certeza que deseja excluir permanentemente o curso:</p>
            <h6 class="fw-bold" id="trackTitle"></h6>
            <p class="small text-muted mt-2">Esta ação não pode ser desfeita e todos os dados relacionados serão removidos.</p>
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger">
              <i class="bi bi-trash-fill me-1"></i> Excluir Permanentemente
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('styles')
  <style>
    
    .card {
      border-radius: 0.75rem;
      overflow: hidden;
    }
    .card-header {
      padding: 1rem 1.5rem;
    }
    .table {
      margin-bottom: 0;
    }
    .table th {
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.75rem;
      letter-spacing: 0.5px;
      color: #6c757d;
      border-top: 0;
    }
    .table td {
      vertical-align: middle;
      padding: 1rem;
      border-top: 1px solid #f0f0f0;
    }
    .badge {
      font-weight: 500;
      padding: 0.35em 0.65em;
    }
    .btn-outline-primary:hover {
      background-color: rgba(13, 110, 253, 0.1);
    }
    .btn-outline-danger:hover {
      background-color: rgba(220, 53, 69, 0.1);
    }
    .rounded-circle {
      width: 32px;
      height: 32px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
  </style>
@endpush

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize tooltips
      const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      });

      // Delete modal configuration
      const deleteButtons = document.querySelectorAll('.delete-btn');
      const deleteForm = document.getElementById('deleteForm');
      const trackTitle = document.getElementById('trackTitle');

      deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
          const trackId = this.getAttribute('data-id');
          const title = this.getAttribute('data-title');

          trackTitle.textContent = title;
          deleteForm.action = `/admin/tracks/${trackId}`;
        });
      });
    });
  </script>
@endpush