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
            @foreach ($carts as $cart)
                @php
                    $product = App\ProductImage::where('product_id', $cart->product_id)
                        ->orderBy('priority', 'asc')
                        ->first();
                    $product1 = App\Product::where('id', $cart->product_id)->first();
                @endphp
                <div class="itemdetailsrow">
                    <div class="itemproduct">
                        <div class="itemimg">
                            @if ($product->image != 'no-image')
                                <img src="{{ asset("uploads/products/$product->image") }}" alt="{{ $product->name }}">
                            @else
                                <img src="https://placehold.co/400x400?text=No+Image+Found!" alt="Default Image">
                            @endif
                        </div>
                        <div class="itemtitle"><a
                                href="{{ route('product', $product1->slug) }}">{{ $cart->product_name }}</a></div>
                    </div>
                    <div class="itemprice"><label for="" class="d-lg-none d-md-none d-block">Price</label> Rs.
                        {{ $cart->price }}</div>
                    <div class="itemqty">
                        <label for="" class="d-lg-none d-md-none d-block">Quantity</label>
                        <div class="d-flex">
                            <!-- <input type="number" class="form-control" min="0" max="100" value="{{ $cart->quantity }}" onchange="addToCart({{ $cart->product_id }}, this.value)"> -->
                            <div class="input-group count number-spinner">
                                <input type="button" onclick="update_cart2('m',{{ $cart->id }})" value="-"
                                    class="button-minus" data-field="quantity" data-cart="{{ $cart->id }}">
                                <input type="number" step="1" id="cartp_qty{{ $cart->id }}" max="20"
                                    min="1" value="{{ $cart->quantity }}" name="quantity" class="quantity-field"
                                    style="width:40%">
                                <input type="button" onclick="update_cart2('p',{{ $cart->id }})" value="+"
                                    class="button-plus" data-field="quantity" data-cart="{{ $cart->id }}">
                            </div>

                        </div>
                    </div>
                    <div class="itemsubtotal"><label for="" class="d-lg-none d-md-none d-block">Sub
                            Total</label> Rs. {{ $cart->sub_total }}</div>
                    <div class="itemsavings"><label for="" class="d-lg-none d-md-none d-block">Savings</label>
                        Rs. {{ round(($cart->mop - $cart->price) * $cart->quantity) }}</div>
                    <div class="itemremove"><label for=""
                            class="d-lg-none d-md-none d-block">Remove</label><button type="button"
                            onclick='removeCart({{ $cart->id }})'><i class="fal fa-trash-alt"></i></button></div>
                </div>
            @endforeach

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
                    <td>Total Products ({{ $cart->total_quantity }})</td>
                    <td>Rs. {{ $cart->cart_total }} @if($cart->cart_total > 399) <span>Free Shipping</span> @endif</td>
                </tr>
                <tr>
                    <td>Sub Total</td>
                    <td>Rs. {{ $cart->cart_total }}</td>
                </tr>
                <tr>
                    <td>Coupon code Discount</td>
                    <td>Rs. {{ $used_coupon->coupon_amount ?? 0 }}</td>
                </tr>
                <tr>
                    <td>Shipping Charges</td>
                    <td>
                        <span class="{{ $shipping_charges > 0 ? 'text-danger' : '' }}">Rs. {{ $shipping_charges ?? 0 }}</span>
                        <small class='text-danger'>{{$shipping_charges > 0 ? 'Free shipping above 399' : ''}}</small>
                    </td>
                </tr>
                <tr>
                    <td class="border-0 pb-0">Grand Total</td>
                    <td class="">Rs. {{ $cart->cart_total - ($used_coupon->coupon_amount ?? 0) + ($shipping_charges ?? 0) }}</td>
                </tr>
                <tr>
                    <td class="border-0">Savings</td>
                    <td class="border-0">Rs. {{ round($cart->saving) }}</td>
                </tr>
            </table>
            @if (session()->has('customer_id'))
                @if ($address_count > 0)
                    <a href="{{ route('make-payment') }}" class="continue-payment">Continue</a>
                @else
                    <a href="{{ route('checkout') }}" class="continue-payment">Continue</a>
                @endif
            @else
                <a href="{{ route('userlogin') }}" class="continue-payment">Login/Sign Up</a>
        </div>
        @endif
    </div>
</div>
</div>

<!--NEW ARRIVAL START-->
