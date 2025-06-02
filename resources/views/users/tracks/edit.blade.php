@extends('layouts.app')

@section('content')

    <div class="mb-5 text-center">
        <h1 class="fw-bold" style="font-family: 'Poppins', sans-serif; color: #06D6A0;">Editar Plano de Estudos</h1>
        <p class="text-muted fs-5" style="font-family: 'Inter', sans-serif;">Atualize seu plano de estudos existente</p>
    </div>

    <form id="editPlanForm" action="{{ route('tracks.update', ['username' => $user->username, 'id' => $track->id]) }}"
          method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 900px;">
        @csrf
        @method('PATCH')

        <!-- Informações Básicas -->
        <div class="card mb-4 shadow-sm" style="border-radius: 8px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="card-body">
                <h2 class="card-title h5 mb-4">
                    <i class="fas fa-info-circle me-2" style="color: #06D6A0;"></i> Informações Básicas
                </h2>

                <div class="mb-3">
                    <label for="planTitle" class="form-label fw-semibold">Título do Plano</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background-color: {{ old('plan_color', $track->plan_color ?? '#06D6A0') }}; color: white;"><i class="fas fa-book"></i></span>
                        <input
                            type="text"
                            class="form-control"
                            id="planTitle"
                            name="title"
                            placeholder="Ex: Guia de Desenvolvimento Front-End"
                            value="{{ old('title', $track->title) }}"
                            required
                        />
                    </div>
                    <div class="form-text">Escolha um título claro e descritivo para seu plano de estudos</div>
                </div>

                <div class="mb-3">
                    <label for="planDescription" class="form-label fw-semibold">Descrição</label>
                    <textarea
                        class="form-control"
                        id="planDescription"
                        name="description"
                        placeholder="Descreva o objetivo e conteúdo do plano..."
                        rows="4"
                        required
                    >{{ old('description', $track->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="planVisibility" class="form-label fw-semibold">Visibilidade</label>
                    <select class="form-select" id="planVisibility" name="is_public">
                        <option value="1" {{ $track->is_public ? 'selected' : '' }}>Público - Visível para todos</option>
                        <option value="0" {{ !$track->is_public ? 'selected' : '' }}>Privado - Apenas você pode ver</option>
                    </select>
                </div>

                <!-- Novo campo para escolha de cor do plano -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Cor do Plano</label>
                    <p class="text-muted small mb-2">Escolha uma cor para personalizar seu plano de estudos</p>

                    <div class="d-flex flex-wrap gap-2">
                        @php
                            $colors = [
                                '#06d6a0' => 'Verde Água',                         '#4fff7b' => 'Verde Limão',
                                '#f72585' => 'Rosa',
                                '#f8961e' => 'Laranja',
                                '#345e7d' => 'Azul Marinho',
                                '#5ddaf8' => 'Azul Claro'
                            ];
                            $currentColor = old('plan_color', $track->plan_color ?? '#06d6a0');
                        @endphp

                        @foreach($colors as $colorCode => $colorName)
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input visually-hidden"
                                    type="radio"
                                    name="plan_color"
                                    id="color_{{ str_replace('#', '', $colorCode) }}"
                                    value="{{ $colorCode }}"
                                    {{ $colorCode === $currentColor ? 'checked' : '' }}
                                    onchange="updateColorPreview(this)"
                                >
                                <label
                                    class="form-check-label color-option p-0"
                                    for="color_{{ str_replace('#', '', $colorCode) }}"
                                    style="width: 40px; height: 40px; background-color: {{ $colorCode }}; border-radius: 50%; cursor: pointer; border: 3px solid {{ $colorCode === $currentColor ? '#000' : 'transparent' }};"
                                    title="{{ $colorName }}"
                                    onclick="this.previousElementSibling.checked = true; updateColorPreview(this.previousElementSibling);"
                                ></label>
                            </div>
                        @endforeach
                    </div>
                    <div id="colorPreview" class="mt-2">
                        <span class="badge p-2" style="background-color: {{ $currentColor }};">
                            Cor selecionada: {{ $colors[$currentColor] ?? 'Personalizada' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dificuldade e Tecnologias -->
        <div class="card mb-4 shadow-sm" style="border-radius: 8px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="card-body">
                <h2 class="card-title h5 mb-4">
                    <i class="fas fa-tools me-2" style="color: {{ old('plan_color', $track->plan_color ?? '#06D6A0') }};"></i> Dificuldade e Tecnologias
                </h2>

                <div class="mb-4">
                    <label for="planCategory" class="form-label fw-semibold">Categoria</label>
                    <p class="text-muted small mb-2">Selecione a categoria principal deste plano de estudos</p>
                    <select class="form-select" id="planCategory" name="category_id" required>
                        <option value="" disabled>Selecione uma categoria</option>
                        @php
                            $categories = DB::table('categories')->get();
                        @endphp
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (old('category_id', $track->category_id) == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="planDifficulty" class="form-label fw-semibold">Nível de Dificuldade</label>
                    <p class="text-muted small mb-2">Selecione o nível de dificuldade deste plano de estudos</p>
                    <select class="form-select" id="planDifficulty" name="difficulty" required>
                        <option value="beginner" {{ $track->difficulty === 'beginner' ? 'selected' : '' }}>Iniciante</option>
                        <option value="intermediate" {{ $track->difficulty === 'intermediate' ? 'selected' : '' }}>Intermediário</option>
                        <option value="advanced" {{ $track->difficulty === 'advanced' ? 'selected' : '' }}>Avançado</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tecnologias Utilizadas</label>
                    <p class="text-muted small mb-2">Selecione as tecnologias, linguagens e ferramentas abordadas neste plano</p>

                    <div class="row">
                        @if(isset($availableTags) && count($availableTags) > 0)
                            @foreach($availableTags->chunk(5) as $chunk)
                                <div class="col-md-4">
                                    @foreach($chunk as $tag)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="technologies[]" value="{{ $tag->id }}" id="tech_{{ $tag->id }}"
                                                {{ in_array($tag->id, $trackTags) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="tech_{{ $tag->id }}">
                                                <i class="fas fa-tag text-secondary me-1"></i> {{ $tag->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <p class="text-muted fst-italic">Nenhuma tecnologia disponível.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Conteúdos do Plano -->
        <div class="card mb-4 shadow-sm" style="border-radius: 8px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="card-body">
                <h2 class="card-title h5 mb-4">
                    <i class="fas fa-file-alt me-2" style="color: {{ old('plan_color', $track->plan_color ?? '#06D6A0') }};"></i> Conteúdos do Plano
                </h2>
                <p class="text-muted mb-4">
                    Adicione cursos, artigos, vídeos ou outros recursos ao seu plano de estudos
                </p>

                <!-- Campo para upload de imagem -->
                <div class="mb-4">
                    <label for="coverImage" class="form-label fw-semibold">Imagem de Capa</label>
                    <input
                        type="file"
                        class="form-control"
                        id="coverImage"
                        name="cover_image"
                        accept="image/*"
                        onchange="previewImage(this)"
                    >
                    <div class="form-text">Imagem que representará seu plano de estudos (opcional)</div>

                </div>

                <!-- INPUT URL + TIPO + TITULO -->
                <div class="mb-3">
                    <div class="input-group mb-2">
                        <input
                            type="url"
                            class="form-control"
                            id="contentUrlInput"
                            placeholder="Cole a URL do conteúdo aqui"
                            aria-label="URL do conteúdo"
                        />
                        <input
                            type="text"
                            class="form-control"
                            id="contentTitleInput"
                            placeholder="Título do conteúdo"
                            aria-label="Título do conteúdo"
                        />
                        <select class="form-select" id="contentTypeSelect" aria-label="Tipo do conteúdo">
                            <option value="video" selected>Vídeo</option>
                            <option value="article">Artigo</option>
                            <option value="podcast">Podcast</option>
                            <option value="course">Curso</option>
                            <option value="exercise">Exercício</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <textarea
                            class="form-control"
                            id="contentDescriptionInput"
                            placeholder="Descrição do conteúdo"
                            rows="2"
                        ></textarea>
                    </div>

                    <div class="input-group mb-3 align-items-center">
                        <span class="input-group-text" style="background-color: {{ old('plan_color', $track->plan_color ?? '#06D6A0') }}; color: white;">Tempo estimado (min)</span>
                        <input
                            type="number"
                            class="form-control"
                            id="contentTimeInput"
                            placeholder="30"
                            min="1"
                            value="30"
                        />

                        <span class="input-group-text" style="background-color: {{ old('plan_color', $track->plan_color ?? '#06D6A0') }}; color: white;">Recurso</span>
                        <select class="form-select" id="contentResourceSelect">
                            <option value="1" selected>Externo</option>
                            <option value="0">Interno</option>
                        </select>

                        <button class="btn ms-3" type="button" onclick="addUrlContent()" style="background-color: {{ old('plan_color', $track->plan_color ?? '#06D6A0') }}; color: white;">
                            <i class="fas fa-plus me-1"></i> Adicionar
                        </button>
                    </div>
                </div>

                <!-- Lista de conteúdos adicionados -->
                <div id="contentsList" class="mb-3">
                    @if($steps->isEmpty())
                        <div class="text-center text-muted py-4" id="noContentsPlaceholder">
                            <i class="fas fa-book-open fa-2x mb-2"></i>
                            <p>Nenhum conteúdo adicionado ainda</p>
                        </div>
                    @else
                        @foreach($steps as $step)
                            <div class="content-item d-flex align-items-center border rounded p-2 mb-2" data-index="{{ $loop->index }}" style="transition: all 0.3s ease;">
                                <div class="me-3">
                                    <div class="d-flex align-items-center justify-content-center bg-light rounded" style="width: 60px; height: 60px;">
                                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background-color: {{ old('plan_color', $track->plan_color ?? '#06D6A0') }}; box-shadow: 0 4px 10px rgba(6, 214, 160, 0.3);">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="me-auto">
                                    <div class="fw-semibold" style="color: #2C5364;">{{ $step->title }}</div>
                                    <div class="small text-muted">{{ $step->content_type }} • {{ $step->content_url }}</div>
                                    <div class="small text-muted">{{ Str::limit($step->description, 50) }}</div>
                                    <div class="small text-muted">{{ $step->estimated_time }} min • {{ $step->external_resource ? 'Recurso externo' : 'Recurso interno' }}</div>
                                </div>
                                <button type="button" class="btn btn-sm px-3" onclick="removeContent(this)" title="Excluir conteúdo" style="background-color: #0F2027; color: white;">
                                    <i class="fas fa-times me-2"></i> Excluir
                                </button>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Campo oculto para armazenar todos os steps -->
                <div id="stepsContainer">
                    @foreach($steps as $step)
                        <input type="hidden" name="steps[{{ $loop->index }}]" value="{{ json_encode([
                            'url' => $step->content_url,
                            'title' => $step->title,
                            'type' => $step->content_type,
                            'description' => $step->description,
                            'estimated_time' => $step->estimated_time,
                            'external_resource' => $step->external_resource
                        ]) }}">
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Botões de ação -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('tracks.show', ['username' => $user->username, 'id' => $track->id]) }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Cancelar
            </a>
            <button type="submit" class="btn" style="background-color: {{ old('plan_color', $track->plan_color ?? '#06D6A0') }}; color: white;">
                <i class="fas fa-save me-2"></i> Salvar alterações
            </button>
        </div>
    </form>

    <script>
        // Seu JavaScript permanece o mesmo (pode manter como está)

        // Adicionar função para preview da imagem
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded" style="max-width: 100%; max-height: 120px;">`;
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.innerHTML = `
                    <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background-color: {{ old('plan_color', $track->plan_color ?? '#06D6A0') }}; box-shadow: 0 4px 10px rgba(6, 214, 160, 0.3);">
                        <i class="fas fa-play text-white"></i>
                    </div>
                `;
            }
        }

        // Função para atualizar a visualização da cor selecionada
        function updateColorPreview(input) {
            const colorCode = input.value;
            const colorName = input.parentElement.querySelector('label').getAttribute('title');

            // Atualiza o preview da cor
            document.getElementById('colorPreview').innerHTML = `
                <span class="badge p-2" style="background-color: ${colorCode};">Cor selecionada: ${colorName}</span>
            `;

            // Atualiza as bordas das opções de cor
            document.querySelectorAll('.color-option').forEach(option => {
                option.style.border = '3px solid transparent';
            });

            input.nextElementSibling.style.border = '3px solid #000';

            // Atualiza a cor dos elementos de destaque na página
            const elementsToUpdate = document.querySelectorAll('.input-group-text, .btn[style*="background-color"]');
            elementsToUpdate.forEach(element => {
                if (element.style.backgroundColor.includes('#')) {
                    element.style.backgroundColor = colorCode;
                }
            });
        }
    </script>

@endsection
