@can('create appointments')

    @extends('layouts.app')

    @section('title', 'Rendez-vous - Créer')

    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">Créer un rendez-vous</h5>
                    </div>

                    <div class="card-body">
                        <div>
                            <form action="{{ route('appointments.store') }}" method="POST" class="row">
                                @csrf

                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Prospect <span class="text-danger">*</span></label>
                                    <select name="prospect_id" class="form-select" id="status">
                                        @foreach ($prospects as $prospect)
                                            <option value="{{ $prospect->id }}">{{ $prospect->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Rendez-vous <span class="text-danger">*</span></label>
                                    <input name="appointment_date" type="text" class="form-control" id="datetime-datepicker"
                                        placeholder="Sélectionnez la date du rendez-vous">
                                </div>

                                <div>
                                    <a href="{{ route('appointments.index') }}" class="btn btn-light">Retour</a>
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
