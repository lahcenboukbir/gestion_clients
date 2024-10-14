@extends('layouts.app')

@section('title', 'Rendez-vous')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Liste des types d'équipements</h5>
                </div>

                <div class="card-body">
                    <table id="scroll-horizontal-datatable" class="table w-100 nowrap table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type d'équipement</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equipments as $equipment)
                                <tr class="align-baseline">
                                    <td>{{ $equipment->id }}</td>
                                    <td>{{ $equipment->type_name }}</td>
                                    <td>

                                        {{-- <a href="" class="btn btn-success btn-sm py-0 px-2">
                                            <span class="mdi mdi-eye-outline"></span>
                                        </a> --}}

                                        <a href="{{ route('equipment.types.edit', $equipment->id) }}"
                                            class="btn btn-warning btn-sm py-0 px-2">
                                            <span class="mdi mdi-file-edit-outline"></span>
                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm py-0 px-2"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $equipment->id }}">
                                            <span class="mdi mdi-delete-outline"></span>
                                        </button>

                                        <div class="modal fade" id="deleteModal{{ $equipment->id }}" tabindex="-1"
                                            aria-labelledby="deleteModal{{ $equipment->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="deleteModal{{ $equipment->id }}">
                                                            Supprimer {{ $equipment->type_name }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form
                                                            action="{{ route('equipment.types.destroy', $equipment->id) }}"
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
                        <a href="{{ route('equipment.types.create') }}" class="btn btn-success">Ajouter</a>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
