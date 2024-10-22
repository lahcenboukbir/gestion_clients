@extends('layouts.app')

@section('title', 'Rendez-vous')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Liste des consultations</h5>
                </div>

                <div class="card-body">
                    <table id="scroll-horizontal-datatable" class="table w-100 nowrap table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Statut</th>
                                <th>Remarques</th>
                                <th>Date de confirmation</th>
                                <th>Date de consultation</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consultations as $consultation)
                                <tr class="align-baseline">
                                    <td>{{ $consultation->consultation_id }}</td>
                                    <td>{{ $consultation->customer_name }}</td>
                                    <td>{{ $consultation->status }}</td>
                                    <td>{{ $consultation->notes ?? 'N/A' }}</td>
                                    <td>
                                        {{ $consultation->confirmation_date ? date('Y-m-d H:i', strtotime($consultation->confirmation_date)) : 'N/A' }}
                                    </td>
                                    <td>
                                        {{ $consultation->consultation_date_time ? date('Y-m-d | H:i', strtotime($consultation->consultation_date_time)) : 'N/A' }}
                                    </td>
                                    <td>

                                        <a href="{{ route('consultations.show', $consultation->consultation_id) }}"
                                            class="btn btn-success btn-sm py-0 px-2">
                                            <span class="mdi mdi-eye-outline"></span>
                                        </a>

                                        <a href="{{ route('consultations.edit', $consultation->consultation_id) }}"
                                            class="btn btn-warning btn-sm py-0 px-2">
                                            <span class="mdi mdi-file-edit-outline"></span>
                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm py-0 px-2"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $consultation->consultation_id }}">
                                            <span class="mdi mdi-delete-outline"></span>
                                        </button>

                                        <div class="modal fade" id="deleteModal{{ $consultation->consultation_id }}"
                                            tabindex="-1"
                                            aria-labelledby="deleteModal{{ $consultation->consultation_id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="deleteModal{{ $consultation->consultation_id }}">
                                                            Supprimer {{ $consultation->customer_name }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form
                                                            action="{{ route('consultations.destroy', $consultation->consultation_id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="button" class="btn btn-dark btn-sm py-0 px-2"
                                                                data-bs-dismiss="modal">
                                                                <span class="mdi mdi-close"></span></button>
                                                            <button type="submit" class="btn btn-danger btn-sm py-0 px-2">
                                                                <span class="mdi mdi-delete-outline"></span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Confirmation --}}
                                        @if (!$consultation->confirmation_date)
                                            <button type="button" class="btn btn-primary btn-sm py-0 px-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmModal{{ $consultation->consultation_id }}">
                                                <span class="mdi mdi-check-circle-outline"></span>
                                            </button>

                                            <div class="modal fade" id="confirmModal{{ $consultation->consultation_id }}"
                                                tabindex="-1"
                                                aria-labelledby="confirmModal{{ $consultation->consultation_id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="confirmModal{{ $consultation->consultation_id }}">
                                                                Confirmer</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form
                                                                action="{{ route('consultations.confirm', $consultation->consultation_id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PUT')

                                                                <button type="button"
                                                                    class="btn btn-light btn-sm py-0 px-2"
                                                                    data-bs-dismiss="modal">
                                                                    <span class="mdi mdi-close"></span></button>
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm py-0 px-2">
                                                                    <span class="mdi mdi-check-circle-outline"></span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        {{-- unconfirm --}}
                                        @if ($consultation->confirmation_date)
                                            <button type="button" class="btn btn-info btn-sm py-0 px-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#unconfirmModal{{ $consultation->consultation_id }}">
                                                <span class="mdi mdi-reload"></span>
                                            </button>

                                            <div class="modal fade" id="unconfirmModal{{ $consultation->consultation_id }}"
                                                tabindex="-1"
                                                aria-labelledby="unconfirmModal{{ $consultation->consultation_id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="unconfirmModal{{ $consultation->consultation_id }}">
                                                                Annuler la confirmation</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form
                                                                action="{{ route('consultations.unconfirm', $consultation->consultation_id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PUT')

                                                                <button type="button"
                                                                    class="btn btn-light btn-sm py-0 px-2"
                                                                    data-bs-dismiss="modal">
                                                                    <span class="mdi mdi-close"></span></button>
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-info py-0 px-2">
                                                                    <span class="mdi mdi-reload"></span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        {{-- notes --}}
                                        @if ($consultation->confirmation_date)
                                            <button type="button" class="btn btn-dark btn-sm py-0 px-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#notesModal{{ $consultation->consultation_id }}">
                                                <span class="mdi mdi-text"></span>
                                            </button>

                                            <div class="modal fade" id="notesModal{{ $consultation->consultation_id }}"
                                                tabindex="-1"
                                                aria-labelledby="notesModal{{ $consultation->consultation_id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="notesModal{{ $consultation->consultation_id }}">
                                                                Ajouter
                                                                des
                                                                remarques</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('consultations.notes', $consultation->consultation_id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="row g-3">
                                                                    <div>
                                                                        <label for="notes"
                                                                            class="form-label">Remarques</label>
                                                                        <input type="text" name="notes"
                                                                            class="form-control" id="notes"
                                                                            placeholder="Ajouter des remarques"
                                                                            value="{{ $consultation->notes }}" autofocus>
                                                                    </div>

                                                                    <div class="col">
                                                                        <div class="hstack gap-2 justify-content-end">
                                                                            <button type="button" class="btn btn-light"
                                                                                data-bs-dismiss="modal">Fermer</button>
                                                                            <button type="submit"
                                                                                class="btn btn-success">Ajouter</button>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    @can('create appointments')
                        <div class="mt-3">
                            <a href="{{ route('consultations.create') }}" class="btn btn-success">Ajouter</a>
                        </div>
                    @endcan

                </div>

            </div>
        </div>
    </div>
@endsection






