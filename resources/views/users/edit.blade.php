@role('admin')
    @extends('layouts.app')

    @section('title', 'Utilisateurs - Modifier')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier les informations du {{ $user->name }}</h5>
                </div>

                <div class="card-body">
                    <div>
                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data"
                            class="row">
                            @csrf
                            @method('PUT')

                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                <input name="name" type="text" id="name" class="form-control"
                                    value="{{ $user->name }}" placeholder="Modifier le nom">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Adresse e-mail <span
                                        class="text-danger">*</span></label>
                                <input name="email" type="email" id="email" class="form-control"
                                    value="{{ $user->email }}" placeholder="Modifier l'email">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Mot de passe <span
                                        class="text-danger">*</span></label>
                                <input name="password" type="password" id="password" class="form-control"
                                    placeholder="Modifier le mot de passe">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone_number" class="form-label">Numéro de téléphone</label>
                                <input name="phone_number" type="text" id="phone_number" class="form-control"
                                    value="{{ $user->phone_number }}" placeholder="Modifier le numéro de téléphone">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="img" class="form-label">Image</label>
                                <input name="img" class="form-control form-control" id="img" type="file">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="address" class="form-label">Adresse</label>
                                <input name="text" type="address" id="address" class="form-control"
                                    value="{{ $user->address }}" placeholder="Modifier l'adresse">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="roles" class="form-label">Rôle <span class="text-danger">*</span></label>
                                <select name="role_id" class="form-select" id="roles">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            @if ($role->id === $user_role->role_id) selected @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea name="bio" class="form-control" id="bio" rows="1" spellcheck="false"
                                    placeholder="Modifier la bio">{{ $user->bio }}</textarea>
                            </div>

                            <div>
                                <a href="{{ route('users.index') }}" class="btn btn-light">Retour</a>
                                <button class="btn btn-success" type="submit">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@endrole
