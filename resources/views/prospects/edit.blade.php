@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier les informations du {{$prospect->name}}</h5>
                </div>

                <div class="card-body">
                    <div>
                        <form action="{{ route('prospects.update', $prospect->id) }}" method="POST" class="row">
                            @csrf
                            @method('PUT')

                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input name="name" type="text" id="name" class="form-control"
                                    value="{{ $prospect->name }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="company" class="form-label">Entreprise</label>
                                <input name="company" type="text" id="company" class="form-control"
                                    value="{{ $prospect->company }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input name="email" type="email" id="example-email" name="mail" class="form-control"
                                    value="{{ $prospect->email }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone_number" class="form-label">Numéro de téléphone</label>
                                <input name="phone_number" type="text" id="phone_number" class="form-control"
                                    value="{{ $prospect->phone_number }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">Ville</label>
                                <input name="city" type="text" id="city" class="form-control"
                                    value="{{ $prospect->city }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="acitivity" class="form-label">Activité</label>
                                <input name="activity" type="text" id="acitivity" class="form-control"
                                    value="{{ $prospect->activity }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Statut</label>
                                <select name="status" class="form-select" id="status">
                                    <option value="new" {{ $prospect->status == 'new' ? 'selected' : '' }}>Nouveau
                                    </option>
                                    <option value="interested" {{ $prospect->status == 'interested' ? 'selected' : '' }}>
                                        Intéressé</option>
                                    <option value="not_interested"
                                        {{ $prospect->status == 'not_interested' ? 'selected' : '' }}>Pas intéressé</option>
                                    <option value="customer" {{ $prospect->status == 'customer' ? 'selected' : '' }}>Client
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="user_id" class="form-label">Commerciale</label>
                                <input class="form-control" type="text" value="{{ $prospect->user_id }}" aria-label="readonly input example" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label">Commentaire</label>
                                <textarea name="comment" class="form-control" id="comment" rows="5" spellcheck="false">{{ $prospect->comment }}</textarea>
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
