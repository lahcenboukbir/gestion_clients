@role('admin')

    @extends('layouts.app')

    @section('title', 'Utilisateurs - Afficher')

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
                        </div>

                        <div>
                            <a href="{{ route('users.index') }}" class="btn btn-light">Retour</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

@endrole
