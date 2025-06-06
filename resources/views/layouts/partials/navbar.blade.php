<nav class="navbar navbar-expand-lg navbar-light bg-white py-md-4 py-3">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand fw-bold" href="{{ route('index') }}">
            <img src="{{ asset('logo_black.png') }}" alt="Logo Sudify" class="d-none d-md-block" style="width: 150px;">
            <img src="{{ asset('logo_square.png') }}" alt="Logo Sudify" class="d-md-none" style="width: 25px;">
        </a>
        
        <!-- Desktop content (shown on lg and up) -->
        <div class="d-none d-lg-flex w-100">
            <!-- Search form - centered -->
            <form class="d-flex mx-auto" style="max-width: 400px;">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                        <iconify-icon icon="solar:magnifer-line-duotone" class="text-secondary" width="20"></iconify-icon>
                    </span>
                    <input type="search" class="bg-white form-control border-start-0 rounded-end-pill border-dark" placeholder="Pesquisar...">
                </div>
            </form>
            <!-- Nav items - right aligned -->
            <ul class="navbar-nav d-flex align-items-center">
                @guest
                    <li class="nav-item me-2">
                        <a class="nav-link p-0" href="#">
                            Início
                        </a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link p-0" href="#">
                            Sobre Nós
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary border-0 rounded-3 fw-medium px-3" href="{{ route('login') }}">
                            Entrar
                        </a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item me-2 dropdown">
                        <a class="nav-link p-0 position-relative d-none d-lg-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <iconify-icon icon="solar:bell-bold-duotone" class="text-secondary" width="28"></iconify-icon>
                            <span class="position-absolute translate-middle badge rounded-pill bg-danger" style="padding: 5px; right: -1px; top: 6px !important;">
                                <span class="visually-hidden">6 notificações não lidas</span>
                            </span>
                        </a>
                        <!-- Desktop Dropdown Menu -->
                        <ul class="dropdown-menu dropdown-menu-end p-0 rounded-4 bg-white" style="width: 350px;">
                            <li class="dropdown-header py-2 px-3 d-flex justify-content-between align-items-center rounded-4">
                                <span class="fw-bold text-secondary">Notificações</span>
                                <small><a href="#" class="text-primary">Ver todas</a></small>
                            </li>
                            <li class="dropdown-item p-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="d-flex align-items-center rounded-circle p-2 bg-primary bg-opacity-25">
                                            <iconify-icon icon="solar:chat-round-bold" width="24" class="text-primary"></iconify-icon>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-wrap">
                                        <h6 class="mb-1">Novo comentário</h6>
                                        <p class="mb-0 small text-muted">Antónia Silva respondeu o seu comentário</p>
                                        <small class="text-muted">2 minutos atrás</small>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown-item p-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="d-flex align-items-center rounded-circle p-2 bg-warning bg-opacity-25">
                                            <iconify-icon icon="solar:star-bold" width="24" class="text-warning"></iconify-icon>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-wrap">
                                        <h6 class="mb-1">Trilha avaliada</h6>
                                        <p class="mb-0 small text-muted">José Gomes avaliou a sua trilha "PHP para Iniciantes"</p>
                                        <small class="text-muted">1 hora atrás</small>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown-item p-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="d-flex align-items-center rounded-circle p-2 bg-info bg-opacity-25">
                                            <iconify-icon icon="solar:calendar-mark-bold" width="24" class="text-info"></iconify-icon>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-wrap">
                                        <h6 class="mb-1">Evento amanhã</h6>
                                        <p class="mb-0 small text-muted">Estás incrito no evento "Tech Talks" que será amanhã às 14h</p>
                                        <small class="text-muted">Ontem</small>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown-footer text-center py-2 small text-secondary">
                                +3 notificações não lidas
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item me-2 dropdown">
                        <a class="nav-link p-0" href="#" id="desktopDropdown" data-bs-toggle="dropdown">
                            <iconify-icon icon="solar:user-circle-bold-duotone" class="text-secondary" width="32"></iconify-icon>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-white">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('users.profile', auth()->user()->username) }}">
                                    <iconify-icon icon="solar:user-rounded-bold-duotone" class="text-secondary me-2" width="20"></iconify-icon>
                                    Perfil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('tracks.index', auth()->user()->username) }}">
                                    <iconify-icon icon="solar:clipboard-list-bold-duotone" class="text-secondary me-2" width="20"></iconify-icon>
                                    Trilhas
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <iconify-icon icon="solar:settings-bold-duotone" class="text-secondary me-2" width="20"></iconify-icon>
                                    Configurações
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger d-flex align-items-center" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <iconify-icon icon="solar:logout-3-bold-duotone" class="text-danger me-2" width="20"></iconify-icon>
                                    Sair
                                </a>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
        
        <!-- Mobile toggle button -->
        <button class="navbar-toggler border-0 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu"
            data-bs-scroll="false" data-bs-backdrop="true">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Mobile offcanvas menu -->
        <div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="mobileMenu" data-bs-scroll="false" data-bs-backdrop="true">
            <div class="offcanvas-header">
                <img src="{{ asset('logo_black.png') }}" alt="Logo Sudify" style="height: 30px;">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">

                <!-- Mobile search -->
                <form class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                            <iconify-icon icon="solar:magnifer-line-duotone" class="text-secondary" width="20"></iconify-icon>
                        </span>
                        <input type="search" class="bg-white form-control border-start-0 rounded-end-pill border-dark" placeholder="Pesquisar...">
                    </div>
                </form>
                
                <!-- Mobile nav items -->
                <ul class="navbar-nav p-2">
                    @guest
                        <li class="nav-item mb-1">
                            <a class="nav-link p-0 fs-medium" href="#">
                                Início
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link p-0" href="#">
                                Sobre Nós
                            </a>
                        </li>
                        <li class="nav-item mb-3">
                            <a class="nav-link p-0" href="#">
                                As nosas trilhas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary w-100 border-0 rounded-3 fw-medium" href="{{ route('login') }}">
                                Entrar
                            </a>
                        </li>
                    @endguest
                    @auth
                        <li class="nav-item mb-1">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <iconify-icon icon="solar:bell-bold-duotone" class="text-secondary me-2" width="24"></iconify-icon>
                                Notificações (3)
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <iconify-icon icon="solar:user-rounded-bold-duotone" class="text-secondary me-2" width="20"></iconify-icon> Perfil
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <iconify-icon icon="solar:clipboard-list-bold-duotone" class="text-secondary me-2" width="20"></iconify-icon> Trilhas
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <iconify-icon icon="solar:settings-bold-duotone" class="text-secondary me-2" width="20"></iconify-icon> Configurações
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger d-flex align-items-center" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <iconify-icon icon="solar:logout-3-bold-duotone" class="text-danger me-2" width="20"></iconify-icon> Sair
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</nav>