@extends('frontend.layouts.main')
@section('content')
    <div class="offcanvas-overlay"></div>
    <!--Banner section start-->

    <!-- Slider Start -->
    {{-- <div class="slider-section">
        <div class="swiper-container">
            <div class="slider-area slider-height-1">
                <div class="main-slider">
                    @foreach ($banners as $banner)
                        <div class="slider-banner">
                            <a href="{{ $banner->link }}"><img data-lazy="{{ asset("uploads/banners/$banner->image") }}"
                                    alt=""></a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div> --}}
    <div class="slider-section slider-contain">
        <div class="owl-carousel owl-theme homeSlider">
            @foreach ($banners as $banner)
                <div class="item">
                    <a href="{{ $banner->link }}"><img src="{{ asset("uploads/banners/$banner->image") }}"
                            alt=""></a>
                </div>
            @endforeach
        </div>
        <div class="custom-dots"></div>
    </div>

    <!-- Slider End -->
    <!--Banner section end-->
    <!--FEATURES START-->
    <div class="static-area mt-0">
        <div class="container-fluid">
            <div class="static-area-wrap">
                <div class="row justify-content-center align-items-center">
                    <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-7 col-12">
                        <div class="row align-items-center">
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-xs-12 col-md-6 col-sm-6 mb-md-30px mb-lm-30px">
                                <a href="{{ route('contactus') }}">
                                    <div class="single-static">
                                        <span class="single-static-span">
                                            <img src="https://www.svgrepo.com/show/365880/whatsapp-logo-thin.svg" alt="#"
                                                class="img-responsive">
                                        </span>
                                        <style>
                                            @media (width <  40rem){
                                                #wp-support-mini-card{
                                                    flex-basis: 0;
                                                }
                                            }
                                            @media (width >  40rem){
                                                /* #wp-support-mini-card h4 b{
                                                    white-space: nowrap;
                                                } */
                                                #wp-support-mini-card h4+div{
                                                    text-align: left;
                                                }
                                                .header-shape{
                                                    padding:25px;
                                                }
                                            }
                                        </style>
                                        <div class="single-static-meta" id="wp-support-mini-card">
                                            <h4> 
                                                <b>WHATSAPP SUPPORT </b>
                                            </h4>
                                            <div style="color: #000;font-size: 10px;">
                                                MON TO SAT 2 TO 7PM<br>
                                                +91 8977744691
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-xs-12 col-md-6 col-sm-6 mb-md-30px mb-lm-30px">
                                <a href="{{ route('shoppingpolicy') }}">
                                    <div class="single-static">
                                        <span class="single-static-span">
                                            <img src="{{ asset('frontend/images/icons/free-shipping.png') }}" alt="#"
                                                class="img-responsive">
                                        </span>
                                        <div class="single-static-meta">
                                            <h4><b>Free</b> <br>Shipping</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-xs-12 col-md-6 col-sm-6 mb-md-30px mb-lm-30px">
                                <a href="{{ route('refundpolicy') }}">
                                    <div class="single-static">
                                        <span class="single-static-span">
                                            <img src="{{ asset('frontend/images/icons/return.png') }}" alt="#"
                                                class="img-responsive">
                                        </span>
                                        <div class="single-static-meta">
                                            <h4> <b>FREE</b> <br>Return</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-xs-12 col-md-6 col-sm-6 mb-md-30px mb-lm-30px">
                                <a href="{{ route('paymentpolicy') }}">
                                    <div class="single-static">
                                        <span class="single-static-span">
                                            <img src="{{ asset('frontend/images/icons/payment.png') }}" alt="#"
                                                class="img-responsive">
                                        </span>
                                        <div class="single-static-meta">
                                            <h4> 100% Secure <br> Payment</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12">
                                <p class="text-center"><small>*Terms and Conditions Apply   </small></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-5 col-12">
                        <div class="side-section  header-shape ">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-xs-12 col-md-6 col-sm-12 mb-md-30px mb-lm-30px">
                                    <div class="single-static">
                                        <div class="single-static-meta">
                                            <span><img src="{{ asset('frontend/images/icons/total-reviews.png') }}"
                                                    alt="#"> Total Reviews</span>
                                            <h3>{{ $summery->total_reviews }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-xs-12 col-md-6 col-sm-12 mb-md-30px mb-lm-30px">
                                    <div class="single-static">
                                        <div class="single-static-meta">
                                            <span><img src="{{ asset('frontend/images/icons/rating.png') }}"
                                                    alt="#">
                                                Average Rating</span>
                                            <h3>{{ $summery->rating_avg }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-xs-12 col-md-6 col-sm-12 mb-md-30px mb-lm-30px">
                                    <div class="single-static border-0">
                                        <div class="single-static-meta">
                                            <span><img src="{{ asset('frontend/images/icons/products-sold.png') }}"
                                                    alt="#"> Product SOLD</span>
                                            <h3>{{ $summery->total_product_sold }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--FEATURES END-->
    @if ($newarrivalproducts->isNotEmpty())
        <!--NEW ARRIVAL START-->
        <div class="feature-area mt-60px mb-30px ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-12">
                        <div class="arrival-section">
                            <div class="new-arrival">
                                <h3>NEW
                                    <span> ARRIVALS</span>
                                </h3>
                            </div>
                            <!-- Add Arrows -->
                        </div>
                    </div>
                    <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-12">
                        <div class="center slider feature-slider-two new-arrivals">
                            @foreach ($newarrivalproducts as $product)
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
                                            <!-- <a href="#" class="add-cart-btn">Add to cart</a> -->
                                            @if ($product->stock > 0)
                                                <a href="javascript:void(0);" class="add-cart-btn"
                                                    onclick="addToCart({{ $product->id }},1)">Add To Cart</a>

                                                <a href="javascript:void(0);" class="buy-now-btn"
                                                    onclick="buy_now({{ $product->id }},1)">Buy
                                                    now</a>
                                            @else
                                                <a href="javascript:void(0);" class="notify-btn w-100 text-center"
                                                    onclick="notify({{ $product->id }})">Notify</a>
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
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Feature Area start -->
    <!-- category Area Start -->
    <div class="popular-categories-area">
        <div class="container-fluid">

            <div class="category-slider slider">
                @foreach ($categories as $category)
                    <div>
                        <div class="category-slider-item">
                            <div class="category-slider-bg ">
                                <div class="thumb-category">
                                    <a href="{{ route('categorylist', $category->slug) }}">
                                        <img src="https://images.weserv.nl/?url={{ asset("uploads/category/$category->image") }}&w=200&h=200" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="category-discript">
                                <h4>{{ $category->category }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>



        </div>
    </div>
    <!-- category Area End -->
    <!-- Feature Area End -->
    <!--NEW ARRIAVAL END-->
    <!--TESTIMONIAL SECTION START-->
    <div class="testi-slider">
        <div class="container-fluid">
            <div class="testimonial slider">
                @foreach ($testimonials as $testimonial)
                    <div>
                        <div class="testimonial-slider-item">
                            <div class="testimonial-slider-bg ">
                                <div class="clinet-testi">
                                    <div class="client-img">
                                        <img src="https://images.weserv.nl/?url={{ asset("uploads/testimonial/$testimonial->profile_image") }}&w=200&h=200"
                                            alt="">
                                    </div>
                                    <div class="client-details">
                                        <h4>{{ $testimonial->name }}</h4>
                                        <div class="arrival-ratings">
                                            @php
                                                $maxRating = 5;
                                                $rating = $testimonial->rating ?? 0;
                                            @endphp
                                            @for ($i = 1; $i <= $maxRating; $i++)
                                                @if ($i <= $rating)
                                                    <i class="ion-android-star"></i>
                                                @else
                                                    <i class="ion-android-star-outline"></i>
                                                @endif
                                            @endfor

                                        </div>
                                        <p>{{ $testimonial->review }}</p>
                                        <h5>{{ $testimonial->designation }}</h5>
                                        <h6><span>City: </span>{{ $testimonial->city }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!--TESTIMONIAL END-->
    @if ($recentlysoldproducts->isNotEmpty())
        <!--BEST SELLER START-->
        <div class="feature-area mt-60px mb-30px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-12">
                        <div class="arrival-section">
                            <div class="new-arrival">
                                <h3>RECENTLY
                                    <span> SOLD</span>
                                </h3>
                            </div>
                            <!-- Add Arrows -->
                        </div>
                    </div>
                    <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-12">
                        <div class="center slider feature-slider-two new-arrivals">
                            @foreach ($recentlysoldproducts as $product)
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
                                            <a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
                                        </div>
                                        <div class="arrival-image">
                                            <a href="{{ route('product', $product->slug) }}">
                                                <img src="{{ asset("uploads/products/$product->image") }}"
                                                    alt="{{ $product->name }}"></a>
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
                                            @if ($product->stock > 0)
                                                <a href="javascript:void(0);" class="add-cart-btn"
                                                    onclick="addToCart({{ $product->id }},1)">Add To Cart</a>

                                                <a href="javascript:void(0);" class="buy-now-btn"
                                                    onclick="buy_now({{ $product->id }},1)">Buy
                                                    now</a>
                                            @else
                                                <a href="javascript:void(0);" class="notify-btn w-100 text-center"
                                                    onclick="notify({{ $product->id }})">Notify</a>
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
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!--SELLER-2 SECTION START-->
    @foreach ($categoriesofproducts->take(2) as $category)
        @if ($category->products->isNotEmpty())
            <div class="seller-slider">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="seller-slider-image">
                                <img srcset="{{ asset("/uploads/category/$category->homepage_side_mobile") }} 480w, {{ asset("/uploads/category/$category->homepage_side") }} 768w"
                                    src="{{ asset("/uploads/category/$category->homepage_side") }}" alt=""
                                    class="img-fluid">
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
                                                            $product->totalReviews = \App\ProductReview::where(
                                                                'product_id',
                                                                $product->id
                                                            )->count();
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
                                                        <a href="javascript:void(0);" class="notify-btn w-100 text-center"
                                                            onclick="notify({{ $product->id }})">Notify</a>
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
    <!--SELLER-2 END-->
    <!-- BEST SELLER END -->
    <!--TRENDING START-->
    <!-- Slider Start -->
    <div class="add-section">
        <div class="container-fluid">
            <div class="offers-slider slider">
                @foreach ($ads as $ad)
                    @if ($ad->type == 'Home Ad1')
                        <div>
                            <a href="{{ $ad->link }}"><img src="{{ asset("uploads/ads/$ad->image") }}"
                                    srcset="{{ asset("uploads/ads/$ad->image") }}, {{ asset("uploads/ads/$ad->image") }} 576w"
                                    class="w-100" alt=""></a>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </div>
    <!-- Slider End -->

    <!--TRENDING END-->
    @if ($trendingproducts->isNotEmpty())
        <!--BEST SELLER START-->
        <div class="feature-area mt-60px mb-30px">
            <div class="container-fluid">
                <div class="row trendbox">
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-12">
                        <div class="arrival-section">
                            <div class="new-arrival">
                                <h3>
                                    <span> TRENDING</span>
                                </h3>
                            </div>
                            <!-- Add Arrows -->
                        </div>
                    </div>
                    <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-12">
                        <div class="center slider feature-slider-two new-arrivals">
                            @foreach ($trendingproducts as $product)
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
                                                <a href="javascript:void(0);" class="notify-btn w-100 text-center"
                                                    onclick="notify({{ $product->id }})">Notify</a>
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
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @foreach ($categoriesofproducts->slice(2)->take(2) as $category)
        @if ($category->products->isNotEmpty())
            <div class="seller-slider">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="seller-slider-image">
                                <img srcset="{{ asset("/uploads/category/$category->homepage_side_mobile") }} 480w, {{ asset("/uploads/category/$category->homepage_side") }} 768w"
                                    src="{{ asset("/uploads/category/$category->homepage_side") }}" alt=""
                                    class="img-fluid">
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
                                                            $product->totalReviews = \App\ProductReview::where(
                                                                'product_id',
                                                                $product->id
                                                            )->count();
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
                                                        <a href="javascript:void(0);" class="notify-btn w-100 text-center"
                                                            onclick="notify({{ $product->id }})">Notify</a>
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
    @if ($bestsellingproducts->isNotEmpty())
        <!--NEW ARRIVAL START-->
        <div class="feature-area mt-60px mb-30px" id="best-seller-section">
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

    @foreach ($categoriesofproducts->slice(4) as $category)
        @if ($category->products->isNotEmpty())
            <div class="seller-slider">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="seller-slider-image">
                                <img srcset="{{ asset("/uploads/category/$category->homepage_side_mobile") }} 480w, {{ asset("/uploads/category/$category->homepage_side") }} 768w"
                                    src="{{ asset("/uploads/category/$category->homepage_side") }}" alt=""
                                    class="img-fluid">
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
                                                            $product->totalReviews = \App\ProductReview::where(
                                                                'product_id',
                                                                $product->id
                                                            )->count();
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
                                                        <a href="javascript:void(0);" class="notify-btn w-100 text-center"
                                                            onclick="notify({{ $product->id }})">Notify</a>
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

    {{-- <div id="category-placeholder"></div>

    <div id="loading-spinner" style="display: none; text-align: center; padding: 20px;">
        <span class="loader-new"></span>
        <style>
            .loader-new {
                width: 48px;
                height: 48px;
                border: 5px solid #000;
                border-bottom-color: transparent;
                border-radius: 50%;
                display: inline-block;
                box-sizing: border-box;
                animation: rotation 1s linear infinite;
            }

            @keyframes rotation {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }
        </style>
    </div> --}}


    <!-- BEST SELLER END -->
    <!-- Slider Start -->
    <div class="container-fluid pe-0 ps-0">

        <div class="center ads-slider slider end-slider">
            @foreach ($ads as $ad)
                @if ($ad->type == 'Home Ad2')
                    <div>
                        <div class="ads-banner bg-img d-flex">
                            <a href="{{ $ad->link }}"><img src="{{ asset("uploads/ads/$ad->image") }}"
                                    alt=""></a>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>

    </div>
    <!-- Slider End -->
    <!-- Instagram Youtube videos start -->
    <div class="insta-videos-area">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-xl-4 col-lg-4">
                    <div class="insta-heading">
                        <h6>FOLLOW US ON <img src="{{ asset('frontend/images/instagram-logo.png') }}" class="img-fluid">
                            <img src="{{ asset('frontend/images/youtube-logo.png') }}" class="img-fluid">
                        </h6>
                    </div>
                </div>
            </div>
            <div class="video-slider">
                @php
                    function get_video_id($url)
                    {
                        preg_match('/shorts\/([a-zA-Z0-9_-]+)/', $url, $matches);
                        return $videoId = $matches[1] ?? null;
                    }
                @endphp
                @foreach ($videos as $video)
                    @if ($video->link != '' && $video->link != '#')
                        <div>
                                @php
                                    $url = $video->link;

                                    $video_id = get_video_id($video->link);
                                    $video_url = 'https://www.youtube.com/embed/' . $video_id;
                                    // echo $video_url;
                                @endphp
                            <div class="insta-slider-item">
                                {{-- <iframe width="100%" style="aspect-ratio: 9/16;" src="{{ $video_url }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe> --}}
                                <lite-youtube videoid="{{$video_id}}" playlabel="" width="100%" style="max-width: 262px; aspect-ratio: 9/16;"></lite-youtube>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
           
    <!-- Instagram Youtube videos end -->
    @include ('frontend.brandscroll')
    @if ($notify && $notify->product_name)
        <div class="ProductPopup" id="popup">
            <div class="d-flex">
                <div class="close" id="closePopup">×</div>
                @if ($notify->product_image != 'no-image')
                    <img src="{{ asset("uploads/products/$notify->product_image") }}"
                        alt="{{ $notify->product_name }}" style="object-fit: contain;">
                @else
                    <img src="https://placehold.co/400x400?text=No+Image+Found!" alt="{{ $notify->product_name }}"
                        style="object-fit: contain;">
                @endif

                <div class="info">
                    <h5>Bought {{ $notify->time_of_purchase }}</h5>
                    <h6>{{ $notify->category }}</h6>
                    <p>{{ $notify->product_name }}</p>
                    <div class="d-lg-block d-md-block d-sm-block d-none">
                        <div class="user-info">
                            <img src="{{ asset('frontend/images/gift.png') }}" alt="User Icon">
                            <div>
                                <h6>{{ $notify->customer_name }}</h6>
                                <p>{{ $notify->city }} {{ $notify->time_of_purchase }}<br>{{ $notify->date_of_purchase }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info d-lg-none d-md-noe d-sm-none d-block">
                <div class="user-info w-100">
                    <img src="{{ asset('frontend/images/gift.png') }}" alt="User Icon">
                    <div>
                        <h6>{{ $notify->customer_name }}</h6>
                        <p>{{ $notify->city }} {{ $notify->time_of_purchase }}<br>{{ $notify->date_of_purchase }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Footer Area Start -->
@endsection
