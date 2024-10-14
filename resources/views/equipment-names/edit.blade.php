@extends('layouts.app')

@section('title', 'Equipements - Créer')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier le nom de l'équipement</h5>
                </div>

                <div class="card-body">
                    <div>
                        <form action="{{ route('equipment.names.update', $equipment->id) }}" method="POST" class="row">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="equipment_name" class="form-label">Nom de l'équipement <span class="text-danger">*</span></label>
                                <input type="text" name="equipment_name" id="equipment_name" class="form-control"
                                    value="{{ $equipment->equipment_name }}" placeholder="Modifier le nom d'équipement">
                            </div>

                            <div>
                                <a href="{{ route('equipment.names.index') }}" class="btn btn-light">Retour</a>
                                <button class="btn btn-success" type="submit">Modifier</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
