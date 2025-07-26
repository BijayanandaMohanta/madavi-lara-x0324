<!-- Newsletter area start -->
<section class="home-newsletter">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-10 col-xl-10 col-lg-10">
                <div class="single">
                    <div class="single-image">
                        <h2><img src="{{ asset('frontend/images/newletter-image.png') }}" class="img-fluid"> SIGN UP TO
                            <span>Newsletter</span>
                        </h2>
                    </div>
                    <div class="input-group">
                        <input type="email" class="form-control" id="newsletteremail" placeholder="Email Address">
                        <span class="input-group-btn">
                            <button class="btn btn-theme" type="button" id='newsletter'>SIGN UP</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@php
    $setting = \App\Setting::first();
@endphp
<!-- Newsletter area end -->
<div class="footer-area">
    <div class="footer-container">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-4 col-md-6 col-lg-4 mb-md-30px mb-lm-30px">
                        <div class="single-wedge">
                            <img src="{{ asset("site_settings/$setting->footer_logo") }}"
                                alt="{{ asset("site_settings/$setting->site_name") }}" class="img-fluid">
                        </div>
                        <h5 class="pt-4 fz-18">STORE ADDRESS</h5>
                        <div class="footer-support footer-first-loc">
                            <div class="footer-img">
                                <img src="{{ asset('frontend/images/footer-location.png') }}" alt="">
                            </div>
                            <div class="footer-contact">
                                <small>{{ $setting->store_address }}</small>
                                <div><a href="{{ $setting->google_map_link }}" target="_blank" class="footermaplink"><i
                                            class="fal fa-map-location-dot"></i> Google Map</a> |
                                    <a href="{{ route('storegallery') }}"><i class="fal fa-camera"></i> Store
                                        Gallery</a>
                                </div>
                            </div>
                        </div>

                        <div class="social-info">
                            <h5 class="mb-3">FOLLOW US</h5>
                            <ul>
                                <li><a href="{{ $setting->facebook }}" target="_blank"><i
                                            class="fab fa-facebook-f"></i></a></li>
                                <li><a href="{{ $setting->instagram }}" target="_blank"><i
                                            class="fab fa-instagram"></i></a></li>
                                <li><a href="{{ $setting->linkedin }}" target="_blank"><i
                                            class="fab fa-telegram"></i></a></li>
                                <li><a href="{{ $setting->youtube }}" target="_blank"><i
                                            class="fab fa-youtube"></i></a></li>
                                <li><a href="{{ $setting->twitter }}" target="_blank"><i
                                            class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-xl-2 col-md-3 col-lg-2 col-sm-6 col-6 mb-md-30px mb-lm-30px">
                        <div class="single-wedge">
                            <h4 class="footer-herading">Let us help you</h4>
                            <div class="footer-links">
                                <ul>
                                    <li><a href="{{ route('userlogin') }}">Your Account</a></li>
                                    <li><a href="{{ route('userorders') }}">Your Orders</a></li>
                                    <li><a href="#">Search</a></li>
                                    <li><a href="{{ route('warranty') }}">Warranty</a></li>
                                    <li><a href="{{ route('aboutus') }}">About Us</a></li>
                                    {{-- <li><a href="{{ route('faq') }}">FAQ's</a></li> --}}
                                    <li><a href="{{ route('contactus') }}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-xl-2 col-md-3 col-lg-2 col-sm-6 col-6 mb-sm-30px mb-lm-30px">
                        <div class="single-wedge">
                            <h4 class="footer-herading">policies</h4>
                            <div class="footer-links">
                                <ul>
                                    <li><a href="{{ route('privacypolicy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ route('refundpolicy') }}">Refund Policy</a></li>
                                    <li><a href="{{ route('shoppingpolicy') }}">Shipping Policy</a></li>
                                    <li><a href="{{ route('termsofservice') }}">Terms of Service</a></li>
                                    <li><a href="{{ route('paymentpolicy') }}">Payment Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-md-12 col-lg-4 ">
                        <div class="footer-support">
                            <div class="footer-img">
                                <img src="{{ asset('frontend/images/foote.svg') }}" alt="">
                            </div>
                            <div class="footer-contact">
                                <small>Got questions? Call us Mon to Sat 12 to 7PM</small>
                                <h4 class="mt-2">{{ $setting->toll_free_number }}</h4>
                                <h4>8977744691(WhatsApp)</h4>
                            </div>
                        </div>
                        <div class="single-wedge">
                            <h4 class="footer-herading">beware of fakes</h4>
                            <div class="subscrib-text">
                                <p>{{ $setting->aware_message }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="copy-text"> © 2025 <strong>OPEN BOX RECOMMERCE INDIA LLP</strong> All Rights Reserved.
                        </p>
                    </div>
                    <div class="col-md-6 text-end">
                        <img class="payment-img" src="{{ asset('frontend/assets/images/icons/payment.png') }}"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer Area End -->


@include('frontend.layouts.footerscripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script>
    function addtowish(customer_id, product_id) {
        $.ajax({
            url: "{{ route('addtowishlist') }}", // Ensure the route is correct
            type: "GET",
            data: {
                customer_id: customer_id,
                product_id: product_id,
                _token: "{{ csrf_token() }}" // Ensure CSRF token is present for security
            },
            dataType: "json", // Ensure server returns JSON format
            success: function(response) {
                // Check if the server returned a 'success' status
                if (response.status === 'valid') {

                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonColor: "#232323",
                        cancelButtonColor: "#0AA8E3",
                        confirmButtonText: `Check Wishlist <i class="bi bi-heart-fill"></i>`,
                        cancelButtonText: `Continue Shopping`,
                        customClass: {
                            confirmButton: 'custom-confirm-button', // custom class for confirm button
                            cancelButton: 'custom-cancel-button' // custom class for cancel button
                        }
                    }).then((result) => {
                        if (result.isConfirmed == true) {
                            window.location.href = "{{ route('userwishlist') }}";
                        }
                    });

                    if (window.location.href == "{{ route('userwishlist') }}") {
                        window.location.reload();
                    }

                } else {

                    Swal.fire({
                        title: "Information!",
                        text: response.message,
                        icon: "warning",
                    })

                }
            },
            error: function(xhr, status, error) {
                //console.log(xhr.responseText); // Debug: Print error message in console
                // alert('Error occurred while adding product to cart.');
                Swal.fire({
                    title: "Information!",
                    text: "Need to login first!",
                    icon: "warning",
                })
                $('.addwishicon input[type=checkbox]').prop('checked', false);
            }
        });
    }

    function addToCart(productId, qty) {
        $.ajax({
            url: "{{ route('cart.add') }}", // Ensure the route is correct
            type: "GET",
            data: {
                id: productId,
                qty: qty,
                _token: "{{ csrf_token() }}" // Ensure CSRF token is present for security
            },
            dataType: "json", // Ensure server returns JSON format
            success: function(response) {
                // Check if the server returned a 'success' status
                if (response.status === 'valid') {
                    // if ("{{ Route::is('userwishlist') }}") {
                    //     addtowish("{{ Session::get('customer_id') }}",productId);
                    // }
                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonColor: "#232323",
                        cancelButtonColor: "#0AA8E3",
                        confirmButtonText: `Go to cart <i class="bi bi-cart2"></i>`,
                        cancelButtonText: `Continue Shopping`,
                        customClass: {
                            confirmButton: 'custom-confirm-button', // custom class for confirm button
                            cancelButton: 'custom-cancel-button' // custom class for cancel button
                        }
                    }).then((result) => {
                        if (result.isConfirmed == true) {
                            window.location.href = "{{ route('cart') }}";
                        }
                    });

                    $('#cart-count').attr('data-number', response.cart_count);
                    $("#cart_count_fetch").html(response.html);
                    @if (Route::is('cart'))
                        window.location.href = "{{ route('cart') }}";
                    @endif
                    // Update the text or inner content of the cart-count element
                    //  $('#cart-count').text(response.cart_count);

                } else {

                    Swal.fire({
                        title: "Information!",
                        text: response.message,
                        icon: "warning",
                    })

                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Debug: Print error message in console
                alert('Error occurred while adding product to cart.');
            }
        });
    }

    function buy_now(productId, qty, type = '') {

        $.ajax({
            url: "{{ route('cart.buy') }}", // Ensure the route is correct
            type: "GET",
            data: {
                id: productId,
                qty: qty,
                type: type,
                _token: "{{ csrf_token() }}" // Ensure CSRF token is present for security
            },
            dataType: "json", // Ensure server returns JSON format
            success: function(response) {
                if (response.status === 'valid') {
                    // Redirect to the URL received from the server
                    window.location.href = response.redirect_url;
                } else {
                    Swal.fire({
                        title: "Information!",
                        text: response.message,
                        icon: "warning",
                    })

                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Debug: Print error message in console
                alert('Error occurred while adding product to cart.');
            }
        });
    }

    function update_cart2(type, id) {
        var qty = $('#cartp_qty' + id).val(); // Get current quantity

        // Increase or decrease quantity based on the type parameter
        if (type === 'p') {
            qty = parseInt(qty) + 1;
        } else {
            qty = parseInt(qty) - 1;
        }

        // Ensure that the quantity is at least 1
        if (qty >= 1) {
            $.ajax({
                url: "{{ route('cart.update') }}",
                type: 'GET',
                data: {
                    qty: qty,
                    id: id, // Cart item ID
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        $("#shopcart").html(response.updated_cart_html);
                        $('#cart-count').attr('data-number', response.cart_count);
                        $("#cart_count_fetch").html(response.updated_cart_html1);
                    } else if (response.status == 'invalid') {
                        Swal.fire({
                            title: "Information!",
                            text: response.message,
                            icon: "warning",
                        })
                    } else {
                        var errorMessage =
                            '<div class="redBox"><i class="fa fa-exclamation-triangle"></i> ' + response
                            .message + '</div>';

                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "Error!",
                        text: "Some internal error happens.",
                        icon: "error",
                    })
                }
            });
        } else {

            Swal.fire({
                title: "Information!",
                text: "Quantity cannot be less than 1",
                icon: "warning",
            })

        }
    }

    function update_cart21(type, id) {
        var qty = $('#cartp_qty' + id).val(); // Get current quantity

        // Increase or decrease quantity based on the type parameter
        if (type === 'p') {
            qty = parseInt(qty) + 1;
        } else {
            qty = parseInt(qty) - 1;
        }

        // Ensure that the quantity is at least 1
        if (qty >= 1) {
            $.ajax({
                url: "{{ route('cart_data.update') }}",
                type: 'GET', // Use GET method
                data: {
                    qty: qty,
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    if (response.status == 'success') {
                        @if (Route::is('buy-now-make-payment'))
                            window.location.href = "{{ route('buy-now-make-payment') }}";
                        @endif
                        $("#shopcart").html(response
                            .updated_cart_html); // Assuming `shopcart` is the main cart container
                        $('#cart-count').attr('data-number', response.cart_count);
                        $("#cart_count_fetch").html(response.updated_cart_html2);
                        $("#cart_sum_table").html(response.updated_cart_html1);
                        $("#cart_sum_table1").html(response.updated_cart_html3);

                        // Optionally, you can show a success message if required
                        // alert("updated");
                    } else if (response.status == 'invalid') {
                        Swal.fire({
                            title: "Information!",
                            text: response.message,
                            icon: "warning",
                        })
                    } else {
                        var errorMessage =
                            '<div class="redBox"><i class="fa fa-exclamation-triangle"></i> ' + response
                            .message + '</div>';

                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "Error!",
                        text: "Some internal error happens.",
                        icon: "error",
                    })
                }
            });
        } else {
            // Handle case when quantity is less than 1 (e.g., prevent removing below 1)
            Swal.fire({
                title: "Information!",
                text: "Quantity cannot be less than 1",
                icon: "warning",
            })
        }
    }

    function incrementValue(e) {
        e.preventDefault();
        console.log('clicked');
        var fieldName = $(e.target).data('field');
        var parent = $(e.target).closest('div');
        var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
        if (!isNaN(currentVal)) {
            parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
        } else {
            parent.find('input[name=' + fieldName + ']').val(1);
        }
    }

    function decrementValue(e) {
        e.preventDefault();
        var fieldName = $(e.target).data('field');
        var parent = $(e.target).closest('div');
        var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
        if (!isNaN(currentVal) && currentVal > 1) {
            parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
        } else {
            parent.find('input[name=' + fieldName + ']').val(1);
        }
    }
    $('.input-group').on('click', '.button-plus', function(e) {
        incrementValue(e);
    });
    $('.input-group').on('click', '.button-minus', function(e) {
        decrementValue(e);
    });
