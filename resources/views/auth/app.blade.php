<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Log In | Tapeli - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="bg-white">
    <!-- Begin page -->
    <div class="account-page">
        <div class="container-fluid p-0">
            <div class="row align-items-center g-0">
                <div class="col-xl-5">
                    @yield('content')
                </div>

                <div class="col-xl-7">
                    <div class="account-page-bg p-md-5 p-4">
                        <div class="text-center">
                            <h3 class="text-dark mb-3 pera-title">Quick, Effective, and Productive With Tapeli Admin
                                Dashboard</h3>
                            <div class="auth-image">
                                <img src="{{ asset('images/authentication.svg') }}" class="mx-auto img-fluid"
                                    alt="images">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END wrapper -->

    <!-- Vendor -->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('libs/feather-icons/feather.min.js') }}"></script>

    <!-- Apexcharts JS -->
    <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- for basic area chart -->
    <script src="{{ asset('apexcharts.com/samples/assets/stock-prices.js') }}"></script>

    <!-- Widgets Init Js -->
    <script src="{{ asset('js/pages/analytics-dashboard.init.js') }}"></script>

    <!-- App js-->
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
