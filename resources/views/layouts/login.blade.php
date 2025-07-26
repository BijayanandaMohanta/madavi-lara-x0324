<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $site_settings = \App\Models\Setting::find(1);
    @endphp
    <meta charset="utf-8"/>
    <title>Login @if($site_settings != '')
            {{ $site_settings->site_name }}
        @endif</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon"
          href="@if($site_settings != '') {{ asset('site_settings') . '/'. $site_settings->favicon }} @endif">

    <!-- Bootstrap select pluings -->
    <link href="{{ asset('admin_assets') . '/libs/bootstrap-select/bootstrap-select.min.css' }}" rel="stylesheet"
          type="text/css"/>

    <!-- App css -->
    <link href="{{ asset('admin_assets') . '/css/bootstrap.min.css' }}" rel="stylesheet" type="text/css"
          id="bootstrap-stylesheet"/>
    <link href="{{ asset('admin_assets') . '/css/icons.min.css' }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_assets') . '/css/app.min.css' }}" rel="stylesheet" type="text/css" id="app-stylesheet"/>

</head>

<body class="authentication-bg bg-primary">

<div class="account-pages my-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">

                @yield('content')

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->


<!-- Vendor js -->
<script src="{{ asset('admin_assets') . '/js/vendor.min.js' }}"></script>

<!-- Bootstrap select plugin -->
<script src="{{ asset('admin_assets') . '/libs/bootstrap-select/bootstrap-select.min.js' }}"></script>

<!-- App js -->
<script src="{{ asset('admin_assets') . '/js/app.min.js' }}"></script>


@yield('jscode')

</body>
</html>
