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
                                <li class="breadcrumb-item active">Placed Orders</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Placed Orders
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
                                    <h4 class="page-title">Placed Orders</h4>
                                </div>
                            </div>
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
                                                            
                                                            <a href="{{ route('invoice-generate', [$data->sid ?? 'N/A']) }}"
                                                                class="btn btn-danger waves-effect waves-light btn-xs"><i
                                                                    class="fas fa-download"></i></a>

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
@endsection
