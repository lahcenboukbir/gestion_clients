@extends('reports.app')

@section('title', 'Rapport - EXCEL')

@section('report-title')
    <h5 class="card-title mb-0">Rapports EXCEL</h5>
@endsection

@section('users-report')
    <a href="{{ route('users-excel') }}" class="btn btn-success">Télécharger</a>
@endsection

@section('prospects-report')
    <a href="{{ route('prospects-excel') }}" class="btn btn-success">Télécharger</a>
@endsection

@section('customers-report')
    <a href="{{ route('customers-excel') }}" class="btn btn-success">Télécharger</a>
@endsection

@section('appointments-report')
    <a href="{{ route('appointments-excel') }}" class="btn btn-success">Télécharger</a>
@endsection

