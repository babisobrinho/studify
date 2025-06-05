{{-- Estende o layout principal definido em layouts/app.blade.php --}}
@extends('layouts.app')

@section('title', 'Sobre a Studify')

@section('style')
    <style>
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

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--glow-effect);
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
        
        .tech-marquee {
            overflow: hidden;
            white-space: nowrap;
            position: relative;
            background: #f8f9fa;
            padding: 1rem 0;
        }

        .tech-track {
            display: flex; /* Usar flex ao invés de inline-block */
            animation: scroll-left 50s linear infinite;
            width: max-content; /* Garante que a largura se ajuste ao conteúdo */
        }

        .tech-marquee-wrapper {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .tech-item {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0 2.5rem; /* Aumentei um pouco a margem */
            vertical-align: middle;
        }

        .tech-icon {
            font-size: 3.5rem; /* Tamanho um pouco maior */
            margin-bottom: 0.5rem;
        }

        .tech-name {
            font-size: 1.1rem;
            font-weight: 500;
        }

        @keyframes scroll-left {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }      

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
        }
        
        @media (max-width: 575.98px) {
            .team-flip-card {
                margin-bottom: 1rem;
            }
            
            .card-body {
                padding: 1.50rem;
            }
        }
        
        .team-flip-card-front {
            transition: all 0.3s ease;
        }
        
        .team-flip-card:hover .team-flip-card-front {
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
    </style>
@endsection

@section('content')
    <div class="hero-section text-center py-5 position-relative" id="interactive-header" style="background: linear-gradient(135deg, rgb(6, 214, 160) 0%, rgb(32, 58, 67) 100%)">
        <!-- Efeito de luz que segue o mouse -->
        <div class="mouse-light" id="mouseLight"></div>
        <!-- Efeito de partículas animadas -->
        <div class="position-absolute top-0 start-0 w-100 h-100">
            <div class="position-absolute" style="top:20%; left:10%; width:40px; height:40px; background: rgba(255, 255, 255, 0.08); border-radius:50%; animation: float 6s infinite ease-in-out;"></div>
            <div class="position-absolute" style="top:70%; left:80%; width:60px; height:60px; background: rgba(255, 255, 255, 0.1); border-radius:50%; animation: float 8s infinite ease-in-out 5s;"></div>
            <div class="position-absolute" style="top:55%; left:35%; width:30px; height:30px; background: rgba(255, 255, 255, 0.1); border-radius:50%; animation: float 5s infinite ease-in-out 1s;"></div>
        </div> 
        <div class="container position-relative" style="z-index:1;">
            <div class="d-flex justify-content-between align-items-center mb-4 mb-md-5">
                <a href="{{ route('landing') }}" class="btn btn-primary bg-hover-dark rounded-4 mt-3 px-3 px-md-4 py-2 fw-bold border-0 shadow-sm">
                    <span class="d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:arrow-left-linear" width="20"></iconify-icon>
                        Voltar
                    </span>
                </a>
                <div class="badge bg-primary text-dark mt-3 rounded-pill p-2 small fw-bold">Studify v2.0</div>
            </div>
            
            <h1 class="fw-bold mb-2 text-white" style="font-size: 65px;">
                <span class="d-inline-block">Sobre a <span class="text-dark">Studify</span></span>
            </h1>
            <p class="fs-5 fw-semibold text-white mb-5">
                A Revolução na Educação Tech
            </p>
            <div class="d-flex flex-column flex-md-row justify-content-center mb-4 mb-md-5 gap-3 mt-3 mt-md-4">
                <a href="#future" class="btn btn-lg btn-primary bg-hover-dark border-0 px-3 px-md-4 py-2 rounded-4 fw-semibold shadow">
                    <span class="d-flex align-items-center justify-content-center gap-2">
                        O nosso compromisso
                    </span>
                </a>
                <a href="#team" class="btn btn-outline-light btn-lg px-3 py-2 rounded-4 fw-semibold d-inline-flex align-items-center justify-content-center shadow">
                    <iconify-icon icon="solar:users-group-two-rounded-line-duotone" width="20" class="me-2"></iconify-icon>
                    A nossa equipa
                </a>
            </div>
        </div>
    </div>
    <div class="p-5 my-5" id="future">
        <div class="container py-md-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-6 order-2 order-lg-1">
                    <h2 class="fs-1 fw-bold text-dark p-0 mb-4">
                        O <span class="text-primary">futuro</span> que construímos <span class="text-primary">juntos</span>
                    </h2>
                    <div class="fw-medium">
                        <p class="fs-5 mb-3">Estamos em uma missão para:</p>
                        <ul class="p-0 mb-4">
                            <li class="d-flex align-items-start mb-2">
                                <iconify-icon icon="solar:check-circle-bold" class="text-primary me-2 mt-1" width="18"></iconify-icon>
                                <span>Reduzir a lacuna de habilidades na indústria de tecnologia</span>
                            </li>
                            <li class="d-flex align-items-start mb-2">
                                <iconify-icon icon="solar:check-circle-bold" class="text-primary me-2 mt-1" width="18"></iconify-icon>
                                <span>Democratizar o acesso à educação de qualidade</span>
                            </li>
                            <li class="d-flex align-items-start mb-2">
                                <iconify-icon icon="solar:check-circle-bold" class="text-primary me-2 mt-1" width="18"></iconify-icon>
                                <span>Criar profissionais completos, não apenas codificadores</span>
                            </li>
                            <li class="d-flex align-items-start mb-3 mb-md-4">
                                <iconify-icon icon="solar:check-circle-bold" class="text-primary me-2 mt-1" width="18"></iconify-icon>
                                <span>Transformar a maneira como o mundo aprende tecnologia</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="bg-dark p-3 rounded-4 overflow-hidden shadow-lg">
                        <pre class="text-success mb-0" style="font-size: 0.8rem; white-space: pre-wrap; word-wrap: break-word;">
                            <code>
        // O nosso compromisso em código
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
            .catch(error => console.log(error));
                            </code>
                        </pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="position-relative p-5 d-flex flex-column justify-content-center align-items-center" style="background-image:url('laptop.png'); background-attachment: fixed; min-height: 30vh; background-size: cover; background-position: center;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.74); z-index: 1;"></div>
        <div class="position-relative container pt-5" style="z-index: 2;">
            <h2 class="text-center mb-4 fw-bold text-white">Os nossos valores</h2>
            <div class="container row g-2">
                @foreach([
                    'Inovação Contínua' => 'solar:lightbulb-line-duotone',
                    'Acessibilidade Digital' => 'solar:accessibility-line-duotone',
                    'Excelência Técnica' => 'solar:hand-stars-line-duotone',
                    'Aprendizado Prático' => 'solar:notebook-bookmark-line-duotone'
                ] as $value => $icon)
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 bg-transparent">
                        <div class="card-body text-center">
                            <div class="rounded-circle p-2 mb-2 mx-auto d-flex align-items-center justify-content-center"
                                style="width: 100px; height: 100px; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 15px; border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;">
                                <iconify-icon icon="{{ $icon }}" class="text-white" style="font-size: 60px;"></iconify-icon>
                            </div>
                            <p class="fs-5 fw-semibold mb-2 text-white">{{ $value }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="p-5 my-5">
        <div class="container py-md-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 p-0">
                    <div class="bg-light rounded-4 overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" 
                            class="img-fluid object-cover" alt="Equipa Studify a trabalhar">
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <h2 class="fs-1 fw-bold text-dark p-0 mb-4">
                        A construir o <span class="text-primary">futuro</span> da <span class="text-primary">educação tech</span>
                    </h2>
                    <p class="fs-5 p-0 mb-4">Combinamos a melhor estrutura de roadmaps técnicos com princípios de gamificação inteligente</p>
                    
                    <div class="border-start border-3 border-primary p-2 mb-4" style="max-width: 100%">
                        <p class="fst-italic p-2 m-0" style="font-size: 18px;">
                            "Transformamos iniciantes em arquitetos de tecnologia através de metodologias inovadoras"
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <div class="bg-primary rounded-pill px-3 py-1 small fw-medium">Certificados</div>
                        <div class="bg-primary rounded-pill px-3 py-1 small fw-medium">+100 mentores</div>
                        <div class="bg-primary rounded-pill px-3 py-1 small fw-medium">Aprendizado Divertido</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-100 p-5" style="background: linear-gradient(135deg, rgb(32, 58, 67) 0%, rgb(18, 155, 119) 50%, rgb(32, 58, 67) 100%)">
        <div class="p-3 d-flex flex-column align-items-center py-5">
            <h2 class="text-center mb-4 mb-md-5 fw-bold text-white">O nosso impacto</h2>
            <div class="container row g-2 g-md-4">
                <div class="col-md-3 mb-2 mb-md-0">
                    <div class="text-white rounded-4 p-2 p-md-3 text-center shadow" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 15px; border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;">
                        <iconify-icon icon="solar:users-group-two-rounded-line-duotone" width="40"></iconify-icon>
                        <h3 class="my-2 fw-bold text-white">50,000+</h3>
                        <p class="mb-0 small fw-medium">Alunos</p>
                    </div>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <div class="text-white rounded-4 p-2 p-md-3 text-center shadow" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 15px; border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;">
                        <iconify-icon icon="solar:code-bold-duotone" width="40"></iconify-icon>
                        <h3 class="my-2 fw-bold text-white">1.2M+</h3>
                        <p class="mb-0 small fw-medium">Linhas de código</p>
                    </div>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <div class="text-white rounded-4 p-2 p-md-3 text-center shadow" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 15px; border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;">
                        <iconify-icon icon="solar:crown-line-line-duotone" width="40"></iconify-icon>
                        <h3 class="my-2 fw-bold text-white">85%</h3>
                        <p class="mb-0 small fw-medium">Taxa de conclusão</p>
                    </div>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <div class="text-white rounded-4 p-2 p-md-3 text-center shadow" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 15px; border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;">
                        <iconify-icon icon="solar:course-up-line-duotone" width="40"></iconify-icon>
                        <h3 class="my-2 fw-bold text-white">72%</h3>
                        <p class="mb-0 small fw-medium">Empregabilidade</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-5 my-5 d-flex flex-column align-items-center" id="team">
        <div class="row text-center mb-4">
            <h2 class="fs-1 fw-bold text-dark p-0 mb-2">
                A nossa <span class="text-primary">equipa</span>
            </h2>
            <p class="fs-5">Conheça os talentos por trás da Studify</p>
        </div>
        <div class="container row g-4 m-0 p-0">
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
                        'cargo' => 'CEO & Fundadora',
                        'bio' => '15 anos de experiência em educação tecnológica. Apaixonada por criar soluções inovadoras que transformam vidas através da tecnologia.'
                    ],
                    [
                        'github' => 'JulyDuds',
                        'nome' => 'Juliana Abreu',
                        'cargo' => 'Líder de Desenvolvimento',
                        'bio' => 'Engenheira de software com paixão por educação. Lidera nossa equipe de desenvolvimento de plataforma e conteúdo técnico.'
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
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="team-flip-card">
                        <div class="team-flip-card-inner">
                            <div class="team-flip-card-front card h-100 border-0 rounded-4 shadow-sm">
                                <div class="card-body text-center p-3 d-flex flex-column justify-content-center">
                                    <img src="https://github.com/{{ $member['github'] }}.png" class="rounded-circle mx-auto mb-3 shadow" alt="{{ $member['nome'] }}" width="100" height="100">
                                    <p class="fs-4 fw-semibold mb-1">{{ $member['nome'] }}</p>
                                    <p class="text-primary fw-semibold">{{ $member['cargo'] }}</p>
                                    <div class="d-md-none">
                                        <p class="text-muted small">{{ $member['bio'] }}</p>
                                        <a href="https://github.com/{{ $member['github'] }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                                            <iconify-icon icon="mdi:github"></iconify-icon> Perfil GitHub
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-flip-card-back card fw-light fs-5 h-100 flex-column justify-content-center border-0 bg-secondary text-white">
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
    <section class="p-5 bg-primary">
        <div class="container d-flex flex-column flex-md-row align-items-start align-items-center justify-content-between gap-4 py-5">
            <div class="text-center text-md-start">
                <h2 class="fs-1 fw-bold text-white mb-3">
                    Pronto para transformar<br>
                    a sua carreira?
                </h2>
                <p class="fs-5 ts-5 fw-medium text-white mb-0">
                    Junte-se a milhares de alunos que estão acelerando suas carreiras em tecnologia.
                </p>
            </div>
            <a href="{{ route('register') }}" class="btn btn-light bg-hover-dark btn-lg border-0 py-4 px-5 rounded-4 fw-bold">
                Comece agora
            </a>
        </div>
    </section>

    @vite(['resources/js/components/light-effect.js', 'resources/js/components/particles.js'])
@endsection