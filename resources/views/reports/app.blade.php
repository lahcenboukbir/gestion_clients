@can('generate reports')

@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">

            <div class="card-header">
                @yield('report-title')
            </div>

            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-justified bg-light" role="tablist">
                    @role('admin')

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#users" role="tab">
                            <span class="d-block d-sm-none"><span class="mdi mdi-account"></span></span>
                            <span class="d-none d-sm-block">Utilisateurs</span>
                        </a>
                    </li>
                    @endrole
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#prospects" role="tab">
                            <span class="d-block d-sm-none"><span class="mdi mdi-account-search"></span></span>
                            <span class="d-none d-sm-block">Prospects</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#customers" role="tab">
                            <span class="d-block d-sm-none"><span class="mdi mdi-account-check"></span></span>
                            <span class="d-none d-sm-block">Clients</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#appointments" role="tab">
                            <span class="d-block d-sm-none"><span class="mdi mdi-calendar-account-outline"></span></span>
                            <span class="d-none d-sm-block">Rendez-vous</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted text-center">
                    @role('admin')
                    <div class="tab-pane my-4" id="users" role="tabpanel">
                        @yield('users-report')
                    </div>
                    @endrole
                    <div class="tab-pane active my-4" id="prospects" role="tabpanel">
                        @yield('prospects-report')
                    </div>
                    <div class="tab-pane my-4" id="customers" role="tabpanel">
                        @yield('customers-report')
                    </div>
                    <div class="tab-pane my-4" id="appointments" role="tabpanel">
                        @yield('appointments-report')
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection

@endcan