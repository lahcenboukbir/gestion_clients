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
                                <h4 class="m-0 text-dark fs-20">{{ $prospect->name }}</h4>
                                <p class="my-1 text-muted fs-16">{{ $prospect->company }}</p>
                                <span class="fs-15">
                                    <span class="badge bg-primary-subtle text-primary px-2 py-1 fs-13 fw-normal">
                                        {{ $prospect->status == 'not_interested'
                                            ? 'Pas intéressé'
                                            : ($prospect->status == 'interested'
                                                ? 'Intéressé'
                                                : ($prospect->status == 'new'
                                                    ? 'Nouveau'
                                                    : 'Statut inconnu')) }}
                                    </span>
                                </span>

                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="tab-content text-muted bg-white">
                        <div class="tab-pane active show pt-4" id="profile_about" role="tabpanel">
                            <div class="row">

                                <div class="col-md-12 col-sm-12 col-md-12 mb-4">
                                    <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">Détails du contact</h5>

                                    <div class="row">
                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Adresse e-mail</h6>
                                                <a href="mailto:{{ $prospect->email }}"
                                                    class="text-primary fs-14 text-decoration-underline">{{ $prospect->email }}</a>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Ville</h6>
                                                <a href="" class="fs-14">{{ $prospect->city }}</a>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Numéro de téléphone</h6>
                                                <a href="tel:{{ $prospect->phone_number }}"
                                                    class="fs-14">{{ $prospect->phone_number }}</a>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Activité</h6>
                                                <a href="" class="fs-14">{{ $prospect->activity }}</a>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Commercial</h6>
                                                <a href="{{ route('users.show', $user->id) }}"
                                                    class="fs-14">{{ $user->name }}</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-md-12 mb-0">
                                        <div class="">
                                            <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">Rendez-vous</h5>
                                        </div>

                                        <div class="row">
                                            <div class="col-4">
                                                <div class="card border">
                                                    <div class="card-body">
                                                        <h4 class="m-0 fw-semibold text-dark fs-16">Succès</h4>
                                                        <div class="row mt-2 d-flex align-items-center">
                                                            <div class="col">
                                                                <h5 class="fs-20 mt-1 fw-bold">2024-10-10</h5>
                                                                <p class="mb-0 text-muted">Remarques</p>
                                                            </div>
                                                            <div class="col-auto">
                                                                <a href="#"
                                                                    class="btn btn-sm btn-outline-dark px-3">Plus de détails
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <a href="{{ route('prospects.index') }}" class="btn btn-light">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
