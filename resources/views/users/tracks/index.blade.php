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
            <!-- Plan Card 1 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="{{ route('tracks.show', ['username' => $user->username, 'id' => $track->id]) }}" class="text-decoration-none">
                    <div class="card border-0 h-100 shadow">
                        <div class="card-body border-start bg-white p-4 rounded">
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
                            </div>
                            <h5 class="plan-title">{{ $track->title }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
