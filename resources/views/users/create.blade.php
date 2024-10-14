@role('admin')

    @extends('layouts.app')

    @section('title', 'Utilisateurs - Créer')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Créer un utilisateur</h5>
                </div>

                <div class="card-body">
                    <div>
                        <form method="POST" action="{{ route('users.store') }}" class="row">
                            @csrf

                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                <input name="name" class="form-control" type="text" id="name" required
                                    placeholder="Entrez le nom">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="emailaddress" class="form-label">Adresse e-mail <span
                                        class="text-danger">*</span></label>
                                <input name="email" class="form-control" type="email" id="emailaddress" required
                                    placeholder="Entrez l'e-mail">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Mot de passe <span
                                        class="text-danger">*</span></label>
                                <input name="password" class="form-control" type="password" required id="password"
                                    placeholder="Entrez le mot de passe">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirmez le mot de passe <span
                                        class="text-danger">*</span></label>
                                <input name="password_confirmation" class="form-control" type="password" required
                                    id="password_confirmation" placeholder="Confirmez le mot de passe">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="roles" class="form-label">Rôle <span class="text-danger">*</span></label>
                                <select name="role_id" class="form-select" id="roles">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <a href="{{ route('users.index') }}" class="btn btn-light">Retour</a>
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
