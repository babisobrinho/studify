{{-- Estende o layout principal definido em layouts/app.blade.php --}}
@extends('layouts.app')

@section('title', 'Sobre a Studify')

@section('content')
<head>
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    :root {
        --gradient-dark: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
        --gradient-card: linear-gradient(to bottom right, #ffffff 0%, #f8f9fa 100%);
        --glow-effect: 0 0 15px rgba(25, 26, 28, 0.5);
    }
    
    /* Estilos gerais */
     .parallax1 {
        background-image: url('laptop.png');
        background-attachment: fixed;
        width: 100%;
        min-height: 50vh;
        background-size: cover;
        background-position: center;
        position: relative;
    }
    
    .parallax2, .parallax3 {
        background-image: url('t.png');
        background-attachment: fixed;
        width: 100%;
        min-height: 50vh;
        background-size: cover;
        background-position: center;
        position: relative;
    }
    
    .parallax1::before, 
    .parallax2::before, 
    .parallax3::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.74);
    }
    
    /* Ajustes para dispositivos móveis */
    @media (max-width: 768px) {
        .parallax1, .parallax2, .parallax3 {
            background-attachment: scroll;
            min-height: 30vh;
        }
        
        .parallax1 {
            min-height: 25vh;
        }
    
    /* Dispositivos móveis - desativa o efeito parallax mas mantém a seção visível */
 
        .parallax1 {
            background-image: url('laptop.png') !important;
        }
        .parallax2, .parallax3 {
            background-image: url('t.png') !important;
        }
    }

    
    /* Efeito de luz que segue o mouse */
    .mouse-light {
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity 0.3s ease, transform 0.3s ease-out;
        z-index: 0;
    }
    
    .about-header:hover .mouse-light {
        opacity: 2;
    }
    
    /* Animação flutuante para as bolhas */
    @keyframes float {
        0%, 100% { transform: translateY(0) translateX(0); }
        50% { transform: translateY(-20px) translateX(10px); }
    }
    
    .about-header {
        background-size: 200% 200%;
        animation: gradientBG 8s ease infinite;
        cursor: visible;
    }
    
    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Fundo branco semi-transparente */
    .bg-white-transparent {
        background-color: rgba(0, 0, 0, 0.45) !important;
        backdrop-filter: blur(5px);
    }

    /* Efeito de hover para os ícones de tecnologia */
    .tech-logo-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 50%;
        width: 100px;
        height: 100px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 0.5rem;
        transition: all 0.3s ease;
        text-decoration: none !important;
    }

    .tech-logo {
        position: relative;
        color: #262626;
        transition: .5s;
        z-index: 3;
        width: 50px;
        height: 50px;
        font-size: 50px;
        filter: grayscale(80%);
    }

    .tech-logo-wrapper:hover .tech-logo {
        color: #fff;
        transform: rotateY(360deg);
        filter: grayscale(0%);
    }

    .tech-logo-wrapper:before {
        content: "";
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        height: 100%;
        background: #f00;
        transition: .5s;
        z-index: 2;
        border-radius: 50%;
    }

    .tech-logo-wrapper:hover:before {
        top: 0;
    }

    /* Cores específicas para cada tecnologia */
    .tech-logo-wrapper:nth-child(1):before { background:rgb(255, 255, 255); } /* React */
    .tech-logo-wrapper:nth-child(2):before { background:rgb(221, 232, 227); } /* Vue */
    .tech-logo-wrapper:nth-child(3):before { background:rgb(237, 220, 223); } /* Angular */
    .tech-logo-wrapper:nth-child(4):before { background:rgb(238, 224, 219); } /* Svelte */
    .tech-logo-wrapper:nth-child(5):before { background:rgb(196, 210, 225); } /* TypeScript */
    .tech-logo-wrapper:nth-child(6):before { background:rgb(220, 218, 201); } /* JavaScript */
    
    /* Backend colors */
    .backend-tech:nth-child(1):before { background:rgb(240, 222, 222); } /* Node.js */
    .backend-tech:nth-child(2):before { background:rgb(205, 218, 229); } /* Python */
    .backend-tech:nth-child(3):before { background:rgb(211, 224, 228); } /* Java */
    .backend-tech:nth-child(4):before { background:rgb(210, 231, 210); } /* C# */
    .backend-tech:nth-child(5):before { background:rgb(200, 213, 224); } /* MySQL */
    .backend-tech:nth-child(6):before { background:rgb(229, 216, 216); } /* Laravel */

    /* Estilo para os labels */
    .tech-logo-label {
        margin-top: 0.5rem;
        font-weight: 600;
        color: var(--bs-primary);
        text-align: center;
        width: 100%;
        font-size: 0.8rem;
        position: relative;
        z-index: 3;
        transition: color 0.3s ease;
    }

    .tech-logo-wrapper:hover .tech-logo-label {
        color: black;
    }

    /* Container de logos responsivo */
    .tech-logos-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1.5rem;
        margin: 1.5rem 0;
    }

    /* Ajustes para responsividade */
    @media (max-width: 767.98px) {
        .tech-logo-wrapper {
            width: 100px;
            height: 100px;
        }
        .tech-logo {
            width: 40px;
            height: 40px;
            font-size: 40px;
        }
    }

    @media (max-width: 575.98px) {
        .tech-logo-wrapper {
            width: 90px;
            height: 90px;
        }
        .tech-logo {
            width: 35px;
            height: 35px;
            font-size: 35px;
        }
    }

    /* Estilos para dispositivos móveis */
    @media (max-width: 992px) {
        .display-3 {
            font-size: 2.5rem !important;
        }
        
        .lead {
            font-size: 1.1rem !important;
        }
    }
    
    @media (max-width: 768px) {
        .about-header {
            padding-top: 2rem !important;
            padding-bottom: 2rem !important;
        }
        
        .display-3 {
            font-size: 2rem !important;
        }
        
        .btn-jornada {
            font-size: 1.1rem !important;
            padding: 0.7rem 1.2rem !important;
        }
        
        .row.align-items-center {
            flex-direction: column-reverse;
        }
        
        .container.my-5, 
        .m-5.p-5, 
        .mt-5.mx-5.px-5.py-5,
        .bg-secondary.p-5 {
            margin: 1rem 0.5rem !important;
            padding: 1rem 0.5rem !important;
        }
        
        .px-5.mx-5 {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
            margin-left: 0.5rem !important;
            margin-right: 0.5rem !important;
        }
        
        .ratio-16x9 {
            aspect-ratio: 16/9 !important;
        }
        
        .code-block {
            display: none;
        }
    }
    
    .testimonial-card {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        
        transition: all 0.3s ease;
    }

    .testimonial-card:hover {
        transform: translateY(-5px);
        background: rgba(255,255,255,0.15);
        box-shadow: var(--glow-effect);
    }

    
    @media (max-width: 576px) {        
        .display-3 {
            font-size: 1.8rem !important;
        }
        
        .btn-jornada {
            font-size: 1rem !important;
            padding: 0.6rem 1rem !important;
        }
        
        .d-flex.justify-content-center.gap-3 {
            flex-direction: column;
            gap: 1rem !important;
        }
        
        .vr {
            display: none;
        }
        
        footer .row {
            flex-direction: column;
        }
        
        footer .col-lg-4, 
        footer .col-lg-2 {
            margin-bottom: 1.5rem;
        }
        
        .input-group {
            flex-direction: column;
        }
        
        .input-group input {
            margin-bottom: 0.5rem;
            width: 100% !important;
        }
        
        .input-group button {
            width: 100%;
        }
        
        .future-image {
            display: none;
        }
        /* Estilos específicos para o footer */
        footer {
            overflow: hidden;
            width: 100%;
        }

        footer .container-fluid {
            padding-right: 0;
            padding-left: 0;
        }

        footer .container {
            max-width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (max-width: 576px) {
            footer .container {
                padding-right: 10px;
                padding-left: 10px;
            }
            
            footer .col-lg-4, 
            footer .col-lg-2,
            footer .col-md-6 {
                margin-bottom: 1.5rem;
            }
            
            .input-group {
                flex-direction: column;
            }
            
            .input-group input {
                margin-bottom: 0.5rem;
                width: 100% !important;
            }
            
            .input-group button {
                width: 100%;
            }
        }
            /* Estilos para a seção "O Futuro que Construímos Juntos" */
        #future {
            padding: 0 15px;
        }

        #future h1 {
            font-size: 2rem;
        }

        #future pre code {
            font-size: 0.8rem;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        @media (max-width: 767.98px) {
            #future h1 {
                font-size: 1.8rem;
            }
            
            #future .ratio-16x9 {
                margin-bottom: 1.5rem;
            }
            
            #future ul li {
                margin-bottom: 1rem;
            }
        }

        @media (min-width: 768px) {
            #future h1 {
                font-size: 2.5rem;
            }
            
            #future .px-md-4 {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }
    

    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Aplica efeito parallax apenas se não for mobile
    if (window.innerWidth > 768) {
        const parallaxSections = document.querySelectorAll('.parallax1, .parallax2, .parallax3');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });
        parallaxSections.forEach(section => observer.observe(section));
    } else {
        // Para mobile, apenas mostra as seções sem animação
        document.querySelectorAll('.parallax1, .parallax2, .parallax3').forEach(section => {
            section.classList.add('visible');
        });
    }

    // Efeito de luz que segue o mouse
    const header = document.getElementById('interactive-header');
    const light = document.getElementById('mouseLight');
    
    if(header && light) {
        let mouseX = 0;
        let mouseY = 0;
        let lightX = 0;
        let lightY = 0;
        const delay = 0.1;
        
        header.addEventListener('mousemove', (e) => {
            const rect = header.getBoundingClientRect();
            mouseX = e.clientX - rect.left;
            mouseY = e.clientY - rect.top;
        });
        
        function animate() {
            lightX += (mouseX - lightX) * delay;
            lightY += (mouseY - lightY) * delay;
            
            light.style.left = lightX + 'px';
            light.style.top = lightY + 'px';
            
            requestAnimationFrame(animate);
        }
        
        animate();
    }
});
</script>

