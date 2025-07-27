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
                                <li class="breadcrumb-item active">Orders</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Orders
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
                                    <h4 class="page-title">Orders</h4>
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
                                        <div class="form-group">
                                            <label class="control-label">Payment Option</label>
                                            <select class="form-control @error('payment_option') is-invalid @enderror"
                                                name="payment_option" id="payment_option" onchange="this.form.submit()">
                                                <option value="">Payment Option</option>
                                                <option value="UPI"
                                                    {{ request('payment_option') == 'UPI' ? 'selected' : '' }}>UPI
                                                </option>
                                                <option value="Card"
                                                    {{ request('payment_option') == 'Card' ? 'selected' : '' }}>Card
                                                </option>
                                                <option value="Cash"
                                                    {{ request('payment_option') == 'Cash' ? 'selected' : '' }}>Cash
                                                </option>
                                                <option value="Pay Online"
                                                    {{ request('payment_option') == 'Pay Online' ? 'selected' : '' }}>
                                                    Pay Online</option>
                                                <option value="Pay Partial COD"
                                                    {{ request('payment_option') == 'Pay Partial COD' ? 'selected' : '' }}>
                                                    Pay Partial COD</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <label class="control-label">Order From</label>
                                            <select class="form-control @error('order_from') is-invalid @enderror"
                                                name="order_from" id="order_from" onchange="this.form.submit()">
                                                <option value="">Order From</option>
                                                <option value="Tele Order"
                                                    {{ request('order_from') == 'Tele Order' ? 'selected' : '' }}>
                                                    Offline</option>
                                                <option value="Online"
                                                    {{ request('order_from') == 'Online' ? 'selected' : '' }}>Online
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <label class="control-label">Customer Name/Phone/Email</label>
                                            <input type="text" class="form-control" placeholder="Customer Name/Phone/Email" name="customer_search" value="{{ request('customer_search') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <label class="control-label">Order ID</label>
                                            <input type="text" class="form-control" placeholder="Order ID" name="order_id" value="{{ request('order_id') }}">
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
                                            <th>Order Date</th>
                                            <th>Order Value</th>
                                        
                                            <th>Payment Option</th>
                                             <th>Partial Paid</th>
                                              <th>Shipping Charges</th>
                                            <th>COD</th>
                                           
                                            <th>Order Status</th>
                                            
                                            <th>Update Status</th>
                                            <th>Create shipment</th>
                                            <th>Payment Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $data)
                                            <tr>
                                                <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $key + 1 }}
                                                </td>

                                                <td>{{ $data->order_id }} <br>
                                                    @if ($data->order_from)
                                                        <span class="badge badge-success">
                                                            Offline Order
                                                        </span>
                                                    @else
                                                        <span class="badge badge-warning">
                                                            Online Order
                                                        </span>
                                                    @endif

                                                </td>
                                              
                                                <td>{{ $data->customer_name }}<br>{{ $data->customer_phone }}</td>
                                          
                                            
                                                <td>
                                                    {{ $data->date }}
                                                </td>
                                                <td>{{ round($data->grand_total-$data->coupon-$data->shipping_charges) }}</td>
                                               
                                                <td>{{ $data->payment_option }}</td>
                                                
                                                <td>{{ round($data->partial_amount) }}</td>
                                                 <td>{{ round($data->shipping_charges) }}</td>
                                                 <td>{{ round($data->need_to_pay) }}</td>
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
                                                    <select 
                                                        class="form-control"
                                                        name="order_status" 
                                                        id="order_status" 
                                                        style="width: 120px;"
                                                        onchange="changeOrderStatus(this.value,{{ $data->sid }})">
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
                                                    @if ($data->order_from != 'Tele Order' && $data->order_status != 'Cancelled'&& $data->order_status != 'Delivered' && $data->order_status != 'Store Pickuped' && $data->order_status != 'Blocked')
                                                        @if ($data->shiprocket_order_id == '')
                                                            <a href="{{ route('shipment', [$data->sid ?? 'N/A']) }}"
                                                                class="btn btn-sm btn-success">Create Shipment</a>
                                                        @endif
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
                                                    <a href="{{ route('orders.edit', [$data->sid ?? 'N/A']) }}"
                                                        class="btn btn-info waves-effect waves-light btn-xs"><i
                                                            class="fas fa-eye"></i></a>

                                                            
                                                            <a target="_blank"
                                                            href="{{ route('invoice', $data->sid ?? 'N/A') }}"
                                                            class="btn btn-dark waves-effect waves-light btn-xs mt-1"><i
                                                            class="fas fa-print"></i></a>
{{--                                                             
                                                            <a href="{{ route('invoice-generate', [$data->sid ?? 'N/A']) }}"
                                                                class="btn btn-danger waves-effect waves-light btn-xs"><i
                                                                    class="fas fa-download"></i></a> --}}

                                                </td>

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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script language="javascript">
        $('#example').DataTable({
            responsive: true
        });
    </script>
    <script language="javascript">
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select Product",
                allowClear: true
            });
        });
    </script>
    <script>
        function changeOrderStatus(order_status, sid) {
            const url = "{{ route('orders_update_ajax') }}";
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "order_status": order_status,
                    "sid": sid
                },
                success: function (data) {
                    if (data.status == 'success') {
                        location.reload();
                    }
                    else{
                        alert(data.message);
                    }
                }
            });
        }
    </script>
    <style>
        .select2-container .select2-selection--single{
            height:2.2rem !important;
            padding-top: .2rem;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow{
            top: .2rem;
        }
    </style>
@endsection
