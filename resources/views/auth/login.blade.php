{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

@extends('auth.app')

@section('content')
    <div class="row">
        <div class="col-md-7 mx-auto">
            <div class="mb-0 border-0 p-md-5 p-lg-0 p-4">
                <div class="mb-4 p-0">
                    <a class='auth-logo' href='index.html'>
                        <img src="{{ asset('images/logo-dark.png') }}" alt="logo-dark" class="mx-auto" height="28" />
                    </a>
                </div>

                <div class="pt-0">
                    <form method="POST" action="{{ route('login') }}" class="my-4">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input name="email" class="form-control" type="email" id="email"
                                placeholder="Entrez votre e-mail" value="{{ old('email') }}" required autocomplete="email"
                                autofocus>

                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input name="password" class="form-control" type="password" required="" id="password"
                                placeholder="Entrez votre mot de passe" required autocomplete="current-password">

                        </div>

                        <div class="form-group d-flex mb-3">
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                                </div>
                            </div>
                            <div class="col-sm-6 text-end">
                                @if (Route::has('password.request'))
                                    <a class="text-muted fs-14" href="{{ route('password.request') }}">
                                        Mot de passe oublié ?
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-0 row">
                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn btn-primary" type="submit"> Connexion </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- <div class="text-center text-muted mb-4">
                        <p class="mb-0">Vous n'avez pas de compte ?<a class='text-primary ms-2 fw-medium'
                                href='{{ route('register') }}'>Inscrivez-vous</a></p>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
@endsection
