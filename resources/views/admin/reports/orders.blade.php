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
                                <li class="breadcrumb-item active">Orders Report</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Orders Report
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
                                    <h4 class="page-title">Orders Report</h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    <div class='d-flex' style="justify-content: flex-end; gap:2px;">
                                        <form action="{{ route('export.orders') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="orders"
                                                value="{{ json_encode($report_orders) }}">
                                            <button type="submit"
                                                class="btn btn-success waves-effect waves-light">Export Orders</button>
                                        </form>
                                        <a href="{{ route('download-all-invoice', request()->query()) }}" class="btn btn-dark waves-effect waves-light d-none">
                                            <i class="fas fa-download"></i> Download all Invoices
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <form id="form" method="get" action="" enctype="multipart/form-data">
                                <div class="row m-b-12">
                                    <div class="col-md-3">
                                        <div class="">
                                            <label class="control-label">From Date</label>
                                            <input type="date"
                                                class="form-control @error('from_date') is-invalid @enderror"
                                                name="from_date" id="from_date" value="{{ request('from_date', '') }}"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                onchange="$('#to_date').attr({'min': this.value});">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <label class="control-label">To Date</label>
                                            <input type="date"
                                                class="form-control @error('to_date') is-invalid @enderror"
                                                name="to_date" id="to_date" value="{{ request('to_date', '') }}"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <label class="control-label">Order Status</label>
                                            <select class="form-control @error('order_status') is-invalid @enderror"
                                                name="order_status" id="order_status">
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
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Payment Option</label>
                                            <select class="form-control @error('payment_option') is-invalid @enderror"
                                                name="payment_option" id="payment_option">
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
                                                name="order_from" id="order_from">
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
                                            <label class="control-label" style="color: aliceblue;">.</label>
                                            <button type="submit" class="btn btn-outline-primary w-100"><i
                                                    class="fa fa-filter"></i> Apply Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <hr>

                            <div class="btn btn-primary p-1 fs-3">
                                Online Orders : {{ $total_online_order }}(₹{{ $total_online_order_amount }})
                            </div>
                            <div class="btn btn-secondary p-1 fs-3">
                                Offline Orders : {{ $total_offline_order }}(₹{{ $total_offline_order_amount }})
                            </div>
                            <div class="btn btn-warning p-1 fs-3">
                                Discount : {{ round($totalEarningsDiscounts) }})
                            </div>

                            <br><br>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Order Id</th>
                                            <th>Customer Details</th>
                                            <th>Order Date</th>
                                            <th>Total Amount</th>
                                            <th>Discount Amount</th>
                                            <th>Actual Amount</th>
                                            <th>Shipping Charges</th>
                                            <th>Payment Option</th>
                                            <th>Need To Pay</th>
                                            <th>Partial Paid</th>
                                            <th>Order Status</th>
                                            <th>Payment Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $data)
                                            <tr>
                                                <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $key + 1 }}
                                                </td>
                                                <td>{{ $data->order_id }}
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
                                                <td>{{ $data->customer->name }}<br>{{ $data->customer->mobile }}</td>
                                                <td>
                                                    {{ $data->date }}
                                                </td>
                                                <td>{{ round($data->grand_total) }}</td>
                                                <td>{{ round($data->coupon) }}</td>
                                                <td>{{ round($data->grand_total - $data->coupon) }}</td>
                                                <td>{{ round($data->shipping_charges) }}</td>
                                                <td>{{ $data->payment_option }}</td>
                                                <td>{{ round($data->need_to_pay) }}</td>
                                                <td>{{ round($data->partial_amount) }}</td>

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
                                                    @if ($data->payment_status == 'Paid')
                                                        <span class="badge badge-success">{{ 'Paid' }}</span>
                                                    @endif
                                                    @if ($data->payment_status != 'Paid')
                                                        <span
                                                            class="badge badge-danger">{{ $data->payment_status }}</span>
                                                    @endif

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

    <script language="javascript">
        $('#example').DataTable({
            responsive: true
        });
    </script>
@endsection
