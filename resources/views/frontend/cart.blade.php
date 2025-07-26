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
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li>Shopping Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12">
                <h3 class="subpagetitle">Shopping Cart</h3>
                <p class="text-danger">{{ $check_product_stock ? 'Some products has out of stock. Please remove the out of products and continue!' : '' }}</p>
            </div>
        </div>
        <div class="row" id="shopcart">
            <div class="col-xxl-8 col-xl-8 col-lg-8 cartitemsbox">
                <div class="card">
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
                                            href="{{ route('product', $cart->slug) }}">{{ $cart->product_name }}<br>
                                            {!! ($cart->product->stock ?? 0) == 0 ? "<small class='text-danger'>Products is out of stock remove it!</small>" : '' !!}</a></div>
                                </div>
                                <div class="itemprice"><label for=""
                                        class="d-lg-none d-md-none d-block">Price</label> Rs. {{ $cart->price }}</div>
                                <div class="itemqty">
                                    <label for="" class="d-lg-none d-md-none d-block">Quantity</label>
                                    <div class="d-flex">
                                        <!-- <input type="number" class="form-control" min="0" max="100" value="{{ $cart->quantity }}" onchange="addToCart({{ $cart->product_id }}, this.value)"> -->
                                        @if (($cart->product->stock ?? 0) != 0)
                                        <div class="input-group count number-spinner">
                                            <input type="button" onclick="update_cart2('m',{{ $cart->id }})"
                                                value="-" class="button-minus" data-field="quantity"
                                                data-cart="{{ $cart->id }}">
                                            <input type="number" step="1" id="cartp_qty{{ $cart->id }}"
                                                max="20" min="1" value="{{ $cart->quantity }}" name="quantity"
                                                class="quantity-field" style="width:40%;min-width:30px;">
                                            <input type="button" onclick="update_cart2('p',{{ $cart->id }})"
                                                value="+" class="button-plus" data-field="quantity"
                                                data-cart="{{ $cart->id }}">
                                        </div>
                                        @else
                                            <p>N/A</p>
                                        @endif

                                    </div>
                                </div>
                                <div class="itemsubtotal"><label for="" class="d-lg-none d-md-none d-block">Sub
                                        Total</label> Rs. {{ $cart->sub_total }}</div>
                                <div class="itemsavings"><label for=""
                                        class="d-lg-none d-md-none d-block">Savings</label> Rs.
                                    {{ round(($cart->mop - $cart->price) * $cart->quantity) }}</div>
                                <div class="itemremove"><label for=""
                                        class="d-lg-none d-md-none d-block">Remove</label><button type="button"
                                        onclick='removeCart({{ $cart->id }})'><i class="fal fa-trash-alt"></i></button>
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
            <style>
                .input-group.quantity-stepper {
                    display: flex;
                    align-items: center;
                    width: 150px;
                    /* Adjust as needed */
                }

                .input-group .form-control {
                    width: 50px;
                    text-align: center;
                    border-left: 0;
                    border-right: 0;
                }

                .input-group .btn {
                    width: 40px;
                    border-radius: 0;
                }
            </style>
            <div class="col-xxl-4 col-xl-4 col-lg-4">
                <div class="card mb-4 crttotals">
                    <div class="card-body">
                        <table class="table cartotals">
                            <tr>
                                <td>Total Products ({{ $cart->total_quantity ?? 0 }})</td>
                                <td>Rs. {{ $cart->cart_total ?? 0 }} @if($cart->cart_total > 399) 
                                    {{-- <span>Free Shipping</span>  --}}
                                    @endif</td>
                            </tr>
                            <tr>
                                <td>Sub Total</td>
                                <td>Rs. {{ $cart->cart_total ?? 0 }}</td>
                            </tr>
                            <tr>
                                <td>Coupon code Discount</td>
                                <td>Rs. 0</td>
                            </tr>
                            <tr>
                                <td>Shipping Charges</td>
                                <td><span class="{{ $shipping_charges > 0 ? 'text-danger' : '' }}">Rs. {{$shipping_charges ?? 0}}</span><br><small class='text-danger'>{{$shipping_charges > 0 ? 'Free shipping above 399' : ''}}</small></td>
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
                        @if (!$check_product_stock)
                            @if (session()->has('customer_id'))
                                @if ($carts->isNotEmpty())
                                    @if ($address_count > 0)
                                        <a href="{{ route('make-payment') }}" class="continue-payment">Continue</a>
                                    @else
                                        <a href="{{ route('checkout') }}" class="continue-payment">Continue</a>
                                    @endif
                                @else
                                    <a href="{{ route('home') }}" class="continue-payment">Continue Shopping</a>
                                @endif
                            @else
                                <a href="{{ route('userlogin') }}" class="continue-payment">Login/Sign Up</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--NEW ARRIVAL START-->
    @if ($bestsellingproducts->isNotEmpty())
        <!--NEW ARRIVAL START-->
        <div class="feature-area mt-60px mb-30px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-12">
                        <div class="arrival-section">
                            <div class="new-arrival">
                                <h3>BEST
                                    <span> SELLER'S</span>
                                </h3>
                            </div>
                            <!-- Add Arrows -->
                        </div>
                    </div>
                    <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-12">
                        <div class="center slider feature-slider-two new-arrivals">
                            @foreach ($bestsellingproducts as $product)
                                <div>
                                    <div class="feature-slider-item">
                                        <div class="new-arrive">
                                            <div class="arrival-brand">
                                                <small>{{ $product->brand }}</small>
                                            </div>
                                            <div class="arrival-quantity">
                                                @if ($product->stock <= 0)
                                                    <small style="color: red;">Out of Stock</small>
                                                @elseif ($product->stock == 1)
                                                    <small style="color: orange;">Last Stock</small>
                                                @elseif ($product->stock <= $product->min_stock)
                                                    <small>{{ $product->stock }} in Stock</small>
                                                @else
                                                    <small>In Stock</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="arrival-text">
                                            <a href="{{ route('product', $product->slug ?? '') }}">{{ $product->name }}</a>
                                        </div>
                                        <div class="arrival-image">
                                            <a href="{{ route('product', $product->slug ?? '') }}">
                                                @if ($product->image != 'no-image')
                                                    <img src="{{ asset("uploads/products/$product->image") }}"
                                                        alt="{{ $product->name }}">
                                                @else
                                                    <img src="https://placehold.co/400x400?text=No+Image+Found!"
                                                        alt="Default Image">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="arrival-members">
                                            <div class="arrival-ratings1">
                                                <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="rating-members">
                                                <small>20 REVIEWS</small>
                                            </div>
                                        </div>
                                        <div class="arrival-price">
                                            <h4>Rs.{{ $product->price }}</h4>
                                            <h5>Rs.{{ $product->mop }}</h5>
                                        </div>
                                        <div class="arrival-buttons d-flex justify-content-between">
                                            <a href="javascript:void(0);" class="add-cart-btn"
                                                onclick="addToCart({{ $product->id }},1)">Add To Cart</a>
                                            <a href="avascript:void(0);" onclick="buy_now({{ $product->id }},1)"
                                                class="buy-now-btn">Buy
                                                now</a>
                                        </div>
                                        @php
                                            $price = $product->price;
                                            $mrp = $product->mop;

                                            // Calculate percentage off
                                            $percentageOff = $mrp > 0 ? (($mrp - $price) / $mrp) * 100 : 0;
                                        @endphp
                                        @if ($percentageOff >= 1)
                                            <div class="arrival-offer">
                                                <h6>{{ round($percentageOff) }}%</h6>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
