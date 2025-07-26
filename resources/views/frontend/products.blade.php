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

    <div class="shop-grid-sidebar-area rts-section-gap">
        <div class="container">
            <div class="row g-0">
                <div class="col-xl-3 col-lg-12 pr--70 pr_lg--10 pr_sm--10 pr_md--5 rts-sticky-column-item">
                    <div class="sidebar-filter-main theiaStickySidebar">
                        
                        <div class="single-filter-box">
                            <h5 class="title">Product Categories</h5>
                            <div class="filterbox-body">
                                <div class="category-wrapper ">
                                    <!-- single category -->
                                    <div class="single-category">
                                        <input id="cat1" type="checkbox">
                                        <label for="cat1">Veg Pickles
                                        </label>
                                    </div>
                                    <!-- single category end -->
                                    <!-- single category -->
                                    <div class="single-category">
                                        <input id="cat2" type="checkbox">
                                        <label for="cat2">Non-Veg Pickles

                                        </label>
                                    </div>
                                    <!-- single category end -->
                                    <!-- single category -->
                                    <div class="single-category">
                                        <input id="cat3" type="checkbox">
                                        <label for="cat3">Powders
                                        </label>
                                    </div>
                                    <!-- single category end -->
                                    <!-- single category -->
                                    <div class="single-category">
                                        <input id="cat4" type="checkbox">
                                        <label for="cat4">Sweets
                                        </label>
                                    </div>
                                    <!-- single category end -->
                                    <!-- single category -->
                                    <div class="single-category">
                                        <input id="cat7" type="checkbox">
                                        <label for="cat7">Snacks
                                        </label>
                                    </div>
                                    <!-- single category end -->
                                    <!-- single category -->
                                    <div class="single-category">
                                        <input id="cat6" type="checkbox">
                                        <label for="cat6">Ghee
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-filter-box">
                            <h5 class="title">Product Status</h5>
                            <div class="filterbox-body">
                                <div class="category-wrapper">
                                    <!-- single category -->
                                    <div class="single-category">
                                        <input id="cat11" type="checkbox">
                                        <label for="cat11">In Stock

                                        </label>
                                    </div>
                                    <!-- single category end -->
                                    <!-- single category -->
                                    <div class="single-category">
                                        <input id="cat12" type="checkbox">
                                        <label for="cat12">On Sale

                                        </label>
                                    </div>
                                    <!-- single category end -->
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-xl-9 col-lg-12">

                    <div class="row g-4">
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
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
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
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
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
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
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
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
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
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
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
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
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
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
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="single-shopping-card-one">
                                        <!-- iamge and sction area start -->
                                        <div class="image-and-action-area-wrapper">
                                            <a href="{{route('product')}}" class="thumbnail-preview">

                                                <img src="{{asset('frontend/assets')}}/images/grocery/08.jpg" alt="grocery">
                                            </a>

                                        </div>
                                        <!-- iamge and sction area start -->
                                        <div class="body-content">

                                            <a href="#">
                                                <h4 class="title">Ginger</h4>
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
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="single-shopping-card-one">
                                        <!-- iamge and sction area start -->
                                        <div class="image-and-action-area-wrapper">
                                            <a href="{{route('product')}}" class="thumbnail-preview">

                                                <img src="{{asset('frontend/assets')}}/images/grocery/08.jpg" alt="grocery">
                                            </a>

                                        </div>
                                        <!-- iamge and sction area start -->
                                        <div class="body-content">

                                            <a href="#">
                                                <h4 class="title">Ginger</h4>
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
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="single-shopping-card-one">
                                        <!-- iamge and sction area start -->
                                        <div class="image-and-action-area-wrapper">
                                            <a href="{{route('product')}}" class="thumbnail-preview">

                                                <img src="{{asset('frontend/assets')}}/images/grocery/08.jpg" alt="grocery">
                                            </a>

                                        </div>
                                        <!-- iamge and sction area start -->
                                        <div class="body-content">

                                            <a href="#">
                                                <h4 class="title">Ginger</h4>
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
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="single-shopping-card-one">
                                        <!-- iamge and sction area start -->
                                        <div class="image-and-action-area-wrapper">
                                            <a href="{{route('product')}}" class="thumbnail-preview">

                                                <img src="{{asset('frontend/assets')}}/images/grocery/08.jpg" alt="grocery">
                                            </a>

                                        </div>
                                        <!-- iamge and sction area start -->
                                        <div class="body-content">

                                            <a href="#">
                                                <h4 class="title">Ginger</h4>
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
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="single-shopping-card-one">
                                        <!-- iamge and sction area start -->
                                        <div class="image-and-action-area-wrapper">
                                            <a href="{{route('product')}}" class="thumbnail-preview">

                                                <img src="{{asset('frontend/assets')}}/images/grocery/08.jpg" alt="grocery">
                                            </a>

                                        </div>
                                        <!-- iamge and sction area start -->
                                        <div class="body-content">

                                            <a href="#">
                                                <h4 class="title">Ginger</h4>
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
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="single-shopping-card-one">
                                        <!-- iamge and sction area start -->
                                        <div class="image-and-action-area-wrapper">
                                            <a href="{{route('product')}}" class="thumbnail-preview">

                                                <img src="{{asset('frontend/assets')}}/images/grocery/08.jpg" alt="grocery">
                                            </a>

                                        </div>
                                        <!-- iamge and sction area start -->
                                        <div class="body-content">

                                            <a href="#">
                                                <h4 class="title">Ginger</h4>
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
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="single-shopping-card-one">
                                        <!-- iamge and sction area start -->
                                        <div class="image-and-action-area-wrapper">
                                            <a href="{{route('product')}}" class="thumbnail-preview">

                                                <img src="{{asset('frontend/assets')}}/images/grocery/08.jpg" alt="grocery">
                                            </a>

                                        </div>
                                        <!-- iamge and sction area start -->
                                        <div class="body-content">

                                            <a href="#">
                                                <h4 class="title">Ginger</h4>
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
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="single-shopping-card-one">
                                        <!-- iamge and sction area start -->
                                        <div class="image-and-action-area-wrapper">
                                            <a href="{{route('product')}}" class="thumbnail-preview">

                                                <img src="{{asset('frontend/assets')}}/images/grocery/08.jpg" alt="grocery">
                                            </a>

                                        </div>
                                        <!-- iamge and sction area start -->
                                        <div class="body-content">

                                            <a href="{{route('product')}}">
                                                <h4 class="title">Ginger</h4>
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
                            </div>
                </div>
            </div>
        </div>
    </div>


@endsection