@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Inter:wght@400;500&display=swap" rel="stylesheet" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <div class="container my-3 my-md-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">
                <i class="bi bi-plus-circle me-2"></i>Criar Novo Curso
            </h1>
            <div>
                <a href="{{ route('admin.tracks.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.tracks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Título do Curso</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" 
                                   placeholder="Ex: Curso de Front-End" 
                                   value="{{ old('title') }}" required />
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="user_id" class="form-label">Criador</label>
                            <select class="form-select @error('user_id') is-invalid @enderror" 
                                    id="user_id" name="user_id" required>
                                <option value="" disabled selected>Selecione o criador</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->username }})
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
                            <label for="slug" class="form-label">Slug (URL amigável)</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                   id="slug" name="slug" 
                                   placeholder="Ex: curso-frontend" 
                                   value="{{ old('slug') }}" required />
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tags</label>
                            <select class="form-select @error('tags') is-invalid @enderror" 
                                    id="tags" name="tags[]" multiple>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
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
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" 
                                  rows="3" placeholder="Descrição detalhada do curso..." 
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Nível de Dificuldade</label>
                            <select class="form-select @error('difficulty') is-invalid @enderror" 
                                    id="difficulty" name="difficulty" required>
                                <option value="beginner" {{ old('difficulty', 'beginner') == 'beginner' ? 'selected' : '' }}>Iniciante</option>
                                <option value="intermediate" {{ old('difficulty') == 'intermediate' ? 'selected' : '' }}>Intermediário</option>
                                <option value="advanced" {{ old('difficulty') == 'advanced' ? 'selected' : '' }}>Avançado</option>
                            </select>
                            @error('difficulty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-switch pt-4">
                                <input class="form-check-input" type="checkbox" 
                                       id="is_official" name="is_official" 
                                       {{ old('is_official') ? 'checked' : '' }} />
                                <label class="form-check-label" for="is_official">Curso Oficial</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-switch pt-4">
                                <input class="form-check-input" type="checkbox" 
                                       id="is_public" name="is_public" 
                                       {{ old('is_public', true) ? 'checked' : '' }} />
                                <label class="form-check-label" for="is_public">Curso Público</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="cover_image" class="form-label">Imagem de Capa</label>
                        <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                               id="cover_image" name="cover_image" 
                               accept="image/*" />
                        @error('cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Recomendado: 800x400 pixels, formatos JPEG ou PNG</div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-outline-secondary">
                            Limpar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Criar Curso
                        </button>
                    </div>
                </form>
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