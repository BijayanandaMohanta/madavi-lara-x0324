{{-- @foreach ($categoriesofproducts->slice(4) as $category) --}}
@foreach ($categories as $category)
        @if ($category->products->isNotEmpty())
            <div class="seller-slider">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="seller-slider-image">
                                <img srcset="{{ asset("/uploads/category/$category->homepage_side_mobile") }} 480w, {{ asset("/uploads/category/$category->homepage_side") }} 768w" src="{{ asset("/uploads/category/$category->homepage_side") }}" alt=""
                                class="img-fluid" >
                                <div class="smart-wearables-cont1">
                                    @php
                                        // Split the category name into words
                                        $words = explode(' ', $category->category);
                                        $firstWord = array_shift($words); // Get the first word
                                        $remainingWords = implode(' ', $words); // Get the remaining words
                                    @endphp
                                    <h3>{{ $firstWord }} <span>{{ $remainingWords }}</span></h3>
                                    <a href="{{ route('categorylist', $category->slug) }}" class="view-all-btn">View
                                        All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-8 col-sm-6">
                            <div class="center slider feature-slider-two smart-wearables">
                                @foreach ($category->products->take(10) as $product)
                                    <div>
                                        <div class="best-seller-slider-item">
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
                                                    <a
                                                        href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
                                                </div>
                                                <div class="arrival-image">
                                                    <a href="{{ route('product', $product->slug) }}">
                                                        @if ($product->productImages->isNotEmpty())
                                                            <img src="{{ asset("uploads/products/{$product->productImages->first()->image}") }}"
                                                                alt="{{ $product->name }}" >
                                                        @else
                                                            <img src="https://placehold.co/400x400?text=No+Image+Found!"
                                                                alt="Default Image">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="arrival-members">
                                                    <div class="arrival-ratings1">
                                                        @php
                                                        $product->totalReviews = \App\ProductReview::where('product_id', $product->id)->count();
                                                            $averageRating =
                                                                $product->totalReviews > 0
                                                                    ? number_format(
                                                                        $product->sumOfRatings / $product->totalReviews,
                                                                        1,
                                                                    )
                                                                    : 0;
                                                            $fullStars = floor($averageRating);
                                                            $halfStar =
                                                                $averageRating - $fullStars >= 0.5 ? true : false;
                                                        @endphp

                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $fullStars)
                                                                <i class="ion-android-star"></i>
                                                            @elseif ($halfStar && $i == $fullStars + 1)
                                                                <i class="ion-android-star-half"></i>
                                                            @else
                                                                <i class="ion-android-star grey"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <div class="rating-members">
                                                        <small>{{ $product->totalReviews ?? 0 }} REVIEWS</small>
                                                    </div>
                                                </div>
                                                <div class="arrival-price">
                                                    <h4>Rs.{{ $product->price }}</h4>
                                                    <h5>Rs.{{ $product->mop }}</h5>
                                                </div>
                                                <div class="arrival-buttons d-flex justify-content-between">
                                                    @if ($product->stock > 0)
                                                        <a href="javascript:void(0);" class="add-cart-btn"
                                                            onclick="addToCart({{ $product->id }},1)">Add To Cart</a>

                                                        <a href="javascript:void(0);" class="buy-now-btn"
                                                            onclick="buy_now({{ $product->id }},1)">Buy
                                                            now</a>
                                                    @else
                                                       
                                                    <a href="javascript:void(0);" class="notify-btn w-100 text-center" onclick="notify({{$product->id}})">Notify</a>
                                                       
                                                    @endif
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
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach