@can('create prospects')

    @extends('layouts.app')

    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">Créer un prospect</h5>
                    </div>

                    <div class="card-body">
                        <div>
                            <form action="{{ route('prospects.store') }}" method="POST" class="row">
                                @csrf

                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nom</label>
                                    <input name="name" type="text" id="name" class="form-control"
                                        placeholder="Entrez le nom">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="company" class="form-label">Entreprise</label>
                                    <input name="company" type="text" id="company" class="form-control"
                                        placeholder="Entrez le nom de l'entreprise">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input name="email" type="email" id="example-email" name="mail" class="form-control"
                                        placeholder="Entrez l'e-mail">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone_number" class="form-label">Numéro de téléphone</label>
                                    <input name="phone_number" type="text" id="phone_number" class="form-control"
                                        placeholder="Entrez le numéro de téléphone">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">Ville</label>
                                    <input name="city" type="text" id="city" class="form-control"
                                        placeholder="Entrez le nom de l'entreprise">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="acitivity" class="form-label">Activité</label>
                                    <input name="activity" type="text" id="acitivity" class="form-control"
                                        placeholder="Entrez l'activité">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Rendez-vous</label>
                                    <input name="appointment_date" type="text" class="form-control" id="datetime-datepicker"
                                        placeholder="Sélectionnez la date du rendez-vous">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Statut</label>
                                    <select name="status" class="form-select" id="status">
                                        <option disabled selected>Sélectionnez le statut</option>
                                        <option value="new" selected>Nouveau</option>
                                        <option value="interested">Intéressé</option>
                                        <option value="not_interested">Pas intéressé</option>
                                        <option value="customer">Client</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="comment" class="form-label">Commentaire</label>
                                    <textarea name="comment" class="form-control" id="comment" rows="5" spellcheck="false"
                                        placeholder="Ajoutez un commentaire"></textarea>
                                </div>

                                <div>
                                    <a href="{{ route('prospects.index') }}" class="btn btn-light">Retour</a>
                                    <button class="btn btn-success" type="submit">Ajouter</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection

@endcan
