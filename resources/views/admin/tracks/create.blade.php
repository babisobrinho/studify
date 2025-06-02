@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Inter:wght@400;500&display=swap" rel="stylesheet" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    
    <div class="container-fluid px-4 px-lg-5 py-4">
        <!-- Header Section -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-0">
            <div class="d-flex align-items-center">
                <i class="bi bi-plus-circle fs-1 text-primary me-3"></i>
                <div>
                    <h1 class="h3 mb-0 text-gray-800 fw-bold">Criar Novo Curso</h1>
                    <p class="mb-0 text-muted">Preencha os detalhes do novo curso</p>
                </div>
            </div>
            <div>
                <a href="{{ route('admin.tracks.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1 "></i> Voltar para Lista
                </a>
            </div>
        </div>

        <!-- Main Card -->
        <div class="card shadow border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-pencil-square me-2"></i>Formulário de Criação
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.tracks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Basic Information Section -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label fw-semibold border-0">Nome do Curso*</label>
                            <input type="text" class="form-control border-0 @error('title') is-invalid @enderror" 
                                   id="title" name="title" 
                                   placeholder="Ex: Curso de Laravel Avançado"
                                   value="{{ old('title') }}" required />
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="user_id" class="form-label border-0 fw-semibold">Instrutor*</label>
                            <select class="form-select border-0 @error('user_id') is-invalid @enderror" 
                                    id="user_id" name="user_id" required>
                                <option value="" disabled selected>Selecione o instrutor</option>
                                @foreach($instructors as $instructor)
                                    <option value="{{ $instructor->id }}" {{ old('user_id') == $instructor->id ? 'selected' : '' }}>
                                        {{ $instructor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Slug and Tags Section -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 border-0">
                            <label for="slug" class="form-label border-0 fw-semibold">Slug (URL)*</label>
                            <div class="input-group">
                                <span class="input-group-text border-0">/cursos/</span>
                                <input type="text" class="form-control border-0 @error('slug') is-invalid @enderror" 
                                       id="slug" name="slug" 
                                       placeholder="Ex: curso-laravel-avancado"
                                       value="{{ old('slug') }}" required />
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text">URL amigável para o curso (auto-gerado)</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tags" class="form-label fw-semibold">Tags</label>
                            <select class="form-select select2 border-0 @error('tags') is-invalid @enderror" 
                                    id="tags" name="tags[]" multiple="multiple">
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

                    <!-- Description Section -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Descrição Curta*</label>
                        <textarea class="form-control border-0 @error('description') is-invalid @enderror" 
                                  id="description" name="description" 
                                  rows="3" required>{{ old('description') }}</textarea>
                        <div class="form-text">Uma breve descrição que aparecerá nos cards do curso (máx. 255 caracteres).</div>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- About Section -->
                    <div class="mb-4">
                        <label for="about" class="form-label fw-semibold">Sobre o Curso</label>
                        <textarea class="form-control border-0 @error('about') is-invalid @enderror" 
                                  id="about" name="about" 
                                  rows="5">{{ old('about') }}</textarea>
                        <div class="form-text">Descrição detalhada que aparecerá na página do curso.</div>
                        @error('about')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Settings Section -->
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <label for="difficulty" class="form-label fw-semibold">Nível*</label>
                            <select class="form-select border-0 @error('difficulty') is-invalid @enderror" 
                                    id="difficulty" name="difficulty" required>
                                <option value="beginner" {{ old('difficulty', 'beginner') == 'beginner' ? 'selected' : '' }}>Iniciante</option>
                                <option value="intermediate" {{ old('difficulty') == 'intermediate' ? 'selected' : '' }}>Intermediário</option>
                                <option value="advanced" {{ old('difficulty') == 'advanced' ? 'selected' : '' }}>Avançado</option>
                            </select>
                            @error('difficulty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-check border-0 form-switch pt-4">
                                <input class="form-check-input border-0" type="checkbox" role="switch"
                                       id="is_official" name="is_official" 
                                       {{ old('is_official') ? 'checked' : '' }} />
                                <label class="form-check-label fw-semibold" for="is_official">Curso Oficial</label>
                            </div>
                            @error('is_official')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-check form-switch pt-4">
                                <input class="form-check-input" type="checkbox" role="switch"
                                       id="is_public" name="is_public" 
                                       {{ old('is_public', true) ? 'checked' : '' }} />
                                <label class="form-check-label fw-semibold" for="is_public">Curso Público</label>
                            </div>
                            @error('is_public')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Cover Image Section -->
                    <div class="mb-4">
                        <label for="cover_image" class="form-label fw-semibold">Imagem do Curso</label>
                        <input type="file" class="form-control border-0 @error('cover_image') is-invalid @enderror" 
                            id="cover_image" name="cover_image" 
                            accept="image/*" />
                        <div class="form-text">Imagem de capa recomendada: 800x450 pixels, formatos JPEG ou PNG.</div>
                        @error('cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i> Limpar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Criar Curso
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .card {
                border-radius: 0.75rem;
                overflow: hidden;
            }
            .card-header {
                padding: 1rem 1.5rem;
                border-bottom: 1px solid rgba(0,0,0,.05);
            }
            .form-label {
                font-weight: 500;
                color: #495057;
            }
            .form-switch .form-check-input {
                width: 2.5em;
                height: 1.5em;
            }
            .select2-container--default .select2-selection--multiple {
                min-height: 38px;
                border: 1px solid #ced4da;
            }
            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                background-color: #e9ecef;
                border: 1px solid #ced4da;
            }
            .input-group-text {
                background-color: #f8f9fa;
                font-weight: 500;
                color: #495057;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Geração automática do slug baseado no título
            document.getElementById('title').addEventListener('input', function() {
                const title = this.value;
                const slug = title.toLowerCase()
                    .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Remove acentos
                    .replace(/[^\w\s-]/g, '') // Remove caracteres especiais
                    .replace(/[\s_-]+/g, '-') // Substitui espaços e underscores por hífens
                    .replace(/^-+|-+$/g, ''); // Remove hífens extras no início/fim
                
                document.getElementById('slug').value = slug;
            });

            // Inicializa o select2 para tags
            $(document).ready(function() {
                $('#tags').select2({
                    placeholder: "Selecione as tags",
                    allowClear: true,
                    width: '100%'
                });
            });
        </script>
    @endpush
@endsection