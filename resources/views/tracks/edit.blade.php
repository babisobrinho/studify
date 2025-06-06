@extends('layouts.app')

@section('content')
    <!-- Header com gradiente igual ao dashboard -->
    <div class="container-fluid text-center d-flex flex-column align-items-center justify-content-center" style="height: 250px; background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%)">
        <h1 class="fw-bold display-6 display-md-5 text-primary">Editar Trilha de Estudos</h1>
        <p class="text-white p-0 m-0">Atualize sua jornada de aprendizado!</p>
    </div>
    
    <!-- Conteúdo principal com margem negativa para sobrepor ao gradiente -->
    <section class="container py-5 mb-5 mt-md-4 p-0">
        <form id="editPlanForm" action="{{ route('tracks.update', ['username' => $user->username, 'id' => $track->id]) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Informações Básicas -->
            <div class="card mb-4 shadow-sm rounded-4">
                <div class="card-body">
                    <h2 class="card-title h5 mb-4">
                        Informações Básicas
                    </h2>

                    <div class="mb-3">
                        <label for="planTitle" class="form-label fw-semibold">Título</label>
                        <input type="text" class="form-control rounded-end border-0" id="planTitle" name="title"
                                placeholder="Ex: Guia de Desenvolvimento Front-End" value="{{ old('title', $track->title) }}" required/>
                        <div class="form-text">Escolha um título claro e descritivo para a sua trilha de estudos</div>
                    </div>

                    <div class="mb-3">
                        <label for="planDescription" class="form-label fw-semibold">Descrição</label>
                        <textarea class="form-control border-0" id="planDescription" name="description"
                            placeholder="Descreva o objetivo e conteúdo da trilha..." rows="4" required>{{ old('description', $track->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="planVisibility" class="form-label fw-semibold">Visibilidade</label>
                        <select class="form-select border-0" id="planVisibility" name="is_public">
                            <option value="1" {{ $track->is_public ? 'selected' : '' }}>Público - Visível para todos</option>
                            <option value="0" {{ !$track->is_public ? 'selected' : '' }}>Privado - Apenas você pode ver</option>
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
                                $currentColor = old('plan_color', $track->color) ?: 'primary';
                            @endphp

                            @foreach($colors as $colorCode => $colorName)
                                <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input visually-hidden" type="radio" 
                                        name="plan_color" id="color_{{ $colorCode }}"
                                        value="{{ $colorCode }}" 
                                        {{ $colorCode == $currentColor ? 'checked' : '' }} 
                                        onchange="updateColorPreview(this)">
                                    <label class="form-check-label color-option p-0 rounded-circle d-flex align-items-center justify-content-center bg-{{ $colorCode }} {{ $colorCode == $currentColor ? 'border border-2 border-dark' : 'border-0' }}" 
                                        for="color_{{ $colorCode }}"
                                        style="width: 40px; height: 40px; cursor: pointer;"
                                        title="{{ $colorName }}"
                                        onclick="this.previousElementSibling.checked = true; updateColorPreview(this.previousElementSibling);">
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div id="colorPreview" class="mt-3">
                            <span class="badge rounded-pill p-2 bg-{{ $currentColor }} text-white">
                                Cor selecionada: {{ $colors[$currentColor] ?? 'Verde Água' }}
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
                            <option value="" disabled>Selecione uma categoria</option>
                            @php
                                $categories = DB::table('categories')->get();
                            @endphp
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == old('category_id', $track->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="planDifficulty" class="form-label fw-semibold">Nível de Dificuldade</label>
                        <select class="form-select border-0" id="planDifficulty" name="difficulty" required>
                            <option value="beginner" {{ old('difficulty', $track->difficulty) == 'beginner' ? 'selected' : '' }}>Iniciante</option>
                            <option value="intermediate" {{ old('difficulty', $track->difficulty) == 'intermediate' ? 'selected' : '' }}>Intermediário</option>
                            <option value="advanced" {{ old('difficulty', $track->difficulty) == 'advanced' ? 'selected' : '' }}>Avançado</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tecnologias Utilizadas</label>
                        <p class="text-muted small mb-2">Selecione as tecnologias, linguagens e ferramentas abordadas nesta trilha</p>
                        <div class="row">
                            @if(isset($availableTags) && count($availableTags) > 0)
                                @php
                                    $selectedTechnologies = $track->tags->pluck('id')->toArray();
                                @endphp
                                @foreach($availableTags->chunk(5) as $chunk)
                                    <div class="col-md-4">
                                        @foreach($chunk as $tag)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="technologies[]" 
                                                    value="{{ $tag->id }}" id="tech_{{ $tag->id }}"
                                                    {{ in_array($tag->id, old('technologies', $selectedTechnologies)) ? 'checked' : '' }}>
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
                            <button class="btn ms-3 rounded-4 bg-primary text-white fw-semibold" type="button" onclick="addUrlContent()">
                                Adicionar Conteúdo
                            </button>
                        </div>
                    </div>

                    <!-- Lista de conteúdos adicionados -->
                    <div id="contentsList" class="mb-3 p-3">
                        @if($track->steps->isEmpty())
                            <div class="text-center text-muted py-4 fw-medium" id="noContentsPlaceholder">
                                <iconify-icon icon="solar:checklist-minimalistic-bold-duotone" class="text-secondary" style="font-size: 48px;"></iconify-icon>
                                <p class="mt-2">Nenhum conteúdo adicionado</p>
                            </div>
                        @else
                            @foreach($track->steps as $index => $step)
                                <div class="content-item d-flex align-items-center rounded-4 p-3 mb-3 border border-2 border-secondary bg-light shadow-sm" data-index="{{ $index }}">
                                    <div class="me-3">
                                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-secondary bg-opacity-25" 
                                            style="width: 60px; height: 60px;">
                                            @php
                                                $icon = match($step->type) {
                                                    'video' => 'solar:videocamera-record-linear',
                                                    'article' => 'solar:document',
                                                    'podcast' => 'solar:microphone-linear',
                                                    'course' => 'solar:square-academic-cap-linear',
                                                    'exercise' => 'solar:pen-new-square-linear',
                                                    default => 'solar:document'
                                                };
                                                $colorClass = match($step->type) {
                                                    'video' => 'danger',
                                                    'article' => 'primary',
                                                    'podcast' => 'info',
                                                    'course' => 'success',
                                                    'exercise' => 'warning',
                                                    default => 'primary'
                                                };
                                            @endphp
                                            <iconify-icon icon="{{ $icon }}" width="30" class="text-secondary"></iconify-icon>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 me-3">
                                        <h6 class="mb-1 fw-semibold">{{ $step->title }}</h6>
                                        <p class="mb-1 small text-muted">{{ Str::limit($step->description, 80) }}</p>
                                        <div class="d-flex align-items-center small text-muted">
                                            <span class="badge bg-{{ $colorClass }} text-white me-2">{{ $step->type }}</span>
                                            <span>{{ $step->estimated_time }} min • {{ $step->external_resource ? 'Externo' : 'Interno' }}</span>
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
                                </div>
                                
                                <!-- Input hidden para o step -->
                                <input type="hidden" name="steps[{{ $index }}]" value="{{ json_encode([
                                    'url' => $step->url,
                                    'title' => $step->title,
                                    'type' => $step->type,
                                    'description' => $step->description,
                                    'estimated_time' => $step->estimated_time,
                                    'external_resource' => $step->external_resource
                                ]) }}">
                            @endforeach
                        @endif
                    </div>

                    <!-- Campo oculto para armazenar todos os steps -->
                    <div id="stepsContainer"></div>
                </div>
            </div>

            <!-- Botões de ação -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('tracks.show', ['username' => $user->username, 'id' => $track->id]) }}" class="btn btn-outline-secondary rounded-4 fw-semibold">
                    <iconify-icon icon="solar:arrow-left-linear" class="me-1"></iconify-icon> Cancelar
                </a>
                <div>
                    <button type="button" class="btn btn-danger text-white fw-semibold rounded-4 me-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        Apagar
                    </button>
                    <button type="submit" class="btn rounded-4 fs-semibold bg-primary text-white fw-semibold">
                        Guardar Alterações
                    </button>
                </div>
            </div>
        </form>
    </section>

    <!-- Modal de confirmação de exclusão -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog border-0 rounded-4 bg-white">
            <div class="modal-content rounded-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja apagar esta trilha de estudos? Esta ação não pode ser desfeita.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="{{ route('tracks.destroy', ['username' => $user->username, 'id' => $track->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger text-white fw-semibold">Apagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mapeamento de ícones por tipo de conteúdo
        const contentIcons = {
            video: { icon: 'solar:videocamera-record-linear', colorClass: 'danger' },
            article: { icon: 'solar:document', colorClass: 'primary' },
            podcast: { icon: 'solar:microphone-linear', colorClass: 'info' },
            course: { icon: 'solar:square-academic-cap-linear', colorClass: 'success' },
            exercise: { icon: 'solar:pen-new-square-linear', colorClass: 'warning' }
        };

        // Função para atualizar a visualização da cor selecionada
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

        // Inicializar a cor selecionada quando a página carregar
        document.addEventListener('DOMContentLoaded', function() {
            const initialColorInput = document.querySelector('input[name="plan_color"]:checked');
            if (initialColorInput) {
                updateColorPreview(initialColorInput);
            }

            // Configurar drag and drop
            setupDragAndDrop();
        });

        // Configuração do drag and drop
        function setupDragAndDropForItem(item) {
    item.style.cursor = 'grab';
    
    item.addEventListener('dragstart', function(e) {
        this.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/html', this.innerHTML);
        document.body.style.cursor = 'grabbing';
    });

    item.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        return false;
    });

    item.addEventListener('dragenter', function(e) {
        e.preventDefault();
        this.classList.add('over');
    });

    item.addEventListener('dragleave', function() {
        this.classList.remove('over');
    });

    item.addEventListener('drop', function(e) {
        e.stopPropagation();
        e.preventDefault();
        
        const draggedItem = document.querySelector('.dragging');
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
        
        document.body.style.cursor = '';
        return false;
    });

    item.addEventListener('dragend', function() {
        this.classList.remove('dragging', 'over');
        document.body.style.cursor = '';
    });
}

        // Função para atualizar a ordem dos steps
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
        
        // Função para adicionar conteúdo à lista
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
            contentItem.dataset.index = newIndex;
            contentItem.draggable = true;
            contentItem.innerHTML = `
                <div class="me-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-secondary bg-opacity-25" 
                        style="width: 60px; height: 60px;">
                        <iconify-icon icon="${icon}" width="30" class="text-secondary"></iconify-icon>
                    </div>
                </div>
                <div class="flex-grow-1 me-3">
                    <h6 class="mb-1 fw-semibold">${title}</h6>
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

            // Configurar drag and drop para o novo item
            setupDragAndDropForItem(contentItem);

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

        // Configuração do drag and drop
    function setupDragAndDrop() {
        const items = document.querySelectorAll('.content-item');
        
        items.forEach(item => {
            item.addEventListener('dragstart', handleDragStart);
            item.addEventListener('dragover', handleDragOver);
            item.addEventListener('drop', handleDrop);
            item.addEventListener('dragend', handleDragEnd);
            
            // Adicionar estilo de cursor
            item.style.cursor = 'grab';
        });
    }

    // Variável global para o item sendo arrastado
    let draggedItem = null;

    function handleDragStart(e) {
        draggedItem = this;
        e.dataTransfer.effectAllowed = 'move';
        this.classList.add('dragging');
        document.body.style.cursor = 'grabbing';
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
        document.body.style.cursor = '';
    }

    // Inicializar o drag and drop quando a página carrega
    document.addEventListener('DOMContentLoaded', function() {
        setupDragAndDrop();
        
        // Configurar drag and drop para novos itens adicionados
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.classList && node.classList.contains('content-item')) {
                        node.addEventListener('dragstart', handleDragStart);
                        node.addEventListener('dragover', handleDragOver);
                        node.addEventListener('drop', handleDrop);
                        node.addEventListener('dragend', handleDragEnd);
                        node.style.cursor = 'grab';
                    }
                });
            });
        });

        observer.observe(document.getElementById('contentsList'), {
            childList: true,
            subtree: true
        });
    });

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
        cursor: grab;
    }
    .content-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .content-item.dragging {
        opacity: 0.5;
        background-color: #f8f9fa;
        cursor: grabbing;
    }
    .color-option:hover {
        transform: scale(1.1);
        transition: transform 0.2s ease;
    }
</style>
@endsection