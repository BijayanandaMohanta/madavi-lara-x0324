@extends('frontend.layouts.main')
@section('content')

    <div class="rts-navigation-area-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="navigator-breadcrumb-wrapper">
                        <a href="{{route('home')}}">Home</a>
                        <i class="fa-regular fa-chevron-right"></i>
                        <a class="current" href="#">Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- about area start -->
    <div class="rts-chop-details-area rts-section-gap bg_light-1">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-12 mt--0">
                    <div class="shopdetails-style-1-wrapper">
                        <div class="product-details-popup-wrapper in-shopdetails">
                            <div class="rts-product-details-section rts-product-details-section2 product-details-popup-section">
                                <div class="product-details-popup">
                                    <div class="details-product-area">
                                        <div class="product-thumb-area">
                                            <div class="cursor"></div>
                                            @foreach ($product->productimages()->get() as $product_image)
                                                <div class="thumb-wrapper {{"link-".$loop->index}} filterd-items {{$loop->first ? "figure" : "hide"}}">
                                                    <div class="product-thumb zoom" onmousemove="zoom(event)" style="background-image: url({{asset("uploads/products/$product_image->image")}}"><img src="{{asset("uploads/products/$product_image->image")}}" alt="product-thumb">
                                                    </div>
                                                </div>
                                            @endforeach
                                            
                                            <div class="product-thumb-filter-group">
                                                @foreach ($product->productimages()->get() as $product_image)
                                                <div class="thumb-filter filter-btn {{$loop->first ? "active" : ""}}" data-show="{{"link-".$loop->index}}"><img src="{{asset("uploads/products/$product_image->image")}}" alt="product-thumb-filter"></div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="contents">
                                            <div class="product-status">
                                                <span class="product-catagory">{{$product->category->category ?? 'No Category'}}</span>
                                                
                                            </div>
                                            <h2 class="product-title">{{$product->name}}</h2>
                                            {{$product->description}}
                                            <span class="price">Availble Quantity :</span>
                                            <div class="price-tag">
                                                <ul>
                                                    @php
                                                        $btn_color = ['warning','danger','light','dark'];
                                                    @endphp
                                                    @foreach ($product->prices as $price)
                                                        <li class="btn-{{$btn_color[$loop->index]}}">{{$price->quantity}} - <span class="current">₹{{$price->amount}}/-</span></li>
                                                    @endforeach
                                                </ul>
                                            </div>


                                            <div class="product-uniques">
                                                {!!$product->below_description!!}
                                            </div>
                                            
                                            <a href="#" class="rts-btn btn-primary radious-sm with-icon" data-bs-toggle="modal" data-bs-target="#order_now_modal">
                                                    <div class="btn-text">
                                                       Order Now
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa-regular fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa-regular fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-discription-tab-shop mt--50">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Product Details</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Additional Information</button>
                                </li>
                                
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade   show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                    <div class="single-tab-content-shop-details">
                                        <div class="details-row-2">
                                            <div class="left-area">
                                                <img src="{{asset("uploads/products/$product->size_chart_image")}}" alt="shop">
                                            </div>
                                            <div class="right">
                                                <style>
                                                    #myTabContent .right ul{
                                                        display: unset;
                                                    }
                                                </style>
                                                {!!$product->specification!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                    <div class="single-tab-content-shop-details">
                                        <style>
                                            #profile-tab-pane table {
                                                width: 100%;
                                            }
                                            #profile-tab-pane table,
                                            #profile-tab-pane th,
                                            #profile-tab-pane td {
                                                border: 1px solid #dee2e6;
                                            }
                                            #profile-tab-pane table {
                                                border-collapse: collapse;
                                            }
                                            #profile-tab-pane th,
                                            #profile-tab-pane td {
                                                padding: 0.75rem;
                                                vertical-align: top;
                                                background-color: #fff;
                                            }
                                            #profile-tab-pane th {
                                                background-color: #f8f9fa;
                                                font-weight: 500;
                                            }
                                        </style>
                                         {!!$product->highlights!!}
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- rts grocery feature area start -->
    <div class="rts-grocery-feature-area rts-section-gap bg_light-1 pt-0 {{$similarproducts->isEmpty() ? 'd-none' : ''}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-area-between">
                        <h2 class="title-left">
                            Related Product
                        </h2>
                        <div class="next-prev-swiper-wrapper">
                            <div class="swiper-button-prev"><i class="fa-regular fa-chevron-left"></i></div>
                            <div class="swiper-button-next"><i class="fa-regular fa-chevron-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="category-area-main-wrapper-one">
                        <div class="swiper mySwiper-category-1 swiper-data" data-swiper='{
                            "spaceBetween":16,
                            "slidesPerView":6,
                            "loop": true,
                            "speed": 700,
                            "navigation":{
                                "nextEl":".swiper-button-next",
                                "prevEl":".swiper-button-prev"
                            },
                            "breakpoints":{
                            "0":{
                                "slidesPerView":1,
                                "spaceBetween": 12},
                            "380":{
                                "slidesPerView":1,
                                "spaceBetween":12},
                            "480":{
                                "slidesPerView":2,
                                "spaceBetween":12},
                            "640":{
                                "slidesPerView":2,
                                "spaceBetween":16},
                            "840":{
                                "slidesPerView":4,
                                "spaceBetween":16},
                            "1540":{
                                "slidesPerView":4,
                                "spaceBetween":16}
                            }
                        }'>
                            <div class="swiper-wrapper">
                                <!-- single swiper start -->
                                @forelse ($similarproducts as $sproduct)
                                    <div class="swiper-slide">
                                        <div class="single-shopping-card-one">
                                            <!-- iamge and sction area start -->
                                            <div class="image-and-action-area-wrapper">
                                                <a href="{{ route('product', $sproduct->slug) }}" class="thumbnail-preview">
                                                    <img src="{{ asset("uploads/products/{$sproduct->productimages()->first()->image}") }}"
                                                        alt="{{ $sproduct->name }}">
                                                </a>
                                            </div>
                                            <!-- iamge and sction area start -->
                                            <div class="body-content">
                                                <a href="{{ route('product', $sproduct->slug) }}">
                                                    <h4 class="title">{{ $sproduct->name }}</h4>
                                                </a>
                                                <p class="mb--10">{{ \Illuminate\Support\Str::words($sproduct->description, 8) }}</p>

                                                <span class="price">Availble Quantity :</span>
                                                <div class="price-tag">
                                                    <ul>
                                                        @php
                                                            $btn_color = ['warning', 'danger', 'light', 'dark'];
                                                        @endphp
                                                        @foreach ($sproduct->prices as $price)
                                                            <li class="btn-{{ $btn_color[$loop->index] }}">{{ $price->quantity }} -
                                                                <span class="current">₹{{ $price->amount }}/-</span></li>
                                                        @endforeach
                                                    </ul>
                                                </div>


                                                <div class="cart-counter-action">
                                                    <a href="{{ route('product', $sproduct->slug) }}"
                                                        class="rts-btn btn-primary radious-sm with-icon">
                                                        <div class="btn-text">
                                                            Order Now
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No Similar product available</p>
                                @endforelse
                                    
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts grocery feature area end -->


