{{-- Estende o layout principal --}}
@extends('layouts.app')

{{-- Define o título da página --}}
@section('title', 'Plataforma de Aprendizagem em Tech')

<head>
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>

<style>
    :root {
        --gradient-primary: linear-gradient(135deg,rgb(6, 214, 160) 0%,rgb(32, 58, 67) 100%);
        --gradient-dark: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
        --gradient-card: linear-gradient(to bottom right, #ffffff 0%, #f8f9fa 100%);
        --glow-effect: 0 0 15px rgba(3, 4, 4, 0.5);
    }

    /* Efeitos de fundo animados */
    .animated-bg {
        position: relative;
        overflow: hidden;
    }

    .animated-bg::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
        z-index: 0;
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Estilo do cabeçalho hero */
    .hero-section {
        background: var(--gradient-primary);
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        backdrop-filter: blur(2px);
    }

    .hero-badge {
        background: rgba(0, 0, 0, 0.14);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    /* Efeito de partículas */
    .particles {
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,0.15);
        animation: float 6s infinite ease-in-out;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }

    /* Cards de cursos */
    .course-card {
        background: var(--gradient-card);
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    .course-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .course-icon {
        background: var(--gradient-primary);
        color: white;
        border-radius: 12px;
        padding: 15px;
        box-shadow: 0 4px 10px rgba(58, 123, 213, 0.3);
    }

    /* Seção de depoimentos */
    .testimonial-card {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        border: 1px solid rgba(255,255,255,0.2);
        transition: all 0.3s ease;
    }

    .testimonial-card:hover {
        transform: translateY(-5px);
        background: rgba(255,255,255,0.15);
        box-shadow: var(--glow-effect);
    }

    /* Botões */
    .btn-glow {
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .btn-glow::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: 0.5s;
        z-index: -1;
    }

    .btn-glow:hover::before {
        left: 100%;
    }

    /* Efeitos de hover */
    .hover-scale {
        transition: transform 0.3s ease;
    }

    .hover-scale:hover {
        transform: scale(1.05);
    }

    /* Modal de vídeo */
    .video-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.9);
    }

    .video-modal-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        max-width: 1200px;
    }

    .close-video {
        position: absolute;
        top: 20px;
        right: 30px;
        color: white;
        font-size: 35px;
        font-weight: bold;
        cursor: pointer;
    }

    /* Responsividade */
    @media (max-width: 992px) {
        .display-3 {
            font-size: 2.8rem !important;
        }
        
        .hero-content {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }
    }

    @media (max-width: 768px) {
        .display-3 {
            font-size: 2.2rem !important;
        }
        
        .course-card {
            margin-bottom: 1.5rem;
        }
        
        .hero-buttons {
            flex-direction: column;
            gap: 1rem !important;
            width: 100%;
        }
        
        .hero-buttons .video-btn {
            display: none;
        }
        
        .hero-buttons .btn-light {
            padding: 0.75rem 1rem !important;
            width: 100%;
            text-align: center;
        }
    }

    @media (max-width: 576px) {
        .display-3 {
            font-size: 1.8rem !important;
        }
        
        .section-title {
            font-size: 1.5rem !important;
        }
        
        .hero-buttons .btn-light {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }
    }
        /* Efeito de luz que segue o mouse */
        .mouse-light {
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
        pointer-events: none; /* Isso permite que o mouse interaja com elementos abaixo */
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }

    .hero-section:hover .mouse-light {
        opacity: 2;

    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Criar partículas dinâmicas
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        for (let i = 0; i < 5; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particles');
            
            // Posições e tamanhos aleatórios
            const size = Math.random() * 30 + 10;
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;
            const delay = Math.random() * 5;
            const duration = Math.random() * 10 + 5;
            
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${posX}%`;
            particle.style.top = `${posY}%`;
            particle.style.animationDelay = `${delay}s`;
            particle.style.animationDuration = `${duration}s`;
            
            heroSection.appendChild(particle);
        }
    }

    // Controle do modal de vídeo
    const videoModal = document.getElementById('videoModal');
    const videoBtn = document.querySelector('.video-btn');
    const closeBtn = document.querySelector('.close-video');
    const youtubeIframe = document.getElementById('youtubeVideo');

    if (videoBtn && videoModal) {
        videoBtn.addEventListener('click', function() {
            videoModal.style.display = "block";
            youtubeIframe.src = "https://www.youtube.com/embed/-0RQU0LyJqg?si=Vqqeg-ejOQpfGIp3"; 
        });
    }

    if (closeBtn && videoModal) {
        closeBtn.addEventListener('click', function() {
            videoModal.style.display = "none";
            youtubeIframe.src = "";
        });
    }

    window.addEventListener('click', function(event) {
        if (event.target == videoModal) {
            videoModal.style.display = "none";
            youtubeIframe.src = "";
        }
    });
});

 document.addEventListener('DOMContentLoaded', function() {
    // Efeito de luz que segue o mouse
    const heroSection = document.querySelector('.hero-section');
    const light = document.querySelector('.mouse-light');
    
    if(heroSection && light) {
        let mouseX = 0;
        let mouseY = 0;
        let lightX = 0;
        let lightY = 0;
        const delay = 0.1;
        
        heroSection.addEventListener('mousemove', (e) => {
            const rect = heroSection.getBoundingClientRect();
            mouseX = e.clientX - rect.left;
            mouseY = e.clientY - rect.top;
        });
        
        function animate() {
            // Aplicar suavização ao movimento
            lightX += (mouseX - lightX) * delay;
            lightY += (mouseY - lightY) * delay;
            
            // Atualizar posição da luz
            light.style.left = lightX + 'px';
            light.style.top = lightY + 'px';
            
            requestAnimationFrame(animate);
        }
        
        animate();
        
        // Mostrar/ocultar luz ao entrar/sair do hero section
        heroSection.addEventListener('mouseenter', () => {
            light.style.opacity = '1';
        });
        
        heroSection.addEventListener('mouseleave', () => {
            light.style.opacity = '0';
        });
    }
 });
</script>

{{-- Início da seção de conteúdo --}}
@section('content')
<section class="position-relative">
    <!-- Modal de Vídeo -->
    <div id="videoModal" class="video-modal">
        <span class="close-video">&times;</span>
        <div class="video-modal-content">
            <iframe id="youtubeVideo" width="100%" height="600" frameborder="0" allowfullscreen
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
            </iframe>
        </div>
    </div>
  <!-- Efeito de luz que segue o mouse -->
    <div class="mouse-light" id="mouseLight"></div>
    <!-- Hero Section -->
    <div class="hero-section text-white py-5">
        <div class="container hero-content py-5">
            <!-- Botão Sobre Nós -->
            <div class="d-flex justify-content-end mb-5">
                <a href="{{ route('about') }}" class="btn rounded-4 mt-3 mt-md-5 px-3 px-md-4 py-2 fw-bold border-0 shadow-sm"
                style="background-color: var(--bs-primary); border-color: var(--bs-primary); color: var(--bs-dark)"
                onmouseover="this.style.backgroundColor='var(--bs-blue)'; this.style.color='var(--bs-white)'"
                onmouseout="this.style.backgroundColor='var(--bs-primary)'; this.style.color='var(--bs-dark)'; this.style.borderColor='var(--bs-dark)'">
                <span class="d-flex align-items-center gap-2">
                    {{-- Ícone SVG de seta para a direita --}}
                Sobre Nós
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                </svg>
                </span>
            </a>
            </div>
            
            <!-- Conteúdo Principal -->
            <div class="row align-items-center">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <h1 class="display-3 fw-bold mb-4">Transforme sua carreira tech</h1>
                    
                    <div class="d-flex flex-wrap gap-3 mb-5">
                        <span class="hero-badge rounded-pill px-4 py-2"> Novos Roadmaps</span>
                        <span class="hero-badge rounded-pill px-4 py-2"> Projetos Práticos</span>
                        <span class="hero-badge rounded-pill px-4 py-2"> Mentoria Expert</span>
                    </div>
                    
                    <div class="d-flex flex-wrap gap-3 hero-buttons">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg rounded-4 px-4 py-3 fw-bold">
                            Comece Agora <iconify-icon icon="mdi:arrow-right" class="ms-2"></iconify-icon>
                        </a>
                        
                        <button class="btn btn-outline-light btn-lg rounded-4 px-4 py-3 fw-bold video-btn">
                            <iconify-icon icon="mdi:play-circle" class="me-2"></iconify-icon> Ver Vídeo
                        </button>
                    </div>
                </div>
                
                <div class="col-lg-5">
                    <div class="ratio ratio-16x9 bg-white rounded-4 overflow-hidden shadow-lg hover-scale">
                        <iframe src="https://www.youtube.com/embed/-0RQU0LyJqg?si=Vqqeg-ejOQpfGIp3" title="YouTube video" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Seção de Cursos -->
    <div class="container my-5 py-5">
        <div class="row mb-5">
            <div class="col-md-8">
                <h2 class="display-5 fw-bold mb-3">Explore Nossos <span class="text-primary">Cursos</span></h2>
                <p class="lead text-muted">Aprenda com os melhores instrutores e domine as tecnologias mais demandadas do mercado.</p>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-md-end">
                <a href="#" class="btn btn-link text-decoration-none fw-bold">
                    Ver Todos <iconify-icon icon="mdi:arrow-right" class="ms-2"></iconify-icon>
                </a>
            </div>
        </div>
        
        <div class="row g-4">
            @foreach($tracks as $track)
            <div class="col-md-6 col-lg-4">
                <div class="course-card h-100 d-flex flex-column justify-content-between">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-4 mb-4">
                            <div class="course-icon">
                                <iconify-icon icon="{{ $track->cover_image }}" width="32" height="32"></iconify-icon>
                            </div>
                            <div>
                                <h3 class="h5 mb-1">{{ $track->title }}</h3>
                                <span class="badge bg-primary bg-opacity-10 text-primary">{{ $track->difficulty }}</span>
                            </div>
                        </div>
                        <p class="text-muted mb-4">{{ $track->description }}</p>
                    </div>
                    <div class="card-footer border-0 p-3">
                        <button class="btn btn-outline-primary w-100 rounded-4">
                            Continuar <iconify-icon icon="mdi:arrow-right" class="ms-2"></iconify-icon>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Seção de Destaques -->
    <div class="bg-light py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="display-5 fw-bold mb-3">Por que escolher a <span class="text-primary">Studify</span>?</h2>
                    <p class="lead text-muted">Nossa plataforma combina a melhor estrutura educacional com tecnologia de ponta para seu aprendizado.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-4 p-4 mb-4 mx-auto" style="width: 80px; height: 80px;">
                                <iconify-icon icon="mdi:roadmap" width="32" height="32" class="text-primary"></iconify-icon>
                            </div>
                            <h4 class="mb-3">Roadmaps Inteligentes</h4>
                            <p class="text-muted">Planos de estudo personalizados que se adaptam ao seu progresso.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-4 p-4 mb-4 mx-auto" style="width: 80px; height: 80px;">
                                <iconify-icon icon="mdi:code-braces" width="32" height="32" class="text-primary"></iconify-icon>
                            </div>
                            <h4 class="mb-3">Aprenda Praticando</h4>
                            <p class="text-muted">Projetos reais para consolidar seu conhecimento.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-4 p-4 mb-4 mx-auto" style="width: 80px; height: 80px;">
                                <iconify-icon icon="mdi:account-group" width="32" height="32" class="text-primary"></iconify-icon>
                            </div>
                            <h4 class="mb-3">Comunidade Ativa</h4>
                            <p class="text-muted">Conecte-se com outros alunos e mentores.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-4 p-4 mb-4 mx-auto" style="width: 80px; height: 80px;">
                                <iconify-icon icon="mdi:certificate" width="32" height="32" class="text-primary"></iconify-icon>
                            </div>
                            <h4 class="mb-3">Certificados Reconhecidos</h4>
                            <p class="text-muted">Valide suas habilidades no mercado.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Depoimentos -->
    <div class="py-5" style="background: var(--gradient-dark);">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="display-5 fw-bold text-white mb-3">O que nossos alunos dizem</h2>
                    <p class="lead text-white-50">Veja como a Studify está transformando carreiras em tecnologia.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card d-flex flex-column justify-content-between h-100 p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle overflow-hidden me-3" style="width: 50px; height: 50px;">
                                <img src="https://images.pexels.com/photos/732425/pexels-photo-732425.jpeg" 
                                     alt="Mariana Brito" 
                                     class="w-100 h-100 object-fit-cover">
                            </div>
                            <div>
                                <h5 class="mb-0 text-white">Mariana Brito</h5>
                                <small class="text-white-50">Desenvolvedora Front-end</small>
                            </div>
                        </div>
                        <p class="text-white">"A Studify mudou minha carreira! Em 6 meses consegui meu primeiro emprego como desenvolvedora."</p>
                        <div class="text-warning">
                            <iconify-icon icon="mdi:star" width="20"></iconify-icon>
                            <iconify-icon icon="mdi:star" width="20"></iconify-icon>
                            <iconify-icon icon="mdi:star" width="20"></iconify-icon>
                            <iconify-icon icon="mdi:star" width="20"></iconify-icon>
                            <iconify-icon icon="mdi:star" width="20"></iconify-icon>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="testimonial-card d-flex flex-column justify-content-between h-100 p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle overflow-hidden me-3" style="width: 50px; height: 50px;">
                                <img src="https://images.pexels.com/photos/936119/pexels-photo-936119.jpeg" 
                                     alt="Carlos Silva" 
                                     class="w-100 h-100 object-fit-cover">
                            </div>
                            <div>
                                <h5 class="mb-0 text-white">Carlos Silva</h5>
                                <small class="text-white-50">Engenheiro de Dados</small>
                            </div>
                        </div>
                        <p class="text-white">"Os projetos práticos me deram a confiança que precisava para migrar de área profissional."</p>
                        <div class="text-warning">
                            <iconify-icon icon="mdi:star" width="20"></iconify-icon>
                            <iconify-icon icon="mdi:star" width="20"></iconify-icon>
                            <iconify-icon icon="mdi:star" width="20"></iconify-icon>
                            <iconify-icon icon="mdi:star" width="20"></iconify-icon>
                            <iconify-icon icon="mdi:star-half" width="20"></iconify-icon>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="testimonial-card d-flex flex-column justify-content-between h-100 p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle overflow-hidden me-3" style="width: 50px; height: 50px;">
                                <img src="https://images.pexels.com/photos/3886347/pexels-photo-3886347.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" 
                                     alt="Ana Ferraz" 
                                     class="w-100 h-100 object-fit-cover">
                            </div>
                            <div>
                                <h5 class="mb-0 text-white">Ana Ferraz</h5>
                                <small class="text-white-50">UX Designer</small>
                            </div>
                        </div>
                        <p class="text-white">"A metodologia de aprendizado é incrível! Nunca imaginei que poderia aprender tanto em pouco tempo."</p>
                        <div class="text-warning">
                            <iconify-icon icon="mdi:star" width="20"></iconify-icon>
                            <iconify-icon icon="mdi:star" width="20"></iconify-icon>
                            <iconify-icon icon="mdi:star" width="20"></iconify-icon>
                            <iconify-icon icon="mdi:star" width="20"></iconify-icon>
                            <iconify-icon icon="mdi:star" width="20"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Final -->
    <div class="py-5 bg-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h2 class="display-5 fw-bold text-white mb-3">Pronto para transformar sua carreira?</h2>
                    <p class="lead ts-5 fw-semibold text-white mb-0">Junte-se a milhares de alunos que estão acelerando suas carreiras em tecnologia.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg rounded-4 px-4 py-3 fw-bold">
                        Comece Agora <iconify-icon icon="mdi:arrow-right" class="ms-2"></iconify-icon>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection