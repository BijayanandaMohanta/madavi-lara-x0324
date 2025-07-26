@extends('frontend.layouts.main')
@section('content')
    <div class="dashboardlayout">
        <div class="container-fluid pt-4 pb-4">
            <div class="row">
                <div class="col-xxl-3 col-xl-3 col-lg-3 d-xxl-block d-xl-block d-lg-block d-none">
                    @include('frontend.dashboardmenu')
                </div>
                <div class="col-xxl-9 col-xl-9 col-lg-9">
                    <div class="row">
                        <div class="col-xxl-12 col-x-12 col-lg-12">
                            <div class="dashwidget">
                                <div class="float-end sort">
                                    <select id="orderStatus">
                                        <option value="">Order Status</option>
                                        <option value="Delivered" {{ request('status') == 'Delivered' ? 'selected' : '' }}>
                                            Delivered
                                        </option>
                                        <option value="Placed" {{ request('status') == 'Placed' ? 'selected' : '' }}>
                                            Placed
                                        </option>
                                        <option value="Accepted" {{ request('status') == 'Accepted' ? 'selected' : '' }}>
                                            Accepted
                                        </option>
                                        <option value="Shipped" {{ request('status') == 'Shipped' ? 'selected' : '' }}>
                                            Shipped
                                        </option>
                                        <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>
                                            Cancelled
                                        </option>
                                        <option value="Processing"
                                            {{ request('status') == 'Processing' ? 'selected' : '' }}>
                                            Processing
                                        </option>
                                    </select>

                                    <script>
                                        document.getElementById('orderStatus').addEventListener('change', function() {
                                            const selectedStatus = this.value;
                                            const url = new URL(window.location.href);

                                            if (selectedStatus) {
                                                url.searchParams.set('status', selectedStatus); // Add or update the query parameter
                                            } else {
                                                url.searchParams.delete('status'); // Remove the parameter if no status is selected
                                            }

                                            window.location.href = url.toString(); // Redirect to the updated URL
                                        });
                                    </script>

                                </div>
                                <h3>My Orders</h3>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-x-12 col-lg-12">
                            <div class="dashwidget px-0">
                                <div class="row">
                                    <div class="col-xxl-12 col-xl-12 col-lg-12 py-2">
                                        @forelse($orders as $order)
                                            <div class="row ordersbox">
                                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 orderid">
                                                    <h3>#{{ $order->order_id }}</h3>
                                                    <p>{{ $order->date }}</p>
                                                    <small class="codtxt">{{ $order->payment_option }}</small>
                                                </div>
                                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2 col-sm-6 col-6 orderprice">
                                                    <h3>Rs. {{ $order->sub_total }}</h3>
                                                    <p>{{ $order->total_items }} items</p>
                                                </div>
                                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-5 col-sm-9 col-12 shipping">
                                                    <h4 class="status_ship">Placed on
                                                        {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y h:i A') }}
                                                    </h4>
                                                    <p>Current status :
                                                        @if (
                                                            $order->order_status == 'Delivered' ||
                                                                $order->order_status == 'Shipped' ||
                                                                $order->order_status == 'Assigned To Delivery Boy')
                                                            <span class="text-success">{{ $order->order_status }}</span>
                                                        @elseif ($order->order_status == 'Delivered' || $order->order_status == 'Accepted' || $order->order_status == 'Placed')
                                                            <span class="text-primary">{{ $order->order_status }}</span>
                                                        @elseif ($order->order_status == 'Cancelled')
                                                            <span class="text-danger">{{ $order->order_status }}</span>
                                                        @else
                                                            <span class="text-primary">{{ $order->order_status }}</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div
                                                    class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-3 col-12 align-self-center">
                                                    <a href="{{ route('order.view', ['sid' => $order->sid]) }}"
                                                        class="btn-view">View Details</a>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <p>No data found.</p>
                                                </div>
                                            </div>
                                        @endforelse


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
