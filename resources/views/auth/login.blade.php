@extends('layouts.app-custom')

@section('content')
<div class="min-vh-100 d-flex justify-content-center align-items-center align-content-center">
    <div class="row container d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body my-5">
                    <div class="row py-lg-5 d-flex">
                        <div class="col-lg-6 d-flex justify-content-center align-items-center d-none d-lg-block position-relative">
                            <div class="position-absolute top-50 translate-middle" style="left: 60%;">
                                <div class="border border-dark bg-dark" style="width: 300px; height: 5px; transform: rotate(-30deg); margin-top: 0px; margin-left: -30px;"></div>
                                <div class="border border-dark bg-dark" style="width: 300px; height: 5px; transform: rotate(30deg); margin-top: 143px; margin-left: -30px;"></div>
                                <div class="border border-dark bg-dark" style="width: 300px; height: 5px; transform: rotate(30deg); margin-top: 0px; margin-left: 30px;"></div>
                                <div class="border border-dark bg-dark" style="width: 300px; height: 5px; transform: rotate(-30deg); margin-top: 143px; margin-left: 30px;"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h1 class="fw-bold text-center">Studify</h1>
                            <p class="mb-4 fw-bold text-center text-dark">Olá, é um prazer tê-lo de volta!</p>
                            <form method="POST" action="{{ route('login') }}" class="pt-3 px-4">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="email" class="form-label visually-hidden">Email</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror border-0 rounded-pill"
                                            name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 position-relative">
                                        <label for="password" class="form-label visually-hidden">Palavra-passe</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror border-0 rounded-pill pe-5"
                                            name="password" placeholder="Palavra-passe" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12 mb-1">
                                        <div class="form-check">
                                            <input class="form-check-input border-0" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                Lembrar-se de mim
                                            </label>
                                        </div>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <div class="col-12">
                                            <a class="" href="{{ route('password.request') }}">
                                                Esqueceu-se da palavra-passe?
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <div class="row mb-0">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary rounded-pill" style="width: 200px;">
                                            Entrar
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
