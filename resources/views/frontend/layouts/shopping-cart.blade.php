@php
    if (Cookie::has('sid')) {
        $sid = Cookie::get('sid');
    } else {
        $sid = Session::get('sid');
    }
    $carts = App\Cart::where('sid', $sid)->get();
@endphp

<li class="px-0">
    <div class="innerproductitembox">
        @forelse ($carts as $cart)
            @php
                $product = App\ProductImage::where('product_id', $cart->product_id)
                    ->orderBy('priority', 'asc')
                    ->first();
                $product1 = App\Product::where('id', $cart->product_id)->first();
            @endphp
            <div class="p-3 pb-0">
                <div class="row">
                    <div class="col-4">
                        @if ($product->image != 'no-image')
                            <img src="{{ asset("uploads/products/$product->image") }}" alt="{{ $product->name }}">
                        @else
                            <img src="https://placehold.co/400x400?text=No+Image+Found!" alt="Default Image">
                        @endif
                    </div>
                    <div class="col-8">
                        <h5><a href="{{ route('product', $product1->slug ?? '') }}">{{ $cart->product_name }}</a></h5>
                        <div class="price">Rs. {{ $cart->price }} <del>Rs. {{ $cart->mop }}</del> <br>
                        <small class="text-danger" style="font-size: 0.7rem;">Quantity :{{ $cart->quantity }}</small></div>
                        <div class="d-flex py-2">
                            <!-- <input type="number" min="0" max="100" value="1">
                    <button type="button" class="btn-remove ms-3"><i class="fal fa-trash-alt"></i></button> -->
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            @empty
            <div class="h-100 w-100 text-center">
                <img src="{{ asset('frontend/cart-empty.jpg') }}" alt="" style="height: 170px" class="border-0"> <br>
                <h5 class="text-center">Your Cart is Empty!</h5>
            </div>
        @endforelse

       

    </div>
    <!-- <hr> -->
    @if ($carts->isNotEmpty())
    <div class="row justify-content-center fixedcartbtns">
        <div class="col-10 pb-2 pt-2">
            <button type="button" class="btn-viewcart" onclick="location.href='{{ route('cart') }}'">View Cart</button>

            @if (session()->has('customer_id'))
                @php
                    $customer_id = Session::get('customer_id');
                    $address_count = App\Address::where('customer_id', $customer_id)->count();
                @endphp

                @if ($address_count > 0)
                    <button type="button" class="btn-checkout"
                        onclick="location.href='{{ route('make-payment') }}'">Checkout</button>
                @else
                    <button type="button" class="btn-checkout"
                        onclick="location.href='{{ route('checkout') }}'">Checkout</button>
                @endif
            @else
                <button type="button" class="btn-checkout"
                    onclick="location.href='{{ route('userlogin') }}'">Login/Sign Up</button>

            @endif


        </div>
    </div>
    @endif
    
</li>
