@can('show appointments')
    @extends('layouts.app')

    @section('title', 'Rendez-vous - Afficher')

    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content text-muted bg-white">
                            <div class="tab-pane active show" id="profile_about" role="tabpanel">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-md-12 mb-0">
                                            <div class="">
                                                <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">Rendez-vous avec
                                                    {{ $prospect_name->name }}</h5>
                                            </div>

                                            <div class="row">
                                                @foreach ($appointments as $appointment)
                                                    <div class="col-sm-6 col-md-6">
                                                        <div class="card border">
                                                            <div class="card-body">
                                                                <h4 class="m-0 fw-semibold text-dark fs-16">
                                                                    <span
                                                                        class="badge
                                                                    @if ($appointment->outcome == 'success') text-bg-success
                                                                    @elseif($appointment->outcome == 'pending') text-bg-dark
                                                                    @elseif($appointment->outcome == 'fail') text-bg-danger
                                                                    @else text-bg-light @endif">{{ $appointment->outcome ?? 'N/A' }}</span>
                                                                </h4>
                                                                <div class="row mt-2 d-flex align-items-center">
                                                                    <div class="col">
                                                                        <h5 class="fs-20 mt-1 fw-bold">
                                                                            <span
                                                                                class="d-block mb-1">{{ date('d/m/Y', strtotime($appointment->appointment_date)) }}</span>
                                                                            <span>{{ date('H:i', strtotime($appointment->appointment_date)) }}</span>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        @can('delete appointments')
                                                                            <button type="button"
                                                                                class="btn btn-sm btn-outline-danger px-3"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#deleteModal{{ $appointment->id }}">
                                                                                Supprimer
                                                                            </button>

                                                                            <div class="modal fade"
                                                                                id="deleteModal{{ $appointment->id }}"
                                                                                tabindex="-1"
                                                                                aria-labelledby="deleteModal{{ $appointment->id }}"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5"
                                                                                                id="deleteModal{{ $appointment->id }}">
                                                                                                Supprimer le rendez-vous</h1>
                                                                                            <button type="button" class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <form
                                                                                                action="{{ route('appointments.destroy', $appointment->id) }}"
                                                                                                method="POST" class="d-inline">
                                                                                                @csrf
                                                                                                @method('DELETE')

                                                                                                <button type="button"
                                                                                                    class="btn btn-dark btn-sm py-0 px-2"
                                                                                                    data-bs-dismiss="modal">
                                                                                                    <span
                                                                                                        class="mdi mdi-close"></span></button>
                                                                                                <button type="submit"
                                                                                                    class="btn btn-danger btn-sm py-0 px-2">
                                                                                                    <span
                                                                                                        class="mdi mdi-delete-outline"></span>
                                                                                                </button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endcan

                                                                        @can('edit appointments')
                                                                            <a href="{{ route('appointments.edit', $appointment->id) }}"
                                                                                class="btn btn-sm btn-outline-warning px-3">Modifier
                                                                            </a>
                                                                        @endcan

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('appointments.index') }}" class="btn btn-light">Retour</a>
                        </div>
                    </div>
                </div>
            </div>
        @endsection

    @endcan
