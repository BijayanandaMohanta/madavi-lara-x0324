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
                                <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">View Order</a></li>
                                <li class="breadcrumb-item active">View Order</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
            @section('page_title')
                View Order
            @endsection
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @include('flash_msg')
                        <div class="row">
                            <div class="col-md-6">
                                <span class="badge badge-light">Order Status :</span>
                                @if (
                                    $order->order_status == 'Delivered' ||
                                        $order->order_status == 'Shipped' ||
                                        $order->order_status == 'Assigned To Delivery Boy')
                                    <span class="badge badge-success">{{ $order->order_status }}</span>
                                @elseif ($order->order_status == 'Delivered' || $order->order_status == 'Accepted' || $order->order_status == 'Placed')
                                    <span class="badge badge-primary">{{ $order->order_status }}</span>
                                @elseif ($order->order_status == 'Cancelled')
                                    <span class="badge badge-danger">{{ $order->order_status }}</span>
                                @else
                                    <span class="badge badge-primary">{{ $order->order_status }}</span>
                                @endif
                                <h5 class="page-title">Order Id: <span
                                        class='text-primary'>#{{ $order->order_id }}</span></h5>
                                <h5 class="page-title">Order Date: <span
                                        class='text-primary'>{{ \Carbon\Carbon::parse($order->updated_at)->format('d M Y h:i A') }}</span>
                                </h5>
                                <h5 class="page-title">Payment Option: <span
                                        class='text-primary'>{{ $order->payment_option ?? '' }}</span></h5>
                                @if (!empty($order->txn_id))
                                    <h5 class="page-title">Transaction Id: <span
                                            class='text-primary'>{{ $order->txn_id }}</span></h5>
                                @endif

                                @if (!empty($order->razorpay_order_id))
                                    <h5 class="page-title">Razorpay Order Id: <span
                                            class='text-primary'>{{ $order->razorpay_order_id }}</span></h5>
                                @endif

                                @if (!empty($order->shiprocket_order_id))
                                    <h5 class="page-title">Ship rocket order Id: <span
                                            class='text-primary'>{{ $order->shiprocket_order_id }}</span></h5>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="float-right">
                                    @if (
                                        $order->order_status != 'Cancelled' &&
                                            $order->order_status != 'Undelivered' &&
                                            $order->order_status != 'Return And Refund')

                                        <form action="{{ route('orders.update', ['order' => $carts[0]->sid]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')

                                            Status:
                                            <select class="form-control @error('order_status') is-invalid @enderror"
                                                name="order_status" id="order_status">
                                                <option value="">Choose Status</option>
                                                <option value="Placed"
                                                    {{ ($order->order_status ?? 'Placed') == 'Placed' ? 'selected' : '' }}>
                                                    Placed
                                                </option>
                                                <option value="Accepted"
                                                    {{ ($order->order_status ?? '') == 'Accepted' ? 'selected' : '' }}>
                                                    Accepted
                                                </option>
                                                <option value="Shipped"
                                                    {{ ($order->order_status ?? '') == 'Shipped' ? 'selected' : '' }}>
                                                    Shipped
                                                </option>

                                                <option value="Cancelled"
                                                    {{ ($order->order_status ?? '') == 'Cancelled' ? 'selected' : '' }}>
                                                    Cancelled
                                                </option>

                                                <option value="Delivered"
                                                    {{ ($order->order_status ?? '') == 'Delivered' ? 'selected' : '' }}>
                                                    Delivered
                                                </option>
                                                <option value="Return And Refund"
                                                    {{ ($order->order_status ?? '') == 'Return And Refund' ? 'selected' : '' }}>
                                                    Return And Refund
                                                </option>
                                                <option value="Undelivered"
                                                    {{ ($order->order_status ?? '') == 'Undelivered' ? 'selected' : '' }}>
                                                    Undelivered
                                                </option>
                                                <option value="Store Pickuped"
                                                    {{ ($order->order_status ?? '') == 'Store Pickuped' ? 'selected' : '' }}>
                                                    Store Pickuped
                                                </option>
                                                <option value="Blocked"
                                                    {{ ($order->order_status ?? '') == 'Blocked' ? 'selected' : '' }}>
                                                    Blocked
                                                </option>
                                            </select>
                                            @error('order_status')
                                                <div class="invalid-feedback">{{ $message ?? '' }}</div>
                                            @enderror

                                            <button type="submit" class="btn btn-success mt-2">Update</button>
                                            @if ($order->order_from != 'Tele Order')
                                                @if ($order->shiprocket_order_id == '' && $order->order_status != 'Cancelled'&& $order->order_status != 'Delivered' && $order->order_status != 'Store Pickuped')
                                                    <a href="{{ route('shipment', [$carts[0]->sid ?? 'N/A']) }}"
                                                        class="btn btn-success mt-2">Create Shipment</a>
                                                @endif
                                            @endif
                                        </form>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            @php
                                $setting = \App\Setting::first();
                            @endphp
                            <div class="col-4 dashdelvbox">
                                <h5 style="margin: 0;">Sold By :</h5> <br>
                                <p style="margin: 0;">
                                    {{ $setting->site_name }}<br>
                                    {{ $setting->address }}
                                </p> <br>
                                <p style="margin: 0;">
                                    <strong>PAN No:</strong> AAJFO0613L<br>
                                    <strong>GST Registration No:</strong> 36AAJFO0613L1Z8
                                </p>
                            </div>

                            <div class="col-4">
                                <h5 style="margin: 0;">Billing Address :</h5> <br>
                                <p style="margin: 0;">
                                    Name : {{ $address_data->first_name ?? 'N/A' }}
                                    {{ $address_data->last_name ?? 'N/A' }}<br>
                                    Phone : {{ $address_data->phone ?? 'N/A' }} <br>
                                    Email : {{ $address_data->email ?? 'N/A' }} <br>
                                    Address : {{ $address_data->address ?? 'N/A' }}<br>
                                    {{ $address_data->apartment ?? 'N/A' }},{{ $address_data->city ?? 'N/A' }}<br>
                                    {{ $address_data->state ?? 'N/A' }},{{ $address_data->pincode ?? 'N/A' }}<br>

                                </p>
                                <p style="margin: 0;"><strong>State/UT Code:</strong> {{ $address_data->state }}</p>
                            </div>
                            <div class="col-4">
                                <h5 style="margin: 0;">Shipping Address :</h5> <br>
                                <p style="margin: 0;">
                                    Name : {{ $address_data->first_name ?? 'N/A' }}
                                    {{ $address_data->last_name ?? 'N/A' }}<br>
                                    Phone : {{ $address_data->phone ?? 'N/A' }} <br>
                                    Email : {{ $address_data->email ?? 'N/A' }} <br>
                                    Address : {{ $address_data->address ?? 'N/A' }}<br>
                                    {{ $address_data->apartment ?? 'N/A' }},{{ $address_data->city ?? 'N/A' }}<br>
                                    {{ $address_data->state ?? 'N/A' }},{{ $address_data->pincode ?? 'N/A' }}<br>

                                </p>
                                <p style="margin: 0;"><strong>State/UT Code:</strong> {{ $address_data->state }}</p>
                            </div>
                        </div>

                        <hr>

                        <h5 class="mt-2">Products :</h5> <br>

                        <table id="example" class="table table-bordered dt-responsive"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>

                                    <th>Product Name</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Sub Total</th>
                                    <th>Sl No</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $data)
                                    <tr>
                                        <td>{{ $data->product_name }}</td>
                                        <td>
                                            @if ($data->image != 'no-image')
                                                <img src="{{ asset("uploads/products/$data->image") }}"
                                                    alt="{{ $data->product_name }}" style="height:50px;width:50px;">
                                            @else
                                                <img src="https://placehold.co/80x80?text=No+Image+Found!"
                                                    alt="Default Image">
                                            @endif
                                        </td>
                                        <td>{{ $data->quantity }}</td>
                                        <td>Rs. {{ $data->sub_total }}</td>
                                        <td>
                                            <input type="text" class="form-control" name="sl_no" value="{{$data->sl_no}}"
                                                onblur="update_cart_sl_no(this.value,{{ $data->id }},{{ $data->product_id }})">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- @php
    dd($order_log);
