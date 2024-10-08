@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Liste des utilisateurs</h5>
                </div>

                <div class="card-body">
                    <table id="scroll-horizontal-datatable" class="table w-100 nowrap table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="align-baseline">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>

                                    <td>
                                        @can('show users')
                                            <a href="{{ route('users.show', $user->id) }}"
                                                class="btn btn-success btn-sm py-0 px-2">
                                                <span class="mdi mdi-eye-outline"></span>
                                            </a>
                                        @endcan

                                        @can('edit users')
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="btn btn-warning btn-sm py-0 px-2">
                                                <span class="mdi mdi-file-edit-outline"></span>
                                            </a>
                                        @endcan

                                        @can('delete users')
                                            <button type="button" class="btn btn-danger btn-sm py-0 px-2"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                                <span class="mdi mdi-delete-outline"></span>
                                            </button>

                                            <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1"
                                                aria-labelledby="deleteModal{{ $user->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="deleteModal{{ $user->id }}">
                                                                Supprimer {{ $user->name }}</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('users.destroy', $user->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="button" class="btn btn-dark btn-sm py-0 px-2"
                                                                    data-bs-dismiss="modal">
                                                                    <span class="mdi mdi-close"></span></i></button>
                                                                <button type="submit" class="btn btn-danger btn-sm py-0 px-2">
                                                                    <span class="mdi mdi-delete-outline"></span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                            @endforelse

                        </tbody>
                    </table>

                    @can('create users')
                        <div class="mt-3">
                            <a href="{{ route('users.create') }}" class="btn btn-success">Ajouter</a>
                        </div>
                    @endcan

                </div>

            </div>
        </div>
    </div>
@endsection
