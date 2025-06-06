@extends('layouts.app')

@section('content')
    <!-- Header com gradiente igual ao dashboard -->
    <div class="container-fluid text-center d-flex flex-column align-items-center justify-content-center" style="height: 250px; background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%)">
    <h1 class="fw-bold display-6 display-md-5 text-primary">Nova Trilha de Estudos</h1>
        <p class="text-white p-0 m-0">Dá início a uma nova jornada no teu aprendizado!</p>
    </div>
    
    <!-- Conteúdo principal com margem negativa para sobrepor ao gradiente -->
    <section class="container py-5 mb-5 mt-md-4 p-0">
        <form id="createPlanForm" action="{{ route('tracks.store', ['username' => $user->username]) }}"
            method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Informações Básicas -->
            <div class="card mb-4 shadow-sm rounded-4">
                <div class="card-body">
                    <h2 class="card-title h5 mb-4">
                        Informações Básicas
                    </h2>

                    <div class="mb-3">
                        <label for="planTitle" class="form-label fw-semibold">Título</label>
                        <input type="text" class="form-control rounded-end border-0" id="planTitle" name="title"
                                placeholder="Ex: Guia de Desenvolvimento Front-End" required/>
                        <div class="form-text">Escolha um título claro e descritivo para a sua trilha de estudos</div>
                    </div>

                    <div class="mb-3">
                        <label for="planDescription" class="form-label fw-semibold">Descrição</label>
                        <textarea class="form-control border-0" id="planDescription" name="description"
                            placeholder="Descreva o objetivo e conteúdo da trilha..." rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="planVisibility" class="form-label fw-semibold">Visibilidade</label>
                        <select class="form-select border-0" id="planVisibility" name="is_public">
                            <option value="1">Público - Visível para todos</option>
                            <option value="0">Privado - Apenas você pode ver</option>
                        </select>
                    </div>

                    <!-- Escolha de cor da trilha -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Cor da Trilha</label>
                        <p class="text-muted small mb-2">Escolha uma cor para personalizar sua trilha de estudos</p>

                        <div class="d-flex flex-wrap gap-2">
                            @php
                                $colors = [
                                    'secondary' => 'Azul Escuro',
                                    'info' => 'Azul',
                                    'primary' => 'Verde Água',
                                    'success' => 'Verde',
                                    'warning' => 'Amarelo Escuro',
                                    'danger' => 'Magenta',
                                ];
                            @endphp

                            @foreach($colors as $colorCode => $colorName)
                                <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input visually-hidden" type="radio" 
                                        name="plan_color" id="color_{{ $colorCode }}"
                                        value="{{ $colorCode }}" 
                                        {{ $colorCode == 'primary' ? 'checked' : '' }} 
                                        onchange="updateColorPreview(this)">
                                    <label class="form-check-label color-option p-0 rounded-circle d-flex align-items-center justify-content-center bg-{{ $colorCode }} {{ $colorCode == 'primary' ? 'border border-2 border-dark' : 'border-0' }}" 
                                        for="color_{{ $colorCode }}"
                                        style="width: 40px; height: 40px; cursor: pointer;"
                                        title="{{ $colorName }}"
                                        onclick="this.previousElementSibling.checked = true; updateColorPreview(this.previousElementSibling);">
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div id="colorPreview" class="mt-3">
                            <span class="badge rounded-pill p-2 bg-primary text-white">
                                Cor selecionada: Verde Água
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dificuldade e Tecnologias -->
            <div class="card mb-4 shadow-sm rounded-4">
                <div class="card-body">
                    <h2 class="card-title h5 mb-4">
                        Categoria e Tecnologias
                    </h2>
                    <div class="mb-4">
                        <label for="planCategory" class="form-label fw-semibold">Categoria</label>
                        <select class="form-select border-0" id="planCategory" name="category_id" required>
                            <option value="" selected disabled>Selecione uma categoria</option>
                            @php
                                $categories = DB::table('categories')->get();
                            @endphp
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="planDifficulty" class="form-label fw-semibold">Nível de Dificuldade</label>
                        <select class="form-select border-0" id="planDifficulty" name="difficulty" required>
                            <option value="beginner" selected>Iniciante</option>
                            <option value="intermediate">Intermediário</option>
                            <option value="advanced">Avançado</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tecnologias Utilizadas</label>
                        <p class="text-muted small mb-2">Selecione as tecnologias, linguagens e ferramentas abordadas nesta trilha</p>
                        <div class="row">
                            @if(isset($availableTags) && count($availableTags) > 0)
                                @foreach($availableTags->chunk(5) as $chunk)
                                    <div class="col-md-4">
                                        @foreach($chunk as $tag)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="technologies[]" value="{{ $tag->id }}" id="tech_{{ $tag->id }}">
                                                <label class="form-check-label" for="tech_{{ $tag->id }}">
                                                    {{ $tag->name }}
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

            <!-- Conteúdos da Trilha -->
            <div class="card mb-4 shadow-sm rounded-4">
                <div class="card-body">
                    <h2 class="card-title h5 mb-4 d-flex align-items-center">
                        Conteúdos da Trilha
                    </h2>
                    <p class="text-muted mb-4">
                        Adicione cursos, artigos, vídeos ou outros recursos à sua trilha de estudos
                    </p>

                    <!-- Campo para upload de imagem 
                    <div class="mb-4">
                        <label for="coverImage" class="form-label fw-semibold">Imagem de Capa (opcional)</label>
                        <input type="file" class="form-control border-0" id="coverImage" name="cover_image" accept="image/*" onchange="previewImage(this)">
                        <div id="imagePreview" class="mt-2"></div>
                    </div>-->

                    <!-- INPUT URL + TIPO + TITULO -->
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <input type="url" class="form-control border-0" id="contentUrlInput" placeholder="Cole a URL do conteúdo aqui" aria-label="URL do conteúdo"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control border-0" id="contentTitleInput" placeholder="Título do conteúdo" aria-label="Título do conteúdo"/>
                        </div>
                        <div class="col-12 mb-3">
                            <textarea class="form-control border-0" id="contentDescriptionInput" placeholder="Descrição do conteúdo" rows="2"></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <select class="form-select border-0" id="contentTypeSelect" aria-label="Tipo do conteúdo">
                                <option value="video" selected>Vídeo</option>
                                <option value="article">Artigo</option>
                                <option value="podcast">Podcast</option>
                                <option value="course">Curso</option>
                                <option value="exercise">Exercício</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="number" class="form-control border-0" id="contentTimeInput" placeholder="Tempo em minutos. Ex: 30" min="1" value="30"/>
                        </div>
                        <div class="col-md-4 mb-3">
                            <select class="form-select border-0" id="contentResourceSelect">
                                <option value="1" selected>Conteúdo Externo</option>
                                <option value="0">Conteúdo Interno</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3 d-flex justify-content-end">
                            <button class="btn ms-3 rounded-4 bg-primary text-white" type="button" onclick="addUrlContent()">
                                Adicionar Conteúdo
                            </button>
                        </div>
                            
                        </div>
                    </div>

                    <!-- Lista de conteúdos adicionados -->
                    <div id="contentsList" class="mb-3 p-3">
                        <div class="text-center text-muted py-4 fw-medium" id="noContentsPlaceholder">
                            <iconify-icon icon="solar:checklist-minimalistic-bold-duotone" class="text-secondary" style="font-size: 48px;"></iconify-icon>
                            <p class="mt-2">Nenhum conteúdo adicionado</p>
                        </div>
                    </div>

                    <!-- Campo oculto para armazenar todos os steps -->
                    <div id="stepsContainer"></div>
                </div>
            </div>

            <!-- Botões de ação -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('tracks.index', ['username' => $user->username]) }}" class="btn btn-outline-secondary rounded-4 fw-semibold">
                    <iconify-icon icon="solar:arrow-left-linear" class="me-1"></iconify-icon> Cancelar
                </a>
                <button type="submit" class="btn rounded-4 fs-semibold bg-primary text-white">
                    Criar Nova Trilha
                </button>
            </div>
        </form>
    </section>

    <script>
        // Mapeamento de ícones por tipo de conteúdo - CORRIGIDO COM CLASSES BOOTSTRAP
        const contentIcons = {
            video: { icon: 'solar:videocamera-record-linear', colorClass: 'danger' },
            article: { icon: 'solar:document', colorClass: 'primary' },
            podcast: { icon: 'solar:microphone-linear', colorClass: 'info' },
            course: { icon: 'solar:square-academic-cap-linear', colorClass: 'success' },
            exercise: { icon: 'solar:pen-new-square-linear', colorClass: 'warning' }
        };

        // Função para atualizar a visualização da cor selecionada - CORRIGIDO COM CLASSES BOOTSTRAP
        function updateColorPreview(input) {
            const colorClass = input.value;
            const colorName = input.nextElementSibling.getAttribute('title');
            
            // Atualiza o preview da cor
            const colorPreview = document.getElementById('colorPreview');
            colorPreview.innerHTML = `
                <span class="badge rounded-pill p-2 bg-${colorClass} text-white">
                    Cor selecionada: ${colorName}
                </span>
            `;

            // Remove todas as bordas primeiro
            document.querySelectorAll('.color-option').forEach(option => {
                option.classList.remove('border', 'border-2', 'border-dark');
                option.classList.add('border-0');
            });
            
            // Adiciona borda apenas no selecionado
            input.nextElementSibling.classList.remove('border-0');
            input.nextElementSibling.classList.add('border', 'border-2', 'border-dark');
        }
        
        // Função para adicionar conteúdo à lista - ESTILO CORRIGIDO COM CLASSES BOOTSTRAP
        function addUrlContent() {
            const url = document.getElementById('contentUrlInput').value.trim();
            const title = document.getElementById('contentTitleInput').value.trim();
            const type = document.getElementById('contentTypeSelect').value;
            const description = document.getElementById('contentDescriptionInput').value.trim();
            const time = document.getElementById('contentTimeInput').value;
            const externalResource = document.getElementById('contentResourceSelect').value;

            if (!url || !title) {
                alert('Por favor, preencha a URL e o título do conteúdo.');
                return;
            }

            const noContentsPlaceholder = document.getElementById('noContentsPlaceholder');
            if (noContentsPlaceholder) {
                noContentsPlaceholder.remove();
            }

            // Obter a cor do plano selecionada
            let planColorClass = 'primary';
            const colorInput = document.querySelector('input[name="plan_color"]:checked');
            if (colorInput) {
                planColorClass = colorInput.value;
            }

            // Obter ícone e classe de cor do mapeamento
            const { icon, colorClass } = contentIcons[type] || { icon: 'solar:document', colorClass: 'primary' };

            // Criar objeto de dados do step
            const stepData = {
                url: url,
                title: title,
                type: type,
                description: description,
                estimated_time: time,
                external_resource: externalResource
            };

            // Criar novo item de conteúdo
            const newIndex = document.querySelectorAll('#contentsList .content-item').length;
            const contentItem = document.createElement('div');
            contentItem.className = 'content-item d-flex align-items-center rounded-4 p-3 mb-3 border border-2 border-secondary bg-light shadow-sm';
            contentItem.style.cursor = 'grab';
            contentItem.dataset.index = newIndex;
            contentItem.draggable = true;
            contentItem.innerHTML = `
                <div class="me-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-secondary bg-opacity-25" 
                        style="width: 60px; height: 60px;">
                        <iconify-icon icon="${icon}" width="30" class="text-secondary"></iconify-icon>
                    </div>
                </div>
                <div class="flex-grow-1 me-3 text-wrap">
                    <h6 class="mb-1 fw-semibold text-wrap">${title}</h6>
                    <p class="mb-1 small text-muted">${description.substring(0, 80)}${description.length > 80 ? '...' : ''}</p>
                    <div class="d-flex align-items-center small text-muted">
                        <span class="badge bg-${colorClass} text-white me-2">${type}</span>
                        <span>${time} min • ${externalResource === '1' ? 'Externo' : 'Interno'}</span>
                    </div>
                </div>
                <div class="d-flex">
                    <button type="button" class="btn btn-sm btn-secondary rounded-4 me-2" onclick="editContent(this)">
                        Editar
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-4" onclick="removeContent(this)">
                        Remover
                    </button>
                </div>
            `;

            // Adicionar eventos de drag-and-drop
            contentItem.addEventListener('dragstart', handleDragStart);
            contentItem.addEventListener('dragover', handleDragOver);
            contentItem.addEventListener('drop', handleDrop);
            contentItem.addEventListener('dragend', handleDragEnd);

            document.getElementById('contentsList').appendChild(contentItem);

            // Adicionar ao formulário
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = `steps[${newIndex}]`;
            hiddenInput.value = JSON.stringify(stepData);
            document.getElementById('stepsContainer').appendChild(hiddenInput);

            // Limpar campos
            document.getElementById('contentUrlInput').value = '';
            document.getElementById('contentTitleInput').value = '';
            document.getElementById('contentDescriptionInput').value = '';
        }

        // Funções para drag-and-drop
        let draggedItem = null;

        function handleDragStart(e) {
            draggedItem = this;
            e.dataTransfer.effectAllowed = 'move';
            this.classList.add('dragging');
        }

        function handleDragOver(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
        }

        function handleDrop(e) {
            e.preventDefault();
            if (draggedItem !== this) {
                const contentsList = document.getElementById('contentsList');
                const items = Array.from(contentsList.querySelectorAll('.content-item'));
                const fromIndex = items.indexOf(draggedItem);
                const toIndex = items.indexOf(this);
                
                if (fromIndex < toIndex) {
                    contentsList.insertBefore(draggedItem, this.nextSibling);
                } else {
                    contentsList.insertBefore(draggedItem, this);
                }
                
                updateStepsOrder();
            }
        }

        function handleDragEnd() {
            this.classList.remove('dragging');
        }

        function updateStepsOrder() {
            const stepsContainer = document.getElementById('stepsContainer');
            stepsContainer.innerHTML = '';
            
            document.querySelectorAll('#contentsList .content-item').forEach((item, index) => {
                const data = {
                    url: item.querySelector('h6').textContent,
                    title: item.querySelector('h6').textContent,
                    type: item.querySelector('.badge').textContent.toLowerCase(),
                    description: item.querySelector('p').textContent,
                    estimated_time: parseInt(item.querySelectorAll('span')[1].textContent),
                    external_resource: item.querySelectorAll('span')[1].textContent.includes('Externo') ? '1' : '0'
                };
                
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = `steps[${index}]`;
                hiddenInput.value = JSON.stringify(data);
                stepsContainer.appendChild(hiddenInput);
            });
        }

        function removeContent(button) {
            const contentItem = button.closest('.content-item');
            const index = contentItem.dataset.index;
            
            contentItem.remove();
            document.querySelector(`input[name="steps[${index}]"]`).remove();
            
            // Reindexar
            const items = document.querySelectorAll('#contentsList .content-item');
            if (items.length === 0) {
                document.getElementById('contentsList').innerHTML = `
                    <div class="text-center text-muted py-4" id="noContentsPlaceholder">
                        <iconify-icon icon="solar:playlist-minimalistic-bold-duotone" style="font-size: 48px;"></iconify-icon>
                        <p class="mt-2">Nenhum conteúdo adicionado ainda</p>
                    </div>
                `;
            } else {
                updateStepsOrder();
            }
        }

        function editContent(button) {
            const contentItem = button.closest('.content-item');
            const index = contentItem.dataset.index;
            const hiddenInput = document.querySelector(`input[name="steps[${index}]"]`);
            const data = JSON.parse(hiddenInput.value);
            
            // Preencher formulário com os dados
            document.getElementById('contentUrlInput').value = data.url;
            document.getElementById('contentTitleInput').value = data.title;
            document.getElementById('contentDescriptionInput').value = data.description;
            document.getElementById('contentTimeInput').value = data.estimated_time;
            document.getElementById('contentTypeSelect').value = data.type;
            document.getElementById('contentResourceSelect').value = data.external_resource;
            
            // Remover o item
            contentItem.remove();
            hiddenInput.remove();
        }
    </script>

    <style>
        .content-item {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .content-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .content-item.dragging {
            opacity: 0.5;
            background-color: #f8f9fa;
        }
        .color-option:hover {
            transform: scale(1.1);
            transition: transform 0.2s ease;
        }
    </style>
@endsection