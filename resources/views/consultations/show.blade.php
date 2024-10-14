@extends('layouts.app')

@section('title', 'Consultations - Afficher')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <div class="align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/users/user-11.jpg') }}"
                                class="rounded-circle avatar-xxl img-thumbnail float-start" alt="image profile">

                            <div class="overflow-hidden ms-4">
                                <h4 class="m-0 text-dark fs-20">{{ $customer->customer_name }}</h4>
                                <p class="my-1 text-muted fs-16">{{ $customer->company }}</p>
                                <span class="fs-15">
                                    <span class="badge bg-primary-subtle text-primary px-2 py-1 fs-13 fw-normal">
                                        {{ $customer->status }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-underline border-bottom pt-2" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active p-2" id="consultations_tab" data-bs-toggle="tab" href="#consultations"
                                role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-information"></i></span>
                                <span class="d-none d-sm-block">Consultations</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p-2" id="ports_tab" data-bs-toggle="tab" href="#ports" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-sitemap-outline"></i></span>
                                <span class="d-none d-sm-block">Ports</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p-2" id="equipements_tab" data-bs-toggle="tab" href="#equipements"
                                role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-school"></i></span>
                                <span class="d-none d-sm-block">Equipements</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content text-muted bg-white">
                        <div class="tab-pane active show pt-4" id="consultations" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-md-12 mb-4">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Statut</h6>
                                                <a href="#"
                                                    class="text-primary fs-14">{{ $consultation->status }}</a>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Remarques</h6>
                                                <a href="#" class="fs-14">{{ $consultation->notes ?? 'N/A' }}</a>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Date de confirmation</h6>
                                                <a href="#"
                                                    class="fs-14">{{ $consultation->confirmation_date ? date('Y-m-d | H:i', strtotime($consultation->confirmation_date)) : 'N/A' }}</a>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Date de consultation</h6>
                                                <a href="#"
                                                    class="fs-14">{{ $consultation->consultation_date_time ? date('Y-m-d | H:i', strtotime($consultation->consultation_date_time)) : 'N/A' }}</a>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Commercial</h6>
                                                <a href="#" class="fs-14">{{ $customer->user_name }}</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="tab-pane pt-4" id="ports" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-md-12 mb-4">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Port de départ</h6>
                                                <a href="#"
                                                    class="text-primary">{{ $port->departure_port }}</a>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Port d'arrivée</h6>
                                                <a href="#" class="fs-14">{{ $port->arrival_port ?? 'N/A' }}</a>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Date de départ</h6>
                                                <a href="#"
                                                    class="fs-14">{{ $port->departure_date_time ? date('Y-m-d | H:i', strtotime($port->departure_date_time)) : 'N/A' }}</a>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Date d'arrivée</h6>
                                                <a href="#"
                                                    class="fs-14">{{ $port->arrival_date_time ? date('Y-m-d | H:i', strtotime($port->arrival_date_time)) : 'N/A' }}</a>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Durée</h6>
                                                <a href="#" class="fs-14">{{ $port->duration ?? 'N/A' }}</a>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Commentaire</h6>
                                                <a href="#" class="fs-14">{{ $port->comment ?? 'N/A' }}</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="tab-pane pt-4" id="equipements" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-md-12 mb-4">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Nom de l'équipement</h6>
                                                <a href="#"
                                                    class="text-primary">{{ $equipment->equipment_name }}</a>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Type d'équipement</h6>
                                                <a href="#" class="fs-14">{{ $equipment->type_name ?? 'N/A' }}</a>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Quantité</h6>
                                                <a href="#" class="fs-14">{{ $equipment->quantity ?? 'N/A' }}</a>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Numéro de série</h6>
                                                <a href="#"
                                                    class="fs-14">{{ $equipment->serial_number ?? 'N/A' }}</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div>
                        <a href="{{ route('consultations.index') }}" class="btn btn-light">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
