@extends('layouts.app')

@section('content')

    <div class="mb-4">
        <h1 class="fw-bold">Editar Plano de Estudos</h1>
        <p class="text-muted">Organize seu aprendizado com um plano estruturado</p>
    </div>

    <form id="createPlanForm">
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
                            placeholder="Ex: Guia de Desenvolvimento Front-End"
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
                        placeholder="Descreva o objetivo e conteúdo do plano..."
                        rows="4"
                        required
                    ></textarea>
                </div>

                <div class="mb-3">
                    <label for="planVisibility" class="form-label">Visibilidade</label>
                    <select class="form-select" id="planVisibility">
                        <option value="public">Público - Visível para todos</option>
                        <option value="private">Privado - Apenas você pode ver</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Categoria e Tags -->
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title h5 mb-3">Categoria e Tecnologias</h2>

                <!-- Categoria do Plano -->
                <div class="mb-4">
                    <label for="planCategory" class="form-label">Categoria do Plano de Estudo</label>
                    <p class="text-muted small mb-2">Selecione a categoria principal deste plano de estudos</p>
                    <select class="form-select" id="planCategory" required>
                        <option value="" selected disabled>Selecione uma categoria...</option>
                        <option value="frontend">Front-end</option>
                        <option value="backend">Back-end</option>
                        <option value="fullstack">Full Stack</option>
                        <option value="mobile">Desenvolvimento Mobile</option>
                        <option value="database">Banco de Dados</option>
                        <option value="devops">DevOps</option>
                        <option value="ai">Inteligência Artificial</option>
                        <option value="datascience">Ciência de Dados</option>
                        <option value="gamedev">Desenvolvimento de Jogos</option>
                        <option value="security">Segurança da Informação</option>
                        <option value="cloud">Computação em Nuvem</option>
                        <option value="other">Outra</option>
                    </select>
                </div>

                <!-- Tags de Tecnologias -->
                <div class="mb-3">
                    <label for="techTags" class="form-label">Tecnologias Utilizadas</label>
                    <p class="text-muted small mb-2">Adicione as tecnologias, linguagens e ferramentas abordadas neste plano</p>
                    <input
                        type="text"
                        id="techTags"
                        class="form-control"
                        placeholder="Digite e pressione Enter para adicionar tecnologias (ex: PHP, Laravel, MySQL...)"
                    >
                    <div class="form-text">Pressione Enter após cada tecnologia ou separe-as com vírgulas</div>
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

                <!-- INPUT URL + TIPO + TITULO -->
                <div class="input-group mb-3">
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
                        <option value="curso" selected>Curso</option>
                        <option value="artigo">Artigo</option>
                        <option value="podcast">Podcast</option>
                        <option value="video">Vídeo</option>
                        <option value="outro">Outro</option>
                    </select>
                    <button class="btn btn-primary" type="button" onclick="addUrlContent()">Adicionar</button>
                </div>

                <div id="contentsList" class="mb-3">
                    <div class="text-center text-muted py-4" id="noContentsPlaceholder">
                        <i class="fas fa-book-open fa-2x mb-2"></i>
                        <p>Nenhum conteúdo adicionado ainda</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botões de ação -->
        <div class="d-flex justify-content-between">
            <a href="{{route('tracks.index')}}" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Salvar plano de estudos</button>
        </div>
    </form>

@endsection
