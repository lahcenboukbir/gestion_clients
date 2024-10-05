@extends('pdf.app')

@section('title')
    <h1>Rapport des clients</h1>
@endsection

@section('content')
    <table>
        <caption>1. Informations de tous les clients</caption>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Entreprise</th>
                <th>E-mail</th>
                <th>Numéro de téléphone</th>
                <th>Statut</th>
                <th>Ville</th>
                <th>Activité</th>
                <th>Commentaire</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->company ?? 'N/A' }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone_number ?? 'N/A' }}</td>
                    <td>{{ $customer->status ?? 'N/A' }}</td>
                    <td>{{ $customer->city ?? 'N/A' }}</td>
                    <td>{{ $customer->activity ?? 'N/A' }}</td>
                    <td>{{ $customer->comment ?? 'N/A' }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <table>
        <caption>2. Historique de tous les rendez-vous</caption>
        <thead>
            <tr>
                <th>Name</th>
                <th>Appointment Date</th>
                <th>Notes</th>
                <th>Outcome</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->name }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->notes ?? 'N/A' }}</td>
                    <td>{{ $appointment->outcome ?? 'N/A' }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <table>
        <caption>3. Informations de tous les commerciaux</caption>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Entreprise</th>
                <th>Commercial</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->company }}</td>
                    <td>{{ $user->salesperson }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
