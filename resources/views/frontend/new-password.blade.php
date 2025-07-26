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
</style>

<body>
    <section class="login-page">
        <div class="container-fluid ps-0">
            <div class="row align-items-center">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-5 d-none d-lg-block d-md-block">
                    <div class="login-bg">
                        <img src="{{ asset("site_settings/$setting->login_image") }}" class="img-fluid">
                        <div class="close-login">
                            <a href="{{ route('home') }}">x</a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-7 col-sm-12 col-12">
                    <div class="row justify-content-sm-center py-1 d-lg-block d-none hidelogoupd">
                        <div class="col-sm-12 text-center"><a href="{{ route('home') }}"><img height="60"
                                    src="{{ asset("site_settings/$setting->logo") }}" alt="logo.jpg"></a></div>
                    </div>
                    <div class="login-content">
                        <div class="otp-content mb-3">
                            <h4 class="mb-2">NEW PASSWORD</h4>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <form action="{{ route('new_password_change') }}" method="POST" id="otpForm"
                                    autocomplete="off">
                                    @csrf
                                    <!-- #radio - hide/show -->

                                    <input type="hidden" name="mobile" value={{$customer->mobile}}>
                                    <input type="hidden" name="token" value={{$token}}>

                                    <div class="hide-show-yes">

                                        <div class="mb-3">
                                            <label>Password</label>
                                            <input type="password" name="new_password" id="new_password"
                                                class="form-control" placeholder="Enter New Password"
                                                autocomplete="">
                                        </div>
                                        <div style="position:relative;" class="mb-3">
                                            <label>Re-enter Password</label>
                                            <input type="password" name="password" id="password2" class="form-control"
                                                placeholder="Re-enter New Password" autocomplete="">
                                            <span toggle="#password2"
                                                class="far fa-fw fa-eye-slash field-icon toggle-password"
                                                style="cursor:pointer"></span>
                                        </div>


                                        <div class="button-box mb-2">
                                            <button type="submit" class="login-btn">Submit</button>
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
    <!-- Vendors JS -->
    @include('frontend.layouts.footerscripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            // jQuery validation for the form
            $("#otpForm").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 8
                    },
                    new_password: {
                        required: true
                    }
                },
                messages: {
                    password: {
                        required: "Please enter your password.",
                        minlength: "Your password must be at least 8 digits long."
                    },
                    new_password: {
                        required: "Please enter your new password."
                    }
                }
            });
        });
    </script>
</body>

</html>
