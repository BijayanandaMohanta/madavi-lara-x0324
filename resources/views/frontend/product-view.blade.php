@extends('frontend.layouts.main')
@section('content')
    @php
        function indianFormat($num)
        {
            $num_parts = explode('.', $num);
            $integer_part = $num_parts[0];
            $decimal_part = isset($num_parts[1]) ? '.' . $num_parts[1] : '';

            $last3 = substr($integer_part, -3);
            $rest = substr($integer_part, 0, -3);

            if ($rest != '') {
                $rest = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $rest);
            }

            return $rest . $last3 . $decimal_part;
        }
        $ppid = $product->id;
    @endphp
    <!-- Breadcrumb Area End-->

    <!-- Shop details Area start -->
    <section class="product-details-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                    <div class="product-view d-lg-none d-md-bone">
                        <div class="product-decs">
                            <div class="inner-link">{{ $product->name }}

                                @if ($product->stock <= 0)
                                    <span class="demo" style="color: red;">Out of Stock</span>
                                @elseif ($product->stock == 1)
                                    <span class="in-stock" style="color: orange;">Last Stock</span>
                                @elseif ($product->stock <= $product->min_stock)
                                    <span class="in-stock">{{ $product->stock }} In Stock</span>
                                @else
                                    <span class="in-stock">In Stock</span>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="product-details-area-left">
                        <div class="prostickyoverall">
                            <div class="prodgalleryviewouter">
                                <div class="addwishicon">
                                    <input type="checkbox" id="prodwish" {{ ($wished==1)?"checked":"" }}>
                                    <label for="prodwish"
                                        onclick="addtowish('{{ Session::get('customer_id') }}','{{ $product->id }}')"><i
                                            class="fas fa-circle-heart"></i></label>
                                </div>
                                <div class="slider productslider-nav gallery-thumbs">
                                    @foreach ($product->productimages as $productimage)
                                        <div class="product-slide">
                                            <img src="{{ asset('uploads/products/' . $productimage->image) }}">
                                        </div>
                                    @endforeach
                                    @if ($product->youtube_video)p
                                        @if ($product->youtube_thumbnail)
                                            <div class="product-slide videoslide"><img
                                                    src="{{ asset('uploads/products/' . $product->youtube_thumbnail) }}"> <i
                                                    class="fas fa-play"></i></div>
                                        @else
                                            <div class="product-slide videoslide"><img
                                                    src="https://www.notta.ai/pictures/translate-youtube-video-cover.png">
                                                <i class="fas fa-play"></i>
                                            </div>
                                        @endif
                                    @endif

                                </div>
                                <div class="slider productslider-for gallery-main-image">
                                    @foreach ($product->productimages as $productimage)
                                       <div class="product-slide panzoom-item">
                                            <div class="f-panzoom">
                                            <img class="f-panzoom__content" src="{{ asset('uploads/products/' . $productimage->image) }}">
                                        </div>
                                        </div>
                                    @endforeach
                                    @if ($product->youtube_video)
                                        @php
                                            $videos = $product->youtube_video;
                                            // Initialize variables
                                            $youtube_id = '';

                                            // Check if the URL is a shortened youtu.be link
                                            if (preg_match('/youtu\.be\/([^\?\/]+)/', $videos, $matches)) {
                                                $youtube_id = $matches[1];
                                            }
                                            // Check if the URL is a standard youtube.com link
                                            elseif (preg_match('/\?v=([^\&]+)/', $videos, $matches)) {
                                                $youtube_id = $matches[1];
                                            }

                                            // Construct the embed URL
                                            if ($youtube_id) {
                                                $embed_url = 'https://www.youtube.com/embed/' . $youtube_id;
                                            } else {
                                                $embed_url = ''; // Handle the case where the ID is not found
                                            }
                                        @endphp
                                        @if ($embed_url)
                                            <iframe width="100%" height="500" src="{{ $embed_url }}"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                        @else
                                            <!-- Optional: Add a placeholder or message for unsupported links -->
                                            <p>Invalid YouTube link</p>
                                        @endif
                                    @endif
                                    {{-- <div class="product-slide">
                                        <iframe width="100%" height="500"
                                            src="https://www.youtube.com/embed/8cfPJ9_0UgQ?si=g6Bqm7R50TCnWfjJ?rel=0"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    </div> --}}

                                </div>
                            </div>
                            <div class="relatedproducts-slider">
                                @foreach ($mostRelatedProducts as $mostproduct)
                                    <a href="{{ route('product', $mostproduct->slug) }}">
                                        <div class="relmodelbox">
                                            <div class="modelname">{{ substr($mostproduct->name, 0, 20) }}...</div>
                                            <div class="modelprice">Rs.{{ $mostproduct->price }}</div>
                                        </div>
                                    </a>
                                @endforeach

                            </div>
                            <div class="shipping-sec">
                                <div class="row">
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-6">
                                        <a href="{{ route('shoppingpolicy') }}">
                                            <div class="info-box-icon">
                                                <div class="image-wrapper">
                                                    <img src="{{ asset('frontend/images/category/free-shipping.png') }}">
                                                </div>
                                                <div class="info-box-content">
                                                    <h5 class="info-title">Free <span>Shipping</span></h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-6">
                                        <a href="{{ route('contactus') }}">
                                            <div class="info-box-icon">
                                                <div class="image-wrapper">
                                                    <img src="{{ asset('frontend/images/category/support.png') }}">
                                                </div>
                                                <div class="info-box-content">
                                                    <h5 class="info-title"><span>Support</span> 24/7</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-6">
                                        <a href="{{ route('refundpolicy') }}">
                                            <div class="info-box-icon">
                                                <div class="image-wrapper">
                                                    <img src="{{ asset('frontend/images/category/free-return.png') }}">
                                                </div>
                                                <div class="info-box-content">
                                                    <h5 class="info-title">Free <span>Return</span></h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-6">
                                        <a href="{{ route('paymentpolicy') }}">
                                            <div class="info-box-icon">
                                                <div class="image-wrapper">
                                                    <img src="{{ asset('frontend/images/category/secure-payment.png') }}">
                                                </div>
                                                <div class="info-box-content">
                                                    <h5 class="info-title">100% <span>Secure Payment</span></h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-12">
                                        <p class="text-center"><small>*Terms and condition apply</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 position-relative">
                    <div class="product-view">
                        <div class="breadcrumb-area">
                            <div class="container-fluid ps-0">
                                <div class="row">
                                    <div class="col-xxl-10 col-xl-10 col-md-10 col-sm-8 col-8">
                                        <div class="breadcrumb-content">
                                            <ul class="nav">
                                                <li><a href="{{ route('home') }}">Home</a></li>
                                                @php
                                                    // dd($product->category->slug);
                                                @endphp
                                                <li><a
                                                        href="{{ route('categorylist', $product->category->slug) }}">{{ $product->category->category }}</a>
                                                </li>
                                                {!! $product->subcategory ? "<li>{$product->subcategory->category}</li>" : '' !!}
                                                {!! $product->childcategory ? "<li>{$product->childcategory->category}</li>" : '' !!}
                                                <li>{{ substr($product->name, 0, 15) }}...</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-4 col-4">
                                        <!-- AddToAny BEGIN -->
                                        <div class="a2a_kit a2a_kit_size_16 a2a_default_style float-end">
                                            <a class="a2a_dd" href="https://www.addtoany.com/share"><i
                                                    class="fa fa-share"></i> Share</a>
                                        </div>
                                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                                        <!-- AddToAny END -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-desc-wrap">
                            <div class="product-decs">
                                <div class="inner-link d-lg-block d-mod-block d-none">
                                    {{ $product->name }}
                                    @if ($product->stock <= 0)
                                        <span class="in-stock" style="background: red; color: white;">Out of Stock</span>
                                    @elseif ($product->stock == 1)
                                        <span class="in-stock" style="background: orange; color: white;">Last Stock</span>
                                    @elseif ($product->stock <= $product->min_stock)
                                        <span class="in-stock">{{ $product->stock }} In Stock</span>
                                    @else
                                        <span class="in-stock">In Stock</span>
                                    @endif

                                </div>

                                <div class="rating-product">
                                    <span
                                        class="blue fw-600 mr-8">{{ $totalReviews > 0 ? number_format($sumOfRatings / $totalReviews, 1) : 'N/A' }}</span>
                                    @php
                                        $averageRating =
                                            $totalReviews > 0 ? number_format($sumOfRatings / $totalReviews, 1) : 0;
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
                                    <a href="#">{{ $totalReviews ?? 'N/A' }} Ratings</a> &
                                    <a>{{ $totalReviews ?? 'N/A' }} Reviews</a>

                                </div>
                                <div class="d-flex prdwrapprices">
                                    <div class="arrival-price">
                                        <h4>Rs.{{ indianFormat($product->price) }} Incl. GST</h4>
                                    </div>
                                    <div class="search-result-mrp">
                                        <h5>MRP</h5>
                                        <span>Rs.{{ indianFormat($product->mrp) }}
                                        </span>
                                    </div>
                                    @if ($product->mop > 0)
                                        <div class="search-result-mrp">
                                            <h5>Online</h5>
                                            <span>Rs.{{ indianFormat($product->mop) }}</span>
                                        </div>
                                    @endif
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
                                @if ($product->stock > 0)
                                    <div class="d-flex mt-20">
                                        <div class="form-item">
                                            <style>
                                                input[type="number"] {
                                                    -moz-appearance: textfield;
                                                }

                                                input[type="number"]::-webkit-outer-spin-button,
                                                input[type="number"]::-webkit-inner-spin-button {
                                                    -webkit-appearance: none;
                                                    margin: 0;
                                                }
                                            </style>
                                            <input id="number-input" type="number" value="1" min="1" max="10">

                                            <script>
                                              const numberInput = document.getElementById('number-input');
                                            
                                              numberInput.addEventListener('keydown', function(event) {
                                                  event.preventDefault();
                                              });
                                            
                                            </script>
                                            
                                        </div>
                                        <div class="mobcartbtn">

                                            <a href="javascript:void(0);" class="product-add-cart"
                                                onclick="handleAddToCart({{ $product->id }})">Add To Cart</a>


                                        </div>
                                    </div>
                                    <script>
                                        function handleAddToCart(productId) {
                                            const inputField = document.getElementById('number-input');
                                            let quantity = parseInt(inputField.value); // Get the input value as a number

                                            // If the quantity is more than 1, send 1; otherwise, send the input value
                                            // if (quantity <= 1) {
                                            //     quantity = 1;
                                            // }

                                            addToCart(productId, quantity);
                                        }

                                        // function addToCart(productId, quantity) {
                                        //     console.log(`Product ID: ${productId}, Quantity: ${quantity}`);
                                        //     // Add your logic to send the product and quantity to the cart
                                        // }
                                    </script>
                                    <div class="product-view-buy-now">
                                        @if ($product->price >= 200)
                                        <a href="javascript:void(0);" class="buy-now"
                                        onclick="buy_now({{ $product->id }},1,'Partial COD')">Buy with Partial COD</a>
                                        @endif
                                       @if (Session::get('customer_id') != '')
                                       <a href="javascript:void(0);" class="buy-now"
                                            onclick="buy_now({{ $product->id }},1)">Buy
                                            now</a>
                                        @else
                                        <a href="{{route('userlogin')}}" class="buy-now">Buy now</a>
                                       @endif

                                    </div>
                                @else
                                    <div class="product-view-buy-now">
                                        <a href="javascript:void(0);" class="notify-btn w-100 text-center"
                                            onclick="notify({{ $product->id }})">Notify</a>

                                    </div>
                                @endif

                                <div class="row align-items-center">
                                    <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-7 col-sm-7">
                                        <div class="input-group delivery-sec">
                                            <span>
                                                <h4>Delivery</h4>
                                            </span>
                                            <span>
                                                <input type="text" id="pincode" name="pincode"
                                                    placeholder="Enter Pincode" oninput="validatePincode(this)">
                                                

                                                    <script>
                                                        function validatePincode(input) {
                                                            const pincodeError = document.getElementById('pincode_error');
                                                            const value = input.value;
                                                    
                                                            // Check if the input contains only numbers
                                                            if (!/^\d*$/.test(value)) {
                                                                input.value = value.replace(/\D/g, ''); // Remove non-digit characters
                                                            }
                                                    
                                                            // Check if the input starts with zero
                                                            if (value.startsWith('0')) {
                                                                input.value = value.slice(1); // Remove the leading zero
                                                            }
                                                    
                                                            // Check if the input length exceeds 6 digits
                                                            if (value.length > 6) {
                                                                input.value = value.slice(0, 6); // Trim to 6 digits
                                                            }
                                                    
                                                            // Show error message if the input is invalid
                                                            if (value.length !== 6 || value.startsWith('0')) {
                                                                pincodeError.style.display = 'block';
                                                                input.setCustomValidity('Pincode must be exactly 6 digits and cannot start with zero.');
                                                            } else {
                                                                pincodeError.style.display = 'none';
                                                                input.setCustomValidity('');
                                                            }
                                                        }
                                                    </script>
                                            </span>
                                            <button class="btn-change" type="button" id="button-addon1">Check</button>
                                            <span id="pincode_error" class="text-danger" style="display: none;">Pincode must be exactly 6 digits and cannot start with zero.</span>
                                        </div>
                                    </div>
                                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="delivery-sec1 ps-0">
                                            <h6 id="delivery-estimate"></h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="delivery-sec1">
                                                                                                        <div class="row">
                                                                                                            <div class="col-lg-6 ps-0 offset-lg-2 ps-0">
                                                                                                                <h6>Estimated Delivery between 27 jun 2024 to 29 jun 2024</h6>
                                                                                                            </div>
                                                                                                            <div class="col-lg-4">
                                                                                                                <h6 class="not-service">Pincode is not serviceable</h6>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>   -->
                                <div class="warranty pt-3">
                                    <h6><img src="{{ asset('frontend/images/category/warranty.png') }}"
                                            class="img-fluid"> Warranty and Details</h6>
                                    {!! $product->warranty !!}
                                </div>
                                {{-- <div class="alert alert-success text-center"
                                style="
                                color: #96dbba;
                                background-color: #caffe7;
                                border: 5px solid;
                                ">
                                    <h5>Product will be delivery in 5 to 7 working days</h5>
                                </div> --}}
                                <div class="description">
                                    <h6>Description</h6>
                                    {!! $product->description !!}
                                </div>
                                <div class="highlights">
                                    <h6>Highlights</h6>
                                    {{-- <ul>
                                        <li><a href="javascript:void(0)">Self-Timer, Type C and Mini HDMI, 9 Auto Focus
                                                Points, 3x Optical Zoom, WiFi, Full HD, Video Recording at 1080 p on 30fps,
                                                APS-C CMOS sensor-which is 25 times larger than a typical Smartphone
                                                sensor</a></li>
                                        <li><a href="javascript:void(0)">Effective Pixels : 18 MP</a></li>
                                        <li><a href="javascript:void(0)">Sensor Type : CMOS</a></li>
                                        <li><a href="javascript:void(0)">WiFi Available</a></li>
                                        <li><a href="javascript:void(0)">Full HD</a></li>
                                    </ul> --}}
                                    {!! $product->highlights !!}
                                </div>
                                <div class="specifications">
                                    <h6>Specifications</h6>
                                    {!! $product->specification !!}
                                </div>

                                <div class="comparison-image">
                                    <div class="row">
                                        @if ($product->size_chart_image)
                                            <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                <img src="{{ asset("uploads/products/$product->size_chart_image") }}"
                                                    class="img-fluid">
                                            </div>
                                        @endif
                                        @if ($product->size_chart_image2)
                                            <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                <img src="{{ asset("uploads/products/$product->size_chart_image2") }}"
                                                    class="img-fluid">
                                            </div>
                                        @endif
                                        @if ($product->size_chart_image3)
                                            <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                <img src="{{ asset("uploads/products/$product->size_chart_image3") }}"
                                                    class="img-fluid">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="rating-section border">
                                    <div class="write-review">
                                        <div class="">
                                            <h6>Ratings & Reviews</h6>
                                        </div>
                                        @if (Session::has('customer_id'))
                                            @php
                                                $check = \App\ProductReview::where(
                                                    'customer_id',
                                                    Session::get('customer_id')
                                                )
                                                    ->where('product_id', $product->id)
                                                    ->first();
                                            @endphp
                                            @if (!$check)
                                                <div class="">
                                                    <a href="#ratingsreviewsModal" data-bs-toggle="modal">Write a
                                                        Review</a>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="rating-summary">
                                        <div class="score">
                                            <!-- Display the average rating dynamically -->
                                            <span>{{ $totalReviews > 0 ? number_format($sumOfRatings / $totalReviews, 1) : 'N/A' }}</span>

                                            <div class="arrival-members pb-1">
                                                <div class="arrival-ratings1">
                                                    <!-- Display filled and empty stars based on the average rating -->
                                                    @php
                                                        $averageRating =
                                                            $totalReviews > 0
                                                                ? number_format($sumOfRatings / $totalReviews, 1)
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
                                            </div>

                                            <!-- Display total ratings and reviews -->
                                            <div class="description-rating">{{ $totalReviews }} Ratings &
                                                <br>{{ $totalReviews }} Reviews
                                            </div>
                                        </div>

                                        <!-- Rating distribution section -->
                                        <div class="productviewreviewouter">
                                            <!-- 5 Star Rating Bar -->
                                            <div class="productviewreviewbar" data-rating="5">
                                                <div class="startxt">5 Star</div>
                                                <div class="progress" role="progressbar"
                                                    aria-valuenow="{{ round($ratingPercentages['5_star']) }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar"
                                                        style="width: {{ round($ratingPercentages['5_star']) }}%"></div>
                                                </div>
                                                <div class="prgstatus">{{ round($ratingPercentages['5_star']) }}%</div>
                                            </div>

                                            <!-- 4 Star Rating Bar -->
                                            <div class="productviewreviewbar" data-rating="4">
                                                <div class="startxt">4 Star</div>
                                                <div class="progress" role="progressbar"
                                                    aria-valuenow="{{ round($ratingPercentages['4_star']) }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar"
                                                        style="width: {{ round($ratingPercentages['4_star']) }}%"></div>
                                                </div>
                                                <div class="prgstatus">{{ round($ratingPercentages['4_star']) }}%</div>
                                            </div>

                                            <!-- 3 Star Rating Bar -->
                                            <div class="productviewreviewbar" data-rating="3">
                                                <div class="startxt">3 Star</div>
                                                <div class="progress" role="progressbar"
                                                    aria-valuenow="{{ round($ratingPercentages['3_star']) }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar"
                                                        style="width: {{ round($ratingPercentages['3_star']) }}%"></div>
                                                </div>
                                                <div class="prgstatus">{{ round($ratingPercentages['3_star']) }}%</div>
                                            </div>

                                            <!-- 2 Star Rating Bar -->
                                            <div class="productviewreviewbar" data-rating="2">
                                                <div class="startxt">2 Star</div>
                                                <div class="progress" role="progressbar"
                                                    aria-valuenow="{{ round($ratingPercentages['2_star']) }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar"
                                                        style="width: {{ round($ratingPercentages['2_star']) }}%"></div>
                                                </div>
                                                <div class="prgstatus">{{ round($ratingPercentages['2_star']) }}%</div>
                                            </div>

                                            <!-- 1 Star Rating Bar -->
                                            <div class="productviewreviewbar" data-rating="1">
                                                <div class="startxt">1 Star</div>
                                                <div class="progress" role="progressbar"
                                                    aria-valuenow="{{ round($ratingPercentages['1_star']) }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar"
                                                        style="width: {{ round($ratingPercentages['1_star']) }}%"></div>
                                                </div>
                                                <div class="prgstatus">{{ round($ratingPercentages['1_star']) }}%</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="reviews-container">
                                        @if (!$product_reviews->isEmpty())
                                            <div class="reviewsouter">


                                                @foreach ($product_reviews as $product_review)
                                                    <div class="review">
                                                        <div class="stars">
                                                            <!-- Display the review rating dynamically -->
                                                            <span
                                                                class="black fw-600">{{ number_format($product_review->rating, 1) }}</span>

                                                            <!-- Display stars based on the rating -->
                                                            @php
                                                                $fullStars = floor($product_review->rating); // Calculate the number of full stars
                                                                $halfStar =
                                                                    $product_review->rating - $fullStars >= 0.5
                                                                        ? true
                                                                        : false; // Check if half star is needed
                                                            @endphp

                                                            <!-- Loop through and display stars -->
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

                                                        <!-- Display the review comment -->
                                                        <div class="comment">{{ $product_review->review }}</div>

                                                        <!-- Display the reviewer's name and review date -->
                                                        <div class="name">{{ $product_review->name ?? 'Anonymous' }} -
                                                            <span>{{ $product_review->created_at->format('F d, Y') }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        @else
                                            <div class="reviewsouter">
                                                <span style="color: grey;">No Review Found</span>
                                            </div>
                                        @endif
                                    </div>


                                     @if (!$product_reviews->isEmpty())
                                    <div class="more-reviews">
                                        <a href="" id="reviewHeight">+ More Reviews</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop details Area End -->

    <!--NEW ARRIVAL START-->
    <div class="feature-area mt-60px mb-30px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-12">
                    <div class="arrival-section">
                        <div class="new-arrival">
                            <h3>RELATED
                                <span> PRODUCTS</span>
                            </h3>
                        </div>
                        <!-- Add Arrows -->
                    </div>
                </div>
                <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-12">
                    <div class="center slider feature-slider-two new-arrivals">
                        @foreach ($relatedproducts as $product)
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
                                        <h5>Rs.{{ $product->mrp }}</h5>
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
    <!-- Feature Area start -->

    <!-- Brand area start -->
    @include ('frontend.brandscroll')
    <!-- Brand area end -->



    <!-- review and ratings Modal -->
    <div class="modal fade" id="ratingsreviewsModal" tabindex="-1" aria-labelledby="ratingsreviewsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-3">
                    <h4 class="modal-title fs-5" id="changeaddressModalLabel">Ratings & Reviews</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fal fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body p-0">
                    <form id="reviewForm" action="{{ route('rating_submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $pid }}">
                        <div class="row">
                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                                <div class="form-group p-4 pb-0">
                                    <label for="">Rate this product</label>
                                </div>
                                <div class="form-group p-4 pb-0" style="width: fit-content;">
                                    <div class="reviewratingboxnew">
                                        <input type="radio" name="rating" id="rating-1" value="5"
                                            checked><label for="rating-1"></label>
                                        <input type="radio" name="rating" id="rating-2" value="4"><label
                                            for="rating-2"></label>
                                        <input type="radio" name="rating" id="rating-3" value="3"><label
                                            for="rating-3"></label>
                                        <input type="radio" name="rating" id="rating-4" value="2"><label
                                            for="rating-4"></label>
                                        <input type="radio" name="rating" id="rating-5" value="1"><label
                                            for="rating-5"></label>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group p-4 pt-2">
                                    <label for="">Review this product</label>
                                    <textarea name="review" rows="5" class="form-control" placeholder="Description"></textarea>
                                </div>
                                <div class="form-group pb-4 px-4">
                                    <button type="button" class="btn btn-primary" id="submitReview">Add Review</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .progress {
            cursor: pointer;
        }

        .reviewratingboxnew {
            display: flex;
            flex-direction: row-reverse;
        }

        .reviewratingboxnew input {
            display: none;
        }

        /* when label hover I want the label:before color should change */
        .reviewratingboxnew label:hover:before {
            color: orange;
        }

        /* when hover the left side all star before color should change */
        .reviewratingboxnew label:hover~label:before {
            color: orange;
        }

        /* this is changing the after stars but I want before stars */
        .reviewratingboxnew input:checked~label:before {
            color: orange;
        }
    </style>

@endsection
