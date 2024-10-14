@extends('layouts.app')

@section('title', 'Ports - Créer')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Ajouter un port</h5>
                </div>

                <div class="card-body">
                    <div>
                        <form action="{{ route('ports.store') }}" method="POST" class="row">
                            @csrf

                            <div class="mb-3">
                                <label for="port_name" class="form-label">Nom du port <span class="text-danger">*</span></label>
                                <input type="text" name="port_name" id="port_name" class="form-control"
                                    placeholder="Entrez le nom du port">
                            </div>

                            <div>
                                <a href="{{ route('ports.index') }}" class="btn btn-light">Retour</a>
                                <button class="btn btn-success" type="submit">Ajouter</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
