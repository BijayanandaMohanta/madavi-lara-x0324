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
                            <li>Search Result</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End-->

    <style>
        .list-product .product-decs .rating-product i{
            color: unset;
        }
    </style>

    <!-- Shop Category Area End -->
    <div class="shop-category-area">
        <div class="container-fluid searchresult">
            <div class="row">
                <div class="col-lg-12">
                    <div class="catgfilters"><a data-bs-toggle="collapse" href="#filterSidebar"><i
                                class="fas fa-sliders"></i> Category Filters</a></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-9 col-xl-9 col-lg-9 order-lg-last col-md-12 order-md-first newsearchresult">
                    {{-- <div class="catgfilters"><a data-bs-toggle="offcanvas" href="#categoryfilters"><i class="fas fa-sliders"></i> Category Filters</a></div> --}}
                    
                    <!-- Shop Bottom Area Start -->
                    <div class="shop-bottom-area mt-35">
                        <div class="search-result-title">
                            <h3 class="blue">Results</h3>
                            @if (!empty($products_data))
                            <p>Price and other details may vary based on product size and color</p>
                            @endif
                        </div>

                        <!-- Check if there are products to display -->
                        @if (empty($products_data))
                            <div class="no-results">
                                <h4 class="text-center">No relevant product found!</h4>
                            </div>
                        @else
                            <!-- Shop Tab Content Start -->
                            @foreach ($products_data as $product)
                                <div class="shop-list-wrap scroll-zoom">
                                    <div class="row list-product m-0px">
                                        <div class="col-md-12 padding-0px">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xxl-3 col-xl-3 ps-0">
                                                    <div class="left-img">
                                                        <div class="img-block">
                                                            <a href="{{ route('product', $product->slug) }}" class="thumbnail">
                                                                 @if ($product->productImages->isNotEmpty())
                                                            <img src="{{ asset("uploads/products/{$product->productImages->first()->image}") }}"
                                                                alt="{{ $product->name }}">
                                                        @else
                                                            <img src="https://placehold.co/400x400?text=No+Image+Found!"
                                                                alt="Default Image">
                                                        @endif
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 col-xxl-9 col-xl-9">
                                                    <div class="product-desc-wrap">
                                                        <div class="product-decs">
                                                            <a class="inner-link" href="{{ route('product', $product->slug) }}">
                                                                {{ $product->name }}
                                                                @if ($product->stock <= 0)
                                                                <span style="color: red;">Out of Stock</span>
                                                            @elseif ($product->stock == 1)
                                                                <span style="color: orange;">Last Stock</span>
                                                            @elseif ($product->stock <= $product->min_stock)
                                                                <span class="in-stock">{{ $product->stock }} in Stock</span>
                                                            @else
                                                                <span class="in-stock">In Stock</span>
                                                            @endif

                                                            </a>
                                                            
                                                            <div class="rating-product">
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
                                                                <span class="blue fw-600 mr-8">{{$averageRating}}</span>
                                                                

                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= $fullStars)
                                                                            <i class="ion-android-star"></i>
                                                                        @elseif ($halfStar && $i == $fullStars + 1)
                                                                            <i class="ion-android-star-half"></i>
                                                                        @else
                                                                            <i class="ion-android-star grey"></i>
                                                                        @endif
                                                                    @endfor
                                                                <a href="javascript:void(0);">{{$product->sumOfRatings ?? 0}} Ratings</a> & <a> {{$product->totalReviews??0}} Reviews</a>
                                                            </div>

                                                            <div class="d-flex">
                                                                <div class="arrival-price">
                                                                    <h4>Rs.{{ $product->price }} Incl. GST</h4>
                                                                </div>
                                                                <div class="search-result-mrp">
                                                                    <h5>MRP</h5>
                                                                    <span>Rs.{{ $product->mrp }}</span>
                                                                </div>
                                                                <div class="search-result-mrp">
                                                                    <h5>MOP</h5>
                                                                    <span>Rs.{{ $product->mop }}</span>
                                                                </div>
                                                                
                                                                    @php
                                                                        $price = $product->price;
                                                                        $mrp = $product->mop;

                                                                        // Calculate percentage off
                                                                        $percentageOff = $mrp > 0 ? (($mrp - $price) / $mrp) * 100 : 0;
                                                                    @endphp
                                                                    @if ($percentageOff >= 1)
                                                                        <div class="arrival-offer1">
                                                                            <h6>{{ round($percentageOff) }}%</h6>
                                                                        </div>
                                                                    @endif
                                                                
                                                            </div>
                                                            <div class="col-lg-5 arrival-buttons d-flex justify-content-start">
                                                                @if ($product->stock > 0)
                                                                    <a href="javascript:void(0);" class="add-cart-btn" onclick="addToCart({{ $product->id }},1)">Add To Cart</a>
                                                                    <a href="javascript:void(0);" class="buy-now-btn" onclick="buy_now({{ $product->id }},1)">Buy now</a>
                                                                @else
                                                                    <div class="arrival-buttons d-flex justify-content-between">
                                                                        <a href="javascript:void(0);" class="notify-btn w-100 text-center" onclick="notify({{$product->id}})">Notify</a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Shop Tab Content End -->
                        @endif
                    </div>
                    <!-- Shop Bottom Area End -->
                </div>
                
                <!-- Sidebar Area Start -->
                <div class="col-xxl-3 col-xl-3 col-lg-3 order-lg-first1 col-md-12 order-md-0 order-first mb-md-60px mb-lm-60px filtersidebar collapse collapse-horizontal"
                    id="filterSidebar">
                    <div class="d-lg-block">
                        @include('frontend.category-filters')
                    </div>
                </div>
                <!-- Sidebar Area End -->
            </div>
        </div>
    </div>
@endsection
