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
                                <li class="breadcrumb-item active">Online Orders</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Online Orders
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
                                    <h4 class="page-title">Online Orders</h4>
                                </div>
                                {{-- <div class="col-md-6">
                              <a href="{{ route('tele_orders.index') }}">  <h4 class="page-title">Add Tele Order +</h4></a>
                            </div> --}}

                            </div>
                            <hr>
                            <form id="form" method="get" action="" enctype="multipart/form-data">
                                <div class="row m-b-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">From Date</label>
                                            <input type="date"
                                                class="form-control @error('from_date') is-invalid @enderror"
                                                name="from_date" id="from_date" value="{{ request('from_date', '') }}"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                onchange="$('#to_date').attr({'min': this.value});">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">To Date</label>
                                            <input type="date"
                                                class="form-control @error('to_date') is-invalid @enderror"
                                                name="to_date" id="to_date" value="{{ request('to_date', '') }}"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Order Status</label>
                                            <select class="form-control @error('order_status') is-invalid @enderror"
                                                name="order_status" id="order_status" onchange="this.form.submit()">
                                                <option value="">Order Status</option>
                                                <option value="Delivered"
                                                    {{ request('order_status') == 'Delivered' ? 'selected' : '' }}>
                                                    Delivered</option>
                                                <option value="Placed"
                                                    {{ request('order_status') == 'Placed' ? 'selected' : '' }}>Placed
                                                </option>
                                                <option value="Accepted"
                                                    {{ request('order_status') == 'Accepted' ? 'selected' : '' }}>
                                                    Accepted</option>
                                                <option value="Shipped"
                                                    {{ request('order_status') == 'Shipped' ? 'selected' : '' }}>
                                                    Shipped</option>
                                                <option value="Cancelled"
                                                    {{ request('order_status') == 'Cancelled' ? 'selected' : '' }}>
                                                    Cancelled</option>
                                                <option value="Processing"
                                                    {{ request('order_status') == 'Processing' ? 'selected' : '' }}>
                                                    Processing</option>
                                                <option value="Return And Refund"
                                                    {{ request('order_status') == 'Return And Refund' ? 'selected' : '' }}>
                                                    Return And Refund</option>
                                                <option value="Undelivered"
                                                    {{ request('order_status') == 'Undelivered' ? 'selected' : '' }}>
                                                    Undelivered</option>
                                                <option value="Store Pickuped"
                                                    {{ request('order_status') == 'Store Pickuped' ? 'selected' : '' }}>
                                                    Store Pickuped</option>
                                                <option value="Blocked"
                                                    {{ request('order_status') == 'Blocked' ? 'selected' : '' }}>
                                                    Blocked</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="">
                                            <label class="control-label">Customer Name/Phone/Email</label>
                                            <input type="text" class="form-control"
                                                placeholder="Customer Mobile" name="customer_search"
                                                value="{{ request('customer_search') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <label class="control-label">Order ID</label>
                                            <input type="text" class="form-control" placeholder="Order ID"
                                                name="order_id" value="{{ request('order_id') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <label class="control-label">Product Name</label>
                                            <select name="product_name" id="product_name" class="form-control select2">
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->name }}"
                                                        {{ request('product_name') == $product->name ? 'selected' : '' }}>
                                                        {{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label" style="color: aliceblue;">.</label>
                                            <button type="submit" class="btn btn-outline-primary w-100"><i
                                                    class="fa fa-filter"></i> Apply Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <hr>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Order Id</th>
                                            <th>Customer Details</th>
                                            <th>Product Name</th>
                                            <th>Order Value</th>
                                            <th>Order Status</th>
                                            <th>Update Status</th>
                                            <th>Payment Status</th>
                                            <th>Update Payment Status</th>
                                            <th>Order At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $data)
                                            <tr>
                                                <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $key + 1 }}
                                                </td>

                                                <td>{{ $data->order_id }} <br>

                                                    <span class="badge badge-warning">
                                                        Online Order
                                                    </span>

                                                </td>

                                                <td>{{ $data->name }}<br>{{ $data->mobile }}</td>
                                                <td> <span
                                                        class="badge badge-warning">{{ $data->category }}</span><br>{{ $data->product }}
                                                </td>

                                                <td>{{ $data->amount }}</td>
                                                <td>
                                                    @if (
                                                        $data->order_status == 'Delivered' ||
                                                            $data->order_status == 'Shipped' ||
                                                            $data->order_status == 'Assigned To Delivery Boy')
                                                        <span
                                                            class="badge badge-success">{{ $data->order_status }}</span>
                                                    @elseif ($data->order_status == 'Delivered' || $data->order_status == 'Accepted' || $data->order_status == 'Placed')
                                                        <span
                                                            class="badge badge-primary">{{ $data->order_status }}</span>
                                                    @elseif ($data->order_status == 'Cancelled')
                                                        <span
                                                            class="badge badge-danger">{{ $data->order_status }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-primary">{{ $data->order_status }}</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($data->order_status != 'Cancelled' && $data->order_status != 'Delivered' && $data->order_status != 'Store Pickuped')
                                                        <select class="form-control" name="order_status"
                                                            id="order_status" style="width: 120px;"
                                                            onchange="changeOrderStatus(this.value,{{ $data->id }})">
                                                            >

                                                            <option value="">Choose Status</option>
                                                            <option value="Placed"
                                                                {{ ($data->order_status ?? '') == 'Placed' ? 'selected' : '' }}>
                                                                Placed
                                                            </option>
                                                            <option value="Accepted"
                                                                {{ ($data->order_status ?? '') == 'Accepted' ? 'selected' : '' }}>
                                                                Accepted
                                                            </option>
                                                            <option value="Shipped"
                                                                {{ ($data->order_status ?? '') == 'Shipped' ? 'selected' : '' }}>
                                                                Shipped
                                                            </option>

                                                            <option value="Cancelled"
                                                                {{ ($data->order_status ?? '') == 'Cancelled' ? 'selected' : '' }}>
                                                                Cancelled
                                                            </option>

                                                            <option value="Delivered"
                                                                {{ ($data->order_status ?? '') == 'Delivered' ? 'selected' : '' }}>
                                                                Delivered
                                                            </option>
                                                            <option value="Return And Refund"
                                                                {{ ($data->order_status ?? '') == 'Return And Refund' ? 'selected' : '' }}>
                                                                Return And Refund
                                                            </option>
                                                            <option value="Undelivered"
                                                                {{ ($data->order_status ?? '') == 'Undelivered' ? 'selected' : '' }}>
                                                                Undelivered
                                                            </option>
                                                            <option value="Processing"
                                                                {{ ($data->order_status ?? '') == 'Processing' ? 'selected' : '' }}>
                                                                Processing
                                                            </option>
                                                            <option value="Store Pickuped"
                                                                {{ ($data->order_status ?? '') == 'Store Pickuped' ? 'selected' : '' }}>
                                                                Store Pickuped
                                                            </option>
                                                            <option value="Blocked"
                                                                {{ ($data->order_status ?? '') == 'Blocked' ? 'selected' : '' }}>
                                                                Blocked
                                                            </option>

                                                        </select>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->payment_status == 'Paid')
                                                        <span class="badge badge-success">{{ 'Paid' }}</span>
                                                    @endif
                                                    @if ($data->payment_status != 'Paid')
                                                        <span
                                                            class="badge badge-danger">{{ $data->payment_status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (($data->order_status != 'Cancelled' && $data->order_status != 'Delivered' && $data->order_status != 'Store Pickuped') ||  $data->payment_status != 'Paid')
                                                        <select class="form-control" name="payment_status"
                                                            id="payment_status" style="width: 120px;"
                                                            onchange="changePaymentStatus(this.value,{{ $data->id }})">
                                                            >

                                                            <option value="">Choose Status</option>
                                                            <option value="Paid"
                                                                {{ ($data->payment_status ?? '') == 'Paid' ? 'selected' : '' }}>
                                                                Paid
                                                            </option>
                                                            <option value="Unpaid"
                                                                {{ ($data->payment_status ?? '') == 'Unpaid' ? 'selected' : '' }}>
                                                                Unpaid
                                                            </option>

                                                        </select>
                                                    @endif
                                                </td>
                                                <td>{{ $data->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination">
                                    {{ $orders->appends(request()->query())->links() }}
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

    <script language="javascript">
        $('#example').DataTable({
            responsive: true
        });
    </script>
    <script>
        function changeOrderStatus(order_status, id) {
            const url = "{{ route('online_orders_update_ajax') }}";
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "order_status": order_status,
                    "id": id
                },
                success: function(data) {
                    if (data.status == 'success') {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                }
            });
        }
        function changePaymentStatus(payment_status, id) {
            const url = "{{ route('online_payment_update_ajax') }}";
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "payment_status": payment_status,
                    "id": id
                },
                success: function(data) {
                    if (data.status == 'success') {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                }
            });
        }
    </script>
@endsection
