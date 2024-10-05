@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Liste des prospects</h5>
                </div>

                <div class="card-body">
                    <table id="scroll-horizontal-datatable" class="table w-100 nowrap table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Entreprise</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prospects as $prospect)
                                <tr class="align-baseline">
                                    <td>{{ $prospect->id }}</td>
                                    <td>{{ $prospect->name }}</td>
                                    <td>{{ $prospect->company }}</td>
                                    <td>
                                        <span
                                            class="badge
                                {{ $prospect->status === 'new' ? 'text-bg-dark' : '' }}
                                {{ $prospect->status === 'interested' ? 'text-bg-success' : '' }}
                                {{ $prospect->status === 'not_interested' ? 'text-bg-danger' : '' }}
                                {{ $prospect->status === 'customer' ? 'text-bg-secondary' : '' }}">
                                            {{ $prospect->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('prospects.show', $prospect->id) }}"
                                            class="btn btn-success btn-sm py-0 px-2">
                                            <span class="mdi mdi-eye-outline"></span>
                                        </a>

                                        <a href="{{ route('prospects.edit', $prospect->id) }}"
                                            class="btn btn-warning btn-sm py-0 px-2">
                                            <span class="mdi mdi-file-edit-outline"></span>
                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm py-0 px-2" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $prospect->id }}">
                                            <span class="mdi mdi-delete-outline"></span>
                                        </button>

                                        <div class="modal fade" id="deleteModal{{ $prospect->id }}" tabindex="-1"
                                            aria-labelledby="deleteModal{{ $prospect->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="deleteModal{{ $prospect->id }}">
                                                            Supprimer {{ $prospect->name }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('prospects.destroy', $prospect->id) }}"
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
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <a href="{{ route('prospects.create') }}" class="btn btn-success">Ajouter</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
