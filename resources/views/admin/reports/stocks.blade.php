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
                                <li class="breadcrumb-item active">Stocks Report</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Stocks Report
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
                            @if(Session::has('message'))
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
                                <h4 class="page-title">Stocks Report</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('export_stock_report') }}"
                                    class="btn btn-success btn-sm float-right ml-2">Export Stock Report</a>
                            </div>
                        </div>

                        <a class="btn btn-danger p-1 fs-3" href="?filter=Out Of Stock">
                            Product out of stock: {{$out_of_stock}}
                        </a>
                        <a class="btn btn-warning p-1 fs-3" href="?filter=Low Stock">
                            Product low stock: {{$low_stock}}
                        </a>
                        <a class="btn btn-success p-1 fs-3" href="?filter=In Stock">
                            Product in stock: {{$in_stock}}
                        </a>
                        <br>
                        <br>
                        <form action="" method="get">
                            <div class="col-4 p-0 m-0 d-flex">
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Search by name" value="{{ request('name') }}"><button type="submit"
                                    class="btn btn-success ml-1">Search</button>
                            </div>
                        </form>
                        <hr>
                        <hr>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Product Name</th>
                                        <th>Stock Available</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $data)
                                        <tr>
                                            <td>{{ ($products->currentPage() - 1) * $products->perPage() + $key + 1 }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->stock }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination">
                                {{ $products->appends(request()->query())->links() }}
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

<script language="javascript">
    $('#example').DataTable({
        responsive: true
    });
</script>
@endsection
