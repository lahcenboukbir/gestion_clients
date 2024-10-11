@extends('reports.app')

@section('title', 'Rapport - PDF')

@section('report-title')
    <h5 class="card-title mb-0">Rapports PDF</h5>
@endsection

@section('users-report')
    <a href="{{ route('users-pdf') }}" target="_blank" class="btn btn-danger">Télécharger</a>
@endsection

@section('prospects-report')
    <a href="{{ route('prospects-pdf') }}" target="_blank" class="btn btn-danger">Télécharger</a>
@endsection

@section('customers-report')
    <a href="{{ route('customers-pdf') }}" target="_blank" class="btn btn-danger">Télécharger</a>
@endsection

@section('appointments-report')
    <a href="{{ route('appointments-pdf') }}" target="_blank" class="btn btn-danger">Télécharger</a>
@endsection