<!-- Cabeçalho interativo -->
<div class="about-header text-center py-5 position-relative" 
     id="interactive-header"
     style="background: linear-gradient(135deg,rgb(6, 214, 160) 0%,rgb(32, 58, 67) 100%">
  
    <!-- Efeito de luz que segue o mouse -->
    <div class="mouse-light" id="mouseLight"></div>
    
    <!-- Efeito de partículas animadas -->
    <div class="position-absolute top-0 start-0 w-100 h-100">
        <div class="position-absolute" style="top:20%; left:10%; width:40px; height:40px; background: rgba(255, 255, 255, 0.08); border-radius:50%; animation: float 6s infinite ease-in-out;"></div>
        <div class="position-absolute" style="top:70%; left:80%; width:60px; height:60px; background: rgba(255, 255, 255, 0.1); border-radius:50%; animation: float 8s infinite ease-in-out 5s;"></div>
        <div class="position-absolute" style="top:55%; left:35%; width:30px; height:30px; background: rgba(255, 255, 255, 0.1); border-radius:50%; animation: float 5s infinite ease-in-out 1s;"></div>
    </div>
    
    <div class="container position-relative" style="z-index:1;">
        <!-- Container superior alinhado com o grid do container -->
        <div class="d-flex justify-content-between align-items-center mb-4 mb-md-5 px-3">
            {{-- Botão "Voltar" estilizado --}}
            <a href="{{ route('welcome') }}" class="btn rounded-4 mt-3 mt-md-5 px-3 px-md-4 py-2 fw-bold border-0 shadow-sm"
                style="background-color: var(--bs-primary); border-color: var(--bs-primary); color: var(--bs-dark)"
                onmouseover="this.style.backgroundColor='var(--bs-blue)'; this.style.color='var(--bs-white)'"
                onmouseout="this.style.backgroundColor='var(--bs-primary)'; this.style.color='var(--bs-dark)'; this.style.borderColor='var(--bs-dark)'">
                <span class="d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                    </svg>
                    Voltar
                </span>
            </a>
            {{-- Badge com a versão do sistema --}}
            <div class="bg-primary text-dark mt-3 mt-md-5 rounded-pill px-3 px-md-4 py-2 small fw-bold">Studify v2.0</div>
        </div>
        
        <h1 class="display-3 font-family-primary fw-bold mb-4 mb-md-5 text-white animate__animated animate__fadeInDown">
            <span class="d-inline-block">Sobre a <span class="text-dark">Studify</span></span>
        </h1>
        <p class="lead fw-bold text-white mb-4 mb-md-5 animate__animated animate__fadeIn animate__delay-1s">
            A Revolução na Educação Tech
        </p>
        <div class="d-flex flex-column flex-md-row justify-content-center mb-4 mb-md-5 gap-3 mt-3 mt-md-4 animate__animated animate__fadeIn animate__delay-2s">
            <a href="#diferenciais" class="btn btn-lg px-3 px-md-4 py-2 rounded-4 fw-bold"
               style="background-color: var(--bs-primary); color: var(--bs-dark)"
               onmouseover="this.style.backgroundColor='var(--bs-blue)'; this.style.color='var(--bs-white)'"
               onmouseout="this.style.backgroundColor='var(--bs-primary)'; this.style.color='var(--bs-dark)'">
                <span class="d-flex align-items-center justify-content-center gap-2">
                    O nosso diferencial
                </span>
            </a>

            <a href="#equipe" class="btn btn-outline-light btn-lg px-3 px-md-4 py-2 rounded-4 fw-bold">
                <iconify-icon icon="mdi:account-group" class="me-2"></iconify-icon> Conheça a Equipe
            </a>
        </div>
    </div>
