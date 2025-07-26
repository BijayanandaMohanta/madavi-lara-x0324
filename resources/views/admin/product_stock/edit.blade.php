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
                                <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                                <li class="breadcrumb-item active">Edit Product Image</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Product Image
                    @endsection
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @include('flash_msg')
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="page-title">
                                    <h4>Avaliable Stock Of <br><br>
                                        <span class="text-primary"
                                            style="line-height: 1.4;">{{ $product_data->name }}</span>:
                                    </h4>
                                    <h4
                                        style="
                                        font-size: 9rem;
                                        color: #ccc;
                                        ">
                                        {{ $product_data->stock }}</h4>
                            </div>

                            {{-- <hr> --}}

                            {{-- @method('PUT') --}}


                            <div class="col-md-8">
                                <form id="form" method="post" action="{{ route('product_stock.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-1">
                                        <input type="hidden" name="product_id" value="{{ $product_data->id }}">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="stock">Stock * :</label>
                                                <input type="number"
                                                    class="form-control @error('stock') is-invalid @enderror"
                                                    name="stock" id="stock" value="{{ old('stock') }}"
                                                    autocomplete="off" oninput="validateStockInput(this)">
                                                @error('stock')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <script>
                                                    function validateStockInput(input) {
                                                        // Remove any non-numeric characters (e.g., letters, symbols)
                                                        input.value = input.value.replace(/[^0-9]/g, '');

                                                        // Convert the value to a number
                                                        let value = parseInt(input.value);

                                                        // If the value is 0, negative, or NaN (not a number), clear the input
                                                        if (isNaN(value) || value <= 0) {
                                                            input.value = '';
                                                        }
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="type">Type * :</label>
                                                <select class="form-control @error('type') is-invalid @enderror"
                                                    name="type" id="type">
                                                    <option value="Debit" selected>Debit</option>
                                                    <option value="Credit">Credit</option>
                                                </select>
                                                @error('type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <input type="submit" name="submit" id="save" class="btn btn-success"
                                                value="Add/Remove Stock">
                                        </div>
                                    </div>
                                </form>

                                <h5>Stock Transactions</h5>

                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $data)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y h:i A') }}
                                                </td>
                                                <td>
                                                    @if ($data->type == 'Credit')
                                                        <span class="badge badge-success">{{ 'Credit' }}</span>
                                                    @endif
                                                    @if ($data->type == 'Debit')
                                                        <span class="badge badge-danger">{{ 'Debit' }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $data->remark }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- end container-fluid -->
</div> <!-- end content -->
@endsection
@section('csscodes')
<link rel="stylesheet" href="{{ asset('admin_assets') . '/libs/dropify/dropify.min.css' }}">
@endsection
@section('jscodes')
<!-- Plugins js -->
<script src="{{ asset('admin_assets') . '/libs/dropify/dropify.min.js' }}"></script>

<!-- Init js-->
<script src="{{ asset('admin_assets') . '/js/pages/form-fileuploads.init.js' }}"></script>

<link href="{{ asset('admin_assets') . '/libs/datatables/dataTables.bootstrap4.min.css' }}" rel="stylesheet">
<link href="{{ asset('admin_assets') . '/libs/datatables/responsive.bootstrap4.min.css' }}" rel="stylesheet">

<!-- Sweet Alert-->
<link href="{{ asset('admin_assets') . '/libs/sweetalert2/sweetalert2.min.css' }}" rel="stylesheet" type="text/css" />

<!-- Tables -->
<script src="{{ asset('admin_assets') . '/libs/datatables/jquery.dataTables.min.js' }}"></script>
<script src="{{ asset('admin_assets') . '/libs/datatables/dataTables.bootstrap4.min.js' }}"></script>

<script src="{{ asset('admin_assets') . '/libs/datatables/dataTables.responsive.min.js' }}"></script>
<script src="{{ asset('admin_assets') . '/libs/datatables/responsive.bootstrap4.min.js' }}"></script>

<!-- Init js-->
<script src="{{ asset('admin_assets') . '/js/pages/datatables.init.js' }}"></script>
<script src="{{ asset('admin_assets') . '/js/pages/sweet-alerts.init.js' }}"></script>
@endsection
