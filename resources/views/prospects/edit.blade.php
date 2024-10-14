@can('edit prospects')
    @extends('layouts.app')

    @section('title', 'Prospects - Modifier')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier les informations du {{ $prospect->name }}</h5>
                </div>

                <div class="card-body">
                    <div>
                        <form action="{{ route('prospects.update', $prospect->id) }}" method="POST" class="row">
                            @csrf
                            @method('PUT')

                            <div class="col-md-6 mb-3">
                                <label for="company" class="form-label">Entreprise <span class="text-danger">*</span></label>
                                <input name="company" type="text" id="company" class="form-control"
                                    value="{{ $prospect->company }}" placeholder="Modifier le nom de l'entreprise">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Contact <span class="text-danger">*</span></label>
                                <input name="name" type="text" id="name" class="form-control"
                                    value="{{ $prospect->name }}" placeholder="Modifier le nom">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">E-mail <span class="text-danger">*</span></label>
                                <input name="email" type="email" id="example-email" name="mail" class="form-control"
                                    value="{{ $prospect->email }}" placeholder="Modifier l'email">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone_number" class="form-label">Numéro de téléphone</label>
                                <input name="phone_number" type="text" id="phone_number" class="form-control"
                                    value="{{ $prospect->phone_number }}" placeholder="Modifier le numéro de téléphone">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">Ville</label>
                                <input name="city" type="text" id="city" class="form-control"
                                    value="{{ $prospect->city }}" placeholder="Modifier la ville">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="acitivity" class="form-label">Activité</label>
                                <input name="activity" type="text" id="acitivity" class="form-control"
                                    value="{{ $prospect->activity }}" placeholder="Modifier l'activité">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Statut <span class="text-danger">*</span></label>
                                <select name="status" class="form-select" id="status">
                                    <option value="new" {{ $prospect->status == 'new' ? 'selected' : '' }}>Nouveau
                                    </option>
                                    <option value="interested" {{ $prospect->status == 'interested' ? 'selected' : '' }}>
                                        Intéressé</option>
                                    <option value="not_interested"
                                        {{ $prospect->status == 'not_interested' ? 'selected' : '' }}>Pas intéressé
                                    </option>
                                    <option value="customer" {{ $prospect->status == 'customer' ? 'selected' : '' }}>Client
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label">Commentaire</label>
                                <textarea name="comment" class="form-control" id="comment" rows="5" spellcheck="false"
                                    placeholder="Modifier le commentaire">{{ $prospect->comment }}</textarea>
                            </div>

                            <div>
                                <a href="{{ route('prospects.index') }}" class="btn btn-light">Retour</a>
                                <button class="btn btn-success" type="submit">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@endcan
