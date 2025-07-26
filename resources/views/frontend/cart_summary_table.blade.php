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
        <td id="shipping_charges" data-shipping-charges="{{$shipping_charges ?? 0}}">Rs. {{$shipping_charges ?? 0}}</td>
    </tr>
    <tr>
        <td>Grand Total</td>
        <td>Rs. {{ $cart->cart_total + ($cart->shipping_charges ?? 0) }}</td>
    </tr>
    <tr>
        <td>Savings</td>
        <td class="border-0">Rs. {{ round($cart->saving) }}</td>
    </tr>
</table>
{{-- <a href="{{ route('payment') }}" class="continue-payment">Continue</a> --}}