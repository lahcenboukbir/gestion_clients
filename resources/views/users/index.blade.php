@role('admin')

    @extends('layouts.app')

    @section('title', 'Utilisateurs')

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
                                    <th>Rôle</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="align-baseline">
                                        <td>{{ $user->user_id }}</td>
                                        <td>{{ $user->user_name }}</td>
                                        <td>{{ $user->role_name }}</td>

                                        <td>
                                            @can('show users')
                                                <a href="{{ route('users.show', $user->user_id) }}"
                                                    class="btn btn-success btn-sm py-0 px-2">
                                                    <span class="mdi mdi-eye-outline"></span>
                                                </a>
                                            @endcan

                                            @if (!$loop->first)
                                                @can('edit users')
                                                    <a href="{{ route('users.edit', $user->user_id) }}"
                                                        class="btn btn-warning btn-sm py-0 px-2">
                                                        <span class="mdi mdi-file-edit-outline"></span>
                                                    </a>
                                                @endcan

                                                @can('delete users')
                                                    <button type="button" class="btn btn-danger btn-sm py-0 px-2"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->user_id }}">
                                                        <span class="mdi mdi-delete-outline"></span>
                                                    </button>

                                                    <div class="modal fade" id="deleteModal{{ $user->user_id }}" tabindex="-1"
                                                        aria-labelledby="deleteModal{{ $user->user_id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5"
                                                                        id="deleteModal{{ $user->user_id }}">
                                                                        Supprimer {{ $user->user_name }}</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('users.destroy', $user->user_id) }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <button type="button" class="btn btn-dark btn-sm py-0 px-2"
                                                                            data-bs-dismiss="modal">
                                                                            <span class="mdi mdi-close"></span></i></button>
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
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach

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

@endrole
