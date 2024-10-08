@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Liste des rendez-vous</h5>
                </div>

                <div class="card-body">
                    <table id="scroll-horizontal-datatable" class="table w-100 nowrap table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Entreprise</th>
                                <th>Email</th>
                                <th>Numéro de téléphone</th>
                                <th>Prochain rendez-vous</th>
                                <th>Total des rendez-vous</th>
                                <th>Remarques</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                @php
                                    $latestAppointment = $latestAppointments->firstWhere('id', $appointment->id);
                                @endphp

                                <tr class="align-baseline">

                                    <td>{{ $appointment->id }}</td>
                                    <td>{{ $appointment->name }}</td>
                                    <td>{{ $appointment->company ?? 'N/A' }}</td>
                                    <td>{{ $appointment->email }}</td>
                                    <td>{{ $appointment->phone_number ?? 'N/A' }}</td>
                                    <td>{{ $latestAppointment ? \Carbon\Carbon::parse($latestAppointment->appointment_date)->format('Y-m-d | H:i') : 'N/A' }}
                                    </td>
                                    <td>
                                        <span class="badge text-bg-dark">{{ $appointment->total_appointments }}</span>
                                    </td>
                                    <td>{{ $appointment->notes ?? 'N/A' }}</td>
                                    <td>
                                        {{-- @can('show appointments') --}}
                                            <a href="{{ route('appointments.show', $appointment->id) }}"
                                                class="btn btn-success btn-sm py-0 px-2">
                                                <span class="mdi mdi-eye-outline"></span>
                                            </a>
                                        {{-- @endcan --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @can('create appointments')
                        <div class="mt-3">
                            <a href="{{ route('appointments.create') }}" class="btn btn-success">Ajouter</a>
                        </div>
                    @endcan

                </div>

            </div>
        </div>
    </div>
@endsection
