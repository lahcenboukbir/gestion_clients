@extends('layouts.app')

@section('title', 'Consultations - Créer')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier la consultation</h5>
                </div>

                <div class="card-body">
                    <div>
                        <form action="{{route('consultations.edit', $selected_consultation->id)}}" method="POST" class="row">
                            @csrf
                            @method('PUT')

                            {{-- consultations table --}}

                            <div class="col-md-6 mb-3">
                                <label for="customer_id" class="form-label">Client <span class="text-danger">*</span></label>
                                <select class="form-select" id="customer_id" name="customer_id">
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->customer_id }}"
                                            {{ $customer->customer_id == $selected_customer->customer_id ? 'selected' : '' }}>
                                            {{ $customer->customer_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="consultation_date_time" class="form-label">Date de consultation</label>
                                <input type="datetime-local" id="consultation_date_time" class="form-control"
                                    name="consultation_date_time"
                                    value="{{ $selected_consultation->consultation_date_time }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Statut <span class="text-danger">*</span></label>
                                <select class="form-select" id="status" name="status">
                                    <option value="scheduled"
                                        {{ $selected_consultation->status === 'scheduled' ? 'selected' : '' }}>Programmé
                                    </option>
                                    <option value="completed"
                                        {{ $selected_consultation->status === 'completed' ? 'selected' : '' }}>Terminé
                                    </option>
                                    <option value="canceled"
                                        {{ $selected_consultation->status === 'canceled' ? 'selected' : '' }}>Annulé
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="notes" class="form-label">Remarques</label>
                                <textarea class="form-control" id="notes" rows="1" spellcheck="false" name="notes" placeholder="Modifier les remarques">{{ $selected_consultation->notes }}</textarea>
                            </div>

                            {{-- ports table --}}
                            <div class="col-md-6 mb-3">
                                <label for="departure_port_id" class="form-label">Port de départ <span class="text-danger">*</span></label>
                                <select class="form-select" id="departure_port_id" name="departure_port_id">
                                    @foreach ($ports as $port)
                                        <option value="{{ $port->id }}"
                                            {{ $selected_port->departure_port_id === $port->id ? 'selected' : '' }}>
                                            {{ $port->port_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="arrival_port_id" class="form-label">Port d'arrivée <span class="text-danger">*</span></label>
                                <select class="form-select" id="arrival_port_id" name="arrival_port_id">
                                    @foreach ($ports as $port)
                                        <option value="{{ $port->id }}"
                                            {{ $selected_port->arrival_port_id === $port->id ? 'selected' : '' }}>
                                            {{ $port->port_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="departure_date_time" class="form-label">Date de départ</label>
                                <input type="datetime-local" id="departure_date_time" class="form-control"
                                    name="departure_date_time" value="{{ $selected_port->departure_date_time }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="arrival_date_time" class="form-label">Date d'arrivée</label>
                                <input type="datetime-local" id="arrival_date_time" class="form-control"
                                    name="arrival_date_time" value="{{ $selected_port->arrival_date_time }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="duration" class="form-label">Durée</label>
                                <input type="text" id="duration" class="form-control" name="duration"
                                    value="{{ $selected_port->duration  }}" placeholder="Modifier la durée">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="comment" class="form-label">Commentaire</label>
                                <textarea class="form-control" id="comment" rows="1" spellcheck="false" name="comment" placeholder="Modifier le commentaire">{{ $selected_port->comment }}</textarea>
                            </div>

                            {{-- equipements table --}}
                            <div class="col-md-6 mb-3">
                                <label for="equipment_name_id" class="form-label">Nom de l'équipement <span class="text-danger">*</span></label>
                                <select class="form-select" id="equipment_name_id" name="equipment_name_id">
                                    @foreach ($equipment_names as $equipment_name)
                                        <option value="{{ $equipment_name->id }}"
                                            {{ $selected_equipment->equipment_name_id === $equipment_name->id ? 'selected' : '' }}>
                                            {{ $equipment_name->equipment_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="equipment_type_id" class="form-label">Type d'équipement <span class="text-danger">*</span></label>
                                <select class="form-select" id="equipment_type_id" name="equipment_type_id">
                                    @foreach ($equipment_types as $equipment_type)
                                        <option value="{{ $equipment_type->id }}"
                                            {{ $selected_equipment->equipment_type_id === $equipment_type->id ? 'selected' : '' }}>
                                            {{ $equipment_type->type_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="quantity" class="form-label">Quantité <span class="text-danger">*</span></label>
                                <input type="number" id="quantity" class="form-control" name="quantity" value="{{$equipment->quantity}}" placeholder="Modifier la quantité">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="serial_number" class="form-label">Numéro de série</label>
                                <input type="text" id="serial_number" class="form-control" name="serial_number" value="{{$equipment->serial_number}}" placeholder="Modifier le numéro de série">
                            </div>

                            <div>
                                <a href="{{ route('consultations.index') }}" class="btn btn-light">Retour</a>
                                <button class="btn btn-success" type="submit">Modifer</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
