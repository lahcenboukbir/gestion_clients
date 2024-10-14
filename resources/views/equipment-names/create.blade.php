@extends('layouts.app')

@section('title', 'Ports - Créer')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Ajouter un nom d'équipement</h5>
                </div>

                <div class="card-body">
                    <div>
                        <form action="{{ route('equipment.names.store') }}" method="POST" class="row">
                            @csrf

                            <div class="mb-3">
                                <label for="equipment_name" class="form-label">Nom de l'équipement <span class="text-danger">*</span></label>
                                <input type="text" name="equipment_name" id="equipment_name" class="form-control"
                                    placeholder="Entrez le nom d'équipement">
                            </div>

                            <div>
                                <a href="{{ route('equipment.names.index') }}" class="btn btn-light">Retour</a>
                                <button class="btn btn-success" type="submit">Ajouter</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
