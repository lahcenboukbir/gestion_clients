@extends('pdf.app')

@section('title')
<h1>Rapport des rendez-vous</h1>
@endsection

@section('content')
<table>
    <caption>1. Tous les rendez-vous</caption>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Entreprise</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Remarques</th>
            <th>Résultat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($appointments as $appointment)
            <tr>
                <td>{{ $appointment->name }}</td>
                <td>{{ $appointment->company }}</td>
                <td>{{ date('d/m/Y', strtotime($appointment->appointment_date)) }}</td>
                <td>{{ date('H:i', strtotime($appointment->appointment_date)) }}</td>
                <td>{{ $appointment->notes ?? 'N/A' }}</td>
                <td>{{ $appointment->outcome ?? 'N/A' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
