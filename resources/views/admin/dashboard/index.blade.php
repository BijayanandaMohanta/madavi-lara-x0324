@extends('admin.layouts.main')
@section('content')
    {{-- @php
    dd(Auth::user());
@endphp --}}
    {{-- @php
    $routesPath = base_path('routes/web.php');

if (file_exists($routesPath)) {
    $routesContent = file_get_contents($routesPath);
    echo $routesContent;
}
@endphp --}}

    {{-- @dd($ordersByMonth); --}}

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>

        </div>
        <!-- end page title -->
    </div>
    <style>
        .icon>i {
            font-size: 1.2rem;
        }

        .card {
            border: none;
        }
    </style>
    <div class="row">
        <div class="col-lg-6">
            <h4 class="page-title">Welcome {{ Auth::User()->name }} !</h4>
            <div class="row">
               
                    
                    <div class="col-xl-6 col-md-6">
                        <div class="card widget-box-two bg-primary">
                            <a href="{{ route('product.index') }}">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body wigdet-two-content">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <p class="m-0 text-uppercase text-white">No. of Product</p>
                                                    <h2 class="text-white">
                                                        <span data-plugin="counterup">{{ $products }}</span>
                                                    </h2>
                                                </div>
                                                <div class="rounded-circle bg-white text-primary d-flex justify-content-center align-items-center icon"
                                                    style="width: 50px; height: 50px;">
                                                    <i class="fas fa-cube"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                   
                
            </div>
        </div>

        <div class="col-md-12 col-lg-6">
            <h4>Recent Orders</h4>

            <div class="card pb-2">
                <table class="table table-responsive w-100">
                    <tr>
                        <td>Sl no</td>
                        <td>Order Id</td>
                        <td>Date</td>
                        <td>Grand Total</td>
                        <td>Order Status</td>
                        <td>Payment Status</td>
                        <td>Action</td>

                    </tr>
                    @foreach ($recentOrders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->date }}</td>
                            <td>{{ $order->grand_total }}</td>
                            <td>{{ $order->order_status }}</td>
                            <td>{{ $order->payment_status }}({{ $order->payment_option }})</td>
                            <td><a href="{{ route('orders.edit', [$order->sid ?? 'N/A']) }}">
                                    <div class="btn btn-sm btn-primary">View Order</div>
                                </a></td>
                        </tr>
                    @endforeach
                </table>
                <div class="text-center">
                    <a href="{{ route('orders.index') }}" class="btn btn-primary">View all orders</a>
                </div>
            </div>
        </div>

    </div>
@endsection
