@extends('layouts.app')

@section('style')
<style>
    /* Estilos mínimos necessários que não podem ser feitos apenas com Bootstrap */
    .contribution-grid {
        display: grid;
        grid-template-columns: repeat(52, 1fr);
        grid-template-rows: repeat(7, 1fr);
        gap: 3px;
        width: 100%;
    }
    
    .contribution-cell {
        width: 12px;
        height: 12px;
        border-radius: 2px;
    }
    
    .contribution-cell.level-0 { background-color: #06d6a0; opacity: 8%; }
    .contribution-cell.level-1 { background-color: #06d6a0; opacity: 20%; }
    .contribution-cell.level-2 { background-color: #06d6a0; opacity: 50%; }
    .contribution-cell.level-3 { background-color: #06d6a0; opacity: 100%; }

    .legend-square {
        width: 10px;
        height: 10px;
        margin: 0 1px;
    }
    
    .legend-square.level-0 { background-color: #06d6a0; opacity: 8%; }
    .legend-square.level-1 { background-color: #06d6a0; opacity: 20%; }
    .legend-square.level-2 { background-color: #06d6a0; opacity: 50%; }
    .legend-square.level-3 { background-color: #06d6a0; opacity: 100%; }
    
    /* Card flutuante para desktop */
    .profile-card {
        position: sticky;
        top: 20px;
        margin-bottom: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        padding: 20px;
    }
    
    .profile-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin: 0 auto 15px;
        background-color: #6c757d;
    }
    
    /* Responsividade */
    @media (max-width: 991.98px) {
        .profile-card {
            position: static;
            margin-bottom: 30px;
        }
    }
    
    @media (max-width: 768px) {
        .contribution-cell {
            width: 8px;
            height: 8px;
        }
        
        .mobile-profile-section {
            display: block;
        }
        
        .desktop-profile-section {
            display: none;
        }
    }
    
    @media (min-width: 769px) {
        .mobile-profile-section {
            display: none;
        }
        
        .desktop-profile-section {
            display: block;
        }
    }
    
    @media (max-width: 576px) {
        .contribution-cell {
            width: 6px;
            height: 6px;
        }
        
        .course-card {
            flex-direction: column;
        }
        
        .course-card .course-image {
            width: 100%;
            height: 120px;
            margin-bottom: 10px;
        }
    }
</style>
@endsection

@section('content')

    <div class="bg-primary" style="height: 200px;"></div>

    <!-- Layout para dispositivos móveis -->
    <section class="mobile-profile-section">
        <div class="d-flex justify-content-center" style="margin-top: -60px;">
            <div class="rounded-circle bg-secondary profile-photo"></div>
        </div>
        <div class="text-center mt-3">
            <h2 class="fw-bold">{{ $user->name }}</h2>
            <div>
                <span class="badge bg-primary rounded-pill text-dark px-3 py-2">Junior</span>
            </div>
            <section class="mb-3 p-3">
                <p class="m-0">{{ $user->bio }}</p>
            </section>
        </div>
    </section>

    <div class="container p-0">
        <div class="row">
            <!-- Card flutuante lateral para desktop -->
            <div class="col-lg-3 desktop-profile-section">
                <div class="profile-card" style="margin-top: -80px;">
                    <div class="profile-photo mx-auto"></div>
                    <div class="text-center">
                        <h3 class="fw-bold">{{ $user->name }}</h3>
                        <div class="mb-3">
                            <span class="badge bg-primary rounded-pill text-dark px-3 py-2">Junior</span>
                        </div>
                        <section class="mb-3 p-3">
                            <p class="m-0">{{ $user->bio }}</p>
                        </section>
                        <div class="d-flex justify-content-between text-center small p-2">
                            <div>
                                <div class="fw-bold">{{ $totalXP }}</div>
                                <div>XP</div>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $coursesCount }}</div>
                                <div>Cursos</div>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $badgesCount }}</div>
                                <div>Badges</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Conteúdo principal -->
            <div class="col-lg-9 ps-5">
                <!-- Seção de Conquistas -->
                <section class="mt-4">
                    <h5 class="fw-bold mb-2">Conquistas</h5>
                    <div class="d-flex flex-wrap gap-3 py-2">
                        @foreach($badges as $badge)
                            <div class="text-center" style="width: 100px;">
                                <div class="rounded-circle bg-secondary mx-auto mb-1" style="width: 100px; height: 100px;">
                                    @if($badge->icon)
                                    <img src="{{ asset($badge->icon) }}" alt="{{ $badge->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @endif
                                </div>
                                <span class="small">{{ $badge->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- Seção de Atividade (estilo GitHub) -->
                <section class="mt-4">
                    <h5 class="fw-bold mb-2">Atividade</h5>
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-medium">Estudou durante 150 dias este ano</span>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="contributionSettings" data-bs-toggle="dropdown" aria-expanded="false">
                                    2025
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="contributionSettings">
                                    <li><a class="dropdown-item" href="#">2024</a></li>
                                    <li><a class="dropdown-item" href="#">2023</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="overflow-auto">
                            <div class="d-flex justify-content-between small text-muted mb-1 ps-4">
                                <span>Jan</span>
                                <span>Fev</span>
                                <span>Mar</span>
                                <span>Abr</span>
                                <span>Mai</span>
                                <span>Jun</span>
                                <span>Jul</span>
                                <span>Ago</span>
                                <span>Set</span>
                                <span>Out</span>
                                <span>Nov</span>
                                <span>Dez</span>
                            </div>
                            
                            <div class="d-flex">
                                <div class="d-flex flex-column justify-content-between small text-muted me-1" style="height: 100%;">
                                    <span>Seg</span>
                                    <span>Ter</span>
                                    <span>Qua</span>
                                    <span>Qui</span>
                                    <span>Sex</span>
                                </div>
                                <div id="contribution-grid" class="contribution-grid">
                                    <!-- Grid será gerado via JavaScript -->
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2 small">
                                <a>Entenda como calculamos sua atividade</a>
                                <div class="d-flex align-items-center">
                                    <span>Menos</span>
                                    <div class="d-flex mx-2">
                                        <div class="legend-square level-0"></div>
                                        <div class="legend-square level-1"></div>
                                        <div class="legend-square level-2"></div>
                                        <div class="legend-square level-3"></div>
                                    </div>
                                    <span>Mais</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Seção de Cursos Concluídos -->
                <section class="mt-4 mb-5">
                    <h5 class="fw-bold mb-2">Cursos Concluídos</h5>
                    <div class="row">
                        @foreach($courses as $course)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="d-flex p-2 bg-light rounded course-card h-100">
                                    <div class="bg-secondary rounded me-3 course-image" style="min-width: 60px; height: 60px;"></div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h6 class="mb-1">{{ $course['title'] }} <i class="fas fa-certificate text-primary"></i></h6>
                                            <div>
                                                <a href="#" class="text-decoration-none text-success"><i class="fas fa-check"></i></a>
                                            </div>
                                        </div>
                                        <div class="small text-muted mb-1">{{ $course['hours'] }}h | Prof: {{ $course['teacher'] }}</div>
                                        <div class="d-flex small">
                                            <div class="me-3">
                                                <a href="{{ $course['certificate_url'] }}" class="text-decoration-none text-primary"><i class="fas fa-link"></i> Certificado</a>
                                            </div>
                                            <div>
                                                <a href="{{ $course['linkedin_url'] }}" class="text-decoration-none text-primary"><i class="fas fa-link"></i> LinkedIn</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script>
        <!-- JavaScript para a grade de contribuições -->
        // Dados de exemplo para a grade de contribuições
        document.addEventListener('DOMContentLoaded', function() {
            // Usar os dados de atividade do PHP
            const contributionData = @json($activityData);
            generateContributionGrid(contributionData);
            
            // Adicionar interatividade aos elementos da página
            setupInteractivity();
        });

        /**
        * Gera a grade de contribuições estilo GitHub
        * @param {Array} contributionData - Dados de atividade do usuário
        */
        function generateContributionGrid(contributionData) {
            const contributionGrid = document.getElementById('contribution-grid');
            if (!contributionGrid) return;
            
            contributionGrid.innerHTML = '';
            
            for (let week = 0; week < 52; week++) {
                for (let day = 0; day < 7; day++) {
                    const cell = document.createElement('div');
                    cell.className = 'contribution-cell';
                    
                    const level = contributionData[week * 7 + day] || 0;
                    if (level > 0) {
                        cell.classList.add(`level-${level}`);
                    }
                    
                    // Adicionar tooltip com informações de contribuição
                    const date = new Date();
                    date.setDate(date.getDate() - (52 * 7) + (week * 7 + day));
                    const formattedDate = date.toLocaleDateString('pt-BR', { 
                        day: 'numeric', 
                        month: 'long', 
                        year: 'numeric' 
                    });
                    
                    const contributions = level === 0 ? 'Nenhuma contribuição' : 
                                        level === 1 ? '1-3 contribuições' : 
                                        level === 2 ? '4-6 contribuições' : 
                                                    '7+ contribuições';
                    
                    cell.setAttribute('data-bs-toggle', 'tooltip');
                    cell.setAttribute('data-bs-placement', 'top');
                    cell.setAttribute('title', `${formattedDate}: ${contributions}`);
                    
                    // Adicionar evento de hover para destacar a célula
                    cell.addEventListener('mouseover', function() {
                        this.style.border = '1px solid #777';
                    });
                    
                    cell.addEventListener('mouseout', function() {
                        this.style.border = 'none';
                    });
                    
                    contributionGrid.appendChild(cell);
                }
            }
            
            // Inicializar tooltips do Bootstrap
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }

        /**
        * Configura interatividade para elementos da página
        */
        function setupInteractivity() {
            // Simular mudança de ano na seção de atividade
            const yearButton = document.querySelector('#contributionSettings');
            if (yearButton) {
                yearButton.addEventListener('click', function() {
                    // Alternar entre anos
                    const currentYear = parseInt(this.textContent);
                    const nextYear = currentYear - 1;
                    if (nextYear >= 2021) {
                        this.textContent = nextYear;
                        // Regenerar grid com novos dados aleatórios
                        generateContributionGrid();
                    } else {
                        this.textContent = '2025';
                        generateContributionGrid();
                    }
                });
            }
            
            // Interatividade para badges de conquistas
            const badges = document.querySelectorAll('.badge-circle');
            badges.forEach(badge => {
                badge.addEventListener('mouseover', function() {
                    this.style.transform = 'scale(1.1)';
                    this.style.transition = 'transform 0.2s';
                });
                
                badge.addEventListener('mouseout', function() {
                    this.style.transform = 'scale(1)';
                });
            });
            
            // Interatividade para cartões de cursos
            const courseCards = document.querySelectorAll('.course-card');
            courseCards.forEach(card => {
                card.addEventListener('mouseover', function() {
                    this.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
                    this.style.transition = 'box-shadow 0.2s';
                });
                
                card.addEventListener('mouseout', function() {
                    this.style.boxShadow = '0 1px 3px rgba(0, 0, 0, 0.1)';
                });
            });
        }

        // Função para alternar entre temas claro e escuro (funcionalidade extra)
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            
            // Atualizar cores da grade de contribuições para o tema escuro
            if (document.body.classList.contains('dark-mode')) {
                document.documentElement.style.setProperty('--contribution-level-0', '#161b22');
                document.documentElement.style.setProperty('--contribution-level-1', '#0e4429');
                document.documentElement.style.setProperty('--contribution-level-2', '#006d32');
                document.documentElement.style.setProperty('--contribution-level-3', '#26a641');
            } else {
                document.documentElement.style.setProperty('--contribution-level-0', '#ebedf0');
                document.documentElement.style.setProperty('--contribution-level-1', '#9be9a8');
                document.documentElement.style.setProperty('--contribution-level-2', '#40c463');
                document.documentElement.style.setProperty('--contribution-level-3', '#30a14e');
            }
            
            // Regenerar a grade com as novas cores
            generateContributionGrid();
        }
    </script>
@endsection
