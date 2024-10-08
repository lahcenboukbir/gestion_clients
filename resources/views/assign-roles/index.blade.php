@role('admin')

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Liste des utilisateurs avec leurs rôles</h5>
                </div>

                <div class="card-body">
                    <table id="scroll-horizontal-datatable" class="table w-100 nowrap table-hover">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Rôle</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users_role as $user_role)
                                <tr class="align-baseline">

                                    <td>{{ $user_role->user_name }}</td>
                                    <td>{{ $user_role->role_name }}</td>
                                    <td>
                                        <a href="{{ route('assign.roles.edit', $user_role->user_id) }}"
                                            class="btn btn-warning btn-sm py-0 px-2">
                                            <span class="mdi mdi-file-edit-outline"></span>
                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm py-0 px-2"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user_role->user_id }}">
                                            <span class="mdi mdi-delete-outline"></span>
                                        </button>

                                        <div class="modal fade" id="deleteModal{{ $user_role->user_id }}" tabindex="-1"
                                            aria-labelledby="deleteModal{{ $user_role->user_id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="deleteModal{{ $user_role->user_id }}">
                                                            Supprimer {{ $user_role->user_name }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form
                                                            action="{{ route('assign.roles.destroy', $user_role->user_id) }}"
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
                        <a href="{{ route('assign.roles.create') }}" class="btn btn-success">Ajouter</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@endrole
