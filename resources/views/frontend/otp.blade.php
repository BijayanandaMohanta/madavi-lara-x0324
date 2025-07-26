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

@php
    $setting = \App\Setting::first();
@endphp

<body>
    <section class="login-page">
        <div class="container-fluid ps-0">
            <div class="row align-items-center">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 d-none d-lg-block d-md-block">
                    <div class="login-bg">
                        <img src="{{ asset("site_settings/$setting->login_image") }}" class="img-fluid">
                        <div class="close-login">
                            <a href="{{ route('userlogin') }}">x</a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-7 col-sm-12 col-12  d-lg-none d-md-none d-block pt-4">
                    <div class="row justify-content-sm-center">
                        <div class="col-sm-12 text-center"><a href="{{ route('home') }}"><img height="60"
                                    src="{{ asset('frontend/images/logo.svg') }}" alt="logo.jpg"></a></div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                    <div class="row justify-content-sm-center py-1 d-lg-block d-none hidelogoupd">
                        <div class="col-sm-12 text-center"><a href="{{ route('home') }}"><img height="60"
                                    src="{{ asset("site_settings/$setting->logo") }}" alt="logo.jpg"></a></div>
                    </div>
                    <div class="login-content">
                        @if (session('failure'))
                            <div class="alert alert-danger">
                                {{ session('failure') }}
                            </div>
                        @endif
                        @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

                        <div class="otp-content mb-3">
                            <h4 class="mb-2">OTP VERIFICATION</h4>
                            <p>Please Enter the OTP Sent To<span class="d-block">{{ $customer->mobile }}. <a
                                        href="{{ route('userlogin') }}">Change</a></span></p>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <form method="POST" action="{{ route('customer-otp-verify') }}">
                                    <!-- #radio - hide/show -->
                                    @csrf
                                    <input type="hidden" name='action' value="{{ $action }}">
                                    <input type="hidden" name="token" value="{{ $customer->otp_token }}">
                                    <div class="hide-show-yes">
                                        <div class="mb-3">
                                            <div class="otp-screen">
                                                <input type="text" name="otp1" id="otp1" minlength="1"
                                                    maxlength="1" class="form-control half-wdth-field" required=""
                                                    data-next="#otp2" data-previous="null" autofocus>
                                                <input type="text" name="otp2" id="otp2" minlength="1"
                                                    maxlength="1" class="form-control half-wdth-field" required=""
                                                    data-next="#otp3" data-previous="#otp1">
                                                <input type="text" name="otp3" id="otp3" minlength="1"
                                                    maxlength="1" class="form-control half-wdth-field" required=""
                                                    data-next="#otp4" data-previous="#otp2">
                                                <input type="text" name="otp4" id="otp4" minlength="1"
                                                    maxlength="1" class="form-control half-wdth-field" required=""
                                                    data-next="#otp5" data-previous="#otp3">
                                                <input type="text" name="otp5" id="otp5" minlength="1"
                                                    maxlength="1" class="form-control half-wdth-field" required=""
                                                    data-next="#otp6" data-previous="#otp4">
                                                <input type="text" name="otp6" id="otp6" minlength="1"
                                                    maxlength="1" class="form-control half-wdth-field" required=""
                                                    data-next="null" data-previous="#otp5">
                                            </div>
                                        </div>
                                        <div class="button-box">
                                            <button type="submit" class="login-btn">Verify OTP</button>
                                           
                                        </div>
                                    </div>
                                    <!-- #yes -->

                                    <!-- #no -->
                                </form>
                                 <div class="login-toggle-btn mt-3 text-center">
                        <p class="gray">
                            Not Received Your Code?
                            <!--<span class="black" id="timer">10</span>-->
                        </p>
                        <form method="POST" action="{{ route('customer-resend-otp') }}" class="mt-3">
                            @csrf
                            <input type="hidden" name="token" value="{{ $customer->otp_token }}">
                            <button type="submit" class="btn btn-link">Resend OTP</button>
                        </form>
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.layouts.footerscripts')
    <script>
        $(document).ready(function() {
            let countdown = 10;
            $("#timer").text(countdown);

            let timer = setInterval(function() {
                countdown--;
                $("#timer").text(countdown);

                if (countdown <= 0) {
                    clearInterval(timer);
                }
            }, 1000);
        });
    </script>
    <script>
        document.querySelectorAll('.half-wdth-field').forEach((input) => {
            input.addEventListener('input', (e) => {
                if (e.target.value.length >= e.target.maxLength) {
                    let nextInput = document.querySelector(e.target.dataset.next);
                    if (nextInput) {
                        nextInput.focus();
                    }
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && e.target.value === '') {
                    let prevInput = document.querySelector(e.target.dataset.previous);
                    if (prevInput) {
                        prevInput.focus();
                    }
                }
            });
        });
    </script>
</body>

</html>
