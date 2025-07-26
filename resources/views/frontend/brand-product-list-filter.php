@extends('frontend.layouts.main')
@section('content')
    <div class="offcanvas-overlay"></div>
    <!-- Breadcrumb Area Start -->



    <div class="breadcrumb-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-content">
                        <ul class="nav">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            {{-- <li><a href="{{ route('category', 'camera-and-accessories') }}">Camera &amp; Accessories</a></li> --}}
                            <li>{{ $brand->brand }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End-->

    <!-- Shop Category Area End -->
    <div class="shop-category-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="catgfilters"><a data-bs-toggle="collapse" href="#filterSidebar"><i
                                class="fas fa-sliders"></i> Category Filters</a></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-9 col-xl-9 col-lg-9 order-lg-last col-md-12 order-md-last">
                    <!-- Shop Bottom Area Start -->
                    <div class="catergory-right-sec">
                        <h3 class="blue">{{ $brand->brand }}</h3>
                        <div class="row align-items-center">
                            @foreach ($products as $index => $product)
                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-3 col-6">
                                    <div
                                        class="feature-slider-two slider-nav-style-1 single-product-responsive swiper-initialized swiper-horizontal swiper-pointer-events">
                                        <div class="feature-slider-wrapper">
                                            <!-- Single Item -->
                                            <div class="feature-slider-item swiper-slide">
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
                                                                alt="{{ $product->name }}">
                                                        @else
                                                            <img src="https://placehold.co/400x400?text=No+Image+Found!"
                                                                alt="Default Image">
                                                        @endif
                                                    </a>

                                                </div>
                                                <div class="arrival-members">
                                                    <div class="arrival-ratings1">
                                                        @php
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
                                                        <small>{{ $product->totalReviews }} REVIEWS</small>
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
                                                        
                                                            <a href="#"
                                                                class="notify-btn w-100 text-center">Notify</a>
                                                        
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
                                            <!-- Single Item -->
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                            <div class="pagination">
                                {{ $products->links() }}
                            </div>
                            <!--  Pagination Area Start -->
                            {{-- <div class="pro-pagination-style text-center mb-30px">
                                <ul>
                                    <li><a class="next" href="#"><i class="ion-ios-arrow-left"></i></a></li>
                                    <li><a class="active" href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a class="next" href="#"><i class="ion-ios-arrow-right"></i></a></li>
                                </ul>
                            </div> --}}
                            <!--  Pagination Area End -->
                            <style>
                                div.pagination>nav:nth-child(1) {
                                    margin: auto;
                                }
                            </style>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Area Start -->
                <div class="col-xxl-3 col-xl-3 col-lg-3 order-lg-first1 col-md-12 order-md-0 order-first mb-md-60px mb-lm-60px filtersidebar collapse collapse-horizontal"
                    id="filterSidebar">
                    <div class="d-lg-block">
                        @include('frontend.category-filters')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Category Area End -->
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
                                                <small>{{ $product->stock }} in Stock</small>
                                            </div>
                                        </div>
                                        <div class="arrival-text">
                                            <a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
                                        </div>
                                        <div class="arrival-image">
                                            <a href="{{ route('product', $product->slug) }}">
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
                                                @php
                                                    $averageRating =
                                                        $product->totalReviews > 0
                                                            ? number_format(
                                                                $product->sumOfRatings / $product->totalReviews,
                                                                1,
                                                            )
                                                            : 0;
                                                    $fullStars = floor($averageRating);
                                                    $halfStar = $averageRating - $fullStars >= 0.5 ? true : false;
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
                                                <small>{{ $product->totalReviews }} REVIEWS</small>
                                            </div>
                                        </div>
                                        <div class="arrival-price">
                                            <h4>Rs.{{ $product->price }}</h4>
                                            <h5>Rs.{{ $product->mop }}</h5>
                                        </div>
                                        <div class="arrival-buttons d-flex justify-content-between">
                                            <a href="#" class="add-cart-btn">Add to cart</a>
                                            <a href="{{ route('product', $product->slug) }}" class="buy-now-btn">Buy
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
    <!-- Feature Area start -->

    <!-- Brand area start -->
    @include ('frontend.brandscroll')
    <!-- Brand area end -->
    <!-- Footer Area Start -->
@endsection
