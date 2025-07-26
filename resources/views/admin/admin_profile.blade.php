@extends('admin.layouts.main')
@section('content')

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                        @section('page_title')
                            Profile
                        @endsection
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    @include('flash_msg')
                    <div class="card">
                        <div class="card-body table-responsive">
                            <form action="{{ route('update_admin_profile') }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="control-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   placeholder="John" value="{{ Auth::user()->name }}"
                                                   autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email" class="control-label">Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                   value="{{ Auth::user()->email }}" placeholder="example@mail.com"
                                                   readonly autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="text" class="control-label">Old Password</label>
                                            <input type="password" class="form-control" id="old_password"
                                                   name="old_password"
                                                   placeholder="************" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password" class="control-label">New Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                   placeholder="************" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="passwordNew" class="control-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="passwordNew"
                                                   name="cpassword" placeholder="************" autocomplete="off">
                                            <span id="passwordstatus"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" id="submit"
                                                class="btn btn-success waves-effect waves-light float-right">Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('csscodes')
<link href="{{ asset('admin_assets') . '/libs/datatables/dataTables.bootstrap4.min.css' }}" rel="stylesheet">
<link href="{{ asset('admin_assets') . '/libs/datatables/responsive.bootstrap4.min.css' }}" rel="stylesheet">

<!-- Sweet Alert-->
<link href="{{ asset('admin_assets') . '/libs/sweetalert2/sweetalert2.min.css' }}" rel="stylesheet" type="text/css" />
@endsection
@section('jscodes')
  <!-- Tables -->
<script src="{{ asset('admin_assets') . '/libs/datatables/jquery.dataTables.min.js' }}"></script>
<script src="{{ asset('admin_assets') . '/libs/datatables/dataTables.bootstrap4.min.js' }}"></script>

<script src="{{ asset('admin_assets') . '/libs/datatables/dataTables.responsive.min.js' }}"></script>
<script src="{{ asset('admin_assets') . '/libs/datatables/responsive.bootstrap4.min.js' }}"></script>

<!-- Sweet Alerts js -->
<script src="{{ asset('admin_assets') . '/libs/sweetalert2/sweetalert2.min.js' }}"></script>

<!-- Init js-->
<script src="{{ asset('admin_assets') . '/js/pages/datatables.init.js' }}"></script>
<script src="{{ asset('admin_assets') . '/js/pages/sweet-alerts.init.js' }}"></script>

    <script>
        $(document).ready(function () {
            $("#passwordNew").on('keyup', function () {
                let password = $("#password").val();
                let cpassword = $("#passwordNew").val();
                if (password !== cpassword) {
                    $("#passwordstatus").html("Password does not Match !").css("color", "red");
                    $("#submit").addClass('disabled');
                } else {
                    $("#passwordstatus").html("Password Match !").css("color", "green");
                    $("#submit").removeClass('disabled');

                }
            });
        });
    </script>
    </body>
    </html>
@endsection
