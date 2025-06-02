@extends('layouts.app')

@section('content')

    <div class="mb-5 text-center">
        <h1 class="fw-bold" style="font-family: 'Poppins', sans-serif; color: #06D6A0;">Criar Novo Plano de Estudos</h1>
        <p class="text-muted fs-5" style="font-family: 'Inter', sans-serif;">Organize seu aprendizado com um plano estruturado</p>
    </div>

    <form id="createPlanForm" action="{{ route('tracks.store', ['username' => $user->username]) }}"
          method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 900px;">
        @csrf

        <!-- Informações Básicas -->
        <div class="card mb-4 shadow-sm" style="border-radius: 8px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="card-body">
                <h2 class="card-title h5 mb-4">
                    <i class="fas fa-info-circle me-2" style="color: #06D6A0;"></i> Informações Básicas
                </h2>

                <div class="mb-3">
                    <label for="planTitle" class="form-label fw-semibold">Título do Plano</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background-color: #06D6A0; color: white;"><i class="fas fa-book"></i></span>
                        <input
                            type="text"
                            class="form-control"
                            id="planTitle"
                            name="title"
                            placeholder="Ex: Guia de Desenvolvimento Front-End"
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
                    ></textarea>
                </div>

                <div class="mb-3">
                    <label for="planVisibility" class="form-label fw-semibold">Visibilidade</label>
                    <select class="form-select" id="planVisibility" name="is_public">
                        <option value="1">Público - Visível para todos</option>
                        <option value="0">Privado - Apenas você pode ver</option>
                    </select>
                </div>

                <!-- Novo campo para escolha de cor do plano -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Cor do Plano</label>
                    <p class="text-muted small mb-2">Escolha uma cor para personalizar seu plano de estudos</p>

                    <div class="d-flex flex-wrap gap-2">
                        @php
                            $colors = [
                                '#06d6a0' => 'Verde Água',
                                '#4fff7b' => 'Verde Limão',
                                '#f72585' => 'Rosa',
                                '#f8961e' => 'Laranja',
                                '#345e7d' => 'Azul Marinho',
                                '#5ddaf8' => 'Azul Claro'
                            ];
                        @endphp

                        @foreach($colors as $colorCode => $colorName)
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input visually-hidden"
                                    type="radio"
                                    name="plan_color"
                                    id="color_{{ str_replace('#', '', $colorCode) }}"
                                    value="{{ $colorCode }}"
                                    {{ $colorCode === '#06d6a0' ? 'checked' : '' }}
                                    onchange="updateColorPreview(this)"
                                >
                                <label
                                    class="form-check-label color-option p-0"
                                    for="color_{{ str_replace('#', '', $colorCode) }}"
                                    style="width: 40px; height: 40px; background-color: {{ $colorCode }}; border-radius: 50%; cursor: pointer; border: 3px solid {{ $colorCode === '#06d6a0' ? '#000' : 'transparent' }};"
                                    title="{{ $colorName }}"
                                    onclick="this.previousElementSibling.checked = true; updateColorPreview(this.previousElementSibling);"
                                ></label>
                            </div>
                        @endforeach
                    </div>
                    <div id="colorPreview" class="mt-2">
                        <span class="badge p-2" style="background-color: #06d6a0;">Cor selecionada: Verde Água</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dificuldade e Tecnologias -->
        <div class="card mb-4 shadow-sm" style="border-radius: 8px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="card-body">
                <h2 class="card-title h5 mb-4">
                    <i class="fas fa-tools me-2" style="color: #06D6A0;"></i> Dificuldade e Tecnologias
                </h2>

                <div class="mb-4">
                    <label for="planDifficulty" class="form-label fw-semibold">Nível de Dificuldade</label>
                    <p class="text-muted small mb-2">Selecione o nível de dificuldade deste plano de estudos</p>
                    <select class="form-select" id="planDifficulty" name="difficulty" required>
                        <option value="beginner" selected>Iniciante</option>
                        <option value="intermediate">Intermediário</option>
                        <option value="advanced">Avançado</option>
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
                                            <input class="form-check-input" type="checkbox" name="technologies[]" value="{{ $tag->id }}" id="tech_{{ $tag->id }}">
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
                    <i class="fas fa-file-alt me-2" style="color: #06D6A0;"></i> Conteúdos do Plano
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
                        <span class="input-group-text" style="background-color: #06D6A0; color: white;">Tempo estimado (min)</span>
                        <input
                            type="number"
                            class="form-control"
                            id="contentTimeInput"
                            placeholder="30"
                            min="1"
                            value="30"
                        />

                        <span class="input-group-text" style="background-color: #06D6A0; color: white;">Recurso</span>
                        <select class="form-select" id="contentResourceSelect">
                            <option value="1" selected>Externo</option>
                            <option value="0">Interno</option>
                        </select>

                        <button class="btn ms-3" type="button" onclick="addUrlContent()" style="background-color: #06D6A0; color: white;">
                            <i class="fas fa-plus me-1"></i> Adicionar
                        </button>
                    </div>
                </div>

                <!-- Lista de conteúdos adicionados -->
                <div id="contentsList" class="mb-3">
                    <div class="text-center text-muted py-4" id="noContentsPlaceholder">
                        <i class="fas fa-book-open fa-2x mb-2"></i>
                        <p>Nenhum conteúdo adicionado ainda</p>
                    </div>
                </div>

                <!-- Campo oculto para armazenar todos os steps -->
                <div id="stepsContainer"></div>
            </div>
        </div>

        <!-- Botões de ação -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('tracks.index', ['username' => $user->username]) }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Cancelar
            </a>
            <button type="submit" class="btn" style="background-color: #06D6A0; color: white;">
                <i class="fas fa-save me-2"></i> Salvar plano de estudos
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
                    <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background-color: #06D6A0; box-shadow: 0 4px 10px rgba(6, 214, 160, 0.3);">
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
            const elementsToUpdate = document.querySelectorAll('.input-group-text, .btn[style*="background-color: #06D6A0"]');
            elementsToUpdate.forEach(element => {
                element.style.backgroundColor = colorCode;
            });
        }
    </script>

@endsection