</div>

<!-- Conteúdo principal -->
<div class="container my-4 my-md-5" id="diferenciais">
    <!-- Seção de introdução -->
    <div class="row align-items-center g-4 g-md-5">
        <div class="col-lg-6 order-lg-1 order-2">
            <h2 class="fw-bold mb-3 mb-md-4 text-dark display-5">
                Não somos apenas mais uma plataforma<br>
                <span class="text-primary">Somos uma revolução</span> no aprendizado tech
            </h2>
            <p class="lead text-secondary mb-3 mb-md-4">
                Na Studify, estamos redefinindo como a próxima geração de profissionais de tecnologia adquire conhecimento e habilidades.
            </p>
            
            <div class="d-flex align-items-center mb-2 mb-md-3">
                <iconify-icon icon="mdi:check-circle" class="text-primary me-3" width="24"></iconify-icon>
                <span class="fw-medium">Metodologia baseada em neurociência</span>
            </div>
            <div class="d-flex align-items-center mb-2 mb-md-3">
                <iconify-icon icon="mdi:check-circle" class="text-primary me-3" width="24"></iconify-icon>
                <span class="fw-medium">Roadmaps adaptativos com IA</span>
            </div>
            <div class="d-flex align-items-center mb-3 mb-md-4">
                <iconify-icon icon="mdi:check-circle" class="text-primary me-3" width="24"></iconify-icon>
                <span class="fw-medium">Aprendizado mão na massa</span>
            </div>
            
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-4 px-3 px-md-4 fw-bold">
                Comece Agora <iconify-icon icon="mdi:arrow-right" class="ms-2"></iconify-icon>
            </a>
        </div>
        
        <div class="col-lg-6 order-lg-2 order-1">
            <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-lg position-relative">
                <iframe src="https://www.youtube.com/embed/-0RQU0LyJqg?si=Vqqeg-ejOQpfGIp3" allowfullscreen></iframe>
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.3); pointer-events: none;"></div>
            </div>
            
            <div class="d-flex flex-column flex-md-row justify-content-center gap-3 mt-3 mt-md-4">
                <div class="text-center">
                    <div class="fs-1 fw-bold text-primary">4.9</div>
                    <div class="small">Avaliação média</div>
                </div>
                <div class="vr d-none d-md-block"></div>
                <div class="text-center">
                    <div class="fs-1 fw-bold text-primary">50K+</div>
                    <div class="small">Alunos</div>
                </div>
                <div class="vr d-none d-md-block"></div>
                <div class="text-center">
                    <div class="fs-1 fw-bold text-primary">92%</div>
                    <div class="small">Satisfação</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- O que nos torna diferentes? -->
