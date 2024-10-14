    @extends('layouts.app')

    @section('title', 'Consultations - Créer')

    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">Créer une consultation</h5>
                    </div>

                    <div class="card-body">
                        <div>
                            <form action="{{route('consultations.store')}}" method="POST" class="row">
                                @csrf

                                {{-- consultations table --}}

                                <div class="col-md-6 mb-3">
                                    <label for="customer_id" class="form-label">Client <span class="text-danger">*</span></label>
                                    <select class="form-select" id="customer_id" name="customer_id">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->customer_id }}">{{ $customer->customer_name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="consultation_date_time" class="form-label">Date de consultation</label>
                                    <input type="datetime-local" id="consultation_date_time" class="form-control"
                                        name="consultation_date_time">
                                </div>

                                {{-- ports table --}}
                                <div class="col-md-6 mb-3">
                                    <label for="departure_port_id" class="form-label">Port de départ <span class="text-danger">*</span></label>
                                    <select class="form-select" id="departure_port_id" name="departure_port_id">
                                        @foreach ($ports as $port)
                                            <option value="{{ $port->id }}">{{ $port->port_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="arrival_port_id" class="form-label">Port d'arrivée <span class="text-danger">*</span></label>
                                    <select class="form-select" id="arrival_port_id" name="arrival_port_id">
                                        @foreach ($ports as $port)
                                            <option value="{{ $port->id }}">{{ $port->port_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="departure_date_time" class="form-label">Date de départ</label>
                                    <input type="datetime-local" id="departure_date_time" class="form-control"
                                        name="departure_date_time">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="arrival_date_time" class="form-label">Date d'arrivée</label>
                                    <input type="datetime-local" id="arrival_date_time" class="form-control"
                                        name="arrival_date_time">
                                </div>

                                {{-- equipements table --}}
                                <div class="col-md-6 mb-3">
                                    <label for="equipment_name_id" class="form-label">Nom de l'équipement <span class="text-danger">*</span></label>
                                    <select class="form-select" id="equipment_name_id" name="equipment_name_id">
                                        @foreach ($equipment_names as $equipment_name)
                                            <option value="{{ $equipment_name->id }}">{{ $equipment_name->equipment_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="equipment_type_id" class="form-label">Type d'équipement <span class="text-danger">*</span></label>
                                    <select class="form-select" id="equipment_type_id" name="equipment_type_id">
                                        @foreach ($equipment_types as $equipment_type)
                                            <option value="{{ $equipment_type->id }}">{{ $equipment_type->type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="quantity" class="form-label">Quantité <span class="text-danger">*</span></label>
                                    <input type="number" id="quantity" class="form-control" name="quantity" placeholder="Entrez la quantité">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="serial_number" class="form-label">Numéro de série</label>
                                    <input type="text" id="serial_number" class="form-control" name="serial_number" placeholder="Entrez le numéro de série">
                                </div>

                                <div>
                                    <a href="{{ route('consultations.index') }}" class="btn btn-light">Retour</a>
                                    <button class="btn btn-success" type="submit">Ajouter</button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
