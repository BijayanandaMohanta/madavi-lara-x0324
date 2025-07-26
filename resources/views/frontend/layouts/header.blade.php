@include('frontend.layouts.headerstyles')
@php
    $setting = \App\Setting::first();
    $sid = Cookie::get('sid');
    $count_cart = \App\Cart::where('sid', $sid)->sum('quantity');
    $minutes = 43200;
    Cookie::queue('cart_count', $count_cart, $minutes);
@endphp

<body>
    <?php if (Route::is('home')) { ?>
    {{-- <div class="loader">
        <img class="img-responsive" src="{{ asset('frontend/images/logo.svg') }}" alt="logo.jpg">
    </div> --}}
    <?php } ?>
    <!-- Header Section Start From Here -->
    <style>
        .wbsiteunder {
            background-color: #0aa8e3;
            padding: 10px;
        }

        .wbsiteunder h4 {
            margin: 0px;
            padding: 0px;
            color: #fff;
        }

        .mobilecatspanitem {
            top: 10px;
            position: relative;
            color: #fff;
            font-weight: 600;
        }

        .mobilecatgarrowdrop {
            cursor: pointer;
            width: 20px;
            text-indent: -1000px;
            position: relative;
            top: 0px;
            margin-left: auto;
            margin-top: -20px;
        }
    </style>
    <style>
        .cmsbox {
            padding-bottom: 4rem;

            ol {
                list-style: decimal;
                margin: unset;
                padding: unset;
                padding-left: 20px;

                li {
                    display: list-item;
                    /* margin: 0 0 0 20px; */
                    padding: 0;
                    list-style: decimal;

                    img {
                        width: 100px;
                        aspect-ratio: 1;
                        object-fit: cover;
                    }
                }
            }
        }
    </style>
    <header class="header-wrapper">
        <!-- Header Nav Start -->
        {{-- <div class="wbsiteunder"><marquee behavior="alternate" direction=""><h4>Wesbite Is Under Construction</h4></marquee></div> --}}
        <div class="header-nav">
            <div class="container-fluid">
                <div class="header-nav-wrapper d-md-flex d-sm-flex d-xl-flex d-lg-flex justify-content-between">
                    <div class="header-static-nav">
                        <p><img src="{{ asset('frontend/images/icons/header-icons/right.svg') }}"
                                alt="top-right"> What
                            is
                            <span><a href="{{ route('faq') }}">OPEN BOX?</a></span>
                        </p>
                        <p>{{ $setting->welcome_message }}</p>
                    </div>
                    <div class="header-menu-nav">
                        <p><img src="{{ asset('frontend/images/icons/header-icons/bestdeal.svg') }}" alt="">
                            {{ $setting->offer_message }}&nbsp;<a href="{{ route('offer') }}"><span>SHOP
                                    NOW!</span></a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Nav End -->
        <div class="header-top bg-white ptb-30px">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <div class="logo">
                            <a href="{{ route('home') }}"><img class="img-responsive"
                                    src="{{ asset("site_settings/$setting->logo") }}"
                                    alt="{{ asset("site_settings/$setting->site_name") }}" class="img-fluid"></a>
                        </div>
                    </div>
                    <div class="col-xxl-7 col-xl-7  col-lg-8 col-md-12 col-sm-12 col-12 align-self-center">
                        <div class="header-right-element d-flex">
                            <div class="search-element media-body">
                                <form class="d-flex" action="{{ route('search_result') }}" method="GET">
                                    @csrf
                                    <div class="search-category">
                                        <select name="slug">
                                            <option value="">All categories</option>
                                            @php
                                                $categories = \App\Category::where('status', 1)->get();
                                            @endphp
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->slug }}"
                                                    @if (isset($_GET['slug']) && $_GET['slug'] == $category->slug) selected @endif>
                                                    {{ $category->category }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="text" name="keyword" autocomplete="off"
                                        placeholder="Search Products " class="search-field search"
                                        value="{{ old('keyword', request('keyword') ?? '') }}" />
                                    <style>
                                        .result ul {
                                            position: absolute;
                                            left: 0;
                                            top: 4rem;
                                            background: #fff;
                                            padding: 2rem;
                                            border-radius: 8px;
                                            overflow-y: scroll;
                                            height: 20rem;
                                            max-height: 20rem !important;
                                            width: 100%;
                                            z-index: 99999;
                                            border: 1px solid #ccc;
                                            box-shadow: 0 0 15px rgb(0 0 0 / 11%);

                                            li {
                                                padding: 0.5rem 0;
                                                border-bottom: 1px solid #ccc
                                            }

                                            li:last-child {
                                                border-bottom: none;
                                            }

                                            a {
                                                text-decoration: none;
                                                color: #000;
                                            }

                                            img {
                                                width: 4rem;
                                            }
                                        }

                                        /* Custom scrollbar styles */
                                        .result ul::-webkit-scrollbar {
                                            width: 5px;
                                            /* Adjust the width here */
                                        }

                                        .result ul::-webkit-scrollbar-thumb {
                                            background-color: #232323;
                                            /* Thumb color */
                                            border-radius: 10px;
                                            /* Rounded corners */
                                        }

                                        .result ul::-webkit-scrollbar-track {
                                            background: #f1f1f1;
                                            /* Track color */
                                            border-radius: 10px;
                                            /* Rounded corners */
                                        }
                                    </style>
                                    <div class="search_result" style="display: none">
                                        <div class="result"></div>
                                    </div>
                                    <button type="submit"><img src="{{ asset('frontend/images/header-search.png') }}"
                                            alt=""></button>
                                </form>
                            </div>
                            <!--Cart info Start -->
                            <div class="header-nav">
                                <ul class="menu-nav">
                                    <li>
                                        <a href="{{ route('userwishlist') }}" class="wishlist-bg"><img
                                                src="{{ asset('frontend/images/icons/header-icons/fav.svg') }}"
                                                alt="wishlist"> </a>
                                    </li>

                                    <li class="pr-0">
                                        <div class="dropdown">
                                            <a href="#" class="cart-addon"
                                                data-number="{{ Cookie::get('cart_count') ?? 0 }}" id="cart-count"
                                                data-bs-toggle="dropdown"><img
                                                    src="{{ asset('frontend/images/icons/header-icons/cart.svg') }}"
                                                    alt=""> </a>
                                            <ul class="dropdown-menu animation slideDownIn productitembox"
                                                id="cart_count_fetch" aria-labelledby="dropdownMenuButton-2">
                                                @include('frontend.layouts.shopping-cart')
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="pr-0">
                                        <div class="dropdown">
                                            <button type="button" id="dropdownMenuButton-3" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"><img
                                                    src="{{ asset('frontend/images/icons/header-icons/profile.svg') }}"
                                                    alt="">
                                            </button>

                                            <ul class="dropdown-menu animation slideDownIn"
                                                aria-labelledby="dropdownMenuButton-3">
                                                <div class="login-module border-0 pb-1">
                                                    @php
                                                        $customer = \App\Customer::find(Session::get('customer_id'));
                                                    @endphp
                                                    <p>{{ $customer->name ?? 'New Customer' }}</p>
                                                    <h4>
                                                        <span>
                                                            @if (session()->has('customer_id'))
                                                                <a href="{{ route('userprofile') }}">→ Go To
                                                                    Dashboard</a> <br>
                                                                <a href="{{ route('userlogout') }}">→ Logout</a>
                                                            @else
                                                                <a href="{{ route('userlogin') }}">Login/Sign Up</a>
                                                            @endif
                                                        </span>
                                                    </h4>
                                                </div>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--Cart info End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Nav End -->
        <div class="header-menu bg-blue sticky-nav padding-0px">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xxl-3 col-xl-3 col-lg-3 custom-col-2">
                        <div class="header-menu-vertical">
                            <h4 class="menu-title d-lg-block d-md-none">Shop Categories</h4>
                            <h4 class="menu-title d-lg-none d-block"><a data-bs-toggle="offcanvas"
                                    href="#categoriesMenu">Shop Categories</a></h4>
                            <ul class="menu-content display-none">
                                @php
                                    $categories = \App\Category::where('status', 1)->get();
                                @endphp

                                @foreach ($categories as $category)
                                    @if ($category)
                                        <li class="menu-item">
                                            <a
                                                href="{{ route('categorylist', $category->slug ?? 'default') }}">{{ $category->category }}</a>

                                            @php
                                                $subcategories = \App\Scategory::where('category_id', $category->id)
                                                    ->where('status', 1)
                                                    ->get();
                                            @endphp

                                            @php
                                                $hasAnyChildCategories = false;
                                                foreach ($subcategories as $subcategory) {
                                                    $hasChildCategories = \App\Ccategory::where(
                                                        'category_id',
                                                        $category->id
                                                    )
                                                        ->where('sub_category_id', $subcategory->id)
                                                        ->where('status', 1)
                                                        ->exists();
                                                    if ($hasChildCategories) {
                                                        $hasAnyChildCategories = true;
                                                        break;
                                                    }
                                                }
                                            @endphp

                                            @if ($hasAnyChildCategories)
                                                {{-- // This category has at least one subcategory with child categories --}}
                                                @if ($subcategories->isNotEmpty())
                                                    <ul class="sub-menu flex-wrap">
                                                        @foreach ($subcategories as $subcategory)
                                                            <li>
                                                                <a
                                                                    href="{{ route('subcategorylist', $subcategory->slug ?? 'default') }}">
                                                                    <span><strong>{{ $subcategory->category }}</strong></span>
                                                                </a>
                                                                @php
                                                                    $childcategories = \App\Ccategory::where(
                                                                        'category_id',
                                                                        $category->id
                                                                    )
                                                                        ->where('sub_category_id', $subcategory->id)
                                                                        ->where('status', 1)
                                                                        ->get();
                                                                @endphp
                                                                @if ($childcategories->isNotEmpty())
                                                                    <ul class="submenu-item">
                                                                        @foreach ($childcategories as $childcategory)
                                                                            <li>
                                                                                <a
                                                                                    href="{{ route('childcategorylist', $childcategory->slug ?? 'default') }}">{{ $childcategory->category }}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            @else
                                                {{-- // This category does not have any subcategories with child categories --}}
                                                @if ($subcategories->isNotEmpty())
                                                    <ul class="sub-menu sub-menu-2">
                                                        <li>
                                                            <ul class="submenu-item">
                                                                @foreach ($subcategories as $subcategory)
                                                                    <li>
                                                                        <a
                                                                            href="{{ route('subcategorylist', $subcategory->slug ?? 'default') }}">{{ $subcategory->category }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                @endif
                                            @endif

                                        </li>
                                    @endif
                                @endforeach

                                <script>
                                    document.querySelectorAll('.menu-item').forEach(item => {
                                        const subMenu = item.querySelector('.sub-menu');
                                        if (subMenu) {
                                            const link = item.querySelector('a');
                                            const icon = document.createElement('i');
                                            icon.className = 'ion-ios-arrow-right';
                                            link.appendChild(icon);
                                        }
                                    });
                                </script>
                            </ul>
                        </div>
                    </div>
                    <div class="mobilemenu"><a data-bs-toggle="offcanvas" href="#topMenu"><i
                                class="fal fa-bars fa-2x text-white"></i></a></div>
                    <div class="col-xxl-3 col-xl-3 col-lg-9 custom-col-2">
                        <div class="header-horizontal-menu">
                            <ul class="menu-content">
                                {{-- <li class="active menu-dropdown">
                                    <a href="{{ route('home') }}">HOME</a>
                                </li> --}}
                                @php

                                    $categories = App\Category::where('status', 1)
                                        ->where('display_menu', 1)
                                        ->where('priority', '>', 0)
                                        ->orderBy('priority', 'asc')
                                        ->get();
                                @endphp
                                @foreach ($categories as $category)
                                    <li class="menu-dropdown">
                                        <a
                                            href="{{ route('categorylist', $category->slug) }}">{{ $category->category }}</a>
                                    </li>
                                @endforeach

                                {{-- <li class="menu-dropdown">
                                    <a href="{{ route('categorylist', 'demo') }}">IT Accessories</a>
                                </li>
                                <li class="menu-dropdown">
                                    <a href="{{ route('categorylist', 'demo') }}">Smart Wearables</a>
                                </li>
                                <li class="menu-dropdown">
                                    <a href="{{ route('categorylist', 'demo') }}">Gaming</a>
                                </li>
                                <li class="menu-dropdown">
                                    <a href="{{ route('categorylist', 'demo') }}">Tablets</a>
                                </li>
                                <li class="menu-dropdown"><a href="{{ route('categorylist', 'demo') }}">Audio</a></li>
                                <li><a href="{{ route('categorylist', 'demo') }}">Mobile <small>ACCESSORIES</small></a>

                                </li>
                                <li><a href="{{ route('categorylist', 'demo') }}">CAMERA &
                                        <small>ACCESSORIES</small></a></li>
                                <li>
                                    <a href="{{ route('shopbybrand', 'brandname') }}">SHOP BY BRAND</a>
                                </li> --}}
                                <li>
                                    <a href="{{ route('shopbybrand') }}">SHOP BY BRAND</a>
                                </li>
                            </ul>
                        </div>
                        <!-- header horizontal menu -->
                        <!-- <div class="intro-text-shipping text-end">
                                <div class="free-ship"><a href="#">SHOP BY BRAND</a></div>
                            </div> -->
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- header menu -->
    </header>
    <!-- Header Section End Here -->


    <!--mobile menu -start-->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="topMenu" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Main Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i
                    class="fal fa-times-circle fa-lg"></i></button>
        </div>
        <div class="offcanvas-body">
            @if (session()->has('customer_id'))
                <div class="card bg-white p-3 mb-3">
                    <div class="d-flex">
                        <div class="prfimg"><img src="{{ asset('frontend/images/profileimg.jpg') }}" alt="">
                        </div>
                        <div class="prfcontent">
                            <p>Hello</p>
                            @php
                                $customer = \App\Customer::find(Session::get('customer_id'));
                            @endphp
                            <h4>{{ $customer->name }}</h4>
                        </div>
                    </div>
                </div>
            @endif
            <ul>
                @if (session()->has('customer_id'))
                    <ul id="topmenu">
                        <li><a href="#" class="has-arrow">Dashboard Menu</a>
                            <ul>
                                <li {{ Route::is('userprofile') ? 'class="active"' : '' }}><a
                                        href="{{ route('userprofile') }}"><object
                                            data="{{ asset('frontend/images/dashboard/dashicon-1.svg') }}"
                                            type="image/svg+xml"></object> My
                                        Profile</a></li>
                                <li {{ Route::is('userorders') ? 'class="active"' : '' }}><a
                                        href="{{ route('userorders') }}"><object
                                            data="{{ asset('frontend/images/dashboard/dashicon-2.svg') }}"
                                            type="image/svg+xml"></object> My
                                        Orders</a></li>
                                <li {{ Route::is('userwishlist') ? 'class="active"' : '' }}><a
                                        href="{{ route('userwishlist') }}"><object
                                            data="{{ asset('frontend/images/dashboard/dashicon-3.svg') }}"
                                            type="image/svg+xml"></object> My
                                        Wishlist</a></li>
                                <li {{ Route::is('useraddress') ? 'class="active"' : '' }}><a
                                        href="{{ route('useraddress') }}"><object
                                            data="{{ asset('frontend/images/dashboard/dashicon-4.svg') }}"
                                            type="image/svg+xml"></object>
                                        Manage Address</a></li>
                                <li {{ Route::is('userreviews') ? 'class="active"' : '' }}><a
                                        href="{{ route('userreviews') }}"><object
                                            data="{{ asset('frontend/images/dashboard/dashicon-5.svg') }}"
                                            type="image/svg+xml"></object>
                                        Reviews & Ratings</a></li>
                                <li {{ Route::is('userrewards') ? 'class="active"' : '' }}><a
                                        href="{{ route('userrewards') }}"><object
                                            data="{{ asset('frontend/images/dashboard/dashicon-6.svg') }}"
                                            type="image/svg+xml"></object>
                                        Reward's Box</a></li>
                                <li><a href="{{ route('contactus') }}"><object
                                            data="{{ asset('frontend/images/dashboard/dashicon-7.svg') }}"
                                            type="image/svg+xml"></object> Contact Us</a></li>
                                <li><a href="{{ route('userlogout') }}"><object
                                            data="{{ asset('frontend/images/dashboard/dashicon-8.svg') }}"
                                            type="image/svg+xml"></object> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                @endif
                <li><a href="{{ route('home') }}">HOME</a></li>
                @php

                    $categories = App\Category::where('status', 1)
                        ->where('display_menu', 1)
                        ->where('priority', '>', 0)
                        ->orderBy('priority', 'asc')
                        ->get();
                @endphp
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('categorylist', $category->slug) }}">{{ $category->category }}</a>
                    </li>
                @endforeach
                <li><a href="{{ route('shopbybrand') }}">SHOP BY BRAND</a></li>
            </ul>
        </div>
    </div>


    <!--mobile menu -start-->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="categoriesMenu"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Categories</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i
                    class="fal fa-times-circle fa-lg"></i></button>
        </div>
        <div class="offcanvas-body">
            <ul id="categoriesmenu">
                {{-- <li> --}}
                @php
                    $categories = \App\Category::where('status', 1)->get();
                @endphp

                @foreach ($categories as $category)
                    @if ($category)
                        <li>
                            <span onClick="location.href='{{ route('categorylist', $category->slug) }}'"
                                class="mobilecatspanitem">{{ $category->category }}</span>
                            <a class="has-arrow mobilecatgarrowdrop" href="#">--</a>

                            @php
                                $subcategories = \App\Scategory::where('category_id', $category->id)
                                    ->where('status', 1)
                                    ->get();
                            @endphp

                            @php
                                $hasAnyChildCategories = false;
                                foreach ($subcategories as $subcategory) {
                                    $hasChildCategories = \App\Ccategory::where('category_id', $category->id)
                                        ->where('sub_category_id', $subcategory->id)
                                        ->where('status', 1)
                                        ->exists();
                                    if ($hasChildCategories) {
                                        $hasAnyChildCategories = true;
                                        break;
                                    }
                                }
                            @endphp

                            @if ($hasAnyChildCategories)
                                {{-- // This category has at least one subcategory with child categories --}}
                                @if ($subcategories->isNotEmpty())
                                    <ul class="greymenu">
                                        @foreach ($subcategories as $subcategory)
                                            <li style="background-color:#303030">
                                                <span
                                                    onClick="location.href='{{ route('subcategorylist', $subcategory->slug ?? 'default') }}'"
                                                    class="mobilecatspanitem ps-2">{{ $subcategory->category }}</span>
                                                <a class="has-arrow mobilecatgarrowdrop" href="#"
                                                    style="background-color:#303030">--</a>
                                                @php
                                                    $childcategories = \App\Ccategory::where(
                                                        'category_id',
                                                        $category->id
                                                    )
                                                        ->where('sub_category_id', $subcategory->id)
                                                        ->where('status', 1)
                                                        ->get();
                                                @endphp
                                                @if ($childcategories->isNotEmpty())
                                                    <ul>
                                                        @foreach ($childcategories as $childcategory)
                                                            <li style="background-color:#000">
                                                                <a
                                                                    href="{{ route('childcategorylist', $childcategory->slug ?? 'default') }}">{{ $childcategory->category }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            @else
                                {{-- // This category does not have any subcategories with child categories --}}
                                @if ($subcategories->isNotEmpty())
                                    <ul class="greymenu">
                                        <li>
                                            <ul>
                                                @foreach ($subcategories as $subcategory)
                                                    <li>
                                                        <span
                                                            onClick="location.href='{{ route('subcategorylist', $subcategory->slug ?? 'default') }}'"
                                                            class="mobilecatspanitem ps-2">{{ $subcategory->category }}</span>
                                                        <a class="has-arrow mobilecatgarrowdrop" href="#">--</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                @endif
                            @endif

                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <!--mobile-bottom-menu-->
    <div class="mobile-bottom-menu">
        <ul>
            <li><a data-bs-toggle="offcanvas" href="#categoriesMenu"><i class="icon-grid"></i> Categories</a></li>
            <li><a data-bs-toggle="offcanvas" href="#topMenu"><i class="icon-list"></i>Main Menu</a></li>
            <li>
                @if (session()->has('customer_id'))
                    <a href="{{ route('userprofile') }}"><i class="icon-user"></i>Dashboard</a>
                @else
                    <a href="{{ route('userlogin') }}"><i class="icon-user"></i>Login</a>
                @endif

            </li>
            <li><a data-bs-toggle="offcanvas" href="#shoppingCart"><i class="icon-basket"></i>Cart</a></li>
            <li><a href="#"><i class="icon-heart"></i>Wishlist</a></li>
        </ul>
    </div>


    <!--shopping-cart-->
    <!--mobile menu -start-->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="shoppingCart" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="fas fa-shopping-cart"></i> Shopping Cart
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i
                    class="fal fa-times-circle fa-lg"></i></button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="mobileproductitembox">
                <ul id="cart_count_fetch">
                    @include('frontend.layouts.shopping-cart')
                </ul>
            </div>
        </div>
    </div>