<div class="py-5 py-md-5" style="background: var(--gradient-dark);">
    <h2 class="text-center mb-4 mb-md-5 fw-bold text-white">O que nos torna diferentes?</h2>
    <div class="row px-3 px-md-5 mx-0 mx-md-5 g-3 g-md-4">
        <div class="col-md-6 col-lg-3">
            <div class="border-start border-4 border-primary ps-3 h-100">
                <iconify-icon icon="mdi:roadmap" width="40" class="mb-2 mb-md-3 text-primary"></iconify-icon>
                <h4 class="text-white">Roadmaps Inteligentes</h4>
                <p class="text-white small">Nossos planos de estudo se adaptam ao seu progresso em tempo real, usando algoritmos de IA.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="border-start border-4 border-primary ps-3 h-100">
                <iconify-icon icon="mdi:gamepad-variant" width="40" class="mb-2 mb-md-3 text-primary"></iconify-icon>
                <h4 class="text-white">Gamificação com Propósito</h4>
                <p class="text-white small">Cada conquista corresponde a uma habilidade técnica real para seu currículo.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="border-start border-4 border-primary ps-3 h-100">
                <iconify-icon icon="mdi:account-group" width="40" class="mb-2 mb-md-3 text-primary"></iconify-icon>
                <h4 class="text-white">Comunidade Colaborativa</h4>
                <p class="text-white small">Conectamos você com uma rede global de aprendizes e mentores.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="border-start border-4 border-primary ps-3 h-100">
                <iconify-icon icon="mdi:chart-line" width="40" class="mb-2 mb-md-3 text-primary"></iconify-icon>
                <h4 class="text-white">Aprendizado Baseado em Dados</h4>
                <p class="text-white small">Métodos aprimorados com base em dados reais de desempenho.</p>
            </div>
        </div>
    </div>
</div>

<div class="parallax1"></div>

