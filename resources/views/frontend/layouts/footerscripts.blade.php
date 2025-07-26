<!-- ===================================JS=========================================== -->
<!-- Vendors JS -->
<script src="{{ asset('frontend/assets/js/vendor/vendor.min.js') }}"></script>
{{-- <script src="{{ asset('frontend/assets/js/slick.min.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="{{ asset('frontend/assets/js/plugins/plugins.min.js') }}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> -->
<!-- Main Activation JS -->
<script src="{{ asset('frontend/assets/js/main.js') }}"></script>
<script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
<script src="{{ asset('frontend/assets/js/lite-yt-embed.js') }}"></script>
<script src="https://kit.fontawesome.com/18be827d01.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/metismenu"></script>
<script src="{{ asset('frontend/assets/js/intlTelInput.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sticky-sidebar/3.3.1/jquery.sticky-sidebar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
{{-- New addon --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    // $(document).ready(function() {
        // $('.homeSlider').on('initialized.owl.carousel', function(event) {
        //     $('.placeholder').fadeOut();
        //     $('.homeSlider').fadeIn();
        // });

        // $('.homeSlider').owlCarousel({
        //     loop: true,
        //     margin: 10,
        //     nav: false,
        //     dots: true,
        //     items: 1,
        //     autoplay: true,
        //     autoplayTimeout: 5000,
        //     autoplayHoverPause: true
        // });
    // });
    // $(document).ready(function() {
            var totalSlides = $('.homeSlider .item').length; // Total number of slides

            $('.homeSlider').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: false, // Disable default dots
                items: 1,
                onInitialized: updateDots,
                onTranslated: updateDots,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
            });

            // autoplay: true,
            // autoplayTimeout: 5000,
            // autoplayHoverPause: true,

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
        // });
</script>
<script>
    $("#categoriesmenu").metisMenu();
    $("#topmenu").metisMenu();
    $(function() {
        var minValueInput = $("#min-value");
        var maxValueInput = $("#max-value");

        $("#slider").slider({
            range: true,
            min: 0,
            max: 99999,
            values: [0, 99999],
            slide: function(event, ui) {
                minValueInput.val(ui.values[0]);
                maxValueInput.val(ui.values[1]);
            },
            change: function(event, ui) {
                minValueInput.val(ui.values[0]);
                maxValueInput.val(ui.values[1]);
            }
        });

        minValueInput.on("input change", function() {
            var minVal = parseInt(this.value, 10);
            var maxVal = parseInt(maxValueInput.val(), 10);
            if (minVal >= 0 && minVal <= maxVal) {
                $("#slider").slider("values", 0, minVal);
            }
        });

        maxValueInput.on("input change", function() {
            var maxVal = parseInt(this.value, 10);
            var minVal = parseInt(minValueInput.val(), 10);
            if (maxVal >= minVal && maxVal <= 99999) {
                $("#slider").slider("values", 1, maxVal);
            }
        });
    });
    const input = document.querySelector("#phone");
    const regiti = window.intlTelInput(input, {
        hiddenInput: () => "phone_full",
        initialCountry: "in",
        nationalMode: false,
        showFlags: false,
        separateDialCode: true,
    });
    window.iti = regiti; // useful for testing
    const reginput = document.querySelector("#regphone");
    const iti = window.intlTelInput(reginput, {
        hiddenInput: () => "phone_full",
        initialCountry: "in",
        nationalMode: false,
        showFlags: false,
        separateDialCode: true,
    });
    window.iti = iti; // useful for testing
</script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script> -->
<script src="https://kit.fontawesome.com/18be827d01.js" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
<script type="text/javascript">
    $("input:radio[name='toggler']").click(function() {
        $("#group1 .hidden").hide().removeClass("shown");
        $("#" + $(this).val()).show();
        setTimeout(function() {
            $(".hidden").addClass("shown");
        }, 0);
    });
</script>
<script type="text/javascript">
    $('.hide-show input').change(function() {
        $(this).closest('.hide-show').next('.hide-show-yes').toggle(this.value == 'yes').next('.hide-show-no')
            .toggle(this.value == 'no');
    }).filter(':checked').change();
</script>

{{-- <script>
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script> --}}
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/panzoom/panzoom.umd.js"></script>
    <script>
     const panzoomElements = document.querySelectorAll(".panzoom-item"); // Select all elements with the class

        panzoomElements.forEach((element) => {
        const options = { click: "toggleCover" };  // Your panzoom options
        new Panzoom(element, options);  // Initialize Panzoom for each element
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/lozad"></script>
<script type="text/javascript">
    // Initialize lozad
    lozad('.lozad', {
        load: function(el) {
            // Set the actual image source
            el.src = el.dataset.src;

            // Optional: Add a class or perform actions once the image is loaded
            el.onload = function() {
                el.classList.add('loaded'); // Add a class for styling (optional)
            };
        }
    }).observe();
</script>

{{-- <style>
    /* Skeleton Loading Effect */
.lozad {
    width: 100%; /* Adjust as needed */
    height: 200px; /* Adjust based on your image aspect ratio */
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 8px; /* Optional: Add rounded corners */
    display: block;
    object-fit: cover; /* Ensure the image fits well */
}

/* Skeleton Animation */
@keyframes skeleton-loading {
    0% {
        background-position: 200% 0;
    }
    100% {
        background-position: -200% 0;
    }
}

/* Show the image when it's loaded */
.lozad.loaded {
    background: none; /* Remove skeleton background */
    animation: none; /* Stop the skeleton animation */
}
</style> --}}
