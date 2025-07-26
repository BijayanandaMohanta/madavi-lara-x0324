@include('frontend.layouts.headerstyles')

<style>
    .hidden {
        display: none;
        /*   opacity: 0; */
    }

    .shown {
        display: visible;
        transition: all .5s ease-out;
        opacity: 1;
        color: red;
    }

    .toggle-password {
        position: absolute;
        right: 15px;
        font-size: 16px;
        top: 40px;
        color: #000;
    }
    @media (max-width: 1024px){
        .hidelogoupd{
            display:none!important;
        }
    }
</style>


<section class="login-page">
    <div class="container-fluid ps-0">
        <div class="row justify-content-sm-center py-1 logodisp">
            <div class="col-sm-12 text-center"><a href="{{ route('home') }}"><img height="60"
                        src="{{ asset("site_settings/$setting->logo") }}" alt="logo.jpg"></a></div>
        </div>
        <div class="row align-items-center">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 bgupdlogin">
                <div class="login-bg d-lg-block d-md-none d-none">
                    <img src="{{ asset("site_settings/$setting->login_image") }}" class="img-fluid">
<!--                    <div class="close-login">
                        <a href="{{ route('home') }}">x</a>
                    </div>-->
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 bglogform">
                 <div class="row justify-content-sm-center py-1 d-lg-block d-none hidelogoupd">
            <div class="col-sm-12 text-center"><a href="{{ route('home') }}"><img height="60"
                        src="{{ asset("site_settings/$setting->logo") }}" alt="logo.jpg"></a></div>
        </div>
                <div class="login-content">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home-tab-pane" type="button" role="tab"
                                aria-controls="home-tab-pane" aria-selected="true">Login</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                aria-controls="profile-tab-pane" aria-selected="false">Create Account</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                            aria-labelledby="home-tab" tabindex="0">
                            <div class="hide-show control-group mb-1">
                                <!-- radio - hide/show -->
                                <label class="control control--radio">Email
                                    <input type="radio" name="radio1" value="yes" checked="">
                                    <div class="control__indicator"></div>
                                </label>
                                <label class="control control--radio">Mobile
                                    <input type="radio" name="radio1" value="no" maxlength="10">
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                            <!-- #radio - hide/show -->
                            <div class="hide-show-yes">
                                <form action="{{ route('checklog') }}" method="POST" name="loginFormEmail"
                                    id="loginFormEmail" autocomplete="off">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control"
                                            value="{{ old('email') }}" autocomplete="" oninput="hideServerError()">
                                        @if ($errors->has('email'))
                                            <div class="text-danger serverError">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3" style="position: relative;">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" id="password1"
                                            autocomplete="" oninput="hideServerError()">
                                        <span toggle="#password1"
                                            class="far fa-fw fa-eye-slash field-icon toggle-password"
                                            style="cursor:pointer;"></span>
                                        @if ($errors->has('password'))
                                            <div class="text-danger serverError">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3 text-end">
                                        <a href="{{ route('forgetpassword') }}" class="frgtlink">Forgot Password?</a>
                                    </div>

                                    <script>
                                        function debounce(func, delay) {
                                            let timeout;
                                            return function(...args) {
                                                clearTimeout(timeout);
                                                timeout = setTimeout(() => func.apply(this, args), delay);
                                            };
                                        }

                                        const hideServerError = debounce(() => {
                                            const allErrors = document.getElementsByClassName('serverError');
                                            for (const error of allErrors) {
                                                error.style.display = 'none';
                                            }
                                        }, 300); // 300ms delay
                                    </script>
                                    <div class="button-box">
                                        <button type="submit" class="login-btn">Login</button>
                                        <div class="login-toggle-btn mt-3">
                                            <p>By Continuing, you agree to <a
                                                    href="{{ route('termsofservice') }}">Terms
                                                    of
                                                    use</a> &amp; <a href="{{ route('privacypolicy') }}">Privacy
                                                    policy</a></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- #yes -->
                            <div class="hide-show-no">
                                <form action="checklog" method="POST" name="loginFormMobile" id="loginFormMobile"
                                    autocomplete="off">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="d-block">Mobile No.</label>
                                        <input id="phone" name="phone" type="tel"
                                            value="{{ old('phone') }}" class="form-control w-100" maxlength="10"
                                            autocomplete="off" oninput="validatePhoneInput(this)">
                                        @if ($errors->has('phone'))
                                            <div class="text-danger serverError">{{ $errors->first('phone') }}</div>
                                        @endif
                                    </div>

                                    <script>
                                        function validatePhoneInput(input) {
                                            input.value = input.value.replace(/\D/g, '');
                                            input.value = input.value.replace(/^0+/, '');
                                            if (input.value.length > 10) {
                                                input.value = input.value.slice(0, 10);
                                            }
                                        }
                                    </script>
                                    <div class="button-box">
                                        <button type="submit" class="login-btn">Request OTP</button>
                                        <div class="login-toggle-btn mt-3">
                                            <p>By Continuing, you agree to <a
                                                    href="{{ route('termsofservice') }}">Terms
                                                    of
                                                    use</a> &amp; <a href="{{ route('privacypolicy') }}">Privacy
                                                    policy</a></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- #no -->

                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
                            aria-labelledby="profile-tab" tabindex="0">
                            <form action="{{ route('userregister') }}" method="POST" id="registerForm"
                                autocomplete="off">
                                @csrf
                                <!-- #radio - hide/show -->
                                <div class="hide-show-yes mt-5">
                                    <div class="mb-3">
                                        <label>Full Name</label>
                                        <input type="text" name="name" class="form-control"
                                            oninput="validateFullName(this)">
                                        {{-- @if ($errors->has('name'))
                                            <div class="text-danger">{{ $errors->first('name') }}</div>
                                        @endif --}}
                                    </div>

                                    <script>
                                        function validateFullName(input) {
                                            // Allow only alphabetic characters and spaces
                                            input.value = input.value.replace(/[^A-Za-z\s]/g, '');
                                        }
                                    </script>
                                    <div class="mb-3">
                                        <label class="d-block">Mobile No.</label>
                                        <input name="mobile" type="tel" value=""
                                            class="form-control w-100" oninput="validatePhoneInput(this)">
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                    <div style="position:relative;">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" id="password2">
                                        <span toggle="#password2"
                                            class="far fa-fw fa-eye-slash field-icon toggle-password"
                                            style="cursor:pointer"></span>
                                    </div>
                                    <div class="button-box1">
                                        <div class="cstcheck">
                                            <input type="checkbox" id="iirpe" name="promotional_email"
                                                value="1">
                                            <label for="iirpe">
                                                Interested In Receiving Promotional Emails
                                            </label>
                                        </div>
                                        <div class="cstcheck">
                                            <input type="checkbox" id="iirwam" name="promotional_whatsapp_message"
                                                value="1">
                                            <label for="iirwam">
                                                Interested In Receiving What's App Messages
                                            </label>
                                        </div>
                                        <button type="submit" class="login-btn mt-4">Create Account</button>
                                        <div class="button-box">
                                            <div class="login-toggle-btn mt-3">
                                                <p>By Creating the account, you agree to our <a
                                                        href="{{ route('termsofservice') }}">Terms of use</a> &amp; <a
                                                        href="{{ route('privacypolicy') }}">Privacy policy</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $.validator.addMethod("customPattern", function(value, element, param) {
        // Check if the value matches the provided regex pattern
        return this.optional(element) || param.test(value);
    }, "Invalid input format.");

    $.validator.addMethod("strictEmail", function(value, element) {
        // This regex enforces a valid email structure with a domain suffix
        return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
    }, "Please enter a valid email address.");

    $.validator.addMethod("noLeadingZero", function(value, element) {
        // Ensure the mobile number does not start with zero
        return this.optional(element) || !/^0/.test(value);
    }, "Mobile number cannot start with zero.");

    var registerValidator = $('#registerForm').validate({
        rules: {
            name: {
                required: true,
                // Use the custom method with the regex pattern
                customPattern: /^[A-Za-z\s]+$/
            },
            mobile: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10,
                noLeadingZero: true // Add the custom rule here
            },
            email: {
                required: true,
                email: true,
                strictEmail: true
            },
            password: {
                required: true,
                minlength: 8
            }
        },
        messages: {
            name: {
                required: 'Name is required',
                customPattern: 'Name can only contain letters and spaces'
            },
            mobile: {
                required: 'Mobile number is required',
                number: 'Mobile number must be a number',
                minlength: 'Mobile number must be at least 10 digits',
                maxlength: 'Mobile number must be at most 10 digits',
                noLeadingZero: 'Mobile number cannot start with zero' // Custom error message
            },
            email: {
                required: 'Email is required',
                email: 'Email must be valid'
            },
            password: {
                required: 'Password is required',
                minlength: 'Password must be at least 8 characters'
            }
        }
    });
</script>
<script>
    var loginValidator = $('#loginFormEmail').validate({
        rules: {

            email: {
                required: true,
                email: true
            },
            password1: {
                required: true
            }
        },
        messages: {

            email: {
                required: 'email is required',
                email: 'email must be valid'
            },
            password: {
                required: 'password is required',
                minlength: 'Password must be at least 8 characters'
            }
        }
    });
</script>
<script>
    $('#loginFormMobile').validate({
        rules: {
            phone: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            }
        },
        messages: {
            phone: {
                required: 'mobile number is required',
                number: 'mobile number must be a number',
                minlength: 'mobile number must be at least 10 digits',
                maxlength: 'mobile number must be at most 10 digits'
            }
        }
    });
</script>
<!-- Vendors JS -->
<style>
    .login-content .error {
        text-transform: capitalize;
    }
</style>


@include('frontend.layouts.footerscripts')
