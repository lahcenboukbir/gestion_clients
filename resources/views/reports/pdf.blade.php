@extends('reports.app')

@section('title')
    <h5 class="card-title mb-0">Rapports PDF</h5>
@endsection

@section('users-report')
    <a href="{{ route('users-pdf') }}" class="btn btn-danger">Télécharger</a>
@endsection

@section('prospects-report')
    <a href="{{ route('prospects-pdf') }}" class="btn btn-danger">Télécharger</a>
@endsection

@section('customers-report')
    <a href="{{ route('customers-pdf') }}" class="btn btn-danger">Télécharger</a>
@endsection

@section('appointments-report')
    <a href="{{ route('appointments-pdf') }}" class="btn btn-danger">Télécharger</a>
@endsection
