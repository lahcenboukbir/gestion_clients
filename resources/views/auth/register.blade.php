{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
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
                    <form action="{{ route('register') }}" method="POST" class="my-4">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input class="form-control" name="name" type="text" id="name" required
                                placeholder="Entrez votre nom" value="{{ old('name') }}" autocomplete="name" autofocus>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input name="email" class="form-control" type="email" id="email" required
                                placeholder="Entrez votre e-mail" value="{{ old('email') }}" required autocomplete="email">
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input name="password" class="form-control" type="password" required id="password"
                                placeholder="Entrez votre mot de passe" required autocomplete="new-password">
                        </div>

                        <div class="form-group mb-3">
                            <label for="password-confirm" class="form-label">Confirmer le mot de passe</label>
                            <input name="password_confirmation" class="form-control" type="password" required
                                id="password-confirm" placeholder="Entrez votre mot de passe" required
                                autocomplete="new-password">
                        </div>

                        <div class="form-group mb-0 row">
                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn btn-primary" type="submit"> Inscription </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- <div class="saprator my-4"><span>or sign in with</span></div> --}}

                    <div class="text-center text-muted mb-4">
                        <p class="mb-0">Vous avez déjà un compte ?<a class='text-primary ms-2 fw-medium'
                                href='{{route('login')}}'>Connectez-vous ici</a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
