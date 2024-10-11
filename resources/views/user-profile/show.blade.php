@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <div class="align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/users/user-16.png') }}"
                                class="rounded-circle avatar-xxl img-thumbnail float-start" alt="image profile">

                            <div class="overflow-hidden ms-4">
                                <h4 class="my-1 text-dark fs-20">{{ $user->user_name }}</h4>
                                <span class="fs-15">
                                    <span class="badge bg-primary-subtle text-primary px-2 py-1 fs-13 fw-normal">
                                        {{ $user->role_name }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-underline border-bottom pt-2" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active p-2" id="profile_about_tab" data-bs-toggle="tab" href="#profile_about"
                                role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-information"></i></span>
                                <span class="d-none d-sm-block">À propos</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link p-2" id="setting_tab" data-bs-toggle="tab" href="#profile_setting"
                                role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-school"></i></span>
                                <span class="d-none d-sm-block">Paramètres</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content text-muted bg-white">
                        <div class="tab-pane active show pt-4" id="profile_about" role="tabpanel">
                            <div class="row">

                                <div class="col-md-12 col-sm-12 col-md-12 mb-4">
                                    <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">Détails du contact</h5>

                                    <div class="row">
                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Adresse e-mail</h6>
                                                <a href="mailto:{{ $user->email }}"
                                                    class="text-primary fs-14 text-decoration-underline">{{ $user->email }}</a>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Adresse</h6>
                                                <a href="" class="fs-14">{{ $user->address ?? 'N/A' }}</a>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Numéro de téléphone</h6>
                                                <a href="tel:{{ $user->phone_number }}"
                                                    class="fs-14">{{ $user->phone_number ?? 'N/A' }}</a>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Bio</h6>
                                                <a href="" class="fs-14">{{ $user->bio ?? 'N/A' }}</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane pt-4" id="profile_setting" role="tabpanel">
                            <div class="row">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">

                                        <div class="col-lg-6 col-xl-6">
                                            <div class="card border mb-0">
                                                <div class="card-header">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h4 class="card-title mb-0">Informations personnelles</h4>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body">
                                                    <div class="form-group mb-3 row">
                                                        <label for="name" class="form-label">Nom</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <input name="name" type="text" id="name"
                                                                class="form-control" value="{{ $user->user_name }}" placeholder="Modifier le nom">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label class="phone_number" class="form-label">Numéro de
                                                            téléphone</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="mdi mdi-phone-outline"></i></span>
                                                                <input name="phone_number" type="text" id="phone_number"
                                                                    class="form-control" value="{{ $user->phone_number }}"
                                                                    placeholder="Modifier le numéro de téléphone">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="img" class="form-label">Image</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <input name="img" class="form-control form-control"
                                                                id="img" type="file">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="address" class="form-label">Adresse</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <input name="address" type="address" id="address"
                                                                class="form-control" value="{{ $user->address }}"
                                                                placeholder="Modifier l'adresse">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="bio" class="form-label">Bio</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <textarea name="bio" class="form-control" id="bio" rows="1" spellcheck="false"
                                                                placeholder="Modifier la bio">{{ $user->bio }}</textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-xl-6">
                                            <div class="card border mb-0">

                                                <div class="card-header">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h4 class="card-title mb-0">Sécurité du compte</h4>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body mb-0">
                                                    <div class="form-group mb-3 row">
                                                        <label for="email" class="form-label">Adresse e-mail</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="mdi mdi-email"></i></span>
                                                                <input name="email" type="email" id="email"
                                                                    class="form-control" value="{{ $user->email }}" placeholder="Modifier l'email">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="password" class="form-label">Mot de
                                                            passe</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <input name="password" type="password" id="password"
                                                                class="form-control"
                                                                placeholder="Modifier le mot de passe">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-lg-12 col-xl-12">
                                                            <button type="submit"
                                                                class="btn btn-success">Modifier</button>
                                                            <a href="{{ route('profile.show') }}"
                                                                class="btn btn-light">Annuler</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
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
