@extends('layouts.app')

@section('content')

<!-- Page Title and New Plan Button -->
<div class="container d-flex justify-content-between align-items-center mb-5">
    <h1 class="fw-bold">Planos de Estudo de Ana Clara Sobrinho de Oliveira</h1>
    <a href="{{route('tracks.create')}}" class="btn btn-primary rounded-pill">
        <i class="fas fa-plus me-2"></i>Novo Plano
    </a>
</div>

<!-- Plans Grid -->
<div class="px-5 row d-flex align-content-center">
    @for($i = 0; $i < 8; $i++)
    <!-- Plan Card 1 -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-0">
            <div class="card-body border-start bg-white p-4 rounded">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-success">PUBLICADO</span>
                    <a href="{{route('tracks.show')}}" class="text-secondary">
                        link
                    </a>
                </div>
                <h5 class="plan-title">{B} Guia do Aprendizado</h5>

            </div>
        </div>
    </div>
    @endfor

</div>
@endsection
