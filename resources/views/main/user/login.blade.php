@extends('main.layouts.main')
@section('title', 'User OTP')
@section('content')
    <section class="login-box">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-lg-5 col-md-5 d-lg-block d-md-block d-none">
                    <img src="{{ asset('main_assets') }}/images/slider-layer-1.png" alt="" class="img-fluid">
                </div>
                <div class="col-lg-5 col-md-6 align-self-center">
                    <div class="loginform-box shadow-sm">
                        <h4><i class="fal fa-lock-alt"></i> Login</h4>
                        <p></p>
                        <form action="{{ route('users.otp') }}">
                            <div class="form-group">
                                <input type="number" id="phone" name="mobile" class="form-control w-100" placeholder="Mobile No.">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="referral_code" placeholder="Referral Code">
                            </div>
                            <input type="hidden" name="country_code" id="country_code" value="">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary d-block w-100">GET OTP</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
