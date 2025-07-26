@php
    $setting = \App\Setting::first();

    $currentRouteName = Route::currentRouteName();
    $currentSlug = request()->route('slug');
    $seo_setting = \App\SeoSetting::where('page_name', $currentRouteName)->first();
    if (!$seo_setting && $currentSlug) {
        $seo_setting = \App\SeoSetting::where('page_name', $currentSlug)->first();
    }
    if (!$seo_setting) {
        $seo_setting = \App\SeoSetting::where('page_name', 'home')->first();
    }
    // product view page
    if($currentRouteName == 'product') {
        $product = \App\Product::where('slug', $currentSlug)->first();
        if ($product) {
            $og_title = $product->name;
            $seo_setting->title = $seo_setting->title." - ".$product->name;
            $seo_setting->keywords = $product->name;
            $og_description = $product->description;
            $og_image = asset('uploads/products/' . $product->productimages->first()->image);
            $og_url = route('product', $product->slug);
        }
    }
@endphp
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{ $seo_setting->title }}</title>

    <meta name="description" content="{{ $seo_setting->description }}">
    <meta name="keywords" content="{{ $seo_setting->keywords }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="Cache-Control" content="max-age=3600, public">

    <meta property="og:title" content="{{$og_title ?? $seo_setting->title}}">
    <meta property="og:description" content="{{$og_description ?? $seo_setting->description}}">
    <meta property="og:image" content="{{ $og_image ?? asset('site_settings/' . $setting->logo) }}">
    <meta property="og:site_name" content="Openbox wale">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $og_url ?? url()->current() }}">
    <!-- TWITTER META -->

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@Openbox wale">
    <meta name="twitter:creator" content="@Openbox wale">
    <meta name="twitter:title" content="Openbox wale">
    <meta name="twitter:description" content="Openbox wale">
    <meta name="twitter:image" content="">


    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset("site_settings/$setting->favicon") }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset("site_settings/$setting->favicon") }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset("site_settings/$setting->favicon") }}" />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800&amp;display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/panzoom/panzoom.css" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /> -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/vendor/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/newstyles.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/f5.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/lite-yt-embed.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/intlTelInput.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/ispin/dist/ispin.css">
    <script defer src="https://unpkg.com/ispin"></script>
    <!-- Main Style CSS -->
    <!-- <link rel="stylesheet" href="assets/css/style.css" />     -->
    <link rel="stylesheet" href="https://unpkg.com/metismenu/dist/metisMenu.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>

    <!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=G-YTZV9BQ2DV"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-YTZV9BQ2DV'); </script>
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>

    {{-- Then, copy the tag below and paste it between the body tags (<body></body>) of all of your AMP pages --}}
    
    <!-- Google tag (gtag.js) --> <amp-analytics type="gtag" data-credentials="include"> <script type="application/json"> { "vars": { "gtag_id": "G-YTZV9BQ2DV", "config": { "G-YTZV9BQ2DV": { "groups": "default" } } }, "triggers": { } } </script> </amp-analytics>
    {{-- New addon --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <style>
        .homeSlider {
            min-height: 200px;
            display: flex;
            align-items: center;
            gap: 1rem;
            color:#000;
            img {
                width: 100vw;
            }
        }

        .homeSlider .owl-dots {
            text-align: center;
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background: #ffffff52;
            border-radius: 10px;
            padding-inline: 6px;
            backdrop-filter: blur(1px);
            border: 1px solid #ccc;
        }

        .homeSlider.owl-carousel button.owl-dot {
            background-color: #ccc !important;
            border-radius: 4px;
            border: none;
            width: 8px;
            height: 8px;
            margin-right: 4px;
        }

        .homeSlider.owl-carousel button.owl-dot.active {
            background-color: #0AA8E3 !important;
            width: 1.4rem;
        }

        /* .slider-contain {
            position: relative;
            .owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev, .owl-carousel button.owl-dot{
                padding-inline: 9px !important;
            }
        } */
        .slider-contain {
            position: relative;
            .owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev, .owl-carousel button.owl-dot {
                padding-inline: 9px !important;
                background-color: #fff;
                color: #000;
                font-size: 1.5rem;
                width: 2.3rem;
                border-radius: 4rem;
                border: 1px solid #ccc;
            }
        }

        /* .homeSlider .owl-nav {
            position: absolute;
            bottom: 35px;
            left: 50%;
            transform: translateX(-50%);
            width: 5rem;
            background: #fdfdfd99;
            border-radius: 17px;
            display: flex;
            justify-content: space-between;
            font-size: 15px;
            backdrop-filter: blur(1px);
        } */
        .homeSlider .owl-nav {
            position: absolute;
            width: 100%;
            bottom: 41%;
            transform: translateY(-50%);
            border-radius: 17px;
            display: flex;
            justify-content: space-between;
            font-size: 15px;
        }

        .custom-dots {
            text-align: center;
            margin-top: 10px;
            /* font-size: 18px; */
            /* font-weight: bold; */
            color: #000;
            position: absolute;
            bottom: 35px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
            display:none;
        }
        @media(width < 40rem){
            .homeSlider .owl-nav, .custom-dots{
                bottom: 10px;
                display:none;
            }
            .homeSlider{
                min-height:unset;
            }
            .slider-contain{
                margin-bottom:1rem;
            }
        }
    </style>

</head>
