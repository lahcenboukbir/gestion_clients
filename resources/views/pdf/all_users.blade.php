@extends('pdf.app')

@section('title')
<h1>Rapport des utilisateurs</h1>
@endsection

@section('content')
    <table>
        <caption>1. Liste des utilisateurs</caption>
        <thead>
            <tr>
                <th>Nom</th>
                <th>E-mail</th>
                <th>Date de création</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
