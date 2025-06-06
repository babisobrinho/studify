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
        border-radius: 16px;
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
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
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
    <div class="container-fluid" style="height: 250px; background: linear-gradient(135deg, rgb(18, 155, 119) 0%, rgb(32, 58, 67) 100%)"></div>
    
    <!-- Layout para dispositivos móveis -->
    <section class="mobile-profile-section">
        <div class="container p-3 p-md-5 rounded-4 bg-white shadow-sm" style="margin-top: -100px;">
            <div class="d-flex justify-content-center" style="margin-top: -60px;">
                <div class="profile-photo">
                    <iconify-icon icon="solar:user-rounded-bold-duotone" width="60" height="60" class="text-secondary"></iconify-icon>
                </div>
            </div>
            <div class="text-center mt-3">
                <h2 class="fw-bold">{{ $user->name }}</h2>
                <div class="mb-3">
                    <span class="badge bg-primary text-white rounded-pill px-3 py-2">Junior</span>
                </div>
                <p class="mb-3">Apaixonada em criar experiências intuitivas dentro e fora da web</p>
                <div class="d-flex justify-content-center gap-4 text-center small">
                    <div>
                        <div class="fw-bold">542</div>
                        <div>XP</div>
                    </div>
                    <div>
                        <div class="fw-bold">6</div>
                        <div>Cursos</div>
                    </div>
                    <div>
                        <div class="fw-bold">6</div>
                        <div>Badges</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <!-- Card flutuante lateral para desktop -->
            <div class="col-lg-3 desktop-profile-section">
                <div class="profile-card shadow-sm rounded-4" style="margin-top: -100px;">
                    <div class="profile-photo">
                        <iconify-icon icon="solar:user-rounded-bold-duotone" width="60" height="60" class="text-secondary"></iconify-icon>
                    </div>
                    <div class="text-center">
                        <h3 class="fw-bold">{{ $user->name }}</h3>
                        <div class="mb-3">
                            <span class="badge bg-primary text-white rounded-pill px-3 py-2">Junior</span>
                        </div>
                        <p class="mb-3">{{ $user->bio }}</p>
                        <div class="d-flex justify-content-between text-center small p-2">
                            <div>
                                <div class="fw-bold">542</div>
                                <div>XP</div>
                            </div>
                            <div>
                                <div class="fw-bold">6</div>
                                <div>Cursos</div>
                            </div>
                            <div>
                                <div class="fw-bold">6</div>
                                <div>Badges</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Conteúdo principal -->
            <div class="col-lg-9">
                <section class="mt-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Conquistas</h5>
                            <div class="row g-3 py-2">
                                <!-- Badge Curioso -->
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="text-center">
                                        <div class="rounded-circle bg-light mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                            <iconify-icon icon="solar:magnifer-bold-duotone" width="40" height="40" class="text-info"></iconify-icon>
                                        </div>
                                        <span class="small fw-medium">#404 Skill Not Found</span>
                                    </div>
                                </div>

                                <!-- Badge Estudante -->
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="text-center">
                                        <div class="rounded-circle bg-light mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                            <iconify-icon icon="solar:bug-bold-duotone" width="40" height="40" class="text-secondary"></iconify-icon>
                                        </div>
                                        <span class="small fw-medium">Bug Slayer</span>
                                    </div>
                                </div>

                                <!-- Badge Programador -->
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="text-center">
                                        <div class="rounded-circle bg-light mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                            <iconify-icon icon="solar:code-bold-duotone" width="40" height="40" class="text-success"></iconify-icon>
                                        </div>
                                        <span class="small fw-medium">whileTrueCry</span>
                                    </div>
                                </div>

                                <!-- Badge Certificado -->
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="text-center">
                                        <div class="rounded-circle bg-light mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                            <iconify-icon icon="solar:infinity-bold-duotone" width="40" height="40" class="text-danger"></iconify-icon>
                                        </div>
                                        <span class="small fw-medium">Nested Loop</span>
                                    </div>
                                </div>

                                <!-- Badge Top 10% -->
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="text-center">
                                        <div class="rounded-circle bg-light mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                            <iconify-icon icon="solar:earth-bold-duotone" width="40" height="40" class="text-success"></iconify-icon>
                                        </div>
                                        <span class="small fw-medium">Hello, worldinho!</span>
                                    </div>
                                </div>

                                <!-- Badge Top 10% -->
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="text-center">
                                        <div class="rounded-circle bg-light mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                            <iconify-icon icon="solar:cup-bold-duotone" width="40" height="40" class="text-warning"></iconify-icon>
                                        </div>
                                        <span class="small fw-medium">Ex-noob</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Seção de Atividade (estilo GitHub) -->
                <section class="mt-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold mb-0">Atividade</h5>
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
                                    <a href="#" class="text-decoration-none">Entenda como calculamos sua atividade</a>
                                    <div class="d-flex align-items-center">
                                        <span class="text-muted me-2">Menos</span>
                                        <div class="d-flex mx-1">
                                            <div class="legend-square level-0"></div>
                                            <div class="legend-square level-1"></div>
                                            <div class="legend-square level-2"></div>
                                            <div class="legend-square level-3"></div>
                                        </div>
                                        <span class="text-muted ms-2">Mais</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Seção de Cursos Concluídos -->
                <section class="mt-4 mb-5">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Cursos Concluídos</h5>
                            <div class="row">
                                <!-- Curso 1 -->
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card h-100 border-0 shadow-sm rounded-4 bg-light">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <h6 class="card-title fw-bold mb-1">Introdução ao PHP</h6>
                                                <div>
                                                    <a href="#" class="text-decoration-none text-primary small ms-2" title="Certificado">
                                                        <i class="fas fa-certificate"></i>
                                                    </a>
                                                    <a href="#" class="text-decoration-none text-muted small ms-2" title="LinkedIn">
                                                        <i class="fab fa-linkedin"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <small class="text-muted">Concluído em: 15/03/2025</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Curso 2 -->
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card h-100 border-0 shadow-sm rounded-4 bg-light">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <h6 class="card-title fw-bold mb-1">Laravel para Iniciantes</h6>
                                                <div>
                                                    <a href="#" class="text-decoration-none text-primary small ms-2" title="Certificado">
                                                        <i class="fas fa-certificate"></i>
                                                    </a>
                                                    <a href="#" class="text-decoration-none text-muted small ms-2" title="LinkedIn">
                                                        <i class="fab fa-linkedin"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <small class="text-muted">Concluído em: 22/04/2025</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Curso 3 -->
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card h-100 border-0 shadow-sm rounded-4 bg-light">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <h6 class="card-title fw-bold mb-1">JavaScript Moderno</h6>
                                                <div>
                                                    <a href="#" class="text-decoration-none text-primary small ms-2" title="Certificado">
                                                        <i class="fas fa-certificate"></i>
                                                    </a>
                                                    <a href="#" class="text-decoration-none text-primary small ms-2" title="LinkedIn">
                                                        <i class="fab fa-linkedin"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <small class="text-muted">Concluído em: 05/05/2025</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Curso 4 -->
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card h-100 border-0 shadow-sm rounded-4 bg-light">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <h6 class="card-title fw-bold mb-1">Banco de Dados MySQL</h6>
                                                <div>
                                                    <a href="#" class="text-decoration-none text-primary small ms-2" title="Certificado">
                                                        <i class="fas fa-certificate"></i>
                                                    </a>
                                                    <a href="#" class="text-decoration-none text-primary small ms-2" title="LinkedIn">
                                                        <i class="fab fa-linkedin"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <small class="text-muted">Concluído em: 18/02/2025</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Curso 5 -->
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card h-100 border-0 shadow-sm rounded-4 bg-light">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <h6 class="card-title fw-bold mb-1">UI/UX Design Básico</h6>
                                                <div>
                                                    <a href="#" class="text-decoration-none text-primary small ms-2" title="Certificado">
                                                        <i class="fas fa-certificate"></i>
                                                    </a>
                                                    <a href="#" class="text-decoration-none text-primary small ms-2" title="LinkedIn">
                                                        <i class="fab fa-linkedin"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <small class="text-muted">Concluído em: 10/01/2025</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Curso 6 -->
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card h-100 border-0 shadow-sm rounded-4 bg-light">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <h6 class="card-title fw-bold mb-1">Git e Controle de Versão</h6>
                                                <div>
                                                    <a href="#" class="text-decoration-none text-primary small ms-2" title="Certificado">
                                                        <i class="fas fa-certificate"></i>
                                                    </a>
                                                    <a href="#" class="text-decoration-none text-primary small ms-2" title="LinkedIn">
                                                        <i class="fab fa-linkedin"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <small class="text-muted">Concluído em: 28/03/2025</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Usar os dados de atividade do PHP
            const contributionData = @json($activityData);
            generateContributionGrid(contributionData);
            
            // Adicionar interatividade aos elementos da página
            setupInteractivity();
        });

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
                    
                    cell.addEventListener('mouseover', function() {
                        this.style.border = '1px solid #777';
                    });
                    
                    cell.addEventListener('mouseout', function() {
                        this.style.border = 'none';
                    });
                    
                    contributionGrid.appendChild(cell);
                }
            }
            
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }

        function setupInteractivity() {
            const yearButton = document.querySelector('#contributionSettings');
            if (yearButton) {
                yearButton.addEventListener('click', function() {
                    const currentYear = parseInt(this.textContent);
                    const nextYear = currentYear - 1;
                    if (nextYear >= 2021) {
                        this.textContent = nextYear;
                        generateContributionGrid();
                    } else {
                        this.textContent = '2025';
                        generateContributionGrid();
                    }
                });
            }
            
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
    </script>
@endsection