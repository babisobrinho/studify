@extends('layouts.app')

@section('content')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Inter:wght@400;500&display=swap" rel="stylesheet" />
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <div class="container my-4 my-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="fw-bold"><i class="bi bi-book me-2"></i>Lista de Cursos</h1>
      <a href="{{ route('admin.tracks.create') }}" class="btn btn-outline-success rounded-pill">
        <i class="bi bi-plus-circle me-1"></i> Adicionar Curso
      </a>
    </div>

    <!-- Filtros -->
    <div class="card mb-4 shadow-sm border-0">
      <div class="card-body">
        <form action="{{ route('admin.tracks.index') }}" method="GET">
          <div class="row g-3">
            <div class="col-md-3">
              <label class="form-label">Dificuldade</label>
              <select name="difficulty" class="form-select">
    <option value="">Todas</option>
    @foreach(\App\Enums\DifficultyEnum::cases() as $case)
        <option value="{{ $case->value }}" {{ request('difficulty') === $case->value ? 'selected' : '' }}>
            {{ $case->label() }}
        </option>
    @endforeach
</select>
            </div>
            <div class="col-md-3">
              <label class="form-label">Visibilidade</label>
              <select name="is_public" class="form-select">
                <option value="">Todas</option>
                <option value="1" {{ request('is_public') === '1' ? 'selected' : '' }}>Público</option>
                <option value="0" {{ request('is_public') === '0' ? 'selected' : '' }}>Privado</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label">Tipo</label>
              <select name="is_official" class="form-select">
                <option value="">Todos</option>
                <option value="1" {{ request('is_official') === '1' ? 'selected' : '' }}>Oficial</option>
                <option value="0" {{ request('is_official') === '0' ? 'selected' : '' }}>Comunitário</option>
              </select>
            </div>
            <div class="col-md-3 d-flex align-items-end gap-2">
              <button type="submit" class="btn btn-outline-primary w-100"><i class="bi bi-funnel me-1"></i> Filtrar</button>
              <a href="{{ route('admin.tracks.index') }}" class="btn btn-outline-secondary">Limpar</a>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Tabela de Cursos -->
    <div class="card shadow-sm border-0">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>Título</th>
                <th>Slug</th>
                <th>Dificuldade</th>
                <th>Status</th>
                <th>Tipo</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($tracks as $track)
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      @if($track->cover_image)
                        <img src="{{ asset('storage/' . $track->cover_image) }}" class="me-3 rounded border" alt="{{ $track->title }}" width="50" height="50">
                      @else
                        <div class="me-3 rounded border d-flex align-items-center justify-content-center bg-light" style="width: 50px; height: 50px;">
                          <i class="bi bi-book text-muted"></i>
                        </div>
                      @endif
                      <div>
                        <a href="{{ route('admin.tracks.show', $track->id) }}" class="fw-semibold text-decoration-none text-dark">{{ $track->title }}</a>
                        @if($track->description)
                          <p class="small text-muted mb-0">{{ Str::limit($track->description, 50) }}</p>
                        @endif
                      </div>
                    </div>
                  </td>
                  <td>
                    <code>{{ $track->slug }}</code>
                  </td>
                  <td>
    @php
        $difficultyClasses = [
            'beginner' => 'bg-success',
            'intermediate' => 'bg-warning',
            'advanced' => 'bg-danger'
        ];
        
        // Obter o valor string do Enum
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
                      {{ $track->is_public ? 'Público' : 'Privado' }}
                    </span>
                  </td>
                  <td>
                    <span class="badge {{ $track->is_official ? 'bg-info' : 'bg-light text-dark' }}">
                      {{ $track->is_official ? 'Oficial' : 'Comunitário' }}
                    </span>
                  </td>
                  <td>
                    <div class="d-flex gap-2">
                      <a href="{{ route('admin.tracks.show', $track->id) }}" class="btn btn-outline-primary btn-sm rounded shadow-sm" title="Visualizar">
                        <i class="bi bi-eye"></i>
                      </a>
                      <a href="{{ route('admin.tracks.edit', $track->id) }}" class="btn btn-outline-success btn-sm rounded shadow-sm" title="Editar">
                        <i class="bi bi-pencil"></i>
                      </a>
                      <button class="btn btn-outline-danger btn-sm rounded shadow-sm delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $track->id }}" data-title="{{ $track->title }}" title="Excluir">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center py-4">Nenhum curso encontrado</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Paginação Melhorada -->
        @if($tracks->hasPages())
          <nav class="mt-4" aria-label="Paginação">
            <ul class="pagination justify-content-center flex-wrap">
              {{-- Primeira Página --}}
              @if($tracks->onFirstPage())
                <li class="page-item disabled">
                  <span class="page-link rounded-start"><i class="bi bi-chevron-double-left"></i></span>
                </li>
              @else
                <li class="page-item">
                  <a class="page-link rounded-start" href="{{ $tracks->url(1) }}" aria-label="Primeira">
                    <i class="bi bi-chevron-double-left"></i>
                  </a>
                </li>
              @endif

              {{-- Página Anterior --}}
              @if($tracks->onFirstPage())
                <li class="page-item disabled">
                  <span class="page-link"><i class="bi bi-chevron-left"></i></span>
                </li>
              @else
                <li class="page-item">
                  <a class="page-link" href="{{ $tracks->previousPageUrl() }}" aria-label="Anterior">
                    <i class="bi bi-chevron-left"></i>
                  </a>
                </li>
              @endif

              {{-- Números das Páginas --}}
              @foreach($tracks->getUrlRange(max(1, $tracks->currentPage() - 2), min($tracks->lastPage(), $tracks->currentPage() + 2)) as $page => $url)
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

              {{-- Próxima Página --}}
              @if($tracks->hasMorePages())
                <li class="page-item">
                  <a class="page-link" href="{{ $tracks->nextPageUrl() }}" aria-label="Próxima">
                    <i class="bi bi-chevron-right"></i>
                  </a>
                </li>
              @else
                <li class="page-item disabled">
                  <span class="page-link"><i class="bi bi-chevron-right"></i></span>
                </li>
              @endif

              {{-- Última Página --}}
              @if($tracks->currentPage() == $tracks->lastPage())
                <li class="page-item disabled">
                  <span class="page-link rounded-end"><i class="bi bi-chevron-double-right"></i></span>
                </li>
              @else
                <li class="page-item">
                  <a class="page-link rounded-end" href="{{ $tracks->url($tracks->lastPage()) }}" aria-label="Última">
                    <i class="bi bi-chevron-double-right"></i>
                  </a>
                </li>
              @endif
            </ul>
            
            {{-- Mostrando resultados --}}
            <div class="text-center text-muted mt-2">
              Mostrando {{ $tracks->firstItem() }} a {{ $tracks->lastItem() }} de {{ $tracks->total() }} resultados
            </div>
            
            {{-- Seletor de itens por página --}}
            <div class="d-flex justify-content-center mt-3">
              <form action="{{ route('admin.tracks.index') }}" method="GET" class="row g-2 align-items-center">
                <input type="hidden" name="page" value="1">
                @foreach(request()->except('perPage', 'page') as $key => $value)
                  <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                
                <div class="col-auto">
                  <label for="perPage" class="col-form-label">Itens por página:</label>
                </div>
                <div class="col-auto">
                  <select name="perPage" id="perPage" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="10" {{ request('perPage', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('perPage', 10) == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('perPage', 10) == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('perPage', 10) == 100 ? 'selected' : '' }}>100</option>
                  </select>
                </div>
              </form>
            </div>
          </nav>
        @endif
      </div>
    </div>
  </div>

  <!-- Modal de Confirmação -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content shadow-sm">
        <div class="modal-header">
          <h5 class="modal-title">Confirmar Exclusão</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <form id="deleteForm" method="POST">
          @csrf
          @method('DELETE')
          <div class="modal-body">
            <p>Tem certeza que deseja excluir o curso "<strong id="trackTitle"></strong>"? Esta ação não pode ser desfeita.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger">Excluir</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Configura o modal de exclusão
      const deleteButtons = document.querySelectorAll('.delete-btn');
      const deleteForm = document.getElementById('deleteForm');
      const trackTitle = document.getElementById('trackTitle');

      deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
          const trackId = this.getAttribute('data-id');
          const title = this.getAttribute('data-title');

          trackTitle.textContent = title;
          deleteForm.action = `/admin/tracks/${trackId}`;
        });
      });
    });
  </script>
@endpush