@php
    // phpinfo();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Lexend:wght@100..900&display=swap');
        * {
            font-family: "Geist Mono", monospace !important;
        }
/* 
        .homeSlider {
            min-height: 200px;
            display: flex;
            align-items: center;
            gap: 1rem;

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

        .slider-contain {
            position: relative;
        }

        .homeSlider .owl-nav {
            position: absolute;
            bottom: 35px;
            left: 50%;
            transform: translateX(-50%);
            width: 4rem;
            background: #fdfdfd99;
            border-radius: 17px;
            display: flex;
            justify-content: space-between;
            font-size: 22px;
            padding-inline: 10px;
            backdrop-filter: blur(1px);
            font-weight: 900;
        }

        .custom-dots {
            text-align: center;
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
            position: absolute;
            bottom: 38px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
        } */
    </style>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" /> --}}
    <title>Testing route to check data and others</title>
</head>

<body>
    <small>Created by developer to check and other issues in production.</small>
    {{ dd($data ?? 'No data available') }}
    {{-- <div class="slider-contain">
        <div class="owl-carousel owl-theme homeSlider">
            <div class="item">
                <a href="https://www.openboxwale.in/product/oneplus-bullets-z2-bluetooth-wireless-in-ear-earphones-with-mic-bombastic-bass-10-mins-charge-20-hrs-music-30-hrs-battery-life-acoustic-red"
                    tabindex="0"><img alt="" class=""
                        src="https://openboxwale.in/public/uploads/banners/banner_image_1754329920.png"></a>
            </div>
            <div class="item">
                <a href="https://openboxwale.in/product/cultsport-forge-xr-143-rugged-amoled-barometer-altimeter-compass-strava-integratedblack"
                    tabindex="0"><img alt="" class=""
                        src="https://openboxwale.in/public/uploads/banners/banner_image_390729717.png"></a>
            </div>
            <div class="item">
                <a href="https://openboxwale.in/brand-product-products-collection/apple" tabindex="0"><img
                        alt="" class=""
                        src="https://openboxwale.in/public/uploads/banners/banner_image_1630599548.png"></a>
            </div>
        </div>
        <!-- Custom dots container -->
        <div class="custom-dots"></div>
    </div> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            var totalSlides = $('.homeSlider .item').length; // Total number of slides

            $('.homeSlider').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: false, // Disable default dots
                items: 1,
                onInitialized: updateDots,
                onTranslated: updateDots
            });

            // Function to update the custom dots with current slide number and total slides
            function updateDots(event) {
                var totalSlides = event.item.count; // Total number of slides
                var currentSlide = event.item.index + 1; // Current slide index (1-based)

                // Ensure the current slide number wraps correctly in loop mode
                if (currentSlide > totalSlides) {
                    currentSlide = currentSlide - totalSlides;
                }

                // Update the custom dots container with the current slide number
                $('.custom-dots').html('<span>' + currentSlide + ' / ' + totalSlides + '</span>');
            }
        });
    </script> --}}
</body>

</html>
