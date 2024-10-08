@extends('layouts.app')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Tableau de bord</h4>
        </div>
    </div>

    {{-- cards --}}
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="row g-3">

                @role('admin')
                    <div class="col-md-6 col-xl-3">
                        <a href="{{ route('users.index') }}">
                            <div class="card mb-3">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="mdi mdi-account-multiple-outline"></span>
                                        <h5 class="card-title fs-14">Utilisateurs</h5>
                                    </div>

                                    <div>
                                        <p class="card-text fs-2">{{ $users_count }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endrole

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('prospects.index') }}">
                        <div class="card mb-3">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="mdi mdi-account-multiple-plus-outline"></span>
                                    <h5 class="card-title fs-14">Prospects</h5>
                                </div>

                                <div>
                                    <p class="card-text fs-2">{{ $prospects_count }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('customers.index') }}">
                        <div class="card mb-3">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="mdi mdi-account-multiple-check-outline"></span>
                                    <h5 class="card-title fs-14">Clients</h5>
                                </div>

                                <div>
                                    <p class="card-text fs-2">{{ $customers_count }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('appointments.index') }}">
                        <div class="card mb-3">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="mdi mdi-calendar-account-outline"></span>
                                    <h5 class="card-title fs-14">Rendez-vous</h5>
                                </div>

                                <div>
                                    <p class="card-text fs-2">{{ $appointments_count }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>

    {{-- charts --}}
    <div class="row align-items-center">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Statut des prospects</h5>
                </div>

                <div class="card-body">
                    <div id="multiple_radialbar_chart" class="apex-charts"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Analyse des Prospects et Clients</h5>
                </div>

                <div class="card-body">
                    <div id="simple_pie_chart" class="apex-charts"></div>
                </div>

            </div>
        </div>
    </div>

    {{-- tables --}}
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Utilisateurs récemment ajoutés</h5>
                </div>

                <div class="card-body">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Numéro de téléphone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recently_users as $recently_user)
                                <tr>
                                    <th scope="row">{{ $recently_user->id }}</th>
                                    <td>{{ $recently_user->name }}</td>
                                    <td>{{ $recently_user->email ?? 'N/A' }}</td>
                                    <td>{{ $recently_user->phone_number ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Entreprises récemment ajoutées</h5>
                </div>

                <div class="card-body">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Ville</th>
                                <th scope="col">Activité</th>
                                <th scope="col">Numéro de téléphone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recently_companies as $recently_company)
                                <tr>
                                    <th scope="row">{{ $recently_company->id }}</th>
                                    <td>{{ $recently_company->company }}</td>
                                    <td>{{ $recently_company->city ?? 'N/A' }}</td>
                                    <td>{{ $recently_company->activity ?? 'N/A' }}</td>
                                    <td>{{ $recently_company->phone_number ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- multiple_radialbar_chart --}}
    <script>
        var options = {
            series: [{{ $status_new }}, {{ $status_interested }}, {{ $status_not_interested }},
                {{ $status_customer }}
            ],
            chart: {
                height: 390,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    offsetY: 0,
                    startAngle: 0,
                    endAngle: 270,
                    hollow: {
                        margin: 5,
                        size: '30%',
                        background: 'transparent',
                        image: undefined,
                    },
                    dataLabels: {
                        name: {
                            show: false,
                        },
                        value: {
                            show: false,
                        }
                    },
                    barLabels: {
                        enabled: true,
                        useSeriesColors: true,
                        offsetX: -8,
                        fontSize: '16px',
                        formatter: function(seriesName, opts) {
                            return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
                        },
                    },
                }
            },
            colors: ['#4a5a6b', '#29aa85', '#ec8290', '#537AEF'],
            labels: ['Nouveau', 'Intéressé', 'Pas intéressé', 'Client'],
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        show: false
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#multiple_radialbar_chart"), options);
        chart.render();
    </script>

    {{-- simple_pie_chart --}}
    <script>
        var options = {
            series: [{{ $prospects_count }}, {{ $customers_count }}],
            chart: {
                height: 390,
                type: "pie",
                parentHeightOffset: 0,
            },
            labels: ["Prospects", "Clients"],
            legend: {
                position: "bottom",
            },
            colors: ["#537AEF", "#29aa85"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200,
                    },
                    legend: {
                        position: "bottom",
                    },
                },
            }, ],
        };
        var chart = new ApexCharts(
            document.querySelector("#simple_pie_chart"),
            options
        );
        chart.render();
    </script>
@endsection