{{-- Seção Missão --}}
<div class="row justify-content-center align-items-center g-0 g-md-4 m-0 m-md-5 p-3 p-md-5">
    <div class="col-lg-6 mb-4 mb-lg-0">
        <div class="bg-light rounded-4 overflow-hidden shadow-lg">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" 
                 class="img-fluid object-cover" 
                 alt="Equipe Studify trabalhando">
        </div>
    </div>
    <div class="col-lg-6">
        <h2 class="display-4 fw-bold text-primary px-0 px-md-5 mb-3 mb-md-4">Construindo o futuro da educação tech</h2>
        <p class="lead px-0 px-md-5 mb-4 mb-md-5">Combinamos a melhor estrutura de roadmaps técnicos com princípios de gamificação inteligente</p>
        
        <div class="border-start border-3 border-primary ms-auto ps-3 ps-md-4 py-2 py-md-3 px-0 px-md-5 me-0 me-md-5 mb-4 mb-md-5"
             style="max-width: 100%">
            <p class="fst-italic px-0 px-md-5 mb-0">"Transformamos iniciantes em arquitetos de tecnologia através de metodologias inovadoras"</p>
        </div>

        <div class="d-flex flex-wrap px-0 px-md-5 mb-5 m-md-5 gap-2">
            <div class="bg-primary rounded-pill px-2 px-md-3 py-1 small text-black">Certificados</div>
            <div class="bg-primary rounded-pill px-2 px-md-3 py-1 small text-black">Aprendizado Divertido</div>
            <div class="bg-primary rounded-pill px-2 px-md-3 py-1 small text-black">+100 mentores</div>
        </div>
    </div>
</div>

<div class="m-0 m-md-5 p-3 p-md-5">
    <h2 class="text-center mb-4 mb-md-5 fw-bold text-dark">Nosso Impacto</h2>
    <div class="row g-2 g-md-4">
        <div class="col-6 col-md-3">
            <div class="bg-primary text-dark rounded-4 p-2 p-md-3 text-center">
                <iconify-icon icon="solar:users-group-two-rounded-line-duotone" width="40"></iconify-icon>
                <h3 class="my-2 fw-bold">50,000+</h3>
                <p class="mb-0 small">Alunos</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="bg-primary text-dark rounded-4 p-2 p-md-3 text-center">
                <iconify-icon icon="solar:code-bold-duotone" width="40"></iconify-icon>
                <h3 class="my-2 fw-bold">1.2M+</h3>
                <p class="mb-0 small">Linhas de código</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="bg-primary text-dark rounded-4 p-2 p-md-3 text-center">
                <iconify-icon icon="solar:crown-line-bold-duotone" width="40"></iconify-icon>
                <h3 class="my-2 fw-bold">85%</h3>
                <p class="mb-0 small">Taxa de conclusão</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="bg-primary text-dark rounded-4 p-2 p-md-3 text-center">
                <iconify-icon icon="solar:course-up-line-duotone" width="40"></iconify-icon>
                <h3 class="my-2 fw-bold">72%</h3>
                <p class="mb-0 small">Empregabilidade</p>
            </div>
        </div>
    </div>
</div>

<!-- Front-end Technologies Section -->
<div class="parallax2">
    <div class="container py-4 py-md-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="bg-white-transparent p-3 p-md-4 rounded-4 shadow-lg d-inline-block mb-3 mb-md-4">
                    <h2 class="mb-0 fw-bold text-primary">Tecnologias Front-end que dominamos</h2>
                </div>
            </div>
        </div>
        <div class="bg-white-transparent p-3 p-md-5 rounded-4 shadow-lg">
            <div class="tech-logos-container">
                <!-- React -->
                <a class="tech-logo-wrapper">
                    <iconify-icon icon="logos:react" class="tech-logo"></iconify-icon>
                    <div class="tech-logo-label">React</div>
                </a>
                <!-- Vue -->
                <a class="tech-logo-wrapper">
                    <iconify-icon icon="logos:vue" class="tech-logo"></iconify-icon>
                    <div class="tech-logo-label">Vue.js</div>
                </a>
                <!-- Angular -->
                <a class="tech-logo-wrapper">
                    <iconify-icon icon="logos:angular-icon" class="tech-logo"></iconify-icon>
                    <div class="tech-logo-label">Angular</div>
                </a>
                <!-- Svelte -->
                <a class="tech-logo-wrapper">
                    <iconify-icon icon="logos:svelte-icon" class="tech-logo"></iconify-icon>
                    <div class="tech-logo-label">Svelte</div>
                </a>
                <!-- TypeScript -->
                <a class="tech-logo-wrapper">
                    <iconify-icon icon="logos:typescript-icon" class="tech-logo"></iconify-icon>
                    <div class="tech-logo-label">TypeScript</div>
                </a>
                <!-- JavaScript -->
                <a class="tech-logo-wrapper">
                    <iconify-icon icon="logos:javascript" class="tech-logo"></iconify-icon>
                    <div class="tech-logo-label">JavaScript</div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- O Futuro que Construímos Juntos -->
