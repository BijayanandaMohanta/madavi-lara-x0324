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
                <div class="itemtitle"><a href="{{ route('product', $product1->slug) }}">{{ $cart->product_name }}</a>
                </div>
            </div>
            <div class="itemprice"><label for="" class="d-lg-none d-md-none d-block">Price</label> Rs.
                {{ $cart->price }}</div>
            <div class="itemqty">
                <label for="" class="d-lg-none d-md-none d-block">Quantity</label>
                <div class="d-flex">
                    <!-- <input type="number" class="form-control" min="0" max="100" value="{{ $cart->quantity }}" onchange="addToCart({{ $cart->product_id }}, this.value)"> -->
                    <div class="input-group count number-spinner">
                        <input type="button" onclick="update_cart21('m',{{ $cart->id }})" value="-"
                            class="button-minus" data-field="quantity" data-cart="{{ $cart->id }}">
                        <input type="number" step="1" id="cartp_qty{{ $cart->id }}" max="20"
                            min="1" value="{{ $cart->quantity }}" name="quantity" class="quantity-field"
                            style="width:40%">
                        <input type="button" onclick="update_cart21('p',{{ $cart->id }})" value="+"
                            class="button-plus" data-field="quantity" data-cart="{{ $cart->id }}">
                    </div>

                </div>
            </div>
            <div class="itemsubtotal"><label for="" class="d-lg-none d-md-none d-block">Sub Total</label> Rs.
                {{ $cart->sub_total }}</div>
            <div class="itemsavings"><label for="" class="d-lg-none d-md-none d-block">Savings</label> Rs.
                {{ round(($cart->mop - $cart->price) * $cart->quantity) }}</div>
            <div class="itemremove"><label for="" class="d-lg-none d-md-none d-block">Remove</label><button type="button"
                onclick='removeCart({{ $cart->id }})'><i class="fal fa-trash-alt"></i></button></div>
        </div>
    @endforeach

</div>

<!--NEW ARRIVAL START-->
