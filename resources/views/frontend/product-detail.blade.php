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
                                            <div class="thumb-wrapper one filterd-items figure">
                                                <div class="product-thumb zoom" onmousemove="zoom(event)" style="background-image: url({{asset('frontend/assets')}}/images/shop/01.jpg)"><img src="{{asset('frontend/assets')}}/images/shop/01.jpg" alt="product-thumb">
                                                </div>
                                            </div>
                                            <div class="thumb-wrapper two filterd-items hide">
                                                <div class="product-thumb zoom" onmousemove="zoom(event)" style="background-image: url({{asset('frontend/assets')}}/images/shop/02.jpg)"><img src="{{asset('frontend/assets')}}/images/shop/02.jpg" alt="product-thumb">
                                                </div>
                                            </div>
                                            <div class="thumb-wrapper three filterd-items hide">
                                                <div class="product-thumb zoom" onmousemove="zoom(event)" style="background-image: url({{asset('frontend/assets')}}/images/shop/03.jpg)"><img src="{{asset('frontend/assets')}}/images/shop/03.jpg" alt="product-thumb">
                                                </div>
                                            </div>
                                            <div class="thumb-wrapper four filterd-items hide">
                                                <div class="product-thumb zoom" onmousemove="zoom(event)" style="background-image: url({{asset('frontend/assets')}}/images/shop/04.jpg)"><img src="{{asset('frontend/assets')}}/images/shop/04.jpg" alt="product-thumb">
                                                </div>
                                            </div>
                                            <div class="thumb-wrapper five filterd-items hide">
                                                <div class="product-thumb zoom" onmousemove="zoom(event)" style="background-image: url({{asset('frontend/assets')}}/images/shop/05.jpg)"><img src="{{asset('frontend/assets')}}/images/shop/05.jpg" alt="product-thumb">
                                                </div>
                                            </div>
                                            <div class="product-thumb-filter-group">
                                                <div class="thumb-filter filter-btn active" data-show=".one"><img src="{{asset('frontend/assets')}}/images/shop/01.jpg" alt="product-thumb-filter"></div>
                                                <div class="thumb-filter filter-btn" data-show=".two"><img src="{{asset('frontend/assets')}}/images/shop/02.jpg" alt="product-thumb-filter"></div>
                                                <div class="thumb-filter filter-btn" data-show=".three"><img src="{{asset('frontend/assets')}}/images/shop/03.jpg" alt="product-thumb-filter"></div>
                                                <div class="thumb-filter filter-btn" data-show=".four"><img src="{{asset('frontend/assets')}}/images/shop/04.jpg" alt="product-thumb-filter"></div>
                                                <div class="thumb-filter filter-btn" data-show=".five"><img src="{{asset('frontend/assets')}}/images/shop/05.jpg" alt="product-thumb-filter"></div>
                                            </div>
                                        </div>
                                        <div class="contents">
                                            <div class="product-status">
                                                <span class="product-catagory">Veg Pickles</span>
                                                
                                            </div>
                                            <h2 class="product-title">Mango Avakaya</h2>
                                            <p>Spicy, tangy, and bold Andhra-style delight</p>
                                            <p class="mt--20 mb--20">
                                               Pickle isn't just a side dish—it’s an emotion in every Indian home. Our pickles are slow-cooked, sun-cured, and steeped in tradition
                                            </p>
                                            

                                            <span class="price">Availble Quantity :</span>
                                            <div class="price-tag">
                                                <ul>
                                                    <li class="btn-warning">500 G - <span class="current">₹300/-</span></li>
                                                    <li class="btn-danger">01 KG - <span class="current">₹600/-</span></li>
                                                </ul>
                                            </div>


                                            <div class="product-uniques">
                                                <span class="sku product-unipue mb--10"><span style="font-weight: 400; margin-right: 10px;">SKU: </span> BO1D0MX8SJ</span>
                                                <span class="catagorys product-unipue mb--10"><span style="font-weight: 400; margin-right: 10px;">Categories: </span> T-Shirts, Tops, Mens</span>
                                                <span class="tags product-unipue mb--10"><span style="font-weight: 400; margin-right: 10px;">Tags: </span> fashion, t-shirts, Men</span>
                                                <span class="tags product-unipue mb--10"><span style="font-weight: 400; margin-right: 10px;">LIFE:: </span> 6 Months</span>
                                                <span class="tags product-unipue mb--10"><span style="font-weight: 400; margin-right: 10px;">Type: </span> original</span>
                                                <span class="tags product-unipue mb--10"><span style="font-weight: 400; margin-right: 10px;">Category: </span> Beverages, Dairy & Bakery</span>
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
                                        <p class="disc">
                                            Uninhibited carnally hired played in whimpered dear gorilla koala depending and much yikes off far quetzal goodness and from for grimaced goodness unaccountably and meadowlark near unblushingly crucial scallop tightly neurotic hungrily some and dear furiously this apart.
                                        </p>
                                        <div class="details-row-2">
                                            <div class="left-area">
                                                <img src="{{asset('frontend/assets')}}/images/shop/06.jpg" alt="shop">
                                            </div>
                                            <div class="right">
                                                <h4 class="title">All Natural Italian-Style Chicken Meatballs</h4>
                                                <p class="mb--25">
                                                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. ibero sit amet quam egestas semperAenean ultricies mi vitae est Mauris placerat eleifend.
                                                </p>
                                                <ul class="bottom-ul">
                                                    <li>Elementum sociis rhoncus aptent auctor urna justo</li>
                                                    <li>Habitasse venenatis gravida nisl, sollicitudin posuere</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                    <div class="single-tab-content-shop-details">
                                        <p class="disc">
                                            Uninhibited carnally hired played in whimpered dear gorilla koala depending and much yikes off far quetzal goodness and from for grimaced goodness unaccountably and meadowlark near unblushingly crucial scallop tightly neurotic hungrily some and dear furiously this apart.
                                        </p>
                                        <div class="table-responsive table-shop-details-pd">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Kitchen Fade Defy</th>
                                                        <th>5KG</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>PRAN Full Cream Milk Powder</td>
                                                        <td>3KG</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Net weight</td>
                                                        <td>8KG</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Brand</td>
                                                        <td>Reactheme</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Item code</td>
                                                        <td>4000000005</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Product type</td>
                                                        <td>Powder milk</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <p class="cansellation mt--20">
                                            <span> Return/cancellation:</span> No change will be applicable which are already delivered to customer. If product quality or quantity problem found then customer can return/cancel their order on delivery time with presence of delivery person.
                                        </p>
                                        <p class="note">
                                            <span>Note:</span> Product delivery duration may vary due to product availability in stock.
                                        </p>
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
    <div class="rts-grocery-feature-area rts-section-gap bg_light-1 pt-0">
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
                                <div class="swiper-slide">
                                    <div class="single-shopping-card-one">
                                        <!-- iamge and sction area start -->
                                        <div class="image-and-action-area-wrapper">
                                            <a href="{{route('product')}}" class="thumbnail-preview">

                                                <img src="{{asset('frontend/assets')}}/images/grocery/01.jpg" alt="">
                                            </a>

                                        </div>
                                        <!-- iamge and sction area start -->
                                        <div class="body-content">

                                            <a href="#">
                                                <h4 class="title">Mango Avakaya</h4>
                                            </a>
                                            <p class="mb--10">Spicy, tangy, and bold Andhra-style delight.</p>

                                            <span class="price">Availble Quantity :</span>
                                            <div class="price-tag">
                                                <ul>
                                                    <li class="btn-warning">500 G - <span class="current">₹300/-</span></li>
                                                    <li class="btn-danger">01 KG - <span class="current">₹600/-</span></li>
                                                </ul>
                                            </div>

                                            
                                            <div class="cart-counter-action">
                                                <a href="{{route('product')}}" class="rts-btn btn-primary radious-sm with-icon">
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
                                <!-- single swiper start -->
                                <!-- single swiper start -->
                                <div class="swiper-slide">
                                    <div class="single-shopping-card-one">
                                        <!-- iamge and sction area start -->
                                        <div class="image-and-action-area-wrapper">
                                            <a href="{{route('product')}}" class="thumbnail-preview">

                                                <img src="{{asset('frontend/assets')}}/images/grocery/02.jpg" alt="">
                                            </a>



                                        </div>
                                        
                                        <div class="body-content">

                                            <a href="#">
                                                <h4 class="title">Tomato Pickle</h4>
                                            </a>
                                            <p class="mb--10">Spicy, tangy, and bold Andhra-style delight.</p>

                                            <span class="price">Availble Quantity :</span>
                                            <div class="price-tag">
                                                <ul>
                                                    <li class="btn-warning">500 G - <span class="current">₹300/-</span></li>
                                                    <li class="btn-danger">01 KG - <span class="current">₹600/-</span></li>
                                                </ul>
                                            </div>
                                            
                                            <div class="cart-counter-action">
                                                <a href="{{route('product')}}" class="rts-btn btn-primary radious-sm with-icon">
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
                                <!-- single swiper start -->
                                <!-- single swiper start -->
                                <div class="swiper-slide">
                                    <div class="single-shopping-card-one">
                                        <!-- iamge and sction area start -->
                                        <div class="image-and-action-area-wrapper">
                                            <a href="{{route('product')}}" class="thumbnail-preview">

                                                <img src="{{asset('frontend/assets')}}/images/grocery/03.jpg" alt="grocery">
                                            </a>

                                        </div>
                                        <!-- iamge and sction area start -->
                                        <div class="body-content">

                                            <a href="#">
                                                <h4 class="title">Lemon Pickle</h4>
                                            </a>
                                            <p class="mb--10">Spicy, tangy, and bold Andhra-style delight.</p>

                                            <span class="price">Availble Quantity :</span>
                                            <div class="price-tag">
                                                <ul>
                                                    <li class="btn-warning">500 G - <span class="current">₹300/-</span></li>
                                                    <li class="btn-danger">01 KG - <span class="current">₹600/-</span></li>
                                                </ul>
                                            </div>
                                            <div class="cart-counter-action">
                                                <a href="{{route('product')}}" class="rts-btn btn-primary radious-sm with-icon">
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
                                <!-- single swiper start -->
                                <!-- single swiper start -->
                                <div class="swiper-slide">
                                    <div class="single-shopping-card-one">
                                        <!-- iamge and sction area start -->
                                        <div class="image-and-action-area-wrapper">
                                            <a href="{{route('product')}}" class="thumbnail-preview">

                                                <img src="{{asset('frontend/assets')}}/images/grocery/04.jpg" alt="grocery">
                                            </a>

                                        </div>
                                        <!-- iamge and sction area start -->
                                        <div class="body-content">

                                            <a href="#">
                                                <h4 class="title">Gongura Pickle</h4>
                                            </a>
                                            <p class="mb--10">Spicy, tangy, and bold Andhra-style delight.</p>

                                            <span class="price">Availble Quantity :</span>
                                            <div class="price-tag">
                                                <ul>
                                                    <li class="btn-warning">500 G - <span class="current">₹300/-</span></li>
                                                    <li class="btn-danger">01 KG - <span class="current">₹600/-</span></li>
                                                </ul>
                                            </div>
                                            <div class="cart-counter-action">
                                                <a href="{{route('product')}}" class="rts-btn btn-primary radious-sm with-icon">
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
                                <!-- single swiper start -->
                                <!-- single swiper start -->
                                <div class="swiper-slide">
                                    <div class="single-shopping-card-one">
                                        <!-- iamge and sction area start -->
                                        <div class="image-and-action-area-wrapper">
                                            <a href="{{route('product')}}" class="thumbnail-preview">

                                                <img src="{{asset('frontend/assets')}}/images/grocery/05.jpg" alt="grocery">
                                            </a>

                                        </div>
                                        <!-- iamge and sction area start -->
                                        <div class="body-content">

                                            <a href="#">
                                                <h4 class="title">Garlic Pickle</h4>
                                            </a>
                                            <p class="mb--10">Spicy, tangy, and bold Andhra-style delight.</p>

                                            <span class="price">Availble Quantity :</span>
                                            <div class="price-tag">
                                                <ul>
                                                    <li class="btn-warning">500 G - <span class="current">₹300/-</span></li>
                                                    <li class="btn-danger">01 KG - <span class="current">₹600/-</span></li>
                                                </ul>
                                            </div>
                                            <div class="cart-counter-action">
                                                <a href="{{route('product')}}" class="rts-btn btn-primary radious-sm with-icon">
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
                                <!-- single swiper start -->
                                <!-- single swiper start -->
                                <div class="swiper-slide">
                                    <div class="single-shopping-card-one">
                                        <!-- iamge and sction area start -->
                                        <div class="image-and-action-area-wrapper">
                                            <a href="{{route('product')}}" class="thumbnail-preview">

                                                <img src="{{asset('frontend/assets')}}/images/grocery/06.jpg" alt="grocery">
                                            </a>

                                        </div>
                                        <!-- iamge and sction area start -->
                                        <div class="body-content">

                                            <a href="#">
                                                <h4 class="title">Chilli Pickles </h4>
                                            </a>
                                            <p class="mb--10">Spicy, tangy, and bold Andhra-style delight.</p>

                                            <span class="price">Availble Quantity :</span>
                                            <div class="price-tag">
                                                <ul>
                                                    <li class="btn-warning">500 G - <span class="current">₹300/-</span></li>
                                                    <li class="btn-danger">01 KG - <span class="current">₹600/-</span></li>
                                                </ul>
                                            </div>
                                            <div class="cart-counter-action">
                                                <a href="{{route('product')}}" class="rts-btn btn-primary radious-sm with-icon">
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
                                <!-- single swiper start -->
                                <!-- single swiper start -->
                                <div class="swiper-slide">
                                    <div class="single-shopping-card-one">
                                        <!-- iamge and sction area start -->
                                        <div class="image-and-action-area-wrapper">
                                            <a href="{{route('product')}}" class="thumbnail-preview">

                                                <img src="{{asset('frontend/assets')}}/images/grocery/07.jpg" alt="grocery">
                                            </a>

                                        </div>
                                        <!-- iamge and sction area start -->
                                        <div class="body-content">

                                            <a href="#">
                                                <h4 class="title">Mixed Vegetable Pickle</h4>
                                            </a>
                                            <p class="mb--10">Spicy, tangy, and bold Andhra-style delight.</p>

                                            <span class="price">Availble Quantity :</span>
                                            <div class="price-tag">
                                                <ul>
                                                    <li class="btn-warning">500 G - <span class="current">₹300/-</span></li>
                                                    <li class="btn-danger">01 KG - <span class="current">₹600/-</span></li>
                                                </ul>
                                            </div>
                                            <div class="cart-counter-action">
                                                <a href="{{route('product')}}" class="rts-btn btn-primary radious-sm with-icon">
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
                                <!-- single swiper start -->
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
                                            <select>
                                                <option data-display="Select Category*">All Categories</option>
                                                <option value="1">Veg Pickles</option>
                                                <option value="2">Non-Veg Pickles</option>
                                                <option value="3">Powders</option>
                                                <option value="4">Sweets</option>
                                                <option value="5">Snacks</option>
                                                <option value="6">Ghee</option>
                                            </select>
                                        </div>
                                            <div class="single">
                                            <select>
                                                <option data-display="Select Product*">All Products</option>
                                                <option value="1">Mango Avakaya</option>
                                                <option value="2">Tomato Pickle</option>
                                                <option value="3">Lemon Pickle</option>
                                                <option value="4">Gongura Pickle</option>
                                                <option value="5">Garlic Pickle</option>
                                                <option value="6">Chilli Pickles</option>
                                                <option value="7">Mixed Vegetable Pickle</option>
                                                <option value="8">Ginger</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="contact-form-wrapper--half-area">
                                            <div class="single">
                                            <select>
                                                <option data-display="Select Quantity*">Select Quantity</option>
                                                <option value="1">250 G</option>
                                                <option value="2">500 G</option>
                                                <option value="3">1 KG</option>
                                                <option value="4">2 KG</option>
                                                <option value="5">3 KG</option>
                                                <option value="6">4 KG</option>
                                                <option value="7">5 KG</option>
                                                <option value="8">10 KG</option>
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