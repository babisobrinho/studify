{{-- Estende o layout principal --}}
@extends('layouts.app')

@section('title', 'Plataforma de Aprendizagem Tech')

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
    </style>
@endsection

@section('content')
    <section class="position-relative">
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
        <div class="hero-section" style="background: linear-gradient(135deg, rgb(6, 214, 160) 0%, rgb(32, 58, 67) 100%)">
            <div class="container hero-content py-5">
                <div class="d-flex justify-content-end mb-5">
                    <a href="{{ route('about') }}"  class="btn btn-primary bg-hover-dark rounded-4 mt-3 px-3 px-md-4 py-2 fw-bold border-0 shadow-sm">
                    <span class="d-flex align-items-center gap-2">
                        Sobre Nós
                        <iconify-icon icon="solar:arrow-right-linear" width="20"></iconify-icon>
                    </span>
                </a>
                </div>
                <div class="row d-flex flex-column align-items-center">
                    <div class="col-12 mb-3 text-center">
                        <img src="{{ asset('logo_white.png') }}" alt="Logo Studify" class="img-fluid">
                        <h2 class="fw-semibold fs-3 text-center">Estuda sem limites!</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container p-5 my-5" id="diferenciais">
        <div class="row align-items-center py-5 g-5">
            <div class="col-lg-6 order-lg-1">
                <h2 class="fs-1 fw-bold text-dark p-0 mb-4">
                    Somos <span class="text-primary">uma revolução</span> no aprendizado tech
                </h2>
                <p class="fs-5 text-secondary fw-normal mb-3 mb-md-4">
                    Na Studify, estamos a redefinir como a próxima geração de profissionais de tecnologia adquire conhecimento e habilidades.
                </p>
                <div class="d-flex align-items-center mb-2 mb-md-3">
                    <iconify-icon icon="solar:check-circle-bold" class="text-primary me-2" width="18"></iconify-icon>
                    <span class="fw-medium">Metodologia baseada em neurociência</span>
                </div>
                <div class="d-flex align-items-center mb-2 mb-md-3">
                    <iconify-icon icon="solar:check-circle-bold" class="text-primary me-2" width="18"></iconify-icon>
                    <span class="fw-medium">Roadmaps adaptativos com IA</span>
                </div>
                <div class="d-flex align-items-center mb-5">
                    <iconify-icon icon="solar:check-circle-bold" class="text-primary me-2" width="18"></iconify-icon>
                    <span class="fw-medium">Aprendizado mão na massa</span>
                </div>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="btn btn-primary bg-hover-dark btn-lg border-0 rounded-4 fw-semibold px-3 py-2">
                        Comece agora
                    </a>
                    <button class="video-btn btn btn-outline-dark btn-lg px-3 py-2 rounded-4 fw-semibold d-inline-flex align-items-center justify-content-center shadow">
                        <iconify-icon icon="solar:play-bold" width="20" class="me-2"></iconify-icon>
                        Ver Vídeo
                    </button>
                </div>
            </div>
            <div class="col-lg-6 order-lg-2 d-none d-md-block ">
                <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-lg position-relative">
                    <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/S8a0IIRK2Eo?si=B9qImTGANRjV6mCb" title="YouTube video player" style="background: rgba(0,0,0,0.3); pointer-events: none;" allowfullscreen></iframe>
                </div>
                <div class="d-flex flex-column flex-md-row justify-content-center gap-3 mt-3 mt-md-4">
                    <div class="text-center">
                        <div class="fs-1 fw-bold text-primary">4.9</div>
                        <div class="small fw-medium">Avaliação Média</div>
                    </div>
                    <div class="vr d-none d-md-block"></div>
                    <div class="text-center">
                        <div class="fs-1 fw-bold text-primary">50K+</div>
                        <div class="small fw-medium">Alunos</div>
                    </div>
                    <div class="vr d-none d-md-block"></div>
                    <div class="text-center">
                        <div class="fs-1 fw-bold text-primary">92%</div>
                        <div class="small fw-medium">Satisfação</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="d-flex py-5 flex-column justify-content-center align-items-center" style="background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%)">
        <div class="container row p-5 ">
            <h2 class="fs-1 text-center mb-5 fw-bold text-white">O que nos torna diferentes?</h2>
            <div class="col-md-6 col-lg-3">
                <div class="border-start border-4 border-primary pt-3 ps-3 h-100">
                    <iconify-icon icon="solar:map-point-wave-line-duotone" width="32" height="32" class="text-primary mb-3"></iconify-icon>
                    <h4 class="text-white">Roadmaps Inteligentes</h4>
                    <p class="text-white small">Nossos planos de estudo se adaptam ao seu progresso em tempo real, usando algoritmos de IA.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="border-start border-4 border-primary pt-3 ps-3 h-100">
                    <iconify-icon icon="solar:gamepad-line-duotone" width="32" height="32" class="text-primary mb-3"></iconify-icon>
                    <h4 class="text-white">Gamificação com Propósito</h4>
                    <p class="text-white small">Cada conquista corresponde a uma habilidade técnica real para seu currículo.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="border-start border-4 border-primary pt-3 ps-3 h-100">
                    <iconify-icon icon="solar:users-group-two-rounded-line-duotone" width="32" height="32" class="text-primary mb-3"></iconify-icon>
                    <h4 class="text-white">Comunidade Colaborativa</h4>
                    <p class="text-white small">Conectamos você com uma rede global de aprendizes e mentores.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="border-start border-4 border-primary pt-3 ps-3 h-100">
                    <iconify-icon icon="solar:diploma-line-duotone" width="32" height="32" class="text-primary mb-3"></iconify-icon>
                    <h4 class="text-white">Aprendizado Baseado em Dados</h4>
                    <p class="text-white small">Métodos aprimorados com base em dados reais de desempenho.</p>
                </div>
            </div>
        </div>
        <div class="py-5 tech-marquee-wrapper">
            <div class="tech-track" id="techTrack">
                @php
                    $technologies = [
                        ['icon' => 'fa-brands fa-angular', 'name' => 'Angular'],
                        ['icon' => 'fa-brands fa-android', 'name' => 'Android'],
                        ['icon' => 'fa-brands fa-apple', 'name' => 'iOS'],
                        ['icon' => 'fa-brands fa-aws', 'name' => 'AWS'],
                        ['icon' => 'fa-brands fa-bootstrap', 'name' => 'Bootstrap'],
                        ['icon' => 'fa-brands fa-css3-alt', 'name' => 'CSS3'],
                        ['icon' => 'fa-brands fa-docker', 'name' => 'Docker'],
                        ['icon' => 'fa-brands fa-figma', 'name' => 'Figma'],
                        ['icon' => 'fa-brands fa-git-alt', 'name' => 'Git'],
                        ['icon' => 'fa-brands fa-github', 'name' => 'GitHub'],
                        ['icon' => 'fa-brands fa-gitlab', 'name' => 'GitLab'],
                        ['icon' => 'fa-brands fa-html5', 'name' => 'HTML5'],
                        ['icon' => 'fa-brands fa-java', 'name' => 'Java'],
                        ['icon' => 'fa-brands fa-js-square', 'name' => 'JavaScript'],
                        ['icon' => 'fa-brands fa-jenkins', 'name' => 'Jenkins'],
                        ['icon' => 'fa-brands fa-kickstarter-k', 'name' => 'Kotlin'],
                        ['icon' => 'fa-brands fa-laravel', 'name' => 'Laravel'],
                        ['icon' => 'fa-brands fa-node-js', 'name' => 'Node.js'],
                        ['icon' => 'fa-brands fa-npm', 'name' => 'npm'],
                        ['icon' => 'fa-brands fa-php', 'name' => 'PHP'],
                        ['icon' => 'fa-brands fa-python', 'name' => 'Python'],
                        ['icon' => 'fa-brands fa-react', 'name' => 'React'],
                        ['icon' => 'fa-brands fa-raspberry-pi', 'name' => 'Raspberry Pi'],
                        ['icon' => 'fa-brands fa-redhat', 'name' => 'Red Hat'],
                        ['icon' => 'fa-brands fa-rust', 'name' => 'Rust'],
                        ['icon' => 'fa-brands fa-sass', 'name' => 'Sass'],
                        ['icon' => 'fa-brands fa-slack', 'name' => 'Slack'],
                        ['icon' => 'fa-brands fa-swift', 'name' => 'Swift'],
                        ['icon' => 'fa-brands fa-symfony', 'name' => 'Symfony'],
                        ['icon' => 'fa-brands fa-trello', 'name' => 'Trello'],
                        ['icon' => 'fa-brands fa-ubuntu', 'name' => 'Ubuntu'],
                        ['icon' => 'fa-brands fa-vuejs', 'name' => 'Vue.js'],
                        ['icon' => 'fa-brands fa-windows', 'name' => 'Windows'],
                        ['icon' => 'fa-brands fa-wordpress', 'name' => 'WordPress'],
                        ['icon' => 'fa-brands fa-yarn', 'name' => 'Yarn'],
                    ];
                @endphp

                <!-- Primeira exibição -->
                @foreach($technologies as $tech)
                    <div class="tech-item text-white">
                        <i class="{{ $tech['icon'] }} tech-icon text-hover-primary"></i>
                        <div class="tech-name">{{ $tech['name'] }}</div>
                    </div>
                @endforeach
                
                <!-- Segunda exibição (duplicada) -->
                @foreach($technologies as $tech)
                    <div class="tech-item text-white">
                        <i class="{{ $tech['icon'] }} tech-icon text-hover-primary"></i>
                        <div class="tech-name">{{ $tech['name'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="my-5 p-5 d-flex flex-column align-items-center">
        <div class="container row mb-5 pt-5">
            <div class="col-md-8">
                <h2 class="fs-1 fw-bold mb-2">
                    Explore os nossos <span class="text-primary">cursos</span>
                </h2>
                <p class="fs-5 text-muted">Aprenda com os melhores instrutores e domine as tecnologias com mais demanda do mercado</p>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-md-end">
                <a href="{{ route('register') }}" class="fw-bold text-decoration-none">
                    <span class="d-flex align-items-center gap-2 text-hover-primary">
                        Ver todos <iconify-icon icon="solar:arrow-right-linear" width="20"></iconify-icon>
                    </span>
                </a>
            </div>
        </div>
        <div class="container row g-4">
            @foreach($tracks as $track)
            <div class="col-md-6 col-lg-4">
                <div class="hover-card bg-white rounded-4 h-100 d-flex flex-column justify-content-between shadow" style="transition: all 0.3s ease;">
                    <div class="card-body p-4">
                        <h3 class="h5 mb-1">{{ $track->title }}</h3>
                        <div class="d-flex align-items-center gap-4 my-2">
                            <div class="d-flex justify-content-start align-items-center g-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary me-2">{{ $track->difficulty }}</span>
                                @if(isset($track->average_rating))
                                    <div class="text-warning small d-flex align-items-center">
                                        <iconify-icon icon="solar:star-bold" class="me-1" width="15"></iconify-icon>
                                        {{ number_format($track->average_rating, 1) }}
                                    </div>
                                @else
                                    <div class="text-muted small mt-1">No ratings yet</div>
                                @endif
                            </div>
                        </div>
                        <p class="text-muted m-0">{{ $track->description }}</p>
                    </div>
                    <div class="card-footer border-0 p-3">
                        <button class="btn btn-outline-primary rounded-4">
                            Saber mais <iconify-icon icon="mdi:arrow-right" class="ms-2"></iconify-icon>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <section class="p-5" style="background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%)">
        <div class="container py-5">
            <div class="row justify-content-center mb-3">
                <div class="col-lg-8 text-center">
                    <h2 class="fs-1 fw-bold text-white mb-3">O que nossos alunos dizem</h2>
                </div>
            </div>
            @php
                $testimonials = [
                    [
                        'photo' => 'https://images.pexels.com/photos/732425/pexels-photo-732425.jpeg',
                        'name' => 'Mariana Brito',
                        'position' => 'Desenvolvedora Front-end',
                        'quote' => '"A Studify mudou minha carreira! Em 6 meses consegui meu primeiro emprego como desenvolvedora."',
                    ],
                    [
                        'photo' => 'https://images.pexels.com/photos/936119/pexels-photo-936119.jpeg',
                        'name' => 'Carlos Silva',
                        'position' => 'Engenheiro de Dados',
                        'quote' => '"Os projetos práticos me deram a confiança que precisava para migrar de área profissional."',
                        'stars' => 4.5
                    ],
                    [
                        'photo' => 'https://images.pexels.com/photos/3886347/pexels-photo-3886347.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                        'name' => 'Ana Ferraz',
                        'position' => 'UX Designer',
                        'quote' => '"A metodologia de aprendizado é incrível! Nunca imaginei que poderia aprender tanto em pouco tempo."',
                    ]
                ];
            @endphp
            <div class="row g-4">
                @foreach($testimonials as $testimonial)
                    <div class="col-md-4">
                        <div class="hover-card d-flex flex-column justify-content-between h-100 p-4" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 15px; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s ease;">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle overflow-hidden me-3" style="width: 50px; height: 50px;">
                                    <img src="{{ $testimonial['photo'] }}" 
                                        alt="{{ $testimonial['name'] }}" class="w-100 h-100 object-fit-cover">
                                </div>
                                <div>
                                    <h5 class="mb-0 text-white">{{ $testimonial['name'] }}</h5>
                                    <small class="text-white-50">{{ $testimonial['position'] }}</small>
                                </div>
                            </div>
                            <p class="fst-italic text-white">{{ $testimonial['quote'] }}</p>
                            <div class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    <iconify-icon icon="solar:star-bold" width="20"></iconify-icon>
                                @endfor
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="bg-light p-5 my-5">
        <div class="container py-5">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="display-5 fw-bold">Por que escolher a <span class="text-primary">Studify</span>?</h2>
                </div>
            </div>
            <div class="row g-4">
                @php
                    $features = [
                        [
                            'icon' => 'solar:book-outline',
                            'title' => 'Conteúdo Atualizado',
                            'description' => 'Acesso aos materiais mais recentes do mercado, constantemente revisados por especialistas.'
                        ],
                        [
                            'icon' => 'solar:rocket-outline',
                            'title' => 'Aprendizado Acelerado',
                            'description' => 'Metodologia que permite aprender em 6 meses o que levaria anos de estudo convencional.'
                        ],
                        [
                            'icon' => 'solar:graph-outline',
                            'title' => 'Progresso Mensurável',
                            'description' => 'Dashboard interativo para acompanhar seu desenvolvimento em tempo real.'
                        ],
                        [
                            'icon' => 'solar:headphones-round-outline',
                            'title' => 'Comunidade e Suporte 24/7',
                            'description' => 'Fórum da comunidade e equipa de mentores disponível para tirar dúvidas a qualquer momento.'
                        ]
                    ];
                @endphp
                @foreach($features as $feature)
                    <div class="col-md-6 col-lg-3">
                        <div class="hover-card card border-0 shadow-sm h-100" style="transition: all 0.3s ease;">
                            <div class="card-body text-center p-4">
                                <div class="bg-primary bg-opacity-10 rounded-4 p-4 mb-4 mx-auto" style="width: 80px; height: 80px;">
                                    <iconify-icon icon="{{ $feature['icon'] }}" width="32" height="32" class="text-primary"></iconify-icon>
                                </div>
                                <h4 class="mb-3">{{ $feature['title'] }}</h4>
                                <p class="text-muted">{{ $feature['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
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

    @vite(['resources/js/components/light-effect.js', 'resources/js/components/modal-video.js', 'resources/js/components/particles.js'])
@endsection