@endphp --}}


                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- end container-fluid -->
</div> <!-- end content -->
<style>
    img {
        border-radius: .2rem;
    }
</style>
@endsection
@section('csscodes')
<link rel="stylesheet" href="{{ asset('admin_assets') . '/libs/dropify/dropify.min.css' }}">
@endsection
@section('jscodes')
<!-- Plugins js -->
<script src="{{ asset('admin_assets') . '/libs/dropify/dropify.min.js' }}"></script>

<!-- Init js-->
<script src="{{ asset('admin_assets') . '/js/pages/form-fileuploads.init.js' }}"></script>
<!-- <script>
    $('#intro_video').on('change', function() {
        if (this.files[0].size > 2000000) {
            alert("Please upload video less than 1MB. Thanks!!");
            $(this).val('');
        }
    });
</script> -->
<script>
    window.update_cart_sl_no = function(value, id, product_id) {
        var data = {
            _token: '{{ csrf_token() }}',
            slno: value,
            cart_id: id,
            product_id: product_id
        };

        $.ajax({
            url: '{{ route('update_order_sl_no') }}',
            method: "POST",
            data: data,
            dataType: "json",
            success: function(response) {
                if (response.status == "success") {
                    console.log("updated");
                }
            }
        });
    };
</script>
@endsection