</script>
<script>
    $(document).ready(function() {
        $('#submitReview').click(function() {
            // Collect form data
            var formData = {
                rating: $('input[name="rating"]:checked')
                    .val(), // Get the checked radio button value
                review: $('textarea[name="review"]').val(), // Get the review text
                product_id: $('input[name="product_id"]').val(), // Get the product ID
                _token: '{{ csrf_token() }}' // CSRF token for protection
            };

            // Validate the form
            if (!formData.rating) {
                alert('Please select a rating.');
                return;
            }
            if (!formData.review) {
                alert('Please enter your review.');
                return;
            }

            // AJAX request
            $.ajax({
                url: '{{ route('rating_submit') }}', // Ensure this matches your route name
                type: 'GET', // Change to POST to match your route
                data: formData,
                success: function(response) {
                    // Handle the response from the server
                    // alert('Review submitted successfully!');
                    Swal.fire({
                        title: "Information!",
                        text: "Review submitted successfully!",
                        icon: "success",
                    })
                    // Refresh the page
                    location.reload(); // This will reload the current page
                },
                error: function(xhr) {
                    // Handle errors
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        var errorMessage = '';
                        $.each(errors, function(key, value) {
                            errorMessage += value[0] +
                                "\n"; // Concatenate error messages
                        });
                        alert(errorMessage);
                    } else {
                        Swal.fire({
                            title: "Information!",
                            text: "Something went wrong! Please try again later.",
                            icon: "warning",
                        })
                        // alert('Something went wrong! Please try again later.');
                    }
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#submitUpdateReview').click(function() {
            // Collect form data
            var formData = {
                rating: $('input[name="rating"]:checked')
                    .val(), // Get the checked radio button value
                review: $('textarea[name="review"]').val(), // Get the review text
                product_id: $('input[name="product_id"]').val(), // Get the product ID
                _token: '{{ csrf_token() }}' // CSRF token for protection
            };

            // Validate the form
            if (!formData.rating) {
                alert('Please select a rating.');
                return;
            }
            if (!formData.review) {
                alert('Please enter your review.');
                return;
            }

            // AJAX request
            $.ajax({
                url: '{{ route('rating_update') }}', // Ensure this matches your route name
                type: 'POST', // Change to POST to match your route
                data: formData,
                success: function(response) {

                    Swal.fire({
                        title: "Information!",
                        text: "Review updated successfully!",
                        icon: "success",
                    })
                    // Refresh the page
                    location.reload(); // This will reload the current page
                },
                error: function(xhr) {
                    // Handle errors
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        var errorMessage = '';
                        $.each(errors, function(key, value) {
                            errorMessage += value[0] +
                                "\n"; // Concatenate error messages
                        });
                        alert(errorMessage);
                    } else {
                        Swal.fire({
                            title: "Information!",
                            text: "Something went wrong! Please try again later.",
                            icon: "warning",
                        })
                        // alert('Something went wrong! Please try again later.');
                    }
                }
            });
        });
    });
</script>
<script>
    function removeCart(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0AA8E3',
            cancelButtonColor: '#232323',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('cart.remove') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == "valid") {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonColor: '#0AA8E3',
                            })
                            setTimeout(function() {
                                location.reload();
                            })
                        }
                    }
                })
            }
        })
    }
