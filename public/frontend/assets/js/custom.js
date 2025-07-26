$(document).ready(function () {
    setInterval(function () {
        $("#popup").fadeIn();
        setTimeout(function () {
            $("#popup").fadeOut();
        }, 5000); // Hide after 30 seconds
    }, 120000); // Show every 2 minutes (120 seconds)

    $("#closePopup").click(function () {
        $("#popup").fadeOut();
    });
    $(window).on("load", function () {
        setTimeout(function () {
            $(".loader").fadeOut(2000); // Hide the loader with a fade-out effect
        }, 5000); // 5-second delay
    });
});

//main-slider
/*New Arrivals*/

$(window).on("load", function () {
    $(".main-slider").slick({
        dots: true,
        arrows: true,
        infinite: true,
        centerMode: true,
        centerPadding: "20%",
        slidesToShow: 1,
        slidesToScroll: 1,
        lazyLoad: "ondemand",
        autoplay: true,
        autoplaySpeed: 5000,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    centerMode: false,
                    centerPadding: "0%",
                },
            },
        ],
    });
});

/*New Arrivals*/
$(".new-arrivals").slick({
    dots: false,
    infinite: false,
    centerMode: false,
    slidesToShow: 5,
    autoplay: true,
    autoplaySpeed: 3000,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 2000,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 1,
                infinite: true,
            },
        },

        {
            breakpoint: 1691,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 1,
                infinite: true,
            },
        },

        {
            breakpoint: 1500,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: true,
            },
        },
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 2,
            },
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            },
        },
        {
            breakpoint: 360,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

$(document).ready(function () {
    let fiveMinutes = 5 * 60 * 1000;
    setTimeout(function () {
        $("#popup").fadeIn();
    }, fiveMinutes);

    $("#closePopup").click(function () {
        $("#popup").fadeOut();
    });
});

/*Category*/
$(".category-slider").slick({
    dots: false,
    infinite: false,
    centerMode: false,
    autoplay: true,
    autoplaySpeed: 3000,
    slidesToShow: 5,
    slidesToScroll: 1,

    responsive: [
        {
            breakpoint: 2400,
            settings: {
                slidesToShow: 8,
                slidesToScroll: 1,
                infinite: true,
            },
        },
        {
            breakpoint: 2000,
            settings: {
                slidesToShow: 8,
                slidesToScroll: 1,
                infinite: true,
            },
        },

        {
            breakpoint: 1691,
            settings: {
                slidesToShow: 7,
                slidesToScroll: 1,
                infinite: true,
            },
        },

        {
            breakpoint: 1500,
            settings: {
                slidesToShow: 7,
                slidesToScroll: 1,
                infinite: true,
            },
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 2,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 2,
            },
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            },
        },
    ],
});

/*Testimonial*/
$(".testimonial").slick({
    dots: true,
    infinite: false,
    centerMode: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    responsive: [
        {
            breakpoint: 2400,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: true,
            },
        },
        {
            breakpoint: 2000,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: true,
            },
        },

        {
            breakpoint: 1691,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
            },
        },

        {
            breakpoint: 1500,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
            },
        },
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
            },
        },

        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

/*smart-wearables*/
$(".smart-wearables").slick({
    dots: false,
    infinite: false,
    autoplay: true,
    autoplaySpeed: 3000,
    centerMode: false,
    slidesToShow: 5,
    slidesToScroll: 1,

    responsive: [
        {
            breakpoint: 2000,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 1,
                infinite: true,
            },
        },

        {
            breakpoint: 1691,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: true,
            },
        },

        {
            breakpoint: 1500,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
            },
        },
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 577,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 360,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

/*offers-slider*/
$(".offers-slider").slick({
    dots: true,
    infinite: false,
    centerMode: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
        {
            breakpoint: 2000,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
            },
        },

        {
            breakpoint: 1691,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
            },
        },

        {
            breakpoint: 1500,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
            },
        },

        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

