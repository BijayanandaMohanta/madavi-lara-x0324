@extends('frontend.layouts.main')
@section('content')

    <style>
        input[type="number"] {
            -moz-appearance: textfield;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .button-minus,
        .button-plus {
            background-color: #f7f7f7;
            padding-inline: 9px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-weight: 700;
        }

        .quantity-field {
            text-align: center;
            height: 31px !important;
            border-radius: 3px !important;
            border: 1px solid #ccc !important;
            pointer-events: none;
        }

        .input-group {
            flex-wrap: unset !important;
        }
    </style>
    <div class="breadcrumb-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-content">
                        <ul class="nav">
                            <li><a href="index.php">Home</a></li>
                            <li>Make Payment</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12">
                <h3 class="subpagetitle">Make Payment</h3>
            </div>
        </div>
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-xxl-8 col-xl-8 col-lg-8 cartitemsbox">
                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <div class="delvryboxnew">
                            <form action="">
                                <div class="row">
                                    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-8">
                                        <h3>Delivery Address</h3>
                                        <label class="control control--radio">{{ $address_data->type }}
                                            <input type="radio" name="addresstype" value="Home" checked />
                                            <div class="control__indicator"></div>
                                            <p>{{ $address_data->apartment }}, {{ $address_data->address }},
                                                {{ $address_data->city }}, {{ $address_data->state }} -
                                                {{ $address_data->pincode }}</p>
                                        </label>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4">
                                        <a href="{{route('add-address')}}" class="add-adress">+ Add New Address</a>
                                        <button type="button" class="btn-change-address" data-bs-toggle="modal"
                                            data-bs-target="#changeaddressModal">Change</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card" id="shopcart">
                    <div class="card-headder">
                        <div class="item-productrow">
                            <div class="itemproduct">Product</div>
                            <div class="itemprice">Price</div>
                            <div class="itemqty">Quantity</div>
                            <div class="itemsubtotal">Subtotal</div>
                            <div class="itemsavings">Savings</div>
                            <div class="itemremove">Remove</div>
                        </div>
                    </div>
                    <div class="card-body">
                        @forelse ($carts as $cart)
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
                                    <div class="itemtitle"><a
                                            href="{{ route('product', $cart->slug) }}">{{ $cart->product_name }}</a></div>
                                </div>
                                <div class="itemprice"><label for=""
                                        class="d-lg-none d-md-none d-block">Price</label> Rs. {{ $cart->price }}</div>
                                <div class="itemqty">
                                    <label for="" class="d-lg-none d-md-none d-block">Quantity</label>
                                    <div class="d-flex">
                                        <!-- <input type="number" class="form-control" min="0" max="100" value="{{ $cart->quantity }}" onchange="addToCart({{ $cart->product_id }}, this.value)"> -->
                                        <div class="input-group count number-spinner">
                                            <input type="button" onclick="update_cart21('m',{{ $cart->id }})"
                                                value="-" class="button-minus" data-field="quantity"
                                                data-cart="{{ $cart->id }}">
                                            <input type="number" step="1" id="cartp_qty{{ $cart->id }}"
                                                max="20" min="1" value="{{ $cart->quantity }}" name="quantity"
                                                class="quantity-field" style="width:40%;min-width:30px;">
                                            <input type="button" onclick="update_cart21('p',{{ $cart->id }})"
                                                value="+" class="button-plus" data-field="quantity"
                                                data-cart="{{ $cart->id }}">
                                        </div>

                                    </div>
                                </div>
                                <div class="itemsubtotal"><label for="" class="d-lg-none d-md-none d-block">Sub
                                        Total</label> Rs. {{ $cart->sub_total }}</div>
                                <div class="itemsavings"><label for=""
                                        class="d-lg-none d-md-none d-block">Savings</label> Rs.
                                    {{ round(($cart->mop - $cart->price) * $cart->quantity) }}</div>
                                <div class="itemremove"><label for=""
                                        class="d-lg-none d-md-none d-block">Remove</label><button type="button"
                                        onclick='removeCart({{ $cart->id }})'><i
                                            class="fal fa-trash-alt"></i></button>
                                </div>
                            </div>
                        @empty
                            <div class="itemdetailsrow">
                                <p>No product added on cart</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4">
                <div class="card mb-4 crttotals">
                    <div class="card-body">
                        <div id="cart_sum_table">
                        <table class="table cartotals">
                            <tr>
                                <td>Total Products ({{ $cart->total_quantity ?? 0 }})</td>
                                <td>Rs. {{ $cart->cart_total ?? 0 }} @if($cart->cart_total > 399) {{-- <span>Free Shipping</span>  --}} @endif</td>
                            </tr>
                            <tr>
                                <td>Sub Total</td>
                                <td>Rs. {{ $cart->cart_total ?? 0 }}</td>
                            </tr>
                            <tr>
                                <td>Coupon code Discount</td>
                                <td>Rs. {{ $used_coupon->coupon_amount ?? 0 }}</td>
                            </tr>
                            <tr>
                                <td>Shipping Charges</td> 
                                <td id="shipping_charges" data-shipping-charges="{{$shipping_charges ?? 0}}"><span class="{{ $shipping_charges > 0 ? 'text-danger' : '' }}">Rs.  {{$shipping_charges ?? 0}}</span><small class='text-danger'>{{$shipping_charges > 0 ? 'Free shipping above 399' : ''}}</small></td>
                            </tr>
                            <tr>
                                <td>Grand Total</td>
                                <td>Rs.
                                    {{ ($cart->cart_total ?? 0) - ($used_coupon->coupon_amount ?? 0) + ($shipping_charges ?? 0) }}</td>
                            </tr>
                            <tr>
                                <td class="border-0">Savings</td>
                                <td class="border-0">Rs. {{ round($cart->saving ?? 0) }}</td>
                            </tr>
                        </table>
                    </div>
                        @if (session()->has('customer_id'))
                            @if ($carts->isNotEmpty())
                                <a href="{{ route('payment') }}" class="continue-payment">Continue</a>
                            @else
                                <a href="{{ route('home') }}" class="continue-payment">Continue Shopping</a>
                            @endif
                        @else
                            <a href="{{ route('userlogin') }}" class="continue-payment">Login/Sign Up</a>
                        @endif
                        
                    </div>
                </div>
                <div class="col-xxl-12 col-xl-12 col-lg-12 mb-3">
                    <div class="input-group couponbox">
                        <input type="text" class="form-control" name="coupon_code" id="coupon_code">
                        <button class="btn btn-primary" onclick="applyCoupon()">Apply Code</button>
                    </div>
                </div>
                <div class="col-xxl-12 col-xl-12 col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="couponcodes">
                                <div class="row">

                                    @foreach ($coupons as $index => $coupon)
                                        <div class="col-lg-12">
                                            <div class="cstchkbox">
                                                <input type="radio" name="coupon" id="coupon-{{ $index }}"
                                                    onchange="useCoupon('{{ Cookie::get('sid') }}','{{ $coupon->code }}',{{ Session::get('customer_id') }})"
                                                    @if ($coupon->id == ($used_coupon->coupon_id ?? '')) checked @endif>
                                                <label for="coupon-{{ $index }}">{{ $coupon->code }}</label>
                                            </div>

                                            <div class="couponcontent">
                                                <p>
                                                    {{ $coupon->description }}
                                                </p>
                                                <p>
                                                    @if ($coupon->discount_type == 'Flat Amount')
                                                        Rs. {{ $coupon->offer_amount }} off on minimum purchase of Rs.
                                                        {{ $coupon->min_amount }}.
                                                    @else
                                                        {{ $coupon->offer_amount }}% off on minimum purchase of Rs.
                                                        {{ $coupon->min_amount }}.
                                                    @endif
                                                </p>
                                                <p>Expires on:
                                                    {{ \Carbon\Carbon::parse($coupon->exp_date)->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- change-address Modal -->
    <div class="modal fade" id="changeaddressModal" tabindex="-1" aria-labelledby="changeaddressModalLabel"
        aria-hidden="true">
        <form action="{{ route('change_address') }}" method="POST">
            @csrf
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header py-3">
                        <h4 class="modal-title fs-5" id="changeaddressModalLabel">Change address</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="fal fa-times fa-lg"></i></button>
                    </div>
                    <div class="modal-body p-0">
                        @foreach ($addresses as $address)
                            <div class="p-3">
                                <label class="control control--radio">{{ $address->type }}
                                    <input type="radio" name="choosen_address" value="{{ $address->id }}"
                                        {{ isset($address_data) && $address_data->address_id == $address->id ? 'checked' : '' }} />
                                    <div class="control__indicator"></div>
                                    <p>{{ $address->apartment }}, {{ $address->address }}, {{ $address->landmark }},{{ $address->city }},
                                        {{ $address->state }} - {{ $address->pincode }}</p>
                                </label>
                            </div>
                            <hr>
                        @endforeach


                        <div class="p-3"> <button type="submit" class="btn btn-primary">Apply</button></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js'></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function applyCoupon() {
            var couponCode = document.getElementById('coupon_code').value;
            useCoupon('{{ Cookie::get('sid') }}', couponCode, {{ Session::get('customer_id') }});
        }

        function useCoupon(sid, coupon_code, user_id) {
            $.ajax({
                url: "{{ route('use-coupon') }}",
                type: "GET",
                data: {
                    user_id: user_id,
                    coupon_code: coupon_code,
                    sid: sid,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    // Check if the server returned a 'success' status
                    if (response.status === 'valid') {
                        Swal.fire({
                            title: "Information!",
                            text: response.message,
                            icon: "success",
                        });
                        window.location.href = window.location.href;
                    } else {
                        // console.log(response);
                        Swal.fire({
                            title: "Information!",
                            text: response.message,
                            icon: "warning",
                        })

                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Debug: Print error message in console
                    // alert('Error occurred while adding coupon.');
                    Swal.fire({
                        title: "Error",
                        text: 'Error occurred while adding coupon.',
                        icon: "error",
                    })
                }
            });
        }

        
    </script>
@endsection
