<!-- ===================================JS=========================================== -->
<!-- Vendors JS -->
<script src="assets/js/vendor/vendor.min.js"></script>

<script src="assets/js/plugins/plugins.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> -->
<!-- Main Activation JS -->
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/custom.js"></script>
<script src="https://kit.fontawesome.com/18be827d01.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/metismenu"></script>
<script src="assets/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sticky-sidebar/3.3.1/jquery.sticky-sidebar.min.js" integrity="sha512-5JnN0KAeC4m2DFuyFM/NooqJs5ZAGV/RQ27bS1ItFhFU8tMPTtEhF5utip7GlNRsoGS0qAGUJvcRiMmL0PYWjA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" integrity="sha512-0bEtK0USNd96MnO4XhH8jhv3nyRF0eK87pJke6pkYf3cM0uDIhNJy9ltuzqgypoIFXw3JSuiy04tVk4AjpZdZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $("#categoriesmenu").metisMenu();
    $("#topmenu").metisMenu();
    $(function() {
            var minValueInput = $("#min-value");
            var maxValueInput = $("#max-value");

            $("#slider").slider({
                range: true,
                min: 0,
                max: 24990,
                values: [0, 24990],
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
                if (maxVal >= minVal && maxVal <= 24990) {
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
integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
<script src="https://kit.fontawesome.com/18be827d01.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/panzoom/panzoom.umd.js"></script>
    <script>
     const panzoomElements = document.querySelectorAll(".panzoom-item"); // Select all elements with the class

        panzoomElements.forEach((element) => {
        const options = { click: "toggleCover" };  // Your panzoom options
        new Panzoom(element, options);  // Initialize Panzoom for each element
        });
    </script>