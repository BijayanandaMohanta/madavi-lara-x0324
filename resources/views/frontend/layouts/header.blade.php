<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Madavi Homemade Foods">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Madavi Homemade Foods">
    <title>Madavi Homemade Foods</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets')}}/images/fav.png">
    <link rel="stylesheet preload" href="{{asset('frontend/assets')}}/css/plugins.css" as="style">
    <link rel="stylesheet preload" href="{{asset('frontend/assets')}}/css/style.css" as="style">
</head>

<body class="shop-main-h">
    <div class="rts-header-one-area-one">
        <div class="rts-header-nav-area-one header--sticky">
            <div class="container">
                <div class=" d-none d-md-block">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-sm-3">
                        <div class="logo-search-category-wrapper">
                            <a href="{{route('home')}}" class="logo-area">
                                <img src="{{asset('frontend/assets')}}/images/logo/logo.png" alt="logo-main" class="logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="nav-and-btn-wrapper">
                            <div class="nav-area">
                                <nav>
                                    <ul class="parent-nav">
                                        <li class="parent">
                                            <a class="nav-link" href="{{route('home')}}">Home</a>
                                        </li>
                                        <li class="parent"><a href="{{route('about')}}">About Us</a></li>
                                        <li class="parent has-dropdown">
                                            <a class="nav-link" href="#">Products</a>
                                            <ul class="submenu">
                                                @php
                                                    $categories = App\Models\Category::where('status',1)->get();
                                                @endphp
                                                @foreach ($categories as $category)  
                                                    <li><a class="sub-b" href="{{route('products',$category->slug)}}">{{$category->category}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>

                                        <li class="parent"><a href="{{route('menu')}}">Menu</a></li>
                                        <li class="parent"><a href="{{route('contact')}}">Contact Us</a></li>
                                    </ul>
                                </nav>
                            </div>

                        </div>

                        
                    </div>

                    <div class="col-sm-3">
                        <div class="social-style d-flex justify-content-center">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-whatsapp"></i></a></li>
                                </ul>
                            </div>
                    </div>
                    

                </div>
            </div>


                <div class="row d-flex align-items-center d-block d-md-none">
                        <div class="col-7">
                                <div>
                                    <a href="{{route('home')}}" class="logo-area">
                                        <img src="{{asset('frontend/assets')}}/images/logo/logo.png" alt="logo-main" class="logo" style="width:100px">
                                    </a>
                                </div>
                        </div>
                        <div class="col-5">
                            <div class="menu-btn float-end" id="menu-btn">
                                    <a href="#">
                                        <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect y="14" width="20" height="2" fill="#1F1F25"></rect>
                                            <rect y="7" width="20" height="2" fill="#1F1F25"></rect>
                                            <rect width="20" height="2" fill="#1F1F25"></rect>
                                        </svg>
                                    </a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts header area end -->

    <!-- header style two -->
    <div id="side-bar" class="side-bar header-two">
        <button class="close-icon-menu"><i class="far fa-times"></i></button>

        <div class="mobile-menu-nav-area tab-nav-btn mt--20">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    <!-- mobile menu area start -->
                    <div class="mobile-menu-main">
                        <nav class="nav-main mainmenu-nav mt--30">
                            <ul class="mainmenu metismenu" id="mobile-menu-active">
                                <li>
                                    <a href="{{route('home')}}" class="main">Home</a>
                                </li>
                                <li>
                                    <a href="{{route('about')}}" class="main">About Us</a>
                                </li>

                                <li class="has-droupdown">
                                    <a href="#" class="main">Products</a>
                                    <ul class="submenu mm-collapse">
                                        @php
                                            $categories = App\Models\Category::where('status',1)->get();
                                        @endphp
                                        @foreach ($categories as $category)  
                                            <li><a class="mobile-menu-link" href="{{route('products',$category->slug)}}">{{$category->category}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{route('menu')}}" class="main">Menu</a>
                                </li>
                                <li>
                                    <a href="{{route('contact')}}" class="main">Contact Us</a>
                                </li>
                            </ul>
                        </nav>

                    </div>
                </div>

            </div>

        </div>

    </div>