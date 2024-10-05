@extends('layouts.app')

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
                                <label for="name" class="form-label">Nom</label>
                                <input name="name" type="text" id="name" class="form-control"
                                    placeholder="Entrez le nom" required>
                            </div>

                            <div class="col-12 mb-3">
                                <h6 class="fs-15">Permissions</h6>
                                <div class="mt-3">
                                    @foreach ($permissions as $permission)
                                        <div class="form-check mb-2">
                                            <input name="permissions[]" class="form-check-input" type="checkbox"
                                                value="{{ $permission->id }}" id="{{ $permission->name }}">
                                            <label class="form-check-label" for="{{ $permission->name }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
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