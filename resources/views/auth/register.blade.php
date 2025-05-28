@extends('layouts.app-custom')

@section('content')
<div class="min-vh-100 d-flex justify-content-center align-items-center align-content-center">
    <div class="row container d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card py-lg-5">
                <div class="card-body my-5">
                    <div class="row d-flex">
                        <div class="col-lg-5 d-flex justify-content-center align-items-center d-none d-lg-block position-relative">
                            <div class="position-absolute top-50 translate-middle" style="left: 50%;">
                                <div class="border border-dark bg-dark" style="width: 300px; height: 5px; transform: rotate(-30deg); margin-top: 0px; margin-left: -30px;"></div>
                                <div class="border border-dark bg-dark" style="width: 300px; height: 5px; transform: rotate(30deg); margin-top: 143px; margin-left: -30px;"></div>
                                <div class="border border-dark bg-dark" style="width: 300px; height: 5px; transform: rotate(30deg); margin-top: 0px; margin-left: 30px;"></div>
                                <div class="border border-dark bg-dark" style="width: 300px; height: 5px; transform: rotate(-30deg); margin-top: 143px; margin-left: 30px;"></div>
                            </div>
                        </div>
                        <div class="col-lg-7 p-lg-5 px-5">
                            <h1 class="fw-bold text-center">Studify</h1>
                            <p class="mb-4 fw-bold text-center text-dark">Começa agora a trilhar o teu futuro!</p>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label visually-hidden">Nome Completo</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror border-0 rounded-pill"
                                            name="name" value="{{ old('name') }}" placeholder="Nome Completo" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label visually-hidden">Email</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror border-0 rounded-pill"
                                            name="email" value="{{ old('email') }}" placeholder="E-mail" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="username" class="form-label visually-hidden">Nome de Utilizador</label>
                                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror border-0 rounded-pill"
                                            name="username" value="{{ old('username') }}" placeholder="@nome_de_utlizador" required autocomplete="username" autofocus>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="birthday" class="form-label visually-hidden">Data de Nascimento</label>
                                        <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror border-0 rounded-pill"
                                            name="birthday" value="{{ old('birthday') }}" required autocomplete="birthday">
                                        @error('birthday')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label visually-hidden">Palavra-passe</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror border-0 rounded-pill"
                                            name="password" placeholder="Palavra-passe" autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="password-confirm" class="form-label visually-hidden">Confirmar palavra-passe</label>
                                        <input id="password-confirm" type="password" class="form-control border-0 rounded-pill" name="password_confirmation"
                                            placeholder="Confirmar palavra-passe" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary rounded-pill" style="width: 200px;">
                                            Registar-se
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
