{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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
                    <img src="{{asset('images/logo-dark.png')}}" alt="logo-dark" class="mx-auto" height="28" />
                </a>
            </div>

            <div class="pt-0">
                <form method="POST" action="{{ route('password.email') }}" class="my-4">
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input name="email" class="form-control" type="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Entrez votre e-mail">
                    </div>

                    <div class="form-group mb-0 row">
                        <div class="col-12">
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit"> Récupérer le mot de passe </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="text-center text-muted">
                    <p class="mb-0">Changement d'avis ?<a class='text-primary ms-2 fw-medium' href='{{route('login')}}'>Retour à la connexion</a></p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
