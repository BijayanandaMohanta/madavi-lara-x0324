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
                            <h3>My Orders</h3>
                        </div>
                    </div>
                    <div class="col-xxl-12 col-x-12 col-lg-12">
                        <div class="dashwidget px-0">
                           <div class="orddetailsbox">
                                <div class="row">
                                    <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-4 col-sm-12 col-12">
                                        <h4>Order # {{ $order_data->order_id }}</h4>
                                        <p>{{ $order_data->date }} <small>{{ $order_data->payment_option }}</small></p>
                                    </div>
                                    <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-8 col-sm-12 col-12">
                                        <div class="row ordersbox border-0 px-0">
                                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <div class="shipping ps-5">
                                                    <h4 class="status_ship">{{ $order_status }} on {{ \Carbon\Carbon::parse($order_date)->format('d M Y h:i A') }}</h4>
                                                    <!--<p>your item has been Shipped</p>-->
                                                </div>
                                            </div>
                                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 align-self-sm-center">
                                               <div class="d-flex">
                                                <a href="{{ route('dashboardtrackorder', ['order_id' => $order_data->order_id]) }}" class="btn-view">Track Order</a>

                                                <a href="{{route('invoice',$_GET['sid'] ?? 0)}}" target="_blank" class="btn-view">Download Receipt</a>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           </div>
                           @foreach($carts as $cart)
                           <div class="orddetailsbox">
                                <div class="row">
                                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                                        <div class="itemdetailsrow">
                                            <div class="itemproduct">
                                                <div class="itemimg">@if ($cart->image != 'no-image')
                                                    <img src="{{ asset("uploads/products/$cart->image") }}"
                                                        alt="{{ $cart->product_name }}">
                                                @else
                                                    <img src="https://placehold.co/400x400?text=No+Image+Found!"
                                                        alt="Default Image">
                                                @endif</div>
                                                <div class="itemtitle">
                                                    @if (!empty($cart->slug))
                                                        <a href="{{ route('product', $cart->slug) }}">{{ $cart->product_name }}</a>
                                                    @else
                                                        {{ $cart->product_name }} <!-- Display product name without a link -->
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="itemprice"><label for="" class="d-lg-none d-md-none d-block">Price</label> Rs. {{ $cart->sub_total }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            <div class="orddetailsbox">
                                <div class="row producttotals">
                                    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-6 col-sm-6 col-6"><h4>Total Amount</h4></div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6"><h5>Rs. {{ $order_data->sub_total }}</h5></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xxl-12 col-xl-12 col-lg-12 dashdelvbox">
                                    <h4>Delivery Address</h4>
                                    <div class="hometxt">{{ $address_data->type }}</div>
                                    <h5>{{ $address_data->first_name }} {{ $address_data->last_name }}, {{ $address_data->phone }}</h5>
                                    <p>{{ $address_data->apartment }}, {{ $address_data->address }}, {{ $address_data->city }}, {{ $address_data->state }} - {{ $address_data->pincode }}</p>
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