<div class="container mt-4 mt-md-5 mb-4 mb-md-5" id="future">
    <h1 class="text-center mb-4 mb-md-5 fw-bold">O Futuro que Construímos Juntos</h1>
    
    <div class="row g-4">
        <div class="col-lg-6 order-lg-1 order-2">
            <div class="px-3 px-md-4">
                <p class="fw-bold mb-3 mb-md-4">Estamos em uma missão para:</p>
                <ul class="mb-3 mb-md-4">
                    <li class="d-flex align-items-start mb-2">
                        <iconify-icon icon="mdi:check-circle" class="text-primary me-2 mt-1"></iconify-icon>
                        <span class="fw-medium">Reduzir a lacuna de habilidades na indústria de tecnologia</span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <iconify-icon icon="mdi:check-circle" class="text-primary me-2 mt-1"></iconify-icon>
                        <span class="fw-medium">Democratizar o acesso à educação de qualidade</span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <iconify-icon icon="mdi:check-circle" class="text-primary me-2 mt-1"></iconify-icon>
                        <span class="fw-medium">Criar profissionais completos, não apenas codificadores</span>
                    </li>
                    <li class="d-flex align-items-start mb-3 mb-md-4">
                        <iconify-icon icon="mdi:check-circle" class="text-primary me-2 mt-1"></iconify-icon>
                        <span class="fw-medium">Transformar a maneira como o mundo aprende tecnologia</span>
                    </li>
                </ul>
                
                <!-- Bloco de código (visível apenas em desktop) -->
                <div class="bg-dark rounded-4 p-3 p-md-4 mb-4 d-none d-md-block">
                    <pre class="text-success mb-0"><code>// Nosso compromisso em código
const studifyPromise = new Promise((resolve, reject) => {
    const success = educateWorld();
    if(success) {
        resolve('Mundo transformado!');
    } else {
        reject('Vamos tentar novamente!');
    }
});

studifyPromise
    .then(result => console.log(result))
    .catch(error => console.log(error));</code></pre>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 order-lg-2 order-1 pb-0 pb-md-4">
            <div class="bg-light rounded-4 overflow-hidden shadow-lg h-100">
                <img src="https://images.pexels.com/photos/31396700/pexels-photo-31396700/free-photo-of-close-up-of-hand-writing-in-notebook.jpeg" 
                     class="img-fluid object-cover">
            </div>
        </div>
    </div>
</div>

{{-- Seção Valores --}}
<div class="p-5 p-md-5" style="background: var(--gradient-dark);">
    <h3 class="h2 fw-bold text-white text-center pb-5 mb-4 mb-md-5">Nossos Valores</h3>
    <div class="row g-2 pb-5 g-md-4">
        @foreach([
            'Inovação Contínua' => 'solar:lightbulb-linear',
            'Acessibilidade Digital' => 'solar:accessibility-linear',
            'Excelência Técnica' => 'solar:hand-stars-linear',
            'Aprendizado Prático' => 'solar:notebook-bookmark-linear'
        ] as $value => $icon)
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 bg-transparent">
                <div class="card-body text-center">
                    <div class="bg-primary rounded-circle p-2 p-md-3 mb-2 mb-md-3 mx-auto d-flex align-items-center justify-content-center" 
                         style="width: 70px; height: 70px">
                        <iconify-icon 
                            icon="{{ $icon }}"
                            style="font-size: 28px; color: #000;"
                        ></iconify-icon>
                    </div>
                    <h4 class="h5 mb-2 mb-md-3 text-white">{{ $value }}</h4>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Back-end Technologies Section -->
<div class="parallax3">
    <div class="container py-4 py-md-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="bg-white-transparent p-3 p-md-4 rounded-4 shadow-lg d-inline-block mb-3 mb-md-4">
                    <h2 class="mb-0 fw-bold text-primary">Tecnologias Back-end que ensinamos</h2>
                </div>
            </div>
        </div>
        <div class="bg-white-transparent p-2 p-md-5 rounded-4 shadow-lg">
            <div class="tech-logos-container">
                <!-- Node.js -->
                <a class="tech-logo-wrapper backend-tech">
                    <iconify-icon icon="logos:ruby" class="tech-logo"></iconify-icon>
                    <div class="tech-logo-label">Ruby</div>
                </a>
                <!-- Python -->
                <a class="tech-logo-wrapper backend-tech">
                    <iconify-icon icon="logos:python" class="tech-logo"></iconify-icon>
                    <div class="tech-logo-label">Python</div>
                </a>
                <!-- Java -->
                <a class="tech-logo-wrapper backend-tech">
                    <iconify-icon icon="logos:java" class="tech-logo"></iconify-icon>
                    <div class="tech-logo-label">Java</div>
                </a>
                <!-- C# -->
                <a class="tech-logo-wrapper backend-tech">
                    <iconify-icon icon="logos:c-sharp" class="tech-logo"></iconify-icon>
                    <div class="tech-logo-label">C#</div>
                </a>
                <!-- MySQL -->
                <a class="tech-logo-wrapper backend-tech">
                    <iconify-icon icon="logos:mysql" class="tech-logo"></iconify-icon>
                    <div class="tech-logo-label">MySQL</div>
                </a>
                <!-- Laravel -->
                <a class="tech-logo-wrapper backend-tech">
                    <iconify-icon icon="logos:laravel" class="tech-logo"></iconify-icon>
                    <div class="tech-logo-label">Laravel</div>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Team Section with Flip Cards --}}
