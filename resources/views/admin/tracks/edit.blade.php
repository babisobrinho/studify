@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Inter:wght@400;500&display=swap" rel="stylesheet" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <div class="container my-3 my-md-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">
                <i class="bi bi-pencil me-2"></i>Editar Curso
            </h1>
            <div>
                <a href="{{ route('admin.tracks.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.tracks.update', $track->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Nome do Curso</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" 
                                   value="{{ old('title', $track->title) }}" required />
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="user_id" class="form-label">Instrutor</label>
                            <select class="form-select @error('user_id') is-invalid @enderror" 
                                    id="user_id" name="user_id" required>
                                @foreach($instructors as $instructor)
                                    <option value="{{ $instructor->id }}" {{ $track->user_id == $instructor->id ? 'selected' : '' }}>
                                        {{ $instructor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="slug" class="form-label">Slug (URL)</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                   id="slug" name="slug" 
                                   value="{{ old('slug', $track->slug) }}" required />
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="tags" class="form-label">Tags</label>
                            <select class="form-select @error('tags') is-invalid @enderror" 
                                    id="tags" name="tags[]" multiple>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ $track->tags->contains($tag->id) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tags')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição Curta</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" 
                                  rows="2" required>{{ old('description', $track->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Nível</label>
                            <select class="form-select @error('difficulty') is-invalid @enderror" 
                                    id="difficulty" name="difficulty" required>
                                <option value="beginner" {{ $track->difficulty == 'beginner' ? 'selected' : '' }}>Iniciante</option>
                                <option value="intermediate" {{ $track->difficulty == 'intermediate' ? 'selected' : '' }}>Intermediário</option>
                                <option value="advanced" {{ $track->difficulty == 'advanced' ? 'selected' : '' }}>Avançado</option>
                            </select>
                            @error('difficulty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-switch pt-4">
                                <input class="form-check-input" type="checkbox" 
                                       id="is_official" name="is_official" 
                                       {{ $track->is_official ? 'checked' : '' }} />
                                <label class="form-check-label" for="is_official">Curso Oficial</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-switch pt-4">
                                <input class="form-check-input" type="checkbox" 
                                       id="is_public" name="is_public" 
                                       {{ $track->is_public ? 'checked' : '' }} />
                                <label class="form-check-label" for="is_public">Curso Público</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="cover_image" class="form-label">Imagem do Curso</label>
                        <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                               id="cover_image" name="cover_image" 
                               accept="image/*" />
                        @error('cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($track->cover_image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $track->cover_image) }}" alt="Capa atual" style="max-height: 150px;" class="img-thumbnail">
                                <small class="d-block text-muted">Imagem atual - deixe em branco para manter</small>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between gap-2">
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi bi-trash"></i> Excluir Curso
                        </button>
                        <div class="d-flex gap-2">
                            <button type="reset" class="btn btn-outline-secondary">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Salvar Alterações
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmação de Exclusão -->
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
                    <form action="{{ route('admin.tracks.destroy', $track->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Geração automática do slug baseado no título
        document.getElementById('title').addEventListener('input', function() {
            const title = this.value;
            const slug = title.toLowerCase()
                .replace(/[^\w\s-]/g, '') // Remove caracteres especiais
                .replace(/[\s_-]+/g, '-') // Substitui espaços e underscores por hífens
                .replace(/^-+|-+$/g, ''); // Remove hífens extras no início/fim
            
            document.getElementById('slug').value = slug;
        });
    </script>
@endsection