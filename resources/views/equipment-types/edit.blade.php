@extends('layouts.app')

@section('title', 'Equipements - Créer')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier le type d'équipement</h5>
                </div>

                <div class="card-body">
                    <div>
                        <form action="{{ route('equipment.types.update', $equipment->id) }}" method="POST" class="row">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="type_name" class="form-label">Type d'équipement <span class="text-danger">*</span></label>
                                <input type="text" name="type_name" id="type_name" class="form-control"
                                    value="{{ $equipment->type_name }}" placeholder="Modifier le type d'équipement">
                            </div>

                            <div>
                                <a href="{{ route('equipment.types.index') }}" class="btn btn-light">Retour</a>
                                <button class="btn btn-success" type="submit">Modifier</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
