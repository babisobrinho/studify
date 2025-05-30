@extends('layouts.app')

@section('content')

    <div class="mb-4">
        <h1 class="fw-bold">Editar Plano de Estudos</h1>
        <p class="text-muted">Atualize seu plano de estudos existente</p>
    </div>

    <form id="editPlanForm" action="{{ route('tracks.update', ['username' => $user->username, 'id' => $track->id]) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Informações Básicas -->
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title h5 mb-3">Informações Básicas</h2>

                <div class="mb-3">
                    <label for="planTitle" class="form-label">Título do Plano</label>
                    <div class="input-group">
                        <span class="input-group-text">{B}</span>
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
                    <label for="planDescription" class="form-label">Descrição</label>
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
                    <label for="planVisibility" class="form-label">Visibilidade</label>
                    <select class="form-select" id="planVisibility" name="is_public">
                        <option value="1" {{ $track->is_public ? 'selected' : '' }}>Público - Visível para todos</option>
                        <option value="0" {{ !$track->is_public ? 'selected' : '' }}>Privado - Apenas você pode ver</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Dificuldade e Tecnologias -->
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title h5 mb-3">Dificuldade e Tecnologias</h2>

                <!-- Dificuldade do Plano -->
                <div class="mb-4">
                    <label for="planDifficulty" class="form-label">Nível de Dificuldade</label>
                    <p class="text-muted small mb-2">Selecione o nível de dificuldade deste plano de estudos</p>
                    <select class="form-select" id="planDifficulty" name="difficulty" required>
                        <option value="beginner" {{ $track->difficulty === 'beginner' ? 'selected' : '' }}>Iniciante</option>
                        <option value="intermediate" {{ $track->difficulty === 'intermediate' ? 'selected' : '' }}>Intermediário</option>
                        <option value="advanced" {{ $track->difficulty === 'advanced' ? 'selected' : '' }}>Avançado</option>
                    </select>
                </div>

                <!-- Tecnologias Utilizadas (Checkboxes) -->
                <div class="mb-3">
                    <label class="form-label">Tecnologias Utilizadas</label>
                    <p class="text-muted small mb-2">Selecione as tecnologias, linguagens e ferramentas abordadas neste plano</p>

                    <div class="row">
                        @if(isset($availableTags) && count($availableTags) > 0)
                            @foreach($availableTags->chunk(5) as $chunk)
                                <div class="col-md-4">
                                    @foreach($chunk as $tag)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="technologies[]"
                                                   value="{{ $tag->id }}" id="tech_{{ $tag->id }}"
                                                {{ in_array($tag->id, $trackTags) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="tech_{{ $tag->id }}">{{ $tag->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <p class="text-muted">Nenhuma tecnologia disponível.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Conteúdos do Plano -->
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title h5 mb-3">Conteúdos do Plano</h2>
                <p class="text-muted mb-3">
                    Adicione cursos, artigos, vídeos ou outros recursos ao seu plano de estudos
                </p>

                <!-- Campo para upload de imagem -->
                <div class="mb-3">
                    <label for="coverImage" class="form-label">Imagem de Capa</label>
                    <input
                        type="file"
                        class="form-control"
                        id="coverImage"
                        name="cover_image"
                        accept="image/*"
                    >
                    @if($track->cover_image)
                        <div class="mt-2">
                            <small>Imagem atual:</small>
                            <img src="{{ asset('storage/' . $track->cover_image) }}" alt="Capa atual" class="img-thumbnail mt-2" style="max-width: 200px;">
                        </div>
                    @endif
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

                    <div class="input-group mb-2">
                        <textarea
                            class="form-control"
                            id="contentDescriptionInput"
                            placeholder="Descrição do conteúdo"
                            rows="2"
                        ></textarea>
                    </div>

                    <div class="input-group mb-2">
                        <span class="input-group-text">Tempo estimado (min)</span>
                        <input
                            type="number"
                            class="form-control"
                            id="contentTimeInput"
                            placeholder="30"
                            min="1"
                            value="30"
                        />

                        <span class="input-group-text">Recurso</span>
                        <select class="form-select" id="contentResourceSelect">
                            <option value="1" selected>Externo</option>
                            <option value="0">Interno</option>
                        </select>

                        <button class="btn btn-primary" type="button" onclick="addUrlContent()">Adicionar</button>
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
                            <div class="content-item d-flex align-items-center border rounded p-2 mb-2" data-index="{{ $loop->index }}">
                                <div class="me-auto">
                                    <div class="fw-semibold">{{ $step->title }}</div>
                                    <div class="small text-muted">{{ $step->content_type }} • {{ $step->content_url }}</div>
                                    <div class="small text-muted">{{ Str::limit($step->description, 50) }}</div>
                                    <div class="small text-muted">{{ $step->estimated_time }} min • {{ $step->external_resource ? 'Recurso externo' : 'Recurso interno' }}</div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeContent(this)">
                                    <i class="fas fa-times"></i>
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
            <a href="{{ route('tracks.show', ['username' => $user->username, 'id' => $track->id]) }}" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Atualizar plano de estudos</button>
        </div>
    </form>

    <script>
        @php
            $contentItems = [];
            foreach ($steps as $step) {
                $contentItems[] = [
                    'url' => $step->content_url,
                    'title' => $step->title,
                    'type' => $step->content_type,
                    'description' => $step->description,
                    'estimated_time' => $step->estimated_time,
                    'external_resource' => $step->external_resource,
                ];
            }
        @endphp

        let contentItems = @json($contentItems);

        function addUrlContent() {
            const url = document.getElementById('contentUrlInput').value;
            const title = document.getElementById('contentTitleInput').value;
            const type = document.getElementById('contentTypeSelect').value;
            const description = document.getElementById('contentDescriptionInput').value || 'Conteúdo do plano de estudos';
            const estimatedTime = document.getElementById('contentTimeInput').value || 30;
            const externalResource = document.getElementById('contentResourceSelect').value;

            if (!url || !title) {
                alert('Por favor, preencha a URL e o título do conteúdo.');
                return;
            }

            contentItems.push({
                url: url,
                title: title,
                type: type,
                description: description,
                estimated_time: estimatedTime,
                external_resource: externalResource
            });

            updateHiddenFields();

            const placeholder = document.getElementById('noContentsPlaceholder');
            if (placeholder) {
                placeholder.remove();
            }

            const contentsList = document.getElementById('contentsList');
            const contentItem = document.createElement('div');
            contentItem.className = 'content-item d-flex align-items-center border rounded p-2 mb-2';
            contentItem.dataset.index = contentItems.length - 1;

            contentItem.innerHTML = `
                <div class="me-auto">
                    <div class="fw-semibold">${title}</div>
                    <div class="small text-muted">${type} • ${url}</div>
                    <div class="small text-muted">${description.substring(0, 50)}${description.length > 50 ? '...' : ''}</div>
                    <div class="small text-muted">${estimatedTime} min • ${externalResource == 1 ? 'Recurso externo' : 'Recurso interno'}</div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeContent(this)">
                    <i class="fas fa-times"></i>
                </button>
            `;

            contentsList.appendChild(contentItem);

            document.getElementById('contentUrlInput').value = '';
            document.getElementById('contentTitleInput').value = '';
            document.getElementById('contentDescriptionInput').value = '';
            document.getElementById('contentTimeInput').value = '30';

            console.log('Conteúdo adicionado:', contentItems);
        }

        function removeContent(button) {
            const contentItem = button.closest('.content-item');
            const index = parseInt(contentItem.dataset.index);

            contentItems.splice(index, 1);

            const items = document.querySelectorAll('.content-item');
            items.forEach((item, i) => {
                if (i >= index) {
                    item.dataset.index = i;
                }
            });

            updateHiddenFields();

            contentItem.remove();

            const contentsList = document.getElementById('contentsList');
            if (contentsList.children.length === 0) {
                contentsList.innerHTML = `
                    <div class="text-center text-muted py-4" id="noContentsPlaceholder">
                        <i class="fas fa-book-open fa-2x mb-2"></i>
                        <p>Nenhum conteúdo adicionado ainda</p>
                    </div>
                `;
            }

            console.log('Conteúdo removido, restantes:', contentItems);
        }

        function updateHiddenFields() {
            const container = document.getElementById('stepsContainer');
            container.innerHTML = '';

            contentItems.forEach((item, index) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `steps[${index}]`;
                input.value = JSON.stringify(item);
                container.appendChild(input);
            });
        }

        document.getElementById('editPlanForm').addEventListener('submit', function(event) {
            if (contentItems.length === 0) {
                console.log('Enviando formulário sem conteúdos');
            } else {
                console.log('Enviando formulário com ' + contentItems.length + ' conteúdos');
            }
        });
    </script>

@endsection