</script>
<script>
    function notify(product_id) {
        $.ajax({
            type: "POST",
            url: "{{ route('notify') }}",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: product_id
            },
            dataType: "json",
            success: function(response) {
                if (response.status == "success") {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonColor: '#0AA8E3',
                    })
                } else {
                    Swal.fire({
                        title: 'Information!',
                        text: response.message,
                        icon: 'warning',
                    })
                }
            }
        });
    }
</script>
<script>
    $('#newsletter').on('click', () => {
        const email = $('#newsletteremail').val();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email pattern

        if (email === '') {
            Swal.fire({
                title: 'Information!',
                text: 'Please enter your email address.',
                icon: 'warning',
            });
        } else if (!emailPattern.test(email)) {
            Swal.fire({
                title: 'Error!',
                text: 'Please enter a valid email address.',
                icon: 'error',
            });
        } else {
            $.ajax({
                type: "POST",
                url: "{{ route('newsletter') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    email: email
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == "success") {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonColor: '#0AA8E3',
                        })
                        $('#newsletteremail').val('');
                    } else {
                        Swal.fire({
                            title: 'Information!',
                            text: response.message,
                            icon: 'warning',
                        })
                    }
                }
            });
        }
    })
</script>
<script>
    $(document).on('click', '#button-addon1', function() {
        let pincode = $('#pincode').val(); // Get the pincode value

        if (!pincode) {
            Swal.fire({
                icon: 'error', // Icon for the alert (error, success, warning, info, question)
                title: 'Invalid Pincode', // Title of the alert
                text: 'Pincode must be exactly 6 digits and cannot start with zero.', // Message to display
                confirmButtonText: 'OK', // Text for the confirm button
                confirmButtonColor: '#3085d6', // Color for the confirm button
            });
            $('#pincode_error').hide();
            return;
        }

        $.ajax({
            url: "{{ route('check_delivery') }}",
            type: 'GET',
            data: {
                _token: "{{ csrf_token() }}", // Pass the CSRF token
                pincode: pincode
            },
            success: function(response) {
                if (response.success) {
                    // Update the delivery estimate dynamically
                    $('#delivery-estimate').html(`${response.latest_etd}`);
                    $('#pincode_error').hide();
                } else {
                    // Handle the case when no delivery estimate is found
                    $('#delivery-estimate').html('No Estimated Delivery Date Available.');
                    $('#pincode_error').hide();
                }
            },
            error: function(xhr) {
                // Handle errors during the AJAX request
                // alert('Failed to fetch delivery estimate. Please try again.');
              
                // $('#pincode_error').hide();
                // $('#delivery-estimate').html('Error fetching delivery estimate.');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Handle click on progress bar
        $('.productviewreviewbar').click(function() {
            let rating = $(this).data('rating'); // Get the selected rating from data attribute
            let productId = {{ $ppid ?? 0 }}; // Assuming product ID is available in the view

            // AJAX request to filter reviews
            $.ajax({
                url: "{{ route('filter_review') }}",
                type: 'GET',
                data: {
                    rating: rating,
                    product_id: productId
                },
                success: function(response) {
                    let reviewsContainer = $('#reviews-container');
                    reviewsContainer.empty(); // Clear existing reviews

                    // Check if response has reviews
                    if (response && response.length > 0) {
                        response.forEach(review => {
                            // Calculate stars
                            let fullStars = Math.floor(review.rating);
                            let halfStar = review.rating - fullStars >= 0.5;
                            let stars = '';

                            for (let i = 1; i <= 5; i++) {
                                if (i <= fullStars) {
                                    stars +=
                                        '<i class="ion-android-star"></i>'; // Full star
                                } else if (halfStar && i === fullStars + 1) {
                                    stars +=
                                        '<i class="ion-android-star-half"></i>'; // Half star
                                } else {
                                    stars +=
                                        '<i class="ion-android-star grey"></i>'; // Empty star
                                }
                            }

                            // Generate HTML for each review
                            let reviewHtml = `
                            <div class="review">
                                <div class="stars">
                                    <span class="black fw-600">${parseFloat(review.rating).toFixed(1)}</span>
                                    ${stars}
                                </div>
                                <div class="comment">${review.review}</div>
                                <div class="name">${review.name || 'Anonymous'} - 
                                    <span>${new Date(review.created_at).toLocaleDateString()}</span>
                                </div>
                            </div>
                        `;
                            // Append the review to the container
                            reviewsContainer.append(reviewHtml);
                        });
                    } else {
                        // Display no reviews message if response is empty
                        reviewsContainer.append(
                            '<div class="reviewsouter"><span style="color: grey;">No Review Found</span></div>'
                        );
                    }
                },
                error: function() {
                    // Handle errors
                    alert('Failed to fetch reviews. Please try again.');
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(".search").keyup(function() {
            var c = $(this).val();
            var a = $(".search_result");
            var b = $(".result");
            $(".search_header span").html(c);
            if (c != "") {
                // b.html('<div class="search_loading"><img src="assets/images/loading.gif" /></div>');
                a.slideDown();
                $.ajax({
                    url: "{{ route('realtime_search_result') }}",
                    method: "post",
                    data: {
                        search: c,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: "json",
                    success: function(d) {
                        setTimeout(function() {
                            b.html(d.html);
                            var g = $(".search_result ul");
                            var e = $(".search_result ul li");
                            var f = e.height();
                            g.css({
                                "max-height": (f * 6) + 5
                            })
                        }, 1000);
                    }
                });
            } else {
                b.html("");
                a.slideUp();
            }
        });
    });
</script>
<!--Start of Tawk.to Script-->
{{-- <script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/675c2815af5bfec1dbdb5ec9/1ievvp63n';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script> --}}
<!--End of Tawk.to Script-->
<style>
    .swal2-container>* {
        font-size: .8rem;
    }

    @media (min-width: 768px) {
        .widget-visible {
            display: none !important;
        }
    }
</style>


</body>

</html>
