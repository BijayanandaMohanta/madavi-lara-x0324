@extends('frontend.layouts.main')
@section('content')
    <div class="breadcrumb-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                    <div class="breadcrumb-content">
                        <ul class="nav">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li>Contact Us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid contactusbox">
        <div class="row mb-4">
            <div class="col-xxl-12 col-xl-12 col-lg-12">
                <h3 class="subpagetitle">Contact Us</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-12 pb-2">
                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <h4>We're always eager to hear from you!</h4>
                        <p>We Love to Help you with any Questions / Comments/ Ideas / Requests. Anything, We'd be happy to
                            help.</p>
                    </div>
                </div>
                <style>
                    .contaddressbox{
                        height: 100%;
                    }
                </style>
                <div class="row">
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 align-items-stretch">
                        <div class="contaddressbox">
                            <div class="conticon"><i class="fas fa-map-marker-alt"></i> </div>
                            <div class="contaddress">
                                <h5>Office address</h5>
                                <p>{{ $setting->address }}</p>
                                <p><strong>Retail :</strong>{{ $setting->retail_number }}</p>
                                <p><strong>Wholesale :</strong>{{ $setting->wholesale_number }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 align-items-stretch">
                        <div class="contaddressbox">
                            <div class="conticon"><i class="fas fa-map-marker-alt"></i> </div>
                            <div class="contaddress">
                                <h5>Store address</h5>
                                <p>{{ $setting->store_address }}</p>
                                <p><strong>Phone :</strong>{{ $setting->mobile_number }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 align-items-stretch">
                        <div class="contaddressbox">
                            <div class="conticon"><i class="fas fa-envelope"></i> </div>
                            <div class="contaddress">
                                <h5>Email Us</h5>
                                <p><a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        {{-- <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12617.285512789662!2d-122.42438069573352!3d37.75906194995649!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808f7e3c5f803323%3A0x35800073de45189!2sMission%20District%2C%20San%20Francisco%2C%20CA%2C%20USA!5e0!3m2!1sen!2sin!4v1722328801660!5m2!1sen!2sin"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                        {!! $setting->map_iframe !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center contactform">
            <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-12">
                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                        <h3>Fill the form below so we can get to know you <br>
                            and your needs better.</h3>
                    </div>
                </div>

                <form action="{{ route('contactsave') }}" method="POST" id="contactForm">
                    @csrf <!-- CSRF token for security -->

                    <!-- Display Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <div class="form-group">
                                <label for="first_name" class="star">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" oninput="validateFullName(this)">
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <div class="form-group">
                                <label for="last_name" class="star">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" oninput="validateFullName(this)">
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <div class="form-group">
                                <label for="email" class="star">Email</label>
                                <input type="email" class="form-control" name="email" id="email" >
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <div class="form-group">
                                <label for="mobile_no" class="star">Mobile No</label>
                                <input type="text" class="form-control" name="mobile_no" id="mobile_no" oninput="validatePhoneInput(this)">
                                <small id="mobile_no_error" class="text-danger" style="display: none;">Mobile number should not start with zero.</small>
                            </div>
                        </div>
                        <script>
                            function validateFullName(input) {
                                // Allow only alphabetic characters and spaces
                                input.value = input.value.replace(/[^A-Za-z\s]/g, '');
                            }
                        </script>
                        <script>
                            function validatePhoneInput(input) {
                                // Remove non-numeric characters
                                input.value = input.value.replace(/\D/g, '');
                        
                                // Remove leading zeros
                                input.value = input.value.replace(/^0+/, '');
                        
                                // Ensure the input does not exceed the max length
                                if (input.value.length > 10) {
                                    input.value = input.value.slice(0, 10);
                                }
                            }
                        </script>
                        <div class="col-xxl-12 col-xl-12 col-lg-12">
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" id="message" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-xl-12 col-lg-12 text-center pt-2">
                            <div class="form-group">
                                <button type="submit" class="btn-saveaddress">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Add custom validation method for names (alphabets and spaces only)
        $.validator.addMethod("customPattern", function(value, element, param) {
            return this.optional(element) || param.test(value);
        }, "Invalid input format.");

        // Initialize form validation
        $('#contactForm').validate({
            rules: {
                first_name: {
                    required: true,
                    customPattern: /^[A-Za-z\s]+$/ // Only alphabets and spaces
                },
                last_name: {
                    required: true,
                    customPattern: /^[A-Za-z\s]+$/ // Only alphabets and spaces
                },
                email: {
                    required: true,
                    email: true // Standard email validation
                },
                mobile_no: {
                    required: true,
                    number: true, // Only numbers
                    minlength: 10, // Exactly 10 digits
                    maxlength: 10
                },
                message: {
                    required: true,
                    maxlength: 500 // Optional, but max 500 characters
                }
            },
            messages: {
                first_name: {
                    required: 'First Name is required',
                    customPattern: 'First Name can only contain letters and spaces'
                },
                last_name: {
                    required: 'Last Name is required',
                    customPattern: 'Last Name can only contain letters and spaces'
                },
                email: {
                    required: 'Email is required',
                    email: 'Please enter a valid email address'
                },
                mobile_no: {
                    required: 'Mobile Number is required',
                    number: 'Mobile Number must be a number',
                    minlength: 'Mobile Number must be exactly 10 digits',
                    maxlength: 'Mobile Number must be exactly 10 digits'
                },
                message: {
                    required: 'Message is required',
                    maxlength: 'Message should not exceed 500 characters'
                }
            }
        });
    </script>
    <style>
        
        .error {
            font-size: 12px !important;
            color: red !important;
            text-transform: capitalize;
        }
    </style>
@endsection
