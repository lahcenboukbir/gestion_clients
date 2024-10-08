@auth
    <div class="app-sidebar-menu">
        <div class="h-100" data-simplebar>

            <!--- Sidemenu -->
            <div id="sidebar-menu">

                <div class="logo-box">
                    <a class='logo logo-light' href=''>
                        <span class="logo-sm">
                            <img src="{{ asset('images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('images/logo-light.png') }}" alt="" height="24">
                        </span>
                    </a>
                    <a class='logo logo-dark' href=''>
                        <span class="logo-sm">
                            <img src="{{ asset('images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('images/logo-dark.png') }}" alt="" height="24">
                        </span>
                    </a>
                </div>

                <ul id="side-menu">

                    <li class="menu-title">Menu</li>

                    <li>
                        <a class='tp-link' href='{{ route('dashboard.index') }}'>
                            <span class="mdi mdi-view-dashboard-outline"></span>
                            <span> Tableau de bord </span>
                        </a>
                    </li>

                    <li class="menu-title">Pages</li>

                    <li>
                        <a class='tp-link' href='{{ route('users.index') }}'>
                            <span class="mdi mdi-account-multiple-outline"></span>
                            <span> Utilisateurs </span>
                        </a>
                    </li>

                    <li>
                        <a class='tp-link' href='{{ route('prospects.index') }}'>
                            <span class="mdi mdi-account-multiple-plus-outline"></span>
                            <span> Prospects </span>
                        </a>
                    </li>

                    <li>
                        <a class='tp-link' href='{{ route('customers.index') }}'>
                            <span class="mdi mdi-account-multiple-check-outline"></span>
                            <span> Clients </span>
                        </a>
                    </li>

                    <li>
                        <a class='tp-link' href='{{ route('appointments.index') }}'>
                            <span class="mdi mdi-calendar-account-outline"></span>
                            <span> Rendez-vous </span>
                        </a>
                    </li>

                    @can('generate reports')
                        <li>
                            <a href="#sidebarReport" data-bs-toggle="collapse">
                                <span class="mdi mdi-file-chart-outline"></span>
                                <span> Rapport </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarReport">
                                <ul class="nav-second-level">
                                    <li>
                                        <a class='tp-link' href='{{ route('pdf-report') }}'>PDF</a>
                                    </li>
                                    <li>
                                        <a class='tp-link' href='{{ route('excel-report') }}'>EXCEL</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endcan

                    @role('admin')
                        <li>
                            <a href="s#sidebarRoles" data-bs-toggle="collapse">
                                <span class="mdi mdi-cog-outline"></span>
                                <span> Administration </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarRoles">
                                <ul class="nav-second-level">
                                    <li>
                                        <a class='tp-link' href='{{ route('roles.index') }}'>Gestion des Rôles</a>
                                    </li>
                                    <li>
                                        <a class='tp-link' href='{{ route('assign.roles.index') }}'>Affecter des Rôles</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endrole

                </ul>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
    </div>

@endauth
