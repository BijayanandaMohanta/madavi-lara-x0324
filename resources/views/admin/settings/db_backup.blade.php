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
                                <li class="breadcrumb-item active">Database Backup</li>
                            </ol>
                        </div>
                        @section('page_title')
                            Database Backup
                        @endsection
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            @include('flash_msg')
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="page-title">Database Backup</h4>
                                </div>
                                   
                            </div>
                            <hr>
                            <div class="">
                                <div class="card-body">
                                    <div class="d-grid gap-3">
                                       <div class="text-center">
                                        <a class="btn btn-dark" href="{{ route('export-database') }}">
                                            <i class="fas fa-download me-2"></i> Download Database Backup
                                        </a>
                                       </div>
                                        <div class="alert alert-info mt-3">
                                            <p class="mb-0">
                                                Exporting the database allows you to create a backup of your data, which can be crucial in case of server data loss or emergencies.
                                            </p>
                                        </div>
                                        <div class="alert alert-warning">
                                            <h6 class="alert-heading mb-3">
                                                <i class="fas fa-exclamation-circle me-2"></i> Important Note for Admin:
                                            </h6>
                                            <ul class="mb-0">
                                                <li>It’s recommended to perform this action during nighttime or low-traffic hours to avoid putting additional load on the server.</li>
                                                <li>After exporting the data, please save it securely on your computer or in a drive, organized in date-wise folders. This ensures easy access and helps with disaster recovery when needed.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
        </div> <!-- end container-fluid -->
    </div> <!-- end content -->
@endsection

@section('csscodes')

    <link href="{{ asset('admin_assets') . '/libs/datatables/dataTables.bootstrap4.min.css' }}" rel="stylesheet">
    <link href="{{ asset('admin_assets') . '/libs/datatables/responsive.bootstrap4.min.css' }}" rel="stylesheet">

@endsection

@section('jscodes')

    <script src="{{ asset('admin_assets') . '/libs/datatables/dataTables.bootstrap4.min.js' }}"></script>
    <script src="{{ asset('admin_assets') . '/libs/datatables/responsive.bootstrap4.min.js' }}"></script>

@endsection
