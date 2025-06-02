@extends('layouts.app')

@section('content')

    <div class="container">
        <!-- Page Title and New Plan Button -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="fw-bold">Planos de Estudo</h1>
            <a href="{{ route('tracks.create', ['username' => $user->username]) }}" class="btn btn-primary fw-bold text-white px-3 rounded-pill shadow">
                Novo Plano
            </a>
        </div>
        <!-- Plans Grid -->
        <div class="row d-flex align-content-center">
            @foreach($tracks as $track)
                <!-- Plan Card -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="{{ route('tracks.show', ['username' => $user->username, 'id' => $track->id]) }}" class="text-decoration-none">
                        <div class="card border-0 h-100 shadow">
                            <div class="card-body border-start bg-white p-4 rounded" style="border-left: 4px solid {{ $track->plan_color ?? '#06d6a0' }} !important;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    @if($track->is_public)
                                        <span class="badge bg-success text-dark uppercase">
                                        Público
                                    </span>
                                    @else
                                        <span class="badge bg-dark text-white uppercase">
                                        Privado
                                    </span>
                                    @endif
                                    <span class="badge bg-light text-secondary">
                                    {{ ucfirst((string)$track->difficulty->value) }}
                                </span>
                                </div>
                                <h5 class="plan-title" style="color: {{ $track->plan_color ?? '#06d6a0' }};">{{ $track->title }}</h5>
                                <p class="text-muted small mb-0">
                                    {{ Str::limit($track->description, 60) }}
                                </p>
                                
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

            @if(count($tracks) === 0)
                <div class="col-12 text-center py-5">
                    <div class="text-muted">
                        <i class="fas fa-book-open fa-3x mb-3"></i>
                        <h5>Nenhum plano de estudos encontrado</h5>
                        <p>Crie seu primeiro plano de estudos clicando no botão "Novo Plano".</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
