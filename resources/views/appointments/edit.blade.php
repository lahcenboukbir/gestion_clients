@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier le rendez-vous</h5>
                </div>

                <div class="card-body">
                    <div>
                        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" class="row">
                            @csrf
                            @method('PUT')

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rendez-vous</label>
                                <input name="appointment_date" type="text" class="form-control" id="datetime-datepicker"
                                    value="{{ $appointment->appointment_date }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="outcome" class="form-label">Résultat</label>
                                <select name="outcome" class="form-select" id="outcome">
                                    <option value="success" @if ($appointment->outcome === 'success') selected @endif>Success
                                    </option>
                                    <option value="fail" @if ($appointment->outcome === 'fail') selected @endif>Fail</option>
                                    <option value="pending" @if ($appointment->outcome === 'pending') selected @endif>Pending
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="notes" class="form-label">Remarques</label>
                                <textarea name="notes" class="form-control" id="notes" rows="5" spellcheck="false"
                                    value="{{ $appointment->notes }}"></textarea>
                            </div>

                            <div>
                                <a href="{{ url()->previous() }}" class="btn btn-light">Retour</a>
                                <button class="btn btn-success" type="submit">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
