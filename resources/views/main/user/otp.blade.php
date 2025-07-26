@extends('main.layouts.main')
@section('title', 'User Login')
@section('content')
    <section class="login-box">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-lg-5 col-md-5 d-lg-block d-md-block d-none">
                    <img src="{{ asset('main_assets') }}/images/slider-layer-1.png" alt="" class="img-fluid">
                </div>
                <div class="col-lg-5 col-md-6 align-self-center">
                    <div class="loginform-box shadow-sm">
                        <h4><i class="fal fa-mobile fa-lg"></i> OTP Verification</h4>
                        <p>Code is sent to your +91 630 XXX XXXX</p>
                        <form action="dashboard-myprofile.php">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter OTP">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary d-block w-100">SUBMIT</button>
                            </div>
                            <p class="m-0 p-0 text-center">You didn't Receive Code</p>
                            <a href="#" class="resendcode">RESEND CODE</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
