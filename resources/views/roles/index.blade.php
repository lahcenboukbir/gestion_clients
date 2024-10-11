@role('admin')
    @extends('layouts.app')

    @section('title', 'Gestion des rôles')

    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Liste des rôles</h5>
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
                                @foreach ($roles as $role)
                                    <tr class="align-baseline">

                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <a href="{{ route('roles.show', $role->id) }}"
                                                class="btn btn-success btn-sm py-0 px-2">
                                                <span class="mdi mdi-eye-outline"></span>
                                            </a>

                                            @if (!$loop->first)
                                                <a href="{{ route('roles.edit', $role->id) }}"
                                                    class="btn btn-warning btn-sm py-0 px-2">
                                                    <span class="mdi mdi-file-edit-outline"></span>
                                                </a>

                                                <button type="button" class="btn btn-danger btn-sm py-0 px-2"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $role->id }}">
                                                    <span class="mdi mdi-delete-outline"></span>
                                                </button>

                                                <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1"
                                                    aria-labelledby="deleteModal{{ $role->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5"
                                                                    id="deleteModal{{ $role->id }}">
                                                                    Supprimer {{ $role->name }}</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('roles.destroy', $role->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')

                                                                    <button type="button" class="btn btn-dark btn-sm py-0 px-2"
                                                                        data-bs-dismiss="modal">
                                                                        <span class="mdi mdi-close"></span></button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm py-0 px-2">
                                                                        <span class="mdi mdi-delete-outline"></span>
                                                                    </button>
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

                        <div class="mt-3">
                            <a href="{{ route('roles.create') }}" class="btn btn-success">Ajouter</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    @endsection

@endrole
