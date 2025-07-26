<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') | AI Abrish Islamic Academy</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('main_assets/images/favicon.png') }}" />
    <meta name="keywords" content="AI Abrish Islamic Academy" />
    <meta name="description" content="AI Abrish Islamic Academy" />
    <!-- SOCIAL MEDIA META -->
    <meta property="og:description" content="AI Abrish Islamic Academy">
    <meta property="og:image" content="">
    <meta property="og:site_name" content="AI Abrish Islamic Academy">
    <meta property="og:title" content="AI Abrish Islamic Academy">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">

    <!-- TWITTER META -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@">
    <meta name="twitter:creator" content="@">
    <meta name="twitter:title" content="AI Abrish Islamic Academy">
    <meta name="twitter:description" content="AI Abrish Islamic Academy">
    <meta name="twitter:image" content="http://www.themezinho.net/consto/preview.png">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;family=Water+Brush&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('main_assets/vendors/bootstrap/css/bootstrap.min.css?r='. time()) }}" />
    <link rel="stylesheet" href="{{ asset('main_assets/vendors/bootstrap-select/bootstrap-select.min.css?r='. time()) }}" />
    <link rel="stylesheet" href="{{ asset('main_assets/vendors/jquery-ui/jquery-ui.css?r='. time()) }}" />
    <link rel="stylesheet" href="{{ asset('main_assets/vendors/animate/animate.min.css?r='. time()) }}" />
    <link rel="stylesheet" href="{{ asset('main_assets/vendors/fontawesome/css/all.min.css?r='. time()) }}" />
    <link rel="stylesheet" href="{{ asset('main_assets/vendors/eduact-icons/style.css?r='. time()) }}" />
    <link rel="stylesheet" href="{{ asset('main_assets/vendors/jarallax/jarallax.css?r='. time()) }}" />
    <link rel="stylesheet" href="{{ asset('main_assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css?r='. time()) }}" />
    <link rel="stylesheet" href="{{ asset('main_assets/vendors/nouislider/nouislider.min.css?r='. time()) }}" />
    <link rel="stylesheet" href="{{ asset('main_assets/vendors/nouislider/nouislider.pips.css?r='. time()) }}" />
    <link rel="stylesheet" href="{{ asset('main_assets/vendors/odometer/odometer.min.css?r='. time()) }}" />
    <link rel="stylesheet" href="{{ asset('main_assets/vendors/tiny-slider/tiny-slider.min.css?r='. time()) }}" />
    <link rel="stylesheet" href="{{ asset('main_assets/vendors/owl-carousel/assets/owl.carousel.min.css?r='. time()) }}" />
    <link rel="stylesheet" href="{{ asset('main_assets/vendors/owl-carousel/assets/owl.theme.default.min.css?r='. time()) }}" />
    <link rel="stylesheet" href="{{ asset('main_assets/css/styles.css?r='. time()) }}" />
    <link rel="stylesheet" href="{{ asset('main_assets/css/custom.css?r='. time()) }}" />
    <link rel="stylesheet" href="{{ asset('main_assets/css/responsive.css?r='. time()) }}" />
    <link rel="stylesheet" href="{{ asset('main_assets/css/intlTelInput.min.css?r='. time()) }}" />

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body class="custom-cursor1">

<div class="preloader">
    <div class="preloader__image" style="background-image: url({{ asset('main_assets/images/loader.png') }});"></div>
</div>
<!-- /.preloader -->
<div class="topborder">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>
<div class="page-wrapper">
    <header class="main-header">
        <nav class="main-menu main-menu-with-bg">
            <div class="container">
                <div class="main-menu__logo">
                    <a href="#" class="main-menu__toggler mobile-nav__toggler d-md-block d-sm-none d-lg-none d-none"> <i class="fal fa-bars fa-lg"></i></a>
                    <a href="{{ route('main.home') }}">
                        <img src="{{ asset('main_assets/images/logo.png') }}" width="120" height="68" alt="abrish">
                    </a>
                </div>
                <div class="main-menu__nav">
                    <ul class="main-menu__list">
                        <li><a href="{{ route('main.home') }}">Home</a></li>
                        <li><a href="{{ route('main.about_us') }}">About Us</a></li>
                        <li><a href="{{ route('main.courses') }}">Courses</a></li>
                        <li><a href="{{ route('main.faqs') }}">FAQ's</a></li>
                        <li><a href="{{ route('main.blog') }}">Blog</a></li>
                        <li><a href="{{ route('main.contact_us') }}">Contact Us</a></li>
                    </ul>
                </div>
                <div class="main-menu__right">
                    <a href="#" class="main-menu__toggler mobile-nav__toggler d-lg-none d-md-none d-sm-block d-block"> <i class="fal fa-bars fa-lg"></i></a>
                    <a href="{{ route('users.login') }}" class="abrish-btn d-md-block d-sm-none d-none"><span class="abrish-btn__curve"></span><i class="fal fa-lock"></i> Login</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="stricky-header stricked-menu main-menu main-menu-with-bg">
        <div class="sticky-header__content"></div>
    </div>



    <div class="d-lg-none d-md-none d-block">
        <div class="mobile-fixed-bottom-menu">
            <ul>
                <li class="active"><a href="{{ route('main.home') }}"><i class="fal fa-home"></i> Home</a></li>
                <li><a href="login.php"><i class="fal fa-edit"></i> Quizzes</a></li>
                <li><a href="login.php"><i class="fal fa-users"></i> Batches</a></li>
                <li><a href="login.php"><i class="fal fa-lock-alt"></i> Login</a></li>
            </ul>
        </div>
    </div>
