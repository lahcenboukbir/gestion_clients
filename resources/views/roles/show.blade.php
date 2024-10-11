@role('admin')

    @extends('layouts.app')

    @section('title', 'Gestion des rôles - Afficher')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ $role->name }}</h5>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Créer</td>
                                <td>Afficher</td>
                                <td>Modifier</td>
                                <td>Supprimer</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Utilisateurs</td>

                                @foreach ($all_users_permissions as $user_permission)
                                    <td>
                                        @if (in_array($user_permission, $users_permissions))
                                            <span class="mdi mdi-check-circle-outline text-success"></span>
                                        @else
                                            <span class="mdi mdi-close-circle-outline text-danger"></span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>

                            <tr>
                                <td>Prospects</td>

                                @foreach ($all_prospects_permissions as $prospect_permission)
                                    <td>
                                        @if (in_array($prospect_permission, $prospects_permissions))
                                            <span class="mdi mdi-check-circle-outline text-success"></span>
                                        @else
                                            <span class="mdi mdi-close-circle-outline text-danger"></span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>

                            <tr>
                                <td>Clients</td>

                                @foreach ($all_customers_permissions as $customer_permission)
                                    <td>
                                        @if (in_array($customer_permission, $customers_permissions))
                                            <span class="mdi mdi-check-circle-outline text-success"></span>
                                        @else
                                            <span class="mdi mdi-close-circle-outline text-danger"></span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>

                            <tr>
                                <td>Rendez-vous</td>

                                @foreach ($all_appointments_permissions as $appointment_permission)
                                    <td>
                                        @if (in_array($appointment_permission, $appointments_permissions))
                                            <span class="mdi mdi-check-circle-outline text-success"></span>
                                        @else
                                            <span class="mdi mdi-close-circle-outline text-danger"></span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>

                        </tbody>
                    </table>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Générer les rapports</td>

                                @foreach ($all_reports_permissions as $report_permission)
                                    <td>
                                        @if (in_array($report_permission, $reports_permissions))
                                            <span class="mdi mdi-check-circle-outline text-success"></span>
                                        @else
                                            <span class="mdi mdi-close-circle-outline text-danger"></span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                    </table>

                    <div class="mt-3">
                        <a href="{{ route('roles.index') }}" class="btn btn-light">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@endrole
