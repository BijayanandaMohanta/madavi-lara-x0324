@extends('admin.layouts.main')

@section('content')
    {{-- @php
    die;
@endphp --}}
    <script src="https://d3js.org/d3.v7.min.js"></script>
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
                                <li class="breadcrumb-item active">Best Selling Products Report</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Best Selling Products Report
                    @endsection
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Error!</strong> {{ Session::get('message') }}
                                </div>
                            @endif

                            @include('flash_msg')
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="page-title">Best Selling Products Report</h4>
                                </div>
                                <div class="col-md-6" style="text-align: right;">
                                    <a href="{{ route('export_best_selling_products_report') }}" class="btn btn-primary">Export</a>
                                </div>
                            </div>
                            <hr>
                            <hr>

                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Product Name</th>
                                            <th>Selling Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($bestsellingproducts as $key => $data)
                                        @if (!$data->product || !$data->product->name)
                                            @continue
                                        @endif
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>
                                                {{ $data->product->name }} (ID: {{ $data->product_id }})
                                            </td>
                                            <td>{{ $data->count_per_product ?? 0 }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>


                            </div>

                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
        </div> <!-- end container-fluid -->
    </div> <!-- end content -->
    <!-- Modal -->


@endsection

@section('csscodes')
    <link href="{{ asset('admin_assets') . '/libs/datatables/dataTables.bootstrap4.min.css' }}" rel="stylesheet">
    <link href="{{ asset('admin_assets') . '/libs/datatables/responsive.bootstrap4.min.css' }}" rel="stylesheet">

    <!-- Sweet Alert-->
    <link href="{{ asset('admin_assets') . '/libs/sweetalert2/sweetalert2.min.css' }}" rel="stylesheet"
        type="text/css" />
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
  
    
    @endsection
