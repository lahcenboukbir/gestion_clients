@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
    {{-- cards --}}
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="row g-3">

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

    {{-- calendar --}}
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body app-calendar">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- charts --}}
    <div class="row align-items-center">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 py-0 widget-icons-sections">
                            <span class="mdi mdi-list-status"></span>
                        </div>
                        <h5 class="card-title mb-0">Statut des prospects</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div id="multiple_radialbar_chart" class="apex-charts"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 py-0 widget-icons-sections">
                            <span class="mdi mdi-percent-outline"></span>
                        </div>
                        <h5 class="card-title mb-0">Analyse des Prospects et Clients</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div id="simple_pie_chart" class="apex-charts"></div>
                </div>

            </div>
        </div>
    </div>

    {{-- tables --}}
    @role('admin')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="border border-dark rounded-2 me-2 py-0 widget-icons-sections">
                                <span class="mdi mdi-account-group-outline"></span>
                            </div>
                            <h5 class="card-title mb-0">Utilisateurs récemment ajoutés</h5>
                        </div>
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
                        <div class="d-flex align-items-center">
                            <div class="border border-dark rounded-2 me-2 py-0 widget-icons-sections">
                                <span class="mdi mdi-domain"></span>
                            </div>
                            <h5 class="card-title mb-0">Entreprises récemment ajoutées</h5>
                        </div>
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
    @endrole

    {{-- top / low --}}
    <div class="row">
        {{-- top --}}
        <div class="col-md-6 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 py-0 widget-icons-sections">
                            <span class="mdi mdi-arrow-top-right-bold-outline"></span>
                        </div>
                        <h5 class="card-title mb-0">Utilisateurs les plus performants</h5>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="list-group custom-group">
                        @forelse ($top_users as $top_user)
                            <li class="list-group-item align-items-center d-flex justify-content-between">
                                <div class="product-list">
                                    <img class="avatar-md p-1 rounded-circle bg-primary-subtle img-fluid me-3"
                                        src="{{ asset('images/users/user-16.png') }}" alt="product-image">

                                    <div class="product-body align-self-center">
                                        <h6 class="m-0 fw-semibold">{{ $top_user->user_name }}</h6>
                                        <p class="mb-0 mt-1 text-muted">{{ $top_user->role_name }}</p>
                                    </div>
                                </div>

                                <div class="product-price">
                                    <h4 class="m-0 fw-semibold">{{ $top_user->total_customers }} Clients</h4>
                                    <p class="mb-0 mt-1 text-muted text-center">
                                        <span class="mdi mdi-arrow-up-circle-outline text-success"></span>
                                        <span class="mdi mdi-arrow-up-circle-outline text-success"></span>
                                        <span class="mdi mdi-arrow-up-circle-outline text-success"></span>
                                        <span class="mdi mdi-arrow-up-circle-outline text-success"></span>
                                    </p>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item align-items-center d-flex justify-content-center">
                                <p class="mb-0 mt-1 text-muted">Aucun utilisateur à afficher</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- low --}}
        <div class="col-md-6 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 py-0 widget-icons-sections">
                            <span class="mdi mdi-arrow-bottom-right-bold-outline"></span>
                        </div>
                        <h5 class="card-title mb-0">Utilisateurs les moins performants</h5>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="list-group custom-group">

                        @forelse ($low_users as $low_user)
                            <li class="list-group-item align-items-center d-flex justify-content-between">
                                <div class="product-list">
                                    <img class="avatar-md p-1 rounded-circle bg-primary-subtle img-fluid me-3"
                                        src="{{ asset('images/users/user-16.png') }}" alt="product-image">

                                    <div class="product-body align-self-center">
                                        <h6 class="m-0 fw-semibold">{{ $low_user->user_name }}</h6>
                                        <p class="mb-0 mt-1 text-muted">{{ $low_user->role_name }}</p>
                                    </div>
                                </div>

                                <div class="product-price">
                                    <h5 class="m-0 fw-semibold">{{ $low_user->total_customers }} Clients</h5>
                                    <p class="mb-0 mt-1 text-muted text-center">
                                        <span class="mdi mdi-arrow-down-circle-outline text-danger"></span>
                                        <span class="mdi mdi-arrow-down-circle-outline text-danger"></span>
                                        <span class="mdi mdi-arrow-down-circle-outline text-danger"></span>
                                        <span class="mdi mdi-arrow-down-circle-outline text-danger"></span>
                                    </p>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item align-items-center d-flex justify-content-center">
                                <p class="mb-0 mt-1 text-muted">Aucun utilisateur à afficher</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    {{-- calendar --}}
    <script>
        var events = @json($events);

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            function getInitialView() {
                if (window.innerWidth >= 768 && window.innerWidth < 1200) {
                    return 'timeGridWeek';
                } else if (window.innerWidth <= 768) {
                    return 'listMonth';
                } else {
                    return 'dayGridMonth';
                }
            }

            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'local',
                editable: false,
                selectable: true,
                initialView: getInitialView(),
                themeSystem: 'bootstrap',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                initialDate: new Date(),
                weekNumbers: true,
                dayMaxEvents: true,
                handleWindowResize: true,
                events: events.map(event => ({
                    title: `RV avec ${event.name}`,
                    start: event.formatted_date,
                    className: 'event-primary border-primary text-uppercase font-weight-bold'
                })),
            });
            calendar.render();
        });
    </script>

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