/*ads-slider*/
$(".ads-slider").slick({
    dots: true,
    infinite: true,
    centerMode: true,
    slidesToShow: 3,
    slidesToScroll: 1,

    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 2,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
            },
        },
    ],
});

/*smart-wearables*/
$(".brand-slider").slick({
    dots: false,
    infinite: true,
    centerMode: false,
    slidesToShow: 7,
    slidesToScroll: 1,

    responsive: [
        {
            breakpoint: 2000,
            settings: {
                slidesToShow: 7,
                slidesToScroll: 1,
                infinite: true,
            },
        },

        {
            breakpoint: 1691,
            settings: {
                slidesToShow: 7,
                slidesToScroll: 1,
                infinite: true,
            },
        },

        {
            breakpoint: 1500,
            settings: {
                slidesToShow: 6,
                slidesToScroll: 1,
                infinite: true,
            },
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 2,
            },
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 2,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
    ],
});

/*Video slider*/
$(document).ready(function () {
    $(".video-slider").slick({
        centerMode: false,
        dots: true,
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 7000,
        responsive: [
            {
                breakpoint: 1190,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: "40px",
                    slidesToShow: 4,
                },
            },
            {
                breakpoint: 992,
                settings: {
                    arrows: true,
                    centerMode: true,
                    centerPadding: "40px",
                    slidesToShow: 3,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: true,
                    centerMode: true,
                    centerPadding: "40px",
                    slidesToShow: 3,
                },
            },
            {
                breakpoint: 577,
                settings: {
                    arrows: true,
                    centerMode: true,
                    centerPadding: "40px",
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    centerMode: true,
                    centerPadding: "0px",
                    slidesToShow: 2,
                },
            },
        ],
    });

    //producthuhms slider
    $(".productslider-for").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: ".productslider-nav",
        responsive: [
            {
                breakpoint: 576,
                settings: {
                    arrows: true,
                    autoplay: true,
                },
            },
        ],
    });
    $(".productslider-nav").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        vertical: true,
        verticalSwiping: true,
        asNavFor: ".productslider-for",
        dots: false,
        centerMode: true,
        focusOnSelect: true,
    });

    //relatedmodelsscroll
    $(".relatedproducts-slider").slick({
        dots: false,
        infinite: false,
        centerMode: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                },
            },
        ],
    });

    $(document).ready(function () {
        $("#reviewHeight").click(function (e) {
            e.preventDefault();
            $(".reviewsouter").css("overflow-y", "scroll");
        });
        var sidebar = new StickySidebar(".product-details-area-left", {
            topSpacing: 70,
            bottomSpacing: -100,
            containerSelector: ".product-details-area",
            innerWrapperSelector: ".prostickyoverall",
        });
    });

    // Custom function to play the video on the active slide
    function playActiveSlideVideo() {
        // Pause all videos
        $(".video-slider video").each(function () {
            this.pause();
        });

        // Play the video in the center slide
        var centerSlide = $(".video-slider .slick-center video")[0];
        if (centerSlide) {
            centerSlide.play();
        }
    }

    // Play the video when the slide changes
    $(".video-slider").on("afterChange", function (event, slick, currentSlide) {
        playActiveSlideVideo();
    });

    // Initial play
    playActiveSlideVideo();
});

document.addEventListener("DOMContentLoaded", function () {
    var spinner = new ISpin(document.getElementById("number-input"), {
        // options with defaults
        wrapperClass: "ispin-wrapper",
        buttonsClass: "ispin-button",
        step: 1,
        pageStep: 10,
        disabled: false,
        repeatInterval: 200,
        wrapOverflow: false,
        parse: Number,
        format: String,
        min: 1, // Set your minimum value here
        max: 100,
    });
});

// $(document).ready(function(){
//   $('#cartitembox').click(function(){
//     alert();
//     $('.cartitems').toggle(1000);
//   })
// })

$(document).ready(function () {
    $("#coupon-code").click(function () {
        // Select the content of the input field
        $(this).select();
        document.execCommand("copy");
        alert("Coupon code copied to clipboard!");
    });
});
