<ul>
    @forelse ($results as $product)
        <li class="d-flex align-items-center justify-content-between my-2 gap-3">
            <img src="{{ asset("uploads/products/$product->image") }}" alt="" class="img-fluid"> 
            <a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
            <div>
                <strike class="text-danger">₹{{ $product->mop }}.00</strike> <br>
                ₹{{ $product->price }}.00
            </div>
        </li>
    @empty
        <li class="d-flex align-items-center justify-content-between my-2">
            <a href="#">No Result Found</a>
        </li>
    @endforelse
</ul>
