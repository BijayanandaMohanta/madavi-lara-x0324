@extends('frontend.layouts.main')
@section('content')
    <div class="breadcrumb-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-content">
                        <ul class="nav">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li>Order Successful</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12">
                <div class="thanqbox">
                    <h3>Thank you for your order!</h3>
                    <p>The order confirmation email with details of your order and a link to track its progress has been
                        sent to your email address</p>
                    <div class="order-id">Your Order Id #{{ $order_id }}</div>
                    <div class="ord-details">
                        <p> Order Date : {{ $date }}</p>
                        <p>Estimated Delivery Date : {{$newEtdFormatted}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-8 col-xl-8 col-lg-8 cartitemsbox">
                <div class="card summaryorder">
                    <div class="card-headder">
                        <h4>Order Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xxl-11 col-xl-11 col-lg-11">
                                <div class="row justify-content-between">
                                    @if ($carts->isEmpty())
                                        <div class="col-12">
                                            <p>No items in the cart.</p>
                                        </div>
                                    @else
                                        @foreach ($carts as $cart)
                                            <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-12 mb-3">
                                                <div class="itemdetailsrow">
                                                    <div class="itemproduct">
                                                        <div class="itemimg">
                                                            @if ($cart->image != 'no-image')
                                                                <img src="{{ asset("uploads/products/$cart->image") }}"
                                                                    alt="{{ $cart->product_name }}">
                                                            @else
                                                                <img src="https://placehold.co/400x400?text=No+Image+Found!"
                                                                    alt="Default Image">
                                                            @endif
                                                        </div>
                                                        <div class="itemtitle">
                                                            <a
                                                                href="{{ route('product', $cart->slug) }}">{{ $cart->product_name }}</a>
                                                            <div class="itemprice">Rs. {{ $cart->price }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                                <div class="row justify-content-between">
                                    <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                        <div class="d-flex totalspro">
                                            <div class="totlabel">Subtotal</div>
                                            <div class="totvalue">Rs. {{ $cart->cart_total ?? 0 }}</div>
                                        </div>
                                        <div class="d-flex totalspro">
                                            <div class="totlabel">Coupon Discount</div>
                                            <div class="totvalue">Rs. {{ $coupon ?? 0 }}</div>
                                        </div>
                                        {{-- <div class="d-flex totalspro">
                                            <div class="totlabel">Discount</div>
                                            <div class="totvalue">Rs. 0</div>
                                        </div> --}}
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                        <div class="d-flex totalspro txr">
                                            <div class="totlabel">Grand Total</div>
                                            <div class="totvalue">Rs.  {{ ($cart->cart_total ?? 0) - ($coupon ?? 0) }}</div>
                                        </div>
                                        <div class="d-flex totalspro txr">
                                            <div class="totlabel">Total Savings</div>
                                            <div class="totvalue">Rs. {{ round($cart->saving ?? 0) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4">
                <div class="card mb-3 delvboxright">
                    <div class="card-headder">
                        <h4>Delivery Address</h4>
                    </div>
                    <div class="card-body">
                        <h5>{{ $address_data->type }}</h5>
                        <p>{{ $address_data->apartment }}, {{ $address_data->address }}, {{ $address_data->city }},
                            {{ $address_data->state }} - {{ $address_data->pincode }}</p>
                    </div>
                </div>
                <a href="{{ route('home') }}" class="continue-shopping mb-3">Continue Shopping</a>
            </div>
        </div>
    </div>
@endsection