<div class="my-5 px-3 px-md-4 px-lg-5" id="equipe">
    <div class="row mx-0">
        <div class="col-12 text-center mb-5 px-0">
            <h2 class="display-5 fw-bold">Nossa Equipe</h2>
            <p class="lead">Conheça os talentos por trás da Studify</p>
        </div>
    </div>

    <div class="row g-4 mx-0">
        @php
            $teamMembers = [
                [
                    'github' => 'kiamy6',
                    'nome' => 'Aline Armando',
                    'cargo' => 'Especialista em IA',
                    'bio' => 'Desenvolve algoritmos de aprendizagem adaptativa. Nosso gênio por trás do sistema de recomendações personalizadas.'
                ],
                [
                    'github' => 'babisobrinho',
                    'nome' => 'Babi Sobrinho',
                    'cargo' => 'CTO & Fundador',
                    'bio' => '15 anos de experiência em educação tecnológica. Apaixonada por criar soluções inovadoras que transformam vidas através da tecnologia.'
                ],
                [
                    'github' => 'JulyDuds',
                    'nome' => 'Juliana Abreu',
                    'cargo' => 'Líder de Desenvolvimento',
                    'bio' => 'Engenheiro de software com paixão por educação. Lidera nossa equipe de desenvolvimento de plataforma e conteúdo técnico.'
                ],
                [
                    'github' => 'lenicesoaares',
                    'nome' => 'Lenice Pereira',
                    'cargo' => 'Diretora Pedagógica',
                    'bio' => 'Especialista em metodologias de aprendizagem. Desenvolveu nosso sistema de ensino que aumenta a retenção de conhecimento em 60%.'
                ],
                [
                    'github' => 'RebecaSantosb',
                    'nome' => 'Rebeca Santos',
                    'cargo' => 'Designer de Experiência',
                    'bio' => 'Cria experiências de aprendizagem memoráveis. Responsável pela interface intuitiva que nossos alunos amam.'
                ],
                [
                    'github' => 'taysoic',
                    'nome' => 'Thalyson Santos',
                    'cargo' => 'Gerente de Comunidade',
                    'bio' => 'Conecta alunos e mentores globalmente. Criou nossa rede de suporte que ajuda estudantes a superar desafios.'
                ]
            ];
        @endphp

        @foreach($teamMembers as $member)
        <div class="col-12 col-sm-6 col-lg-4 px-2 px-sm-3">
            <div class="team-flip-card">
                <div class="team-flip-card-inner">
                    {{-- Front of Card --}}
                    <div class="team-flip-card-front card h-100 border-0 rounded-4 shadow-sm">
                        <div class="card-body text-center p-3 p-md-4 d-flex flex-column">
                            <img src="https://github.com/{{ $member['github'] }}.png" 
                                 class="rounded-circle mx-auto mb-3 shadow" 
                                 alt="{{ $member['nome'] }}"
                                 width="100" height="100">
                            <h3 class="h5 mb-1">{{ $member['nome'] }}</h3>
                            <p class="text-primary fw-bold mb-3">{{ $member['cargo'] }}</p>
                            
                            {{-- Mobile-only content --}}
                            <div class="d-md-none mt-auto">
                                <p class="text-muted small">{{ $member['bio'] }}</p>
                                <a href="https://github.com/{{ $member['github'] }}" 
                                   target="_blank" 
                                   class="btn btn-sm btn-outline-primary mt-2">
                                    <iconify-icon icon="mdi:github"></iconify-icon> Perfil GitHub
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Back of Card --}}
                    <div class="team-flip-card-back card fw-bold fs-5 h-100 flex-column justify-content-between border-0 bg-primary text-white">
                        <div class="card-body p-3 p-md-4 d-flex flex-column justify-content-center">
                            <div class="mb-3">
                                <iconify-icon icon="mdi:quote-open" width="24"></iconify-icon>
                            </div>
                            <p class="mb-4">{{ $member['bio'] }}</p>
                            <div class="mt-auto text-center">
                                <a href="https://github.com/{{ $member['github'] }}" 
                                   target="_blank" 
                                   class="btn btn-outline-light btn-sm">
                                    <iconify-icon icon="mdi:github"></iconify-icon> Ver GitHub
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    /* Flip Card Styles */
    .team-flip-card {
        perspective: 1000px;
        height: 100%;
        min-height: 280px;
        margin-bottom: 1.5rem;
    }
    
    .team-flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.6s;
        transform-style: preserve-3d;
    }
    
    .team-flip-card:hover .team-flip-card-inner {
        transform: rotateY(180deg);
    }
    
    .team-flip-card-front,
    .team-flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
        border-radius: 0.5rem;
    }
    
    .team-flip-card-back {
        transform: rotateY(180deg);
    }
    
    /* Mobile Adaptations */
    @media (max-width: 767.98px) {
        .team-flip-card {
            perspective: none;
            min-height: auto;
        }
        
        .team-flip-card-inner {
            transform: none !important;
        }
        
        .team-flip-card-front,
        .team-flip-card-back {
            position: relative;
        }
        
        .team-flip-card-back {
            display: none;
        }
        
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .row {
            margin-left: -8px;
            margin-right: -8px;
        }
        
        [class*="col-"] {
            padding-left: 8px;
            padding-right: 8px;
        }
    }
    
    /* Extra small devices */
    @media (max-width: 575.98px) {
        .team-flip-card {
            margin-bottom: 1rem;
        }
        
        .card-body {
            padding: 1.50rem;
        }
        

    }
    
    /* Hover Effects */
    .team-flip-card-front {
        transition: all 0.3s ease;
    }
    
    .team-flip-card:hover .team-flip-card-front {
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    /* GitHub Button Animation */
    .btn-outline-primary:hover,
    .btn-outline-light:hover {
        transform: translateY(-2px);
        transition: all 0.2s ease;
    }
</style>
    <!-- CTA Final -->
    <div class="py-5 bg-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h2 class="display-5 fw-bold text-white mb-3">Pronto para transformar sua carreira?</h2>
                    <p class="lead ts-5 text-white mb-0">Junte-se a milhares de alunos que estão acelerando suas carreiras em tecnologia.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <button class="btn btn-light btn-lg rounded-4 px-5 py-3 fw-bold btn-glow">
                        Comece Agora <iconify-icon icon="mdi:arrow-right" class="ms-2"></iconify-icon>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h3 class="h4 text-white fw-bold mb-3">Studify</h3>
                    <p class="text-white-50">A plataforma de aprendizado em tecnologia que transforma iniciantes em profissionais qualificados.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="text-white hover-scale">
                            <iconify-icon icon="mdi:facebook" width="24"></iconify-icon>
                        </a>
                        <a href="#" class="text-white hover-scale">
                            <iconify-icon icon="mdi:twitter" width="24"></iconify-icon>
                        </a>
                        <a href="#" class="text-white hover-scale">
                            <iconify-icon icon="mdi:instagram" width="24"></iconify-icon>
                        </a>
                        <a href="#" class="text-white hover-scale">
                            <iconify-icon icon="mdi:linkedin" width="24"></iconify-icon>
                        </a>
                    </div>
                </div>
                
                <div class="col-md-4 col-lg-2">
                    <h4 class="h5 fw-bold text-white mb-3">Cursos</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50 hover-text-white">Front-end</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 hover-text-white">Back-end</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 hover-text-white">Mobile</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 hover-text-white">Data Science</a></li>
                        <li><a href="#" class="text-white-50 hover-text-white">UX/UI Design</a></li>
                    </ul>
                </div>
                
                <div class="col-md-4 text-white col-lg-2">
                    <h4 class="h5 fw-bold text-white mb-3">Recursos</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50 hover-text-white">Roadmaps</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 hover-text-white">Blog</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 hover-text-white">Tutoriais</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 hover-text-white">Projetos</a></li>
                        <li><a href="#" class="text-white-50 hover-text-white">Comunidade</a></li>
                    </ul>
                </div>
                
                <div class="col-md-4 col-lg-4">
                    <h4 class="h5 fw-bold text-white mb-3">Newsletter</h4>
                    <p class="text-white-50 mb-3">Receba as últimas atualizações e ofertas especiais.</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control bg-dark text-white border-secondary" placeholder="Seu e-mail">
                        <button class="btn btn-primary" type="button">
                            <iconify-icon icon="mdi:send" width="20"></iconify-icon>
                        </button>
                    </div>
                    <small class="text-white-50">Ao se inscrever, você concorda com nossos Termos de Serviço.</small>
                </div>
            </div>
            
            <hr class="my-4 border-secondary">
            
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <p class="mb-0 text-white-50 small">© 2025 Studify. Todos os direitos reservados.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#" class="text-white-50 small hover-text-white">Termos</a></li>
                        <li class="list-inline-item"><a href="#" class="text-white-50 small hover-text-white">Privacidade</a></li>
                        <li class="list-inline-item"><a href="#" class="text-white-50 small hover-text-white">Cookies</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</section>
@endsection