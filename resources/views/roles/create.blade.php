@role('admin')

    @extends('layouts.app')

    @section('title', 'Gestion des rôles - Créer')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Créer un rôle</h5>
                </div>

                <div class="card-body">
                    <div>
                        <form action="{{ route('roles.store') }}" method="POST" class="row">
                            @csrf

                            <div class="col-12 mb-3">
                                <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                <input name="name" type="text" id="name" class="form-control"
                                    placeholder="Entrez le nom" required>
                            </div>

                            <div class="col-12 mb-3">
                                <h6 class="fs-15">Permissions <span class="text-danger">*</span></h6>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td></td>
                                            <td>Create</td>
                                            <td>Show</td>
                                            <td>Edit</td>
                                            <td>Delete</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Users</td>
                                            @foreach ($users_permissions as $permission)
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input name="permissions[]" class="form-check-input" type="checkbox"
                                                            role="switch" value="{{ $permission->name }}">
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>

                                        <tr>
                                            <td>Prospects</td>
                                            @foreach ($prospects_permissions as $permission)
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input name="permissions[]" class="form-check-input" type="checkbox"
                                                            role="switch" value="{{ $permission->name }}">
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>

                                        <tr>
                                            <td>Customers</td>
                                            @foreach ($customers_permissions as $permission)
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input name="permissions[]" class="form-check-input" type="checkbox"
                                                            role="switch" value="{{ $permission->name }}">
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>

                                        <tr>
                                            <td>Appointments</td>
                                            @foreach ($appointments_permissions as $permission)
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input name="permissions[]" class="form-check-input" type="checkbox"
                                                            role="switch" value="{{ $permission->name }}">
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered">
                                    <tr>
                                        <td>Générer les rapports</td>
                                        @foreach ($generate_reports as $permission)
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input name="permissions[]" class="form-check-input" type="checkbox"
                                                        role="switch" value="{{ $permission->name }}">
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                </table>
                            </div>

                            <div>
                                <a href="{{ route('roles.index') }}" class="btn btn-light">Retour</a>
                                <button class="btn btn-success" type="submit">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@endrole
