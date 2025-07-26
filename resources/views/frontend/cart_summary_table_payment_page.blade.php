<div class="card mb-4 crttotals">
    <div class="card-body">
        <table class="table cartotals" id="cart_sum_table">
            <tr>
                <td>Total Products ({{ $cart->total_quantity ?? 0 }})</td>
                <td>Rs. {{ $cart->cart_total ?? 0 }} @if($cart->cart_total > 399) <span>Free Shipping</span> @endif</td>
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
                <td id="shipping_charges" data-shipping-charges="{{$shipping_charges ?? 0}}"><span class="{{ $shipping_charges > 0 ? 'text-danger' : '' }}">Rs.  {{$shipping_charges ?? 0}}</span><small class='text-danger'>{{$shipping_charges > 0 ? 'Free shipping above 399' : ''}}</small>
                </td>
            </tr>
            <tr>
                <td>Grand Total</td>
                @php
                    $grand_total = ($cart->cart_total ?? 0) - ($used_coupon->coupon_amount ?? 0) + ($cart->shipping_charges ?? 0);
                @endphp
                <td>Rs.
                    {{ $grand_total }}</td>
            </tr>
            <tr>
                <td>Savings</td>
                <td class="border-0">Rs. {{ round($cart->saving ?? 0) }}</td>
            </tr>
        </table>
    </div>
</div>
<div class="card mb-4 crttotals">
    <div class="card-body makepayment">
        {{-- <form action="{{ route('place_order') }}" method="POST"> --}}
        <form action="" method="POST">
            @csrf
            <div class="d-flex justify-content-between">

                <label class="control control--radio">Pay Online
                    <input type="radio" name="payment_option" value="Pay Online" checked
                        data-amount="{{ $grand_total }}" />
                    <div class="control__indicator"></div>
                </label>
                <div class="paymentrpice">Rs.{{ $grand_total }}</div>
            </div>
            <label class="control control--radio">Pay Partial COD
                @php
                    // $grand_total = $cart->cart_total ?? (0 - ($used_coupon->coupon_amount ?? 0) ?? 0);
                    if (($grand_total >= 200) & ($grand_total <= 2000)) {
                        $partial = 200;
                    } else {
                        $partial = round($grand_total * 0.1);
                    }
                    $need_to_pay = round($grand_total - $partial);
                @endphp
                <input type="radio" name="payment_option" value="Pay Partial COD"
                    data-amount="{{ $partial ?? 0 }}" />
                <div class="control__indicator"></div>

                <p>Pay Rs.{{ $partial }} and remaining Rs. {{ $need_to_pay }} on arrival or the
                    product</p>
                <p>Note : From Rs. 200 to Rs. 2000 you need to pay Rs.200 as partial amount. More than 2000
                    you need to pay 10% of the billing amount as partial amount.</p>
            </label>
            <button class="continue-payment w-100" id="makepayment">Make Payment</button>
        </form>
    </div>
</div>