<div class="modal fade" id="order_now_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Order Form</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="contact-form-wrapper-1">
                                    <h5 class="title">Fill Up The Form If You Have Any Question</h5>
                                    <form action="#" class="contact-form-1">
                                        <div class="contact-form-wrapper--half-area">
                                            <div class="single">
                                                <input type="text" placeholder="Name*">
                                            </div>
                                            <div class="single">
                                                <input type="text" placeholder="Email*">
                                            </div>
                                        </div>
                                        <div class="contact-form-wrapper--half-area">
                                            <div class="single">
                                                <input type="text" name="category" value="{{$product->category->category}}" readonly placeholder="Category*">
                                            </div>
                                            <div class="single">
                                                <input type="text" name="product" value="{{$product->name}}" readonly placeholder="Product*">
                                            </div>
                                        </div>
                                        <div class="contact-form-wrapper--half-area">
                                            <div class="single">
                                            <select>
                                                <option data-display="Select Quantity*">Select Quantity</option>
                                                @foreach ($product->prices as $price)
                                                    <option value="{{$price->quantity}}">{{$price->quantity}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                            <div class="single">
                                                <input type="text" placeholder="Mobile*">
                                            </div>
                                        </div>
                                        
                                        <textarea name="message" placeholder="Write Message Here"></textarea>
                                        <button class="rts-btn btn-primary mt--20">Order Now</button>
                                    </form>
                                </div>
      </div>
      
    </div>
  </div>
</div>

    


@